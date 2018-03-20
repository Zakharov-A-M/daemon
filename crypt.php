<?php

declare(strict_types=1);

class Crypt
{
    /**
     * Encryption text message
     *
     * @param $str
     * @param $key
     * @return string $string
     */
    public function cryptXor(string $str, string $key): string
    {
        $string = '';
        $key = substr($key, 0, strlen($str));

        for ($i = 0; $i < strlen($str); $i++) {
            $string .= $str[$i] ^ $key[$i % strlen($key)];
        }
        return base64_encode($string);
    }
}
