<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Suara;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuaraController extends Controller
{
    public function index()
    {
        $suaras = suara::with(['kandidat', 'user'])->latest()->paginate(5);
        return view('dashboard.admin.suara.index', compact('suaras'));
    }

    public function delete(Request $request)
    {
        $selected = $request->input('selected');

        if (!is_array($selected)) {
            return redirect()->back()->withErrors(['selected' => 'Tidak ada data yang dipilih. Setidak nya Pilih 1 untuk dihapus']);
        }

        // Ubah status pengguna yang terpilih menjadi 0
        User::whereIn('id', suara::whereIn('id', $selected)->pluck('id_users'))->update(['status' => 0]);

        // Hapus data yang terpilih
        Suara::whereIn('id', $selected)->delete();

        return redirect()->back()->with('success', 'Data suara yang dipilih telah dihapus dan status pengguna telah diubah.');
    }
}
