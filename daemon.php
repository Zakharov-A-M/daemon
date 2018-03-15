<?php

include_once('crypt.php');
include_once('curl.php');
include_once('email.php');
include_once('json.php');

const HOUR = 3;

try {
    $response = new Curl();
    $crypt =  new Crypt();
    while (true) {
        $responseArray = $response->performRequest(['method' => 'get']);
        $output = $crypt->cryptXor($responseArray['message'], $responseArray['key']);
        $response->performRequest(['method' => 'update', 'message' => $output]);
        sleep(HOUR);
    }
} catch (Exception $e) {
    Email::sendByEmail(['message' => $e->getMessage(), 'code' =>$e->getCode()]);
}

