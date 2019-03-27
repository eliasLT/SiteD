<?php 

function getNewError($errorCode, $errorMessage){
    $response  = array();
    $response['status'] = 'error';
    $response['code'] = $errorCode;
    $response['message'] = $errorMessage;
    return $response;
}

function getnewSuccess($code, $msg){
    $response  = array();
    $response['status'] = 'success';
    $response['code'] = $code;
    $response['message'] = $msg;
    return $response;
}