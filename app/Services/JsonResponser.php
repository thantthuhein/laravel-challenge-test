<?php

namespace App\Services;

class JsonResponser {
     public function success200($message, $status = 200)
     {
          return response()->json([
               'status' => $status,
               'message' => $message
          ]);
     }

     public function invalid422($message, $status = 422)
     {
          return response()->json([
               'status' => $status,
               'message' => $message
          ]);
     }

     public function notFound404($message, $status = 404)
     {
          return response()->json([
               'status' => $status,
               'message' => $message
          ]);
     }

     public function serverError500($message, $status = 500)
     {
          return response()->json([
               'status' => $status,
               'message' => $message
          ]);
     }
}