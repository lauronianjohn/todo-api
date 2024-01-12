<?php

namespace App\Traits;

trait HttpResponses {
        /**
     * Reponse success with token
     * @param mixed $message
     * @param mixed $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status'    => 'Request was succesful',
            'message'   => $message,
            'data'      => $data,
            'success'   => true
        ], $code);
    }

    /**
     * Reponse with error
     * @param mixed $message
     * @param mixed $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($data, $message = null, $code = 400)
    {
        return response()->json([
            'status'    => 'Error has occured...',
            'message'   => $message,
            'data'      => $data,
            'success'   => false
        ], $code);
    }
}
