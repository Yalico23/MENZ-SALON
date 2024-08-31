<?php 
namespace Clases;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }
    public function EnviarConfirmacion()
    {
        //Crear objeto Email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PUERTO'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom("jeanpiero_23_01@hotmail.com"); //de donde
        $mail->addAddress($this->email, 'Barber.com'); //para quien
        $mail->Subject = 'Confirmar Cuenta';

        //Usando HTML
        $mail->isHTML();
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>
                <head>
                    <style>
                        body {
                            font-family: 'Arial', sans-serif;
                            line-height: 1.6;
                            color: #333;
                        }
                        p {
                            margin-bottom: 15px;
                        }
                        a {
                            color: #007bff;
                            text-decoration: none;
                        }
                    </style>
                </head>
                <body>
                    <p>Hola " . $this->nombre . ",</p>
                    <p>Has creado tu cuenta en Barber. Para confirmar tu cuenta, por favor presiona el siguiente enlace:</p>
                    <p><a href='" . $_ENV['PROJECT_URL'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>
                    <p>Si no solicitaste esta cuenta, puedes ignorar este mensaje.</p>
                </body>
              </html>";


        $mail->Body = $contenido;

        //Enviar el Email
        $mail->send();
    }

    public function enviarInstrucciones()
    {
        //Crear objeto Email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PUERTO'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom("jeanpiero_23_01@hotmail.com"); //de donde
        $mail->addAddress($this->email, 'Barber.com'); //para quien
        $mail->Subject = 'Restablecer tu Password';

        //Usando HTML
        $mail->isHTML();
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>
                <head>
                    <style>
                        body {
                            font-family: 'Arial', sans-serif;
                            line-height: 1.6;
                            color: #333;
                        }
                        p {
                            margin-bottom: 15px;
                        }
                        strong {
                            font-weight: bold;
                        }
                        a {
                            color: #007bff;
                            text-decoration: none;
                        }
                    </style>
                </head>
                <body>
                    <p><strong>Hola " . $this->nombre . ",</strong></p>
                    <p>Has solicitado restablecer tu contraseña. Sigue el siguiente enlace para hacerlo:</p>
                    <p><a href='" . $_ENV['PROJECT_URL'] . "/recuperar?token=" . $this->token . "'>Restablecer contraseña</a></p>
                    <p>Si no solicitaste este restablecimiento, puedes ignorar este mensaje.</p>
                </body>
              </html>";


        $mail->Body = $contenido;

        //Enviar el Email
        $mail->send();
    }
}
?>