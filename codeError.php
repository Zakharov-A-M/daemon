<?php


class CodeError
{
    const CODE_10 = 'Не получилось расшифровать строку';
    const CODE_15 = 'Нет такого метода';
    const CODE_20 = 'Пустое значение параметра message';


    public static function getMessageError(array $array): string
    {
        switch ($array['code']) {
            case 15:
                return self::CODE_15;
                break;
            case 20:
                return self::CODE_20;
                break;
            case 10:
                return  self::CODE_10;
            default:
                return $array['message'];
        }
    }
}