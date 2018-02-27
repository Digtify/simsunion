<?php

namespace App\Http\Controllers;

use App\System\System as System;
use App\User;
use App\System\Account\Settings as Settings;

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

    public static function showAccountSettings($username) {
        if (User::where('username', '=', $username)->exists()) {
            $data = System::getUserDataByName($username);
            $settings = Settings::getSettings($username);

            return view('account.settings', ['username' => $data['username'], 'data' => $data, 'settings' => $settings]);
        } else {
            return view('errors.404');
        }
    }
}