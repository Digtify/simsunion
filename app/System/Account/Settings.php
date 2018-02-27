<?php

namespace App\System\Account;

use DB;

class Settings {

    public static function createUserStats($data) {
        DB::table('users_stats')
            ->insert([
                'username' => $data['username'],
                'birthday' => '',
                'website_anchor' => ''
            ]);
    }

    public static function getUserStats($username, $category) {
        if($category == 'birthday' || $category == 'website_anchor')
            return DB::table('users_stats')
                ->select($category)
                ->where('username', '=', $username)
                ->first();

        return false;
    }

    public static function hasStatsSet($username, $category) {
        return self::getUserStats($username, $category)->$category != "";
    }

    public static function getSettings($username) {
        return [];
    }
}