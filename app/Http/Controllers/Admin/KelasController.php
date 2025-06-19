<?php

namespace App\Http\Controllers\Admin;

use App\Models\kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = kelas::orderBy('name', 'asc')->latest()->paginate(5);
        return view('dashboard.admin.kelas.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('name', $request->kelas);
        $request->validate([
            'kelas.*' => 'required',
        ], [
            'kelas.*.required' => 'kelas wajid diisi'
        ]);

        foreach ($request->kelas as $kelas) {
            kelas::create([
                'name' => $kelas,
            ]);
        }

        return redirect()->route('admin.kelas.index')->with('success', 'Berhasil menambahkan data kelas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = kelas::where('id', $id)->first();
        return view('dashboard.admin.kelas.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'kelas' => 'required',
        ], [
            'kelas.required' => 'Kelas wajib diisi',
        ]);

        $kelas = kelas::findOrFail($id);

        // Cek apakah inputan kelas kosong atau tidak
        if ($request->has('kelas')) {
            $kelas->name = $request->kelas;
        }

        // Cek apakah nama kelas sama dengan yang ada di database
        if ($request->kelas !== $kelas->name) {
            $kelasExists = kelas::where('name', $request->kelas)->exists();
            if ($kelasExists) {
                return redirect()->back()->withErrors(['kelas' => 'Nama kelas sudah ada']);
            }
        }

        $kelas->save();

        return redirect()->route('admin.kelas.index')->with('success', 'Berhasil memperbarui data kelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        kelas::where('id', $id)->delete();
        return redirect()->route('admin.kelas.index')->with('success', 'Berhasil menghapus data');
    }
}
