<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;

class Random
{
    public static function otp()
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $result = '';
        for ($i = 0; $i < 4; $i++) {
            $result .= $characters[rand(0, $charactersLength - 1)];
        }

        $validator = Validator::make(['otp' => $result], ['otp' => 'unique:users,otp']);

        if ($validator->fails()) {
            return Random::otp();
        }
        return $result;
    }
}
