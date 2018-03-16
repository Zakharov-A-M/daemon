<?php

include_once('crypt.php');
include_once('curl.php');
include_once('email.php');
include_once('json.php');

const HOUR = 3;

try {
    $timeStart = time();
    $response = new Curl();
    $crypt =  new Crypt();
    while (true) {
        $responseArray = $response->performRequest(['method' => 'get']);
        $output = $crypt->cryptXor($responseArray['message'], $responseArray['key']);
        if ((time() - $timeStart) >= HOUR) {
            $response->performRequest(['method' => 'update', 'message' => $output]);
            $timeStart = time();
        }
    }
} catch (Exception $e) {
    $email = new Email();
    $email->sendByEmail(['message' => $e->getMessage(), 'code' =>$e->getCode()]);
}

