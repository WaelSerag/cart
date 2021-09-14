<?php
/**
* [sendResponse description]
* @param  [string] $message [message success]
* @param  [array] $data    [any data object or array]
* @return [json]          [json success]
*/
function sendResponse($message,$data,$status = null){
    empty($status) ? $status = 200 : $status;
    return response()->json([
        "status" => true,
        "message" => $message,
        "data"    => $data,
    ],$status);
}
/**
* [sendError description]
* @param  [string] $message [message error]
* @return [array]          [errors]
*/
function sendError($message,$status = null){
    empty($status) ? $status = 400 : $status;
    return response()->json([
        "status" => false,
        "message" => $message,
    ],$status);
}
