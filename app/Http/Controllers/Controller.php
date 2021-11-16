<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // protected function jsonResponse($data, $message, $code = 200)
    // {
    //     return response()->json([
    //         'status' => ($code != 200) ? false : true,
    //         'code' => $code,
    //         'data' => $data,
    //         'message' => $message
    //     ], 200);
    // }



    // protected function jsonFailedResponse($err, $message = null, $code = 422)
    // {

    //     // {
    //     //     "status": "error",
    //     //     "data": null, /* or optional error payload */
    //     //     "message": "Error xyz has occurred"
    //     //   }
    //     if ($err !== null) {
    //         Log::error($err);
    //     }

    //     return response()->json([
    //         'status' => false,
    //         'code' => $code,
    //         'data' => null,
    //         'message' => $message
    //     ], $code);
    // }
}
