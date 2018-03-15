<?php
include_once 'lib/phpmailer/class.phpmailer.php';
include_once 'lib/phpmailer/class.smtp.php';

class Email
{
    const MY_EMAIL = 'morgan.zaharov@yandex.ru';

    /**
     * send message about this exception text
     *
     * @param array $array
     * @return bool
     * @throws phpmailerException
     */
    public static function sendByEmail(array $array): bool
    {
        $message = $array['message'];
        $subject = 'Zakharov A.M.  ';
        $headers = 'Test Daemon    ';

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
        $mail->Subject = $headers . $subject;

        switch ($array['code']) {
            case 15:
                $message = 'Нет такого метода';
                break;
            case 20:
                $message = 'Пустое значение параметра message';
                break;
            case 10:
                $message = 'Не получилось расшифровать строку';
                break;
        }
        $mail->Body = "Error message: {$message};  <br> Code: {$array['code']};";

        return $mail->send();
    }
}
