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
        // return redirect()->route('index');
        dd(Auth::user());
        if(Auth::check()){
            return route('dashboard-admin');
        }

        return "Gagal Login";
    }

    public function customLogin(Request $request){
        // Validasi inputan user
        $request->validate([
            'user_name' => 'required|email',
            'user_pass' => 'required',
        ]);

        // Mengambil data inputan user
        $credentials = [
            'user_name' => $request->user_name,
            'password' => $request->user_pass
        ];

        // Validasi akun dengan database
        dd(Auth::login($credentials));

        if(Auth::attempt($credentials)){
            $grade = Auth::user()->user_grade;
            // dd($grade);
            // Pengecekan user admin atau bukan
            if($grade === 1){
                // dd(Auth::user(), Auth::attempt($credentials));
                echo "Berhasil Login";
                // Pergi ke halaman dashboard khusus admin
                // return redirect()->route('dashboard-admin')->with('Success','Signed In');
            }else if($grade == 5 or $grade == 6){
                // Pergi ke halaman dashboard khusus leader
                return redirect()->route('dashboard-leader')->with('Success','Signed In');
            }
            // pergi kehalaman dashboard untuk teknisi
            return redirect()->intended('/admin/dashboard')->withSuccess('Signed in');
            // return redirect()->route('dashboard-employee')->with('Success','Signed In');
        }
        // Data yang diinput tidak sesuai
        return back()
                ->withInput()
                ->withErrors(['Error', 'Login details are not valid']);   
        // echo "Login Gagal";
    }

    public function customLoginTest(Request $request)
    {
        $request->validate([
            'user_name' => 'required|email',
            'user_pass' => 'required',
        ]);

        // Mengambil data inputan user
        $credentials = [
            'user_name' => $request->user_name,
            'password' => $request->user_pass
        ];

      
    }

    public function logout(){
        Auth::logout();
        return redirect('home');
    }
}
