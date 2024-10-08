<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correo extends CI_Controller {

    public function enviar_correo()
    {
        // Cargar la librería de email con la configuración predeterminada de email.php
        $this->load->library('email');

        // Establecer remitente y destinatario
        $this->email->from('crenasasrl2@gmail.com', 'CRENASA SRL'); // Remitente
        $this->email->to('crenasasrl2@gmail.com'); // Destinatario

        // Asunto y mensaje
        $this->email->subject('Asunto del correo');
        $this->email->message('<p>Este es un correo de prueba.</p>');

        // Enviar el correo
        if ($this->email->send()) {
            echo 'Correo enviado correctamente esto es la prueba 2';
        } else {
            // Mostrar el error si ocurre
            echo $this->email->print_debugger();
        }
    }
}
