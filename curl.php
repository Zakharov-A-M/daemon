<?php

declare(strict_types=1);

class Curl
{
    const URL = 'https://syn.su/testwork.php';

    /**
     * Send http request on this site
     *
     * @param $array $array
     * @return array $responseInfo
     * @throws Exception
     */
    public function performRequest(array $array): array
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::URL);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($array));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            throw new Exception('Error http request');
        }
        curl_close($curl);

        $responseInfo = json_decode($response, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new Exception('Invalid json format');
        }

        if (!empty($responseInfo['errorCode'])) {
            throw new Exception('', $responseInfo['errorCode']);
        }

        return $responseInfo['response'];
    }
}
