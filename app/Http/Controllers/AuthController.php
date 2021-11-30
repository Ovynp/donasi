<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auths.login');
    }

    public function postlogin(Request $request)
    { 
        $this->validate($request,[
        'email' => 'required|email',
        'password' => 'required'

    ]);
       
        if(Auth::attempt($request->only('email','password'))){
            $user = User::where('email', $request->email)->first();
            $kegiatan = Kegiatan::where('users_id', $user->id)->first();
            // dd($kegiatan->id);
            if ($user->role == 'super admin') 
            {
                return redirect('/superAdmin');
            } 
            elseif ($user->role == 'admin') 
            { 
                return redirect('admin/'.$user->id.'/'.$kegiatan->id.'/'.'dashboard');
            }
        }
        return redirect('/login')->with('gagal','Email dan Password Salah !');

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
