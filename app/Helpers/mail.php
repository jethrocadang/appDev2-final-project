<?php

namespace App\Helpers;

use App\Models\User;

function generate_otp() 
{
    $verification_code = rand(10000, 99999);
    $verification_code_exist = User::where('verification_code', $verification_code)->first();

    if ($verification_code_exist) {
        return generate_otp();
    }

    return $verification_code;

}

