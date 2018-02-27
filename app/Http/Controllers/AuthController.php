<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\System\Account\Settings;
use App\System\System as System;
use DB;
use App\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller {

    public static function login() {
        /*
         *  statuses possible -> ok 200, logged-in 403, banned 423, error 505
         *  @param state text, mode text
         */

        $status = Auth::check() ? '403' : '200';
        return view('auth.auth', ['status' => $status, 'mode' => 'login']);
    }

    public static function postLogin(LoginRequest $request) {
        if(Auth::attempt($request->only(['mail', 'password'], $request->has('remember')))) {
            return redirect('');
        } else {
            return view('auth.auth', ['status' => '505', 'mode' => 'login']);
        }
    }

    public static function register() {
        /*
         *  statuses possible -> ok 200, logged-in 403, banned 423, error 505
         *  @param state text, mode text
         */

        $status = Auth::check() ? '403' : '200';
        return view('auth.auth', ['status' => $status, 'mode' => 'register']);
    }

    public static function postRegister(RegisterRequest $request) {
        $data = [
            'mail' => trim($request->input('mail')),
            'username' => trim($request->input('username')),
            'password' => bcrypt($request->input('password')),
            'country_code' => System::getGeoCode(System::getIpv4()),
            'image' => -1,
            'rank' => 1
        ];

        User::create($data);
        Settings::createUserStats($data);

        return redirect('/register/verify-mail');
    }

    public static function verifyMail() {
        return view('auth.onboarding.verify-mail');
    }

    public static function findPeople() {
        return view('auth.onboarding.find-people');
    }

    public static function giveDetails() {
        return view('auth.onboarding.details');
    }

    public static function registerDone() {
        return view('auth.onboarding.complete');
    }
}