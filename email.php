<?php

declare(strict_types=1);

class Email
{
    const MY_EMAIL = 'morgan.zaharov@yandex.ru';
    const CODE_ERROR_10 = 10;
    const CODE_ERROR_15 = 15;
    const CODE_ERROR_20 = 20;

    private $responseMessageError = [
        self::CODE_ERROR_10 => 'Не получилось расшифровать строку',
        self::CODE_ERROR_15 => 'Нет такого метода',
        self::CODE_ERROR_20 => 'Пустое значение параметра message'
    ];

    /**
     * send message about this exception text
     *
     * @param array $array
     * @return bool
     */
    public function sendByEmail(array $array): bool
    {
        $subject = 'Test Daemon : Zakharov A.M.';
        $message = $this->getMessageError($array);

        return mail(self::MY_EMAIL, $subject, "Error message: {$message}  <br>  Code: {$array['code']}");
    }

    /**
     * Get message by code error
     *
     * @param array $array
     * @return string
     */
    public  function getMessageError(array $array): string
    {
        return $this->responseMessageError[$array['code']] ?? $array['message'];
    }
}
