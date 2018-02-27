<?php

namespace App\Http\Controllers\Home;

use App\System\System as System;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class HomeController extends Controller {

    public function show() {
        if(!Auth::check()) {
            return view('marketing.hookup');
        }

        $posts = System::getLatest();
        $user_data = System::getUserDataByName(Auth::user()->username);
        $users_suggested = System::getSuggestedUsers(Auth::user()->username);

        return view('homepage', ['user_data' => $user_data, 'posts' => $posts, 'users_suggested' => $users_suggested]);
    }
}