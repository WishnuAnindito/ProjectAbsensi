<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request){
        $request->validate([
            'user_name' => 'required|email',
            'user_pass' => 'required',
        ]);

        $credentials = $request->only('user_name', 'user_pass');

        if(Auth::attempt($credentials)){
            if(Auth::user()->id == 1){
                return redirect()->intended('admin/dashboard')->with('Success','Signed In');
            }
            return redirect()->intended('dashboard')->with('Success','Signed In');
        }
        return redirect('login')->with('Error', 'Login details are not valid');   
    }

    public function logout(){
        Auth::logout();
        return redirect('home');
    }
}
