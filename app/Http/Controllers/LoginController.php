<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\LoginAction;

class LoginController extends Controller
{
    public function __invoke(Request $request, LoginAction $loginAction)
    {
        $userData = $loginAction->execute($request)->save();

        return response()->json($userData);
    }
}
