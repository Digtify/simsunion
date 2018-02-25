<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB as DB;

class System extends Model {

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

    public static function getLatest() {
        $houses = DB::table('houses')
            ->select('id', 'type', 'name', 'author', 'comment', 'route', 'created_at', 'updated_at')
            ->latest()
            ->limit(5);
        $families = DB::table('families')
            ->select('id', 'type', 'name', 'author', 'comment', 'route', 'created_at', 'updated_at')
            ->latest()
            ->limit(5)
            ->union($houses)
            ->get();

        return $families;
    }

    public static function getPosts($id, $withFamilies) {
        if($withFamilies) {
            $houses = DB::table('houses')
                ->select('id', 'type', 'name', 'author', 'comment', 'route', 'created_at', 'updated_at')
                ->where('author', '=', $id)
                ->latest();

            $families = DB::table('families')
                ->select('id', 'type', 'name', 'author', 'comment', 'route', 'created_at', 'updated_at')
                ->where('author', '=', $id)
                ->latest()
                ->union($houses)
                ->get();

            return $families;
        }

        return DB::table('houses')
            ->select('id', 'type', 'name', 'author', 'comment', 'route', 'created_at', 'updated_at')
            ->where('author', '=', $id)
            ->latest()
            ->get();
    }

    public static function getFamilies($id, $withPosts) {
        if($withPosts) {
            $houses = DB::table('houses')
                ->select('id', 'type', 'name', 'author', 'comment', 'route', 'created_at', 'updated_at')
                ->where('author', '=', $id)
                ->latest();

            $families = DB::table('families')
                ->select('id', 'type', 'name', 'author', 'comment', 'route', 'created_at', 'updated_at')
                ->where('author', '=', $id)
                ->latest()
                ->union($houses)
                ->get();

            return $families;
        }

        return DB::table('families')
            ->select('id', 'type', 'name', 'author', 'comment', 'route', 'created_at', 'updated_at')
            ->where('author', '=', $id)
            ->latest()
            ->get();
    }

    public static function getSuggestedUsers($username) {
        return DB::table('users')
            ->select('username', 'image')
            ->latest()
            ->limit(5)
            ->get();
    }

    public static function getUserById($id) {
        return DB::table('users')
            ->where('id', '=', $id)
            ->select('id', 'username')
            ->first();
    }

    public static function getUserIdByName($username) {
        return DB::table('users')
            ->where('username', '=', $username)
            ->select('id')
            ->first()
            ->id;
    }

    public static function getIpv4() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    public static function getGeoCode($ip) {
        $res = file_get_contents('https://www.iplocate.io/api/lookup/' . $ip);
        $res = json_decode($res);

        switch ($res->country_code) {
            case 'DE':
                return 'de';
                break;
            default:
                return 'en';
                break;
        }
    }

    public static function getUserDataByName($username) {
        $data = DB::table('users')
            ->select('username', 'country_code', 'rank', 'image', 'created_at')
            ->where('username', '=', $username)
            ->first();

        return [
            'username' => $data->username,
            'country_code' => $data->country_code,
            'rank' => $data->rank,
            'image' => $data->image,
            'created_at' => self::toDateFormatWithFormatted($data->created_at, false)
        ];
    }

    public static function getProfileImageByName($username) {
        $image = DB::table('users')
            ->select('image')
            ->where('username', '=', $username)
            ->first()
            ->image;

        if($image != null && $image != '-1' && file_exists('media/uploads/profile/' . $image)) {
            return $image;
        } else {
            return 'no-profile.jpg';
        }
    }

    public static function fixProfileImage($image) {
        if($image == null || $image == '-1' || !file_exists('media/uploads/profile/' . $image)) {
            return 'no-profile.jpg';
        } else {
            //check if exists
            return $image;
        }
    }

    public static function toDateFormat($unformatted) {
        return date('M Y', strtotime($unformatted->created_at));
    }

    public static function toDateFormatWithFormatted($formatted, $withDay) {
        return date(($withDay ? 'j ' : '') . 'M Y', strtotime($formatted));
    }
}
