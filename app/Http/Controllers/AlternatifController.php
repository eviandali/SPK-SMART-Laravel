<?php

namespace App\Http\Controllers;
use App\alternatif;
use App\kriteria;
use App\Pembobotan;
use App\Helpers\SubtenHelpers;
use App\Helpers\SubtdecHelpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $alternatifs = Alternatif::where('user_id', $userId)->get();

        foreach ($alternatifs as $alternatif) {
            $alternatif->nama_doi = substitutionDecrypt($alternatif->nama_doi);
            $alternatif->foto_doi = $alternatif->foto_doi; // Tidak perlu melakukan perubahan di sini

            // Ambil data pembobotan untuk alternatif saat ini
            $pembobotan = Pembobotan::where('alternatif_id', $alternatif->id)->get();
            $alternatif->pembobotan = $pembobotan;

            $kriterias = Kriteria::where('user_id', $userId)->get();
            $alternatif->kriterias = $kriterias;
        }

        return view('modules.alternatif.index', compact('alternatifs'));
    }




    public function create()
    {
        return view('modules.alternatif.create');
    }



    public function store(Request $request)
    {
            // Mendapatkan id user saat ini
        $userId = auth()->user()->id;
        $encryptedName = substitutionEncrypt($request->input('nama_doi'));
        // encrypt nama doi

        // Menyimpan file foto_doi ke direktori yang diinginkan (misalnya: storage/app/public/photos)
        $foto_doi = $request->file('fotodoi');
        $nama_file = time()."_".$foto_doi->getClientOriginalName();

        $tujuan_upload ='foto_doi';
        $foto_doi->move($tujuan_upload,$nama_file);

        // Mendapatkan URL file yang tersimpan


        // Simpan data alternatif ke database
        $alternatif = new Alternatif();
        $alternatif->user_id = $userId;
        $alternatif->nama_doi = $encryptedName;
        $alternatif->$encryptedName;
        $alternatif->foto_doi = ($tujuan_upload."/".$nama_file);
        $alternatif->save();


        return redirect()->route('alternatif.index');
    }

    public function show($id)
    {
        // Logika untuk menampilkan detail alternatif dengan ID tertentu
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->nama_doi = substitutionDecrypt($alternatif->nama_doi);
        return view('modules.hasil.show', ['alternatif' => $alternatif]);
    }

    public function managedoi($id)
    {

        $userId = Auth::id();

        $kriterias = Kriteria::where('user_id', $userId)->get();
        $alternatifs = Alternatif::findOrFail($id);

        $alternatifs->nama_doi = substitutionDecrypt($alternatifs->nama_doi);

       return view('modules.alternatif.managedoi', compact('kriterias', 'alternatifs'));
    }





}
?>
