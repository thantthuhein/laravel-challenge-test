<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use App\Exceptions\LoginException;
use Illuminate\Support\Facades\Hash;
use Facades\App\Services\JsonResponser;

class LoginAction {
     private $request;
     private $userData;

     public function __construct(Request $request)
     {
          $this->request = $request;
     }

     public function execute($request)
     {
          // Login Logics
          if (! $request->email) {
               throw new LoginException(
                    JsonResponser::invalid422('Email Is Required!')
               );
          }

          if (strlen($request->email) < 6) {
               throw new LoginException(
                    JsonResponser::invalid422('Email Is Invalid!')
               );
          }

          if (! $request->password) {
               throw new LoginException(
                    JsonResponser::invalid422('Password Is Required!')
               );
          }

          if (strlen($request->password) < 8) {
               throw new LoginException(
                    JsonResponser::invalid422('Password Is Invalid!')
               );
          }

          $user = User::where('email', $request->email)->first();

          if (! $user) {
               throw new LoginException(
                    JsonResponser::notFound404('User Not Found!')
               );
          }

          if (! Hash::check($request->password, $user->password)) {
               throw new LoginException(
                    JsonResponser::notFound404('Invalid Credentials!')
               );
          }

          $this->userData = [
               'user' => $user,
               'token' => $user->createToken('User-Token')->plainTextToken
          ];

          return $this;
     }

     public function save()
     {
          return $this->userData;
     }
}