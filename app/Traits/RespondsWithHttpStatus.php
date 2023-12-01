<?php

namespace App\Traits;
trait RespondsWithHttpStatus
{
    protected function sendResponse($result, $message)
    {
    	$response = [
    	    'status'  => 'success',
            'statusCode' => 200,
            'message' => $message,
            'data'    => $result,
        ];
        return response()->json($response, 200);
    }

    protected function sendError($error, $errorMessages = [], $code = 400)
    {
    	$response = [
    	    'status'  => 'false',
            'statusCode' => $code,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}

?>
