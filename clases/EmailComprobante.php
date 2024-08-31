<?php
namespace Clases;

use PHPMailer\PHPMailer\PHPMailer;

class EmailComprobante{
    public $email;
    public $mensaje;

    public function __construct($email, $mensaje)
    {
        $this->email = $email;
        $this->mensaje = $mensaje;
    }
    public function EnviarComprobante()
    {
        //Crear objeto Email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PUERTO'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('jeanpiero_23_01@hotmail.com'); //de donde
        $mail->addAddress($this->email, 'Barber.com'); //para quien
        $mail->Subject = 'Comprobante';

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
                    <p>".$this->mensaje."</p>
                </body>
              </html>";


        $mail->Body = $contenido;

        //Enviar el Email
        $mail->send();
    }
}