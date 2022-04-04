<?php

namespace App\Http\Controllers\Check;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        
        $email = $request->email;
        $password = md5($request->password);

        $users = $request->except(['_token']);
        dd(Auth::attempt($users));
        
        $users_data = DB::connection('mysql')->table('emp_person','ep')
                    ->select('ep.emp_id','ep.emp_email_office','tbl_users.user_pass', 'tbl_users.user_grade', 'emp_position.emp_status')
                    ->join('emp_position','ep.emp_id', '=', 'emp_position.emp_id')
                    ->join('tbl_users', 'ep.emp_id', '=', 'tbl_users.user_id')
                    ->where('ep.emp_email_office', 'like', $email)
                    ->where('tbl_users.user_pass', 'like',$password)
                    ->where('emp_position.emp_status', '<', 3)
                    ->where('tbl_users.user_grade', '<', 99)
                    ->first();

        $admin_data = DB::connection('mysql')->table('tbl_users')
                    ->select('tbl_users.user_name','tbl_users.user_pass', 'tbl_users.user_grade', 'emp_position.emp_status')
                    ->join('emp_position','tbl_users.user_id', '=', 'emp_position.emp_id')
                    ->where('tbl_users.user_name', 'like', $email)
                    ->where('tbl_users.user_pass', 'like', $password)
                    ->where('emp_position.emp_status', '<', 3)
                    ->where('tbl_users.user_grade', '=', 99)
                    ->first();

        
        if($users_data){
            return redirect()->route('dashboard')->with('users', $users_data);
        }else if($admin_data){
            return redirect()->route('dashboard-admin')->with('admin', $admin_data);
        }else{
            return redirect()->back()->withErrors(['ErrorAccount', 'Akun tidak sesuai!!!']);
        }


    }
    
    public function logout(){
        Auth::logout();
        return redirect('home');
    }
}
