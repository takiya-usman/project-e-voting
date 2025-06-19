<?php

namespace App\Http\Controllers\Admin;

use App\Models\kandidat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = kandidat::all();
        return view('dashboard.admin.kandidat.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data = kandidat::where('id', $id)->first();
        return view('dashboard.admin.kandidat.edit')->with('data', $data);
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
            
            'calon' => 'required',
            'foto' => 'mimes:jpeg,jpg,png,gif',
        ], [
            
            'calon.required' => 'Nama Calon tidak boleh kosong',
            'foto.mimes' => 'Foto yang boleh dimasukkan adalah JPEG, JPG, PNG, dan GIF'
        ]);
    
        $data = [
            
            'nama_calon' => $request->calon,
        ];
    
        if ($request->hasFile('foto')) {
            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_baru = date('ymdhis') . ".$foto_ekstensi";
            $foto_file->move(public_path('foto'), $foto_baru);
            $data['foto'] = $foto_baru;

            //delete foto lama
            $data_foto = kandidat::where('id', $id)->first();
            File::delete(public_path('foto') . '/' . $data_foto->foto);

            $data['foto'] = $foto_baru;
        }
    
        kandidat::where('id', $id)->update($data);
    
        return redirect()->route('admin.kandidat.index')->with('success', 'Berhasil melakukan update data Kandidat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
