<?php

namespace App\Http\Controllers;

use App\System as System;
use App\User;

class AccountController extends Controller {

    public static function showAccount($username) {
        if (User::where('username', '=', $username)->exists()) {
            $data = System::getUserDataByName($username);
            $posts = System::getPosts(System::getUserIdByName($username), true);

            return view('account.account', ['username' => $data['username'], 'data' => $data, 'posts' => $posts]);
        } else {
            return view('errors.404');
        }
    }

    public static function showCategoryFamilies($username) {
        if (User::where('username', '=', $username)->exists()) {
            $data = System::getUserDataByName($username);
            $families = System::getFamilies(System::getUserIdByName($username), false);

            return view('account.categories.family', ['username' => $data['username'], 'data' => $data, 'families' => $families]);
        } else {
            return view('errors.404');
        }
    }
}