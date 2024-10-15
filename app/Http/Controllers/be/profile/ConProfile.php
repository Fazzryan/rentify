<?php

namespace App\Http\Controllers\be\profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ConProfile extends Controller
{
    public function index()
    {
        $userId = Session::get('user_session')['user_id'];
        $role    = Session::get('user_session')['role'];

        $getProfile = DB::table('users')->where('id', $userId)->where('role', $role)->first();

        return view('be.pages.profile.index', compact('getProfile'));
    }

    public function edit(Request $request)
    {
        $userId   = $request->user_id;
        $username = ucwords(strtolower($request->username));
        $email    = $request->email;
        $password = md5($request->pass);
        $pass     = $request->pass;

        $dataUpdate = array(
            'username' => $username,
            'email'    => $email,
            'password' => $password,
            'pass'     => $pass,
        );

        $validasi = $this->validate($request, [
            'username' => 'required|min:3|max:30',
            'email'    => 'required|email|min:3|max:30',
            'pass'     => 'required|min:3|max:30',
        ]);

        if ($validasi) {
            $checkId = DB::table('users')->where('id', $userId)->count();
            if ($checkId > 0) {
                // cek perubahan
                $checkChanges = DB::table('users')
                    ->where('id', $userId)
                    ->where('username', $username)
                    ->where('email', $email)
                    ->where('password', $password)
                    ->where('pass', $pass)
                    ->count();
                if ($checkChanges > 0) {
                    return redirect()->back()->with('failed', 'Profile No Change!');
                } else {
                    // cek apakah data tersedia
                    $checkAvailable = DB::table('users')->where('id', $userId)->where('email', $email)->count();
                    if ($checkAvailable > 0) {
                        $update = array(
                            'username' => $username,
                            'password' => $password,
                            'pass'     => $pass,
                        );
                        $queryUpdate = DB::table('users')->where('id', $userId)->update($dataUpdate);
                        return redirect()->back()->with('success', 'Profile Updated Successfully!');
                    } else {
                        // cek apakah email sudah ada
                        $checkEmail = DB::table('users')->where('email', $email)->count();
                        if ($checkEmail > 0) {
                            return redirect()->back()->with('failed', 'Email Available!');
                        } else {
                            // jika email masih kosong maka update data
                            $queryUpdate = DB::table('users')->where('id', $userId)->update($dataUpdate);
                            return redirect()->back()->with('success', 'Category Updated Successfully!');
                        }
                    }
                }
            } else {
                return redirect()->back()->with('failed', 'Profile Not Found!');
            }
        }
    }
}
