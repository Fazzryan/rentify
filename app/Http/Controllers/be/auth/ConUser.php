<?php

namespace App\Http\Controllers\be\auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConUser extends Controller
{
    public function index()
    {
        $getUsers = DB::table('users')->get();
        return view('be.pages.auth.index', compact('getUsers'));
    }


    //--------------------------------------------------------------------------
    //  Action Add
    //--------------------------------------------------------------------------
    public function act_add_account(Request $request)
    {
        $username  =  ucwords(strtolower($request->username));
        $email     = $request->email;
        $password  = md5($request->password);
        $pass      = $request->password;
        $role      = $request->role;

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
                return redirect()->back()->with('success', 'Successfully Created an Account');
            }
        }
    }
}
