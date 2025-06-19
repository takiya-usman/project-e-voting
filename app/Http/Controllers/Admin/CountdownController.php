<?php

namespace App\Http\Controllers\Admin;

use App\Models\Countdown;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountdownController extends Controller
{
    public function index()
    {
        $countdown = Countdown::where('active', true)->latest()->first();
        return view('dashboard.admin.countdown.index', compact('countdown'));
    }

    public function store(Request $request)
    {
        Countdown::where('active', true)->update(['active' => false]);
        $countdown = new Countdown();
        $countdown->countdown_date = $request->countdown_date;
        $countdown->active = true;
        $countdown->save();

        return redirect()->back()->with('success', 'Countdown created successfully!');
    }

    public function updateTime(Request $request)
    {
        try {
            $countdown = Countdown::where('active', true)->first();
            $countdown->countdown_date = $request->input('countdown_date', $countdown->countdown_date);
            if ($request->status === 'inactive') {
                $countdown->active = false;
            } else {
                $countdown->active = true;
            }

            $countdown->save();

            return redirect()->back()->with('success', '
            Hitungan mundur Pemilihan berhasil diperbarui!');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1048) {
                return redirect()->back()->with('error', 'Tanggal untuk hitung mundur tidak boleh kosong. Masukkan tanggal yang valid.');
            } else {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui hitungan mundur. Coba lagi nanti.');
            }
        }
    }
}
