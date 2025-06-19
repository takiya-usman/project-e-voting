<?php

namespace App\Http\Controllers\User;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function create(Request $request)
    {

        $request->validate([        
            'kelas_id' => 'required|exists:kelas,id',        
            'nisn' => 'required|min:5|unique:users,nisn',        
            'name' => 'required|max:255',        
            'jenis_kelamin' => 'required',        
            'email' => 'required|email|unique:users,email|max:255',        
            'password' => 'required|min:5|max:30',       
            'cpassword' => 'required|same:password|min:5|max:30',
        ], [        
            'kelas_id.required' => 'Kelas harus dipilih',    
            'kelas_id.exists' => 'Kelas tidak valid',    
            'nisn.unique' => 'Nisn sudah digunakan',    
            'nisn.required' => 'NISN harus diisi',        
            'nisn.min' => 'NISN minimal terdiri dari :min karakter',      
            'name.required' => 'Nama harus diisi',        
            'name.max' => 'Nama maksimal terdiri dari :max karakter',        
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',      
            'email.required' => 'Email harus diisi',        
            'email.email' => 'Format email tidak valid',        
            'email.unique' => 'Email sudah digunakan',        
            'email.max' => 'Email maksimal terdiri dari :max karakter',        
            'password.required' => 'Password harus diisi',        
            'password.min' => 'Password minimal terdiri dari :min karakter',        
            'password.max' => 'Password maksimal terdiri dari :max karakter',        
            'cpassword.required' => 'Konfirmasi password harus diisi',        
            'cpassword.same' => 'Konfirmasi password tidak sama dengan password',        
            'cpassword.min' => 'Konfirmasi password minimal terdiri dari :min karakter',        'cpassword.max' => 'Konfirmasi password maksimal terdiri dari :max karakter',
        ]);



        $user = new User();
        $user->kelas_id = $request->kelas_id;
        $user->nisn = $request->nisn;
        $user->name = $request->name;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            return redirect()->back()->with('success', 'Suskes Registrasi');
        } else {
            return redirect()->back()->with('fail', 'Gagal Registrasi');
        }
    }


    function check(Request $request)
    {
        // Validate inputs
        $request->validate([
            'nisn' => 'required|nisn',
            'password' => 'required|min:5|max:30'
        ], [
            'nisn.required' => 'NISN harus diisi.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus terdiri minimal dari 5 karakter.',
            'password.max' => 'Password harus terdiri maksimal dari 30 karakter.',
        ]);

        // Check if nisn exists in the users table
        $user = User::where('nisn', $request->input('nisn'))->first();
        if (!$user) {
            return redirect()->back()->with('fail', 'NISN tidak terdaftar');
        }

        // Attempt to authenticate user
        $creds = $request->only('nisn', 'password');
        if (Auth::guard('web')->attempt($creds)) {
            return redirect()->route('user.home');
        } else {
            return redirect()->back()->with('fail', 'NISN atau password salah');
        }
    }


    function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
