<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\User;
use Illuminate\Support\Facades\Session;



class LoginController extends Controller
{
    function index()
    {
        return view('login');
    }

    // function authenticate(Request $request)
    // {
    //     $request->validate([
    //         'email'=>'required',
    //         'password'=>'required'
    //     ],[
    //         'email.required'=>'*Email wajib diisi',
    //         'password.required'=>'*Password wajib diisi'
    //     ]);

    //     $infologin = [
    //         'email'=>$request->email,
    //         'password'=>$request->password,
    //     ];

    //     if(Auth::attempt($infologin)){
    //         if(Auth::user()->role == 'guru'){
    //             echo"Halo guru";
    //             echo "<h1>". Auth::user()->name ."</h1>";
    //             echo "<a href='/logout'>Logout</a>";
    //         }
    //         elseif (Auth::user()->role == 'siswa'){
    //             return redirect('siswa');
    //         }
    //         elseif (Auth::user()->role == 'admin'){
    //             return redirect('admin');
    //         }
    //         // return redirect('admin');
    //     }else{
    //         return redirect('/login')->withErrors(['login' => '*Email dan password yang dimasukkan tidak sesuai'])->withInput();
    //     }
    // }

    public function authenticate(Request $request)
    {
        $request->validate([
            'login_number' => 'required',
            'password' => 'required',
        ], [
            'login_number.required' => '*NIS/NIP wajib diisi',
            'password.required' => '*Password wajib diisi',
        ]);

        $login_number = $request->login_number;
        $password = $request->password;

        $user = Auth::attempt(['NIS' => $login_number, 'password' => $password])
            || Auth::attempt(['NIP' => $login_number, 'password' => $password])
            || Auth::attempt(['no_admin' => $login_number, 'password' => $password]);
    

        // Cek hasil otentikasi
        if ($user) {
            if (Auth::user()->role == 'guru') {
                return redirect('guru');
            } elseif (Auth::user()->role == 'siswa') {
                // Jika role siswa
                return redirect('siswa');
            } elseif (Auth::user()->role == 'admin') {
                // Jika role admin
                return redirect('admin');
            }
        } else {
            return redirect('/login')->withErrors(['login' => '*NIS/NIP dan password yang dimasukkan tidak sesuai'])->withInput();
        }
    }

    function logout(){
        // $user = Auth::user(); // Dapatkan pengguna yang sedang diautentikasi
        // $user->login_at = null; // Setel login_at menjadi null
        // $user->save();
        
        Auth::logout();
        return redirect('');
    }
}
