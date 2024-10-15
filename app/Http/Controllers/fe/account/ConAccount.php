<?php

namespace App\Http\Controllers\fe\account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\VarDumper\VarDumper;

class ConAccount extends Controller
{
    public function index()
    {

        return view('fe.pages.account.index');
    }
    public function account_information()
    {
        $userId = session()->get('user_session')['user_id'];
        $getUser = DB::table('users')->where('id', $userId)->first();

        return view('fe.pages.account.account_information', compact('getUser'));
    }

    public function transaction_history()
    {
        $userId = session()->get('user_session')['user_id'];
        $getUser = DB::table('users')->where('id', $userId)->first();
        dd($getUser);
        return view('fe.pages.account.transaction_history', compact('getUser'));
    }

    // Route Edit
    public function act_editaccount(Request $request)
    {
        $userId   = $request->user_id;
        $username = ucwords(strtolower($request->username));
        $email    = $request->email;
        $password = md5($request->password);
        $pass     = $request->password;

        $validate = $this->validate($request, [
            'username' => 'required|min:3|max:40',
            'email'    => 'required|email|max:40',
            'password' => 'nullable|min:5|max:40',
        ]);

        $dataUpdate = array(
            'username' => $username,
            'email'    => $email,
        );

        if ($validate) {
            // cek id apakah ada
            $checkId = DB::table('users')->where('id', $userId)->count();
            if ($checkId > 0) {
                if ($password == null || $pass == null) {
                    // cek perubahan
                    $checkChanges = DB::table('users')
                        ->where('id', $userId)
                        ->where('username', $username)
                        ->where('email', $email)
                        ->count();
                    if ($checkChanges > 0) {
                        return redirect()->back()->with('failed', 'User No Change!');
                    } else {
                        // cek apakah data tersedia 
                        $checkAvailable = DB::table('users')->where('id', $userId)->where('email', $email)->count();
                        if ($checkAvailable > 0) {
                            $queryUpdate = DB::table('users')->where('id', $userId)->update($dataUpdate);
                            return redirect()->back()->with('success', 'User Updated Successfully!');
                        } else {
                            // cek apakah email tersedia
                            $checkEmail = DB::table('users')->where('email', $email)->count();
                            if ($checkEmail > 0) {
                                return redirect()->back()->with('failed', 'Email Not Available!')->withInput();
                            } else {
                                $queryUpdate = DB::table('users')->where('id', $userId)->update($dataUpdate);
                                return redirect()->back()->with('success', 'User Updated Successfully!');
                            }
                        }
                    }
                } else {
                    // cek perubahan
                    $checkChanges = DB::table('users')
                        ->where('id', $userId)
                        ->where('username', $username)
                        ->where('email', $email)
                        ->where('password', $password)
                        ->count();
                    if ($checkChanges > 0) {
                        return redirect()->back()->with('failed', 'User No Change!');
                    } else {
                        // cek apakah data tersedia 
                        $checkAvailable = DB::table('users')->where('id', $userId)->where('email', $email)->count();
                        if ($checkAvailable > 0) {
                            $updateData = array(
                                'username' => $username,
                                'password' => $password,
                                'pass'     => $pass,
                            );
                            $queryUpdate = DB::table('users')->where('id', $userId)->update($updateData);
                            return redirect()->back()->with('success', 'User Updated Successfully!');
                        } else {
                            // cek apakah email tersedia
                            $checkEmail = DB::table('users')->where('email', $email)->count();
                            if ($checkEmail > 0) {
                                return redirect()->back()->with('failed', 'Email Not Available!')->withInput();
                            } else {
                                $data = array(
                                    'password' => $password,
                                    'pass'     => $pass,
                                );
                                $update = array_merge($dataUpdate, $data);

                                $queryUpdate = DB::table('users')->where('id', $userId)->update($update);
                                return redirect()->back()->with('success', 'User Updated Successfully!');
                            }
                        }
                    }
                }
            } else {
                return redirect()->back()->with('failed', 'User Not Found!');
            }
        }
    }
}
