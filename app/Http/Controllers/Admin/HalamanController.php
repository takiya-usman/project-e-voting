<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Suara;
use App\Models\kandidat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HalamanController extends Controller
{
    public function index()
    {
        $kandidat1 = kandidat::find(1);
        $kandidat2 = Kandidat::find(2);
        $kandidat3 = Kandidat::find(3);

        $jumlah_suara_kandidat1 = Suara::where('id_kandidat', 1)->count();
        $jumlah_suara_kandidat2 = Suara::where('id_kandidat', 2)->count();
        $jumlah_suara_kandidat3 = Suara::where('id_kandidat', 3)->count();
        $total_suara = Suara::count();

        $total_users = User::count();

        return view('dashboard.admin.halaman.index', compact('kandidat1', 'kandidat2', 'kandidat3', 'jumlah_suara_kandidat1', 'jumlah_suara_kandidat2', 'jumlah_suara_kandidat3', 'total_suara', 'total_users'));
    }

    public function resetSuara()
    {
        Suara::truncate();
        return redirect()->route('admin.halaman.index');
    }
}
