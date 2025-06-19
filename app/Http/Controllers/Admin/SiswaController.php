<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\kelas;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::with('kelas')
            ->when(request('search'), function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->when(request('status'), function ($query, $status) {
                return $query->where('status', $status);
            }, function ($query) {
                return $query->whereIn('status', [0, 1]);
            })
            ->latest()
            ->paginate(5);

        return view('dashboard.admin.siswa.index')->with('data', $data);
    }

    public function SiswaImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            $file = $request->file('file');
            $namafile = $file->getClientOriginalName();
            $file->move('DataSiswa', $namafile);

            Excel::import(new SiswaImport, public_path('/DataSiswa/' . $namafile));

            return redirect()->route('admin.siswa.index')->with('success', 'Berhasil Import Data.');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1062) {
                return redirect()->route('admin.siswa.index')->with('error', 'NISN atau email sudah terdaftar di dalam sistem.');
            } elseif ($e instanceof \App\Imports\Exception) {
                return redirect()->route('admin.siswa.index')->with('error', $e->getMessage());
            } else {
                return redirect()->route('admin.siswa.index')->with('error', 'Terjadi kesalahan saat mengimpor data siswa. Silahkan cek apakah data yang diimpor sudah sesuai dan lengkap. Pastikan password dan nisn minimal 5 karakter.');
            }
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = kelas::all();
        return view('dashboard.admin.siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required',
            'nisn' => 'required|unique:users,nisn',
            'name' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:5'
        ], [
            'kelas_id.required' => 'Kelas wajib dipilih.',
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.unique' => 'NISN sudah digunakan.',
            'name.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 5 karakter.',

        ]);

        $data = new User();
        $data->kelas_id = $request->kelas_id;
        $data->nisn = $request->nisn;
        $data->name = $request->name;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->status = 0;
        $data->save();

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
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
        $siswa = User::findOrFail($id);
        $kelas = Kelas::all();

        return view('dashboard.admin.siswa.edit', compact('siswa', 'kelas'));
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
            'nisn' => 'required|unique:users,nisn,' . $id,
            'name' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'nullable|min:5'
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.unique' => 'NISN sudah digunakan.',
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password minimal 5 karakter.'
        ]);

        $siswa = User::findOrFail($id);
        $siswa->kelas_id = $request->kelas_id;
        $siswa->nisn = $request->nisn;
        $siswa->name = $request->name;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->email = $request->email;
        if ($request->has('password')) {
            $siswa->password = Hash::make($request->password);
        }
        $siswa->save();

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $siswa = User::find($id);
            $siswa->delete();
            return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return redirect()->back()->with('error', 'Tidak dapat menghapus Data siswa karena siswa sudah melakukan vote. Harap hapus data pada tabel suara terlebih dahulu jika ingin menghapus data siswa.');
            } else {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data siswa.');
            }
        }
    }
}
