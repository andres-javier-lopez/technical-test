<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function requestToken()
    {
        $token = Auth::user()->createToken('Test Token')->accessToken;

        return $token;
    }
}
