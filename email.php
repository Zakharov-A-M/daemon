<?php
include_once 'lib/phpmailer/class.phpmailer.php';
include_once 'lib/phpmailer/class.smtp.php';
include_once 'codeError.php';

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
     * @throws phpmailerException
     */
    public function sendByEmail(array $array): bool
    {
        $subject = 'Test Daemon : Zakharov A.M.';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.yandex.ru';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';
        $mail->Username = 'zakharov19951@yandex.by';
        $mail->Password = 'morgan19951';
        $mail->setFrom('zakharov19951@yandex.by');
        $mail->addAddress(self::MY_EMAIL);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $message = $this->getMessageError($array);

        $mail->Body = "Error message: {$message};  <br> Code: {$array['code']};";

        return $mail->send();
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
