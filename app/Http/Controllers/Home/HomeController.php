<?php

namespace App\Http\Controllers\Home;

use App\System as System;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class HomeController extends Controller {

    public function show() {
        if(!Auth::check()) {
            return view('marketing.hookup');
        }

        $user_data = System::getUserDataByName(Auth::user()->username);
        $posts = System::getLatest();
        $users_suggested = System::getSuggestedUsers(Auth::user()->username);

        return view('homepage', ['user_data' => $user_data, 'posts' => $posts, 'users_suggested' => $users_suggested]);
    }
}