<?php

namespace App\Http\Controllers;
use App\Kriteria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class KriteriaController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //method index
    public function index()
    {
        // Mendapatkan ID user saat ini
        $userId = Auth::id();

        // Mengambil data kriteria berdasarkan ID user
        $kriterias = Kriteria::where('user_id', $userId)->get();

        // Mengirim data kriteria ke view
        return view('modules.kriteria.index', compact('kriterias'));
    }
    //method create
    public function create()
    {
        return view('modules.kriteria.create');
    }
    //method store
    public function store(Request $request)
    {
        // Mendapatkan id user saat ini
        $userId = auth()->user()->id;

        // Validasi data
        $validatedData = $request->validate([
            'criteria' => 'required|array',
            'criteria.*' => 'required|string',
            'value' => 'required|array',
            'value.*' => 'required|numeric',
            'type' => 'required|array',
            'type.*' => 'required|string',
            'normalization' => 'required|array',
            'normalization.*' => 'required|numeric',
        ]);

        // Cek apakah user sudah memiliki data kriteria
        $hasExistingKriteria = Kriteria::where('user_id', $userId)->exists();

        // Jika user belum memiliki data kriteria, tambahkan data kriteria baru
        if (!$hasExistingKriteria) {
            foreach ($validatedData['criteria'] as $index => $criteria) {
                Kriteria::create([
                    'user_id' => $userId,
                    'criteria' => $criteria,
                    'value' => $validatedData['value'][$index],
                    'type' => $validatedData['type'][$index],
                    'normalization' => $validatedData['normalization'][$index],
                ]);
            }
        } else {
            // Jika user sudah memiliki data kriteria, hitung total value dan normalisasi

            // Mendapatkan total value dari kriteria yang sudah ada
            $totalValueExisting = Kriteria::where('user_id', $userId)->sum('value');

            // Menghitung total value dari kriteria baru
            $totalValueNew = array_sum($validatedData['value']);

            // Menghitung total value keseluruhan
            $totalValue = $totalValueExisting + $totalValueNew;

            foreach ($validatedData['criteria'] as $index => $criteria) {
                // Mendapatkan value dari kriteria baru
                $valueNew = $validatedData['value'][$index];

                // Menghitung normalisasi dari kriteria baru
                $normalization = $totalValue > 0 ? $valueNew / $totalValue : 0;

                // Simpan data kriteria ke dalam database
                Kriteria::create([
                    'user_id' => $userId,
                    'criteria' => $criteria,
                    'value' => $valueNew,
                    'type' => $validatedData['type'][$index],
                    'normalization' => $normalization,
                ]);
            }
        }

        // Redirect atau lakukan tindakan lain setelah berhasil menyimpan data kriteria
        return redirect()->back()->with('success', 'Data kriteria berhasil disimpan');
    }

    public function edit($id)
    {
        $kriterias = Kriteria::findOrFail($id);
        $currentNormalization = $kriterias->normalization;
        return view('modules.kriteria.edit', compact('kriterias', 'currentNormalization'));
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang login

        $kriteria = Kriteria::find($id);
        $kriteria->value = $request->input('value');
        $kriteria->normalization = $kriteria->value / Kriteria::where('user_id', $userId)->sum('value');
        $kriteria->save();

        // Update normalization for all records except the current one
        $totalValue = Kriteria::where('user_id', $userId)->where('id', '!=', $id)->sum('value') + $kriteria->value;


        Kriteria::where('user_id', $userId)
            ->where('id', '!=', $id)
            ->update(['normalization' => DB::raw("`value` / $totalValue")]);

        return redirect()->route('kriteria.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang login

        $kriteria = Kriteria::find($id);
        $kriteria->delete();

        // Update normalization for remaining records
        $totalValue = Kriteria::where('user_id', $userId)->sum('value');
        Kriteria::where('user_id', $userId)
            ->update(['normalization' => DB::raw("`value` / $totalValue")]);

        return redirect()->route('kriteria.index')->with('success', 'Data berhasil dihapus');
    }
}

