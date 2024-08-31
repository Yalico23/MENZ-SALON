<?php 
namespace Clases;

use PHPMailer\PHPMailer\PHPMailer;

class EmailCorreo{
    public $Nombre;
    public $Apellidos;
    public $Telefono;
    public $Correo;
    public $Mensaje;

    public function __construct($Nombre, $Apellidos, $Telefono , $Correo, $Mensaje)
    {
        $this->Nombre = $Nombre;
        $this->Apellidos = $Apellidos;
        $this->Telefono = $Telefono;
        $this->Correo = $Correo;
        $this->Mensaje = $Mensaje;
    }

    public function Correo(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PUERTO'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom($this->Correo); //de donde
        $mail->addAddress('jeanpiero_23_01@hotmail.com', 'Barber.com'); //para quien
        $mail->Subject = 'Consulta para la Tienda';

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
                    <p>Hola equipo de BARBER.CORP,</p>
                    <p>Has recibido un mensaje de un usuario desde el sitio web solicitando información o asistencia. Aquí están los detalles:</p>
                    <ul>
                        <li>Nombre: " . $this->Nombre . " " . $this->Apellidos . "</li>
                        <li>Teléfono: " . $this->Telefono . "</li>
                        <li>Correo: " . $this->Correo . "</li>
                        <li>Mensaje: " . $this->Mensaje . "</li>
                    </ul>
                    <p>Por favor, responde a la brevedad posible para ayudar al usuario con su consulta.</p>
                    <p>¡Gracias!</p>
                </body>
              </html>";

        $mail->Body = $contenido;

        //Enviar el Email
        $mail->send();
    }
}
?>