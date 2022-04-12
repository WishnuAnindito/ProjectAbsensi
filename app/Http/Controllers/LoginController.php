<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        // Pergi ke halaman Login
        return view('auth.login');
    }

    public function customLogin(Request $request){
        // Validasi inputan user
        $request->validate([
            'user_name' => 'required|email',
            'user_pass' => 'required',
        ]);

        // Mengambil data inputan user
        $credentials = $request->only('user_name', 'user_pass');

        // Validasi akun dengan database
        if(Auth::attempt($credentials)){
            // Pengecekan user admin atau bukan
            if(Auth::user()->emp_id == 1){
                // Pergi ke halaman dashboard khusus admin
                return redirect()->intended('admin/dashboard')->with('Success','Signed In');
            }
            // pergi kehalaman dashboard untuk teknisi
            return redirect()->intended('dashboard')->with('Success','Signed In');
        }
        // Data yang diinput tidak sesuai
        return redirect('login')->with('Error', 'Login details are not valid');   
    }

    public function logout(){
        Auth::logout();
        return redirect('home');
    }
}
