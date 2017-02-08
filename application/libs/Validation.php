<?php

namespace App\Libs;

class Validation
{
//    Kiem tra tinh hop le cua username
    static public function isValidUser($user) {
        $pattern = "/^[a-zA-Z0-9]{6,18}$/";
        if (preg_match($pattern, $user)) {
            return true;
        } else {
            return false;
        }
    }

//    kiem tra tinh hop le cua password
    static function isValidPass($pass) {
        $pattern = "/^[a-zA-Z0-9]{8,32}$/";
        if (preg_match($pattern, $pass)) {
            return true;
        } else {
            return false;
        }
    }

}