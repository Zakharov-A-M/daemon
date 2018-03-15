<?php


class Json
{
    /**
     * Check if the string is json
     *
     * @param string $str
     * @return bool
     */
    public static function isJson(string $str): bool
    {
        json_decode($str);
        return (JSON_ERROR_NONE !== json_last_error());
    }
}
