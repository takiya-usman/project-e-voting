<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Suara;
use App\Models\kandidat;
use App\Models\Countdown;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class VoteController extends Controller
{
    public function index()
    {
        $kandidats = kandidat::all();
        $jumlah_suara_kandidat1 = Suara::where('id_kandidat', 1)->count();
        $jumlah_suara_kandidat2 = Suara::where('id_kandidat', 2)->count();
        $jumlah_suara_kandidat3 = Suara::where('id_kandidat', 3)->count();

        // Menghitung pemenang berdasarkan jumlah suara terbanyak
        $pemenang = null;
        $pemenang_kedua = null;
        $pemenang_ketiga = null;
        $jumlah_suara_terbanyak = 0;
        $jumlah_suara_terbanyak_kedua = 0;
        $jumlah_suara_terbanyak_ketiga = 0;

        if ($jumlah_suara_kandidat1 >= $jumlah_suara_terbanyak) {
            $jumlah_suara_terbanyak_ketiga = $jumlah_suara_terbanyak_kedua;
            $pemenang_ketiga = $pemenang_kedua;
            $jumlah_suara_terbanyak_kedua = $jumlah_suara_terbanyak;
            $pemenang_kedua = $pemenang;
            $jumlah_suara_terbanyak = $jumlah_suara_kandidat1;
            $pemenang = kandidat::find(1);
        } elseif ($jumlah_suara_kandidat1 >= $jumlah_suara_terbanyak_kedua) {
            $jumlah_suara_terbanyak_ketiga = $jumlah_suara_terbanyak_kedua;
            $pemenang_ketiga = $pemenang_kedua;
            $jumlah_suara_terbanyak_kedua = $jumlah_suara_kandidat1;
            $pemenang_kedua = kandidat::find(1);
        } elseif ($jumlah_suara_kandidat1 >= $jumlah_suara_terbanyak_ketiga) {
            $jumlah_suara_terbanyak_ketiga = $jumlah_suara_kandidat1;
            $pemenang_ketiga = kandidat::find(1);
        }

        if ($jumlah_suara_kandidat2 >= $jumlah_suara_terbanyak) {
            $jumlah_suara_terbanyak_ketiga = $jumlah_suara_terbanyak_kedua;
            $pemenang_ketiga = $pemenang_kedua;
            $jumlah_suara_terbanyak_kedua = $jumlah_suara_terbanyak;
            $pemenang_kedua = $pemenang;
            $jumlah_suara_terbanyak = $jumlah_suara_kandidat2;
            $pemenang = kandidat::find(2);
        } elseif ($jumlah_suara_kandidat2 >= $jumlah_suara_terbanyak_kedua) {
            $jumlah_suara_terbanyak_ketiga = $jumlah_suara_terbanyak_kedua;
            $pemenang_ketiga = $pemenang_kedua;
            $jumlah_suara_terbanyak_kedua = $jumlah_suara_kandidat2;
            $pemenang_kedua = kandidat::find(2);
        } elseif ($jumlah_suara_kandidat2 >= $jumlah_suara_terbanyak_ketiga) {
            $jumlah_suara_terbanyak_ketiga = $jumlah_suara_kandidat2;
            $pemenang_ketiga = kandidat::find(2);
        }

        if ($jumlah_suara_kandidat3 >= $jumlah_suara_terbanyak) {
            $jumlah_suara_terbanyak_ketiga = $jumlah_suara_terbanyak_kedua;
            $pemenang_ketiga = $pemenang_kedua;
            $jumlah_suara_terbanyak_kedua = $jumlah_suara_terbanyak;
            $pemenang_kedua = $pemenang;
            $jumlah_suara_terbanyak = $jumlah_suara_kandidat3;
            $pemenang = kandidat::find(3);
        } elseif ($jumlah_suara_kandidat3 >= $jumlah_suara_terbanyak_kedua) {
            $jumlah_suara_terbanyak_ketiga = $jumlah_suara_terbanyak_kedua;
            $pemenang_ketiga = $pemenang_kedua;
            $jumlah_suara_terbanyak_kedua = $jumlah_suara_kandidat3;
            $pemenang_kedua = kandidat::find(3);
        } elseif ($jumlah_suara_kandidat3 >= $jumlah_suara_terbanyak_ketiga) {
            $jumlah_suara_terbanyak_ketiga = $jumlah_suara_kandidat3;
            $pemenang_ketiga = kandidat::find(3);
        }

        $countdown = Countdown::where('active', 1)->first();
        $countdownDate = $countdown ? $countdown->countdown_date : null;
        $remainingTime = null;

        // Calculate the remaining time from the current time
        if ($countdownDate) {
            $now = Carbon::now();
            $countdownDate = \Carbon\Carbon::parse($countdownDate);
            $remainingTime = $countdownDate->diffInSeconds($now);
            $remainingTime = $remainingTime > 0 ? $remainingTime : 0;
        }

        // Jika tidak ada suara sama sekali
        if ($jumlah_suara_kandidat1 == 0 && $jumlah_suara_kandidat2 == 0 && $jumlah_suara_kandidat3 == 0) {
            $pemenang = null; // Reset the winner if there are no votes
            $pemenang_kedua = null;
            $pemenang_ketiga = null;
        }

        return view('dashboard.user.home', compact('kandidats', 'jumlah_suara_kandidat1', 'jumlah_suara_kandidat2', 'jumlah_suara_kandidat3', 'pemenang', 'pemenang_kedua', 'pemenang_ketiga', 'jumlah_suara_terbanyak', 'jumlah_suara_terbanyak_kedua', 'jumlah_suara_terbanyak_ketiga', 'remainingTime', 'countdown'));
    }




    public function updateStatus(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $user->status = 1;
            $user->save();

            // Tambahkan data ke tabel suara
            $suara = new Suara;
            $suara->id_kandidat = $request->kandidat_id;
            $suara->id_users = $user->id;
            $suara->waktu_pemilihan = now();
            $suara->save();

            // Mengambil data suara berdasarkan id_kandidat
            $suara_kandidat = Suara::where('id_kandidat', $request->kandidat_id)->get();

            // Menghitung jumlah baris data
            $jumlah_suara = $suara_kandidat->count();
            // atau $jumlah_suara = $suara_kandidat->num_rows();

        }

        return redirect()->route('user.home');
    }
}
