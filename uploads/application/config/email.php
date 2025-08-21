<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_port'] = 587; //465 Puerto para TLS
$config['smtp_user'] = 'eabraham203@gmail.com'; // Tu correo electrónico
$config['smtp_pass'] = 'vkinaadhdgxhodke'; // La contraseña del correo electrónico Cr3n4s4SRL2
$config['mailtype'] = 'html';
$config['charset']  = 'utf-8';
$config['wordwrap'] = TRUE;
//$config['smtp_crypto'] = 'tls'; // Usar TLS para Gmail
$config['newline'] = "\r\n"; // Importante para el correcto envío de correos
//$config['crlf'] = "\r\n"; // También importante para el correcto envío de correos
