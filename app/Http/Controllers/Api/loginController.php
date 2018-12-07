<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller {

    public function login(Request $request) {

        $user = $request->user;
        $pass = $request->pass;

        if (Auth::attempt(['email' => $user, 'password' => $pass])) {

            return 1;
        } else {
            return 0;
        }
    }

}
