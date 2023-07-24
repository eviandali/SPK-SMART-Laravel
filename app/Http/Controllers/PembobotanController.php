<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Alternatif;
use App\Kriteria;
use App\Pembobotan;
use App\Helpers\SubtenHelpers;
use App\Helpers\SubtdecHelpers;

class PembobotanController extends Controller
{

    public function store(Request $request)
    {
        // Lakukan validasi data yang diterima dari form
        $validatedData = $request->validate([
            'bobot_kriteria' => 'required|array',
            'bobot_kriteria.*' => 'required|numeric',
            'kriteria_id' => 'required|array',
        ]);

        // Dapatkan ID pengguna
        $userId = Auth::id();

        // Dapatkan ID alternatif
        $alternatifId = $request->input('alternatif_id');

        // Simpan bobot yang dikirim dari form ke dalam database
        foreach ($validatedData['bobot_kriteria'] as $index => $bobot) {
            $kriteriaId = $validatedData['kriteria_id'][$index];
            $kriteria = Kriteria::find($kriteriaId);

            if ($kriteria) {
                $pembobotan = Pembobotan::updateOrCreate(
                    ['user_id' => $userId, 'alternatif_id' => $alternatifId, 'kriteria_id' => $kriteriaId],
                    [
                        'criteria' => $kriteria->criteria,
                        'type' => $kriteria->type,
                        'bobot_kriteria' => $bobot,
                        'value_util' => null,
                        'perkalian_bobot'=> null,
                        'total' => null,
                    ]
                );

                // Jika terdapat perubahan data pembobotan, hitung ulang value_util dan perkalian_bobot
                if ($pembobotan->wasChanged()) {
                    $this->calculateValueUtil($alternatifId);
                    $this->calculatePerkalianBobot($alternatifId);
                }
            }
        }

        // Redirect atau lakukan tindakan lain setelah berhasil menyimpan bobot
        return redirect()->route('alternatif.index');
    }

    public function hitung(Request $request)
    {
        $alternatifId = $request->input('alternatif_id');

        // Memanggil metode calculateValueUtil untuk menghitung ulang value_util
        $this->calculateValueUtil($alternatifId);
        $this->calculatePerkalianBobot($alternatifId);
        $this->hitungTotalPerkalianBobot($alternatifId);
        // Redirect atau lakukan tindakan lain setelah perhitungan selesai
        return redirect()->back()->with('success', 'Perhitungan value_util berhasil dilakukan');
    }

    private function calculateValueUtil($alternatifId)
    {
        $alternatif = Alternatif::findOrFail($alternatifId);
        $pembobotan = $alternatif->pembobotan;

        if ($pembobotan->count() > 0) {
            foreach ($pembobotan as $item) {
                $kriteriaId = $item->kriteria_id;
                $maxBobot = Pembobotan::where('kriteria_id', $kriteriaId)->max('bobot_kriteria');
                $minBobot = Pembobotan::where('kriteria_id', $kriteriaId)->min('bobot_kriteria');

                if ($maxBobot !== null && $minBobot !== null) {
                    $bobotKriteria = $item->bobot_kriteria;
                    $type = $item->type;

                    if ($maxBobot - $minBobot !== 0) {
                        if ($type === 'kekurangan') {
                            $valueUtil = ($maxBobot - $bobotKriteria) / ($maxBobot - $minBobot);
                        } else {
                            $valueUtil = ($bobotKriteria - $minBobot) / ($maxBobot - $minBobot);
                        }
                    } else {
                        $valueUtil = 0;
                    }

                    $item->value_util = $valueUtil;
                    $item->save();
                }
            }
        }
    }

    private function calculatePerkalianBobot($alternatifId)
    {
        $alternatif = Alternatif::findOrFail($alternatifId);
        $pembobotan = $alternatif->pembobotan;

        if ($pembobotan->count() > 0) {
            foreach ($pembobotan as $item) {
                $valueUtil = $item->value_util;

                // Ambil nilai normalization dari tabel kriterias
                $kriteria = Kriteria::findOrFail($item->kriteria_id);
                $normalization = $kriteria->normalization;

                $perkalianBobot = $valueUtil * $normalization;

                // Simpan perkalian bobot ke kolom perkalian_bobot
                $item->perkalian_bobot = $perkalianBobot;
                $item->save();
            }
        }
    }
    private function hitungTotalPerkalianBobot($alternatifId)
    {
        $alternatif = Alternatif::findOrFail($alternatifId);
        $pembobotan = $alternatif->pembobotan;

        $totalPerkalianBobot = $pembobotan->sum('perkalian_bobot');

        // Simpan total perkalian bobot ke kolom total pada setiap baris pembobotan
        foreach ($pembobotan as $item) {
            $item->total = $totalPerkalianBobot;
            $item->save();
        }
    }




    public function edit($id)
    {
        $alternatifs = Alternatif::findOrFail($id);
        $pembobotans = Pembobotan::where('alternatif_id', $alternatifs->id)->get();
        $alternatifs->nama_doi = substitutionDecrypt($alternatifs->nama_doi);

        return view('modules.pembobotan.edit', compact('alternatifs', 'pembobotans'));
    }

    public function update(Request $request, $id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $pembobotans = Pembobotan::where('alternatif_id', $alternatif->id)->get();

        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'bobot_kriteria' => 'required|array',
            'bobot_kriteria.*' => 'required|numeric',
            'kriteria_id' => 'required|array',
            'kriteria_id.*' => 'required|exists:kriterias,id',
        ]);

        // Update bobot pada setiap pembobotan yang ada
        foreach ($pembobotans as $index => $pembobotan) {
            $pembobotan->bobot_kriteria = $validatedData['bobot_kriteria'][$index];
            $pembobotan->save();
        }

        // Redirect atau lakukan tindakan lain setelah berhasil mengupdate data
        return redirect()->route('alternatif.index');
    }


}

