<?php

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
        $outText = $this->encrypt($str, $key);
        return base64_encode($outText);
    }

    /**
     * Encrypt for algorithm XOR
     *
     * @param string $string
     * @param string $key
     * @return string
     */
    private function encrypt(string $string, string $key): string
    {
        $string = mt_rand() . ':' . $string . ':' . mt_rand();
        for($i = 0; $i < strlen($string); $i++) {
            $k = $key . substr($string, $i + 1) . ($i + 1) . "";
            for($j = 0; $j < strlen($k); $j++)
                $string[$i] = $string[$i] ^ $k[$j];
        }
        return $this->base64encode($string);
    }

    /**
     * Base64 encode for algorithm XOR
     *
     * @param string $data
     * @return string
     */
    private function base64encode(string  $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

}