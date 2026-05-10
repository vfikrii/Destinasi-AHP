<?php

namespace App\Services;

use App\Models\Alternatif;
use App\Models\GuestRating;
use App\Models\Ir;
use App\Models\Kriteria;
use App\Models\PerbandinganKriteria;
use App\Models\PvKriteria;
use App\Models\SkalaAhp;
use Illuminate\Support\Facades\DB;

class AhpCalculationService
{
    /**
     * Bangun matriks perbandingan berpasangan n×n dari input form (Kriteria).
     */
    public function buildPairwiseMatrix(array $formData, int $n): array
    {
        $matrik = [];
        $urut = 0;

        for ($x = 0; $x <= ($n - 2); $x++) {
            for ($y = ($x + 1); $y <= ($n - 1); $y++) {
                $urut++;
                $pilih = (int) ($formData["pilih{$urut}"] ?? 1);
                $bobot = max((float) ($formData["bobot{$urut}"] ?? 1), 0.001);

                if ($pilih === 1) {
                    $matrik[$x][$y] = $bobot;
                    $matrik[$y][$x] = 1 / $bobot;
                } else {
                    $matrik[$x][$y] = 1 / $bobot;
                    $matrik[$y][$x] = $bobot;
                }
            }
        }

        for ($i = 0; $i < $n; $i++) {
            $matrik[$i][$i] = 1;
        }

        return $matrik;
    }

    public function calculateColumnSums(array $matrik, int $n): array
    {
        $sums = array_fill(0, $n, 0.0);

        for ($x = 0; $x < $n; $x++) {
            for ($y = 0; $y < $n; $y++) {
                $sums[$y] += $matrik[$x][$y];
            }
        }

        return $sums;
    }

    public function normalizeAndCalculatePV(array $matrik, array $colSums, int $n): array
    {
        $matrikb = [];
        $rowSums = array_fill(0, $n, 0.0);
        $pv = [];

        for ($x = 0; $x < $n; $x++) {
            for ($y = 0; $y < $n; $y++) {
                $matrikb[$x][$y] = $colSums[$y] != 0 ? $matrik[$x][$y] / $colSums[$y] : 0;
                $rowSums[$x] += $matrikb[$x][$y];
            }
            $pv[$x] = $n > 0 ? $rowSums[$x] / $n : 0;
        }

        return [
            'matrikb' => $matrikb,
            'jmlmnk'  => $rowSums,
            'pv'      => $pv,
        ];
    }

    public function calculateEigenVector(array $colSums, array $rowSums, int $n): float
    {
        $eigen = 0.0;
        for ($i = 0; $i < $n; $i++) {
            $eigen += $colSums[$i] * ($rowSums[$i] / $n);
        }
        return $eigen;
    }

    public function calculateConsistencyIndex(float $eigen, int $n): float
    {
        return $n <= 1 ? 0 : ($eigen - $n) / ($n - 1);
    }

    public function calculateConsistencyRatio(float $ci, int $n): float
    {
        $ir = $this->getRandomIndex($n);
        return $ir > 0 ? $ci / $ir : 0;
    }

    public function getRandomIndex(int $n): float
    {
        return (float) (Ir::find($n)?->nilai ?? 0);
    }

    public function processComparison(array $formData, int $n): array
    {
        $matrik = $this->buildPairwiseMatrix($formData, $n);
        $colSums = $this->calculateColumnSums($matrik, $n);
        $norm = $this->normalizeAndCalculatePV($matrik, $colSums, $n);

        $eigen = $this->calculateEigenVector($colSums, $norm['jmlmnk'], $n);
        $ci = $this->calculateConsistencyIndex($eigen, $n);
        $cr = $this->calculateConsistencyRatio($ci, $n);

        return [
            'matrik'      => $matrik,
            'matrikb'     => $norm['matrikb'],
            'jmlmpb'      => $colSums,
            'jmlmnk'      => $norm['jmlmnk'],
            'pv'          => $norm['pv'],
            'eigenvektor' => $eigen,
            'consIndex'   => $ci,
            'consRatio'   => $cr,
        ];
    }

    public function savePvKriteria(array $ids, array $pvValues): void
    {
        DB::transaction(function () use ($ids, $pvValues) {
            foreach ($ids as $i => $id) {
                PvKriteria::updateOrCreate(
                    ['id_kriteria' => $id],
                    ['nilai' => $pvValues[$i]]
                );
            }
        });
    }

    public function savePerbandinganKriteria(array $ids, array $matrik, int $n): void
    {
        DB::transaction(function () use ($ids, $matrik, $n) {
            for ($x = 0; $x <= ($n - 2); $x++) {
                for ($y = ($x + 1); $y <= ($n - 1); $y++) {
                    PerbandinganKriteria::updateOrCreate(
                        ['kriteria1' => $ids[$x], 'kriteria2' => $ids[$y]],
                        ['nilai' => $matrik[$x][$y]]
                    );
                }
            }
        });
    }

    public function getStoredKriteriaComparisons(): array
    {
        $comparisons = PerbandinganKriteria::all();
        $mapped = [];
        foreach ($comparisons as $c) {
            $mapped[$c->kriteria1][$c->kriteria2] = $c->nilai;
        }
        return $mapped;
    }

    /* ── Absolute Measurement AHP (Rating System) ────────────────────────── */

    /**
     * Dapatkan mapping Skala Bintang -> Nilai AHP (Misal 5 -> 9, 4 -> 7, dst)
     */
    private function getSkalaMapping(): array
    {
        return SkalaAhp::pluck('nilai_ahp', 'bintang')->toArray();
    }

    /**
     * Hitung Global Ranking (Rata-rata dari semua User).
     */
    public function calculateGlobalRanking(): array
    {
        $kriteriaList = Kriteria::with('pvKriteria')->orderBy('id')->get();
        $alternatifList = Alternatif::orderBy('id')->get();
        $skalaMapping = $this->getSkalaMapping();

        // Ambil semua rating dan group by alternatif_id
        $allRatings = GuestRating::all()->groupBy('alternatif_id');

        $rankings = [];

        foreach ($alternatifList as $alt) {
            $totalScore = 0.0;
            $altRatings = $allRatings->get($alt->id) ?? collect();

            // Jika belum ada yang merating alternatif ini sama sekali, skip dari Global Ranking
            if ($altRatings->isEmpty()) {
                continue; 
            }

            foreach ($kriteriaList as $krit) {
                $pvKrit = $krit->pvKriteria?->nilai ?? 0;
                
                // Ambil rata-rata rating Bintang untuk Kriteria ini pada Alternatif ini
                $ratingsForKrit = $altRatings->where('kriteria_id', $krit->id);
                $avgBintang = $ratingsForKrit->avg('rating_bintang') ?? 0;
                
                // Konversi rata-rata bintang ke skala AHP
                // Kita gunakan pembulatan ke skala terdekat jika rata-rata desimal (opsional, tapi untuk simpel kita interpolasi atau ambil bintang terdekat)
                // Paling akurat: cari nilai_ahp berdasarkan bintang bulat terdekat
                $roundedBintang = round($avgBintang);
                $nilaiAhp = $skalaMapping[$roundedBintang] ?? 0;

                $totalScore += ($nilaiAhp * $pvKrit);
            }

            $rankings[] = [
                'id_alternatif' => $alt->id,
                'nama' => $alt->nama,
                'nilai' => $totalScore
            ];
        }

        // Urutkan DESC (Peringkat 1 = nilai tertinggi)
        usort($rankings, fn($a, $b) => $b['nilai'] <=> $a['nilai']);

        return [
            'rankings' => $rankings,
            'kriteriaList' => $kriteriaList
        ];
    }

    /**
     * Hitung Personal Ranking (Hanya untuk tempat yang dinilai oleh 1 User).
     */
    public function calculatePersonalRanking(int $userId): array
    {
        $kriteriaList = Kriteria::with('pvKriteria')->orderBy('id')->get();
        $skalaMapping = $this->getSkalaMapping();

        // Ambil rating user ini
        $userRatings = GuestRating::with('alternatif')->where('user_id', $userId)->get()->groupBy('alternatif_id');

        $rankings = [];

        foreach ($userRatings as $altId => $ratings) {
            $totalScore = 0.0;
            $alternatif = $ratings->first()->alternatif;

            foreach ($kriteriaList as $krit) {
                $pvKrit = $krit->pvKriteria?->nilai ?? 0;
                
                $rating = $ratings->firstWhere('kriteria_id', $krit->id);
                $bintang = $rating ? $rating->rating_bintang : 0;
                $nilaiAhp = $skalaMapping[$bintang] ?? 0;

                $totalScore += ($nilaiAhp * $pvKrit);
            }

            $rankings[] = [
                'id_alternatif' => $alternatif->id,
                'nama' => $alternatif->nama,
                'nilai' => $totalScore
            ];
        }

        // Urutkan DESC
        usort($rankings, fn($a, $b) => $b['nilai'] <=> $a['nilai']);

        return [
            'rankings' => $rankings,
            'kriteriaList' => $kriteriaList
        ];
    }
}
