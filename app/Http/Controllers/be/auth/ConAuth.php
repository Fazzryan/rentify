<?php

namespace App\Http\Controllers\be\auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ConAuth extends Controller
{
    public function index()
    {
        $cekSession = $this->cekSession();
        if ($cekSession == "true") {
            // Toastr::success('Anda sudah login!', 'maaf');
            return redirect()->route('be.dashboard')->with('info', 'You are logged in!');
        } else {
            return view('be.pages.auth.login');
        }
    }
    public function register()
    {
        $cekSession = $this->cekSession();
        if ($cekSession == "true") {
            return redirect()->route('fe.beranda')->with('info', 'You are logged in!');
        } else {
            return view('be.pages.auth.register');
        }
    }

    public function actLogin(Request $request)
    {
        $email    = $request->email;
        $password = $request->password;

        //custom notif validasi
        $messages = array(
            'required' => ':attribute Harus Di Isi!',
            'min'      => ':attribute Minimal 6 Karakter!',
            'max'      => ':attribute Maksimal 50 Karakter!'
        );
        $attribute = array(
            'email'    => 'Email',
            'password' => 'Password',
        );
        $credentials = array(
            'email'    => 'required',
            'password' => 'required',
        );
        $validasi = $this->validate($request, $credentials, $messages, $attribute);
        if ($validasi) {
            $pass = md5($password);
            // cek apakah username dan password ada
            $queryLogin = DB::table('users')
                ->where('email', $email)
                ->where('password', $pass);
            $cek = $queryLogin->count();

            if ($cek > 0) {
                $users = $queryLogin->first();
                // jika ada maka buatkan session dan login
                $user_session = [
                    'user_id'  => $users->id,
                    'username' => $users->username,
                    'role'     => $users->role,
                ];

                Session::put('user_session', $user_session);
                Session::put('login', TRUE);

                if ($users->role == 'admin' || $users->role == 'owner') {
                    return redirect()->route('be.dashboard')->with('success', 'Login Successfull!');
                } else if ($users->role == 'user') {
                    return redirect()->route('fe.beranda')->with('success', 'Login Successfull!');
                } else {
                    Session::flush();
                    return redirect()->route('auth.login')->with('error', 'Role Not Available!');
                }
            } else {
                return redirect()->back()->with('failed', 'Email Or Password does not match!')->withInput();
            }
        }
    }

    public function actRegister(Request $request)
    {
        $username = ucwords(strtolower($request->username));
        $email    = $request->email;
        $password = md5($request->password);
        $pass     = $request->password;
        $role     = "user";

        $dataAdd = array(
            'username' => $username,
            'email'    => $email,
            'password' => $password,
            'pass'     => $pass,
            'role'     => $role,
        );

        $validate = $this->validate($request, [
            'username' => 'required|min:3|max:40',
            'email'    => 'required|email',
            'password' => 'required|min:5|max:40'
        ]);

        if ($validate) {
            // cek apakah email sudah ada
            $checkEmail = DB::table('users')->where('email', $email)->count();
            if ($checkEmail > 0) {
                return redirect()->back()->with('failed', 'Email Already Taken!')->withInput();
            } else {
                $queryAdd = DB::table('users')->insert($dataAdd);
                return redirect()->route('auth.login')->with('success', 'Successfully Created an Account');
            }
        }
    }

    public function actLogout()
    {
        Session::flush();
        // Toastr::success('message', 'Berhasil Logout');
        return redirect()->route('auth.login');
        // ->with('success', 'Berhasil logout!')
    }

    public function cekSession()
    {
        if (Session::has('login')) {
            $getLogin = "true";
        } else {
            $getLogin = "false";
        }
        return $getLogin;
    }
}
