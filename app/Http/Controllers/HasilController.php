<?php

namespace App\Http\Controllers;
use App\alternatif;
use App\kriteria;
use App\Pembobotan;
use App\Helpers\SubtenHelpers;
use App\Helpers\SubtdecHelpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $alternatifs = Alternatif::leftJoin('pembobotans', 'alternatifs.id', '=', 'pembobotans.alternatif_id')
            ->select('alternatifs.*', DB::raw('SUM(pembobotans.perkalian_bobot) AS total'))
            ->where('alternatifs.user_id', $userId)
            ->groupBy('alternatifs.id')
            ->orderByDesc('total')
            ->get();

        foreach ($alternatifs as $alternatif) {
            $alternatif->nama_doi = substitutionDecrypt($alternatif->nama_doi);
        }

        return view('modules.hasil.index', compact('alternatifs'));
    }

    public function show($id)
{
    // Ambil data alternatif berdasarkan ID
    $alternatif = Alternatif::findOrFail($id);

    // Lainnya logika yang diperlukan untuk menampilkan detail alternatif
    $alternatif->nama_doi = substitutionDecrypt($alternatif->nama_doi);
    return view('modules.hasil.show', compact('alternatif'));
}

    public function detail($id)
{
    // Ambil data alternatif berdasarkan ID
    $alternatifs = Alternatif::leftJoin('pembobotans', 'alternatifs.id', '=', 'pembobotans.alternatif_id')
    ->select('alternatifs.*', DB::raw('SUM(pembobotans.perkalian_bobot) AS total'))
    ->where('alternatifs.user_id', $userId)
    ->groupBy('alternatifs.id')
    ->orderByDesc('total')
    ->get();

foreach ($alternatifs as $alternatif) {
    $alternatif->nama_doi = substitutionDecrypt($alternatif->nama_doi);
}

    return view('modules.hasil.detail', compact('alternatif'));
}
}
