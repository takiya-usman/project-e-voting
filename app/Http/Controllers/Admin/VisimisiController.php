<?php

namespace App\Http\Controllers\Admin;

use App\Models\kandidat;
use App\Models\visimisi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class VisimisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $data = visimisi::orderBy('id_kandidat')->orderBy('visi')->orderBy('misi')->with('kandidat')->get();
        return view('dashboard.admin.visimisi.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kandi = kandidat::all();
        return view('dashboard.admin.visimisi.create')->with('kandi', $kandi);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('id_kandidat', $request->id_kandidat);
    Session::flash('visi', $request->visi);
    Session::flash('misi', $request->misi);

    $request->validate([
        'id_kandidat' => 'required|exists:kandidat,id',
        'visi' => 'required',
        'misi' => 'required',
    ], [
        'id_kandidat.required' => 'Kandidat harus dipilih terlebih dahulu.',
        'id_kandidat.exists' => 'Kandidat yang dipilih tidak tersedia.',
        'visi.required' => 'Visi wajid diisi.',
        'misi.required' => 'Misi wajid diisi.',
    ]);

    $data = [
        'id_kandidat' => $request->id_kandidat,
        'visi' => $request->visi,
        'misi' => $request->misi,
    ];

    visimisi::create($data);

    return redirect()->route('admin.visimisi.index')->with('success', 'Berhasil melakukan update data Visi & Misi');
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
        {
            $visimisi = visimisi::find($id);
            $kandi = kandidat::all();
            return view('dashboard.admin.visimisi.edit')->with(['visimisi' => $visimisi, 'kandi' => $kandi]);
        }
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
            
            'visi' => 'required',
            'misi' => 'required',
        ], [
            
            'visi.required' => 'Visi wajid diisi.',
            'misi.required' => 'Misi wajid diisi.',
        ]);
    
        $visimisi = visimisi::find($id);
        $visimisi->id_kandidat;
        $visimisi->visi = $request->visi;
        $visimisi->misi = $request->misi;
        $visimisi->save();
    
        return redirect()->route('admin.visimisi.index')->with('success', 'Berhasil melakukan update data Visi & Misi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        visimisi::where('id', $id)->delete();
        return redirect()->route('admin.visimisi.index')->with('success', 'Berhasil menghapus data');
    }
}
