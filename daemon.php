<?php

include_once('crypt.php');
include_once('curl.php');
include_once('email.php');

const HOUR = 3600;

try {
    $timeStart = time();
    $response = new Curl();
    $crypt =  new Crypt();
    while (true) {
        $responseArray = $response->performRequest(['method' => 'get']);
        $output = $crypt->cryptXor($responseArray['response']['message'], $responseArray['response']['key']);
        if ((time() - $timeStart) >= HOUR) {
           $response->performRequest(['method' => 'update', 'message' => $output]);
           $timeStart = time();
        }
    }
} catch (Exception $e) {
    $email = new Email();
    $email->sendByEmail(['message' => $e->getMessage(), 'code' =>$e->getCode()]);
}

