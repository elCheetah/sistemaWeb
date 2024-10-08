<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;
class PdfController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //require_once APPPATH . 'libraries/mpdf810/src/Mpdf.php'; // Asegúrate de que esta ruta sea correcta
        // También asegurarte que la clase Strict esté incluida si es necesario
        //require_once APPPATH . 'libraries/mpdf810/src/Strict.php'; // Asegúrate de que esta ruta sea correcta
        //$this->load->library('tcpdf');
        //$this->load->library('mpdf');
        $this->load->model('Usuario_model');
        $this->load->model('Cliente_model');
        $this->load->model('Garante_model'); // Cargar el modelo de garantes
        // Cargar la biblioteca mPDF
        
    }

    public function genpdf() {
        // Inicializa Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);

        // Cargar contenido HTML para el PDF
        $html = "<h1>Hola, este es tu PDF generado con Dompdf en CodeIgniter</h1>";

        // Renderizar HTML a PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Enviar PDF al navegador
        $dompdf->stream("archivo_generado.pdf", array("Attachment" => 0));
    }
    public function generar_pdf() {
        // Inicializa Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);
    
        // Cargar la vista y pasarla a la librería Dompdf
        $html = $this->load->view('pdf_view', [], true);
    
        // Renderizar HTML a PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        // Enviar PDF al navegador
        $dompdf->stream("archivo_generado.pdf", array("Attachment" => 0));
    }
    
    public function generate_pdf() {
        // Crear una instancia de mPDF con tamaño carta
        $mpdf = new \Mpdf\Mpdf(['format' => 'Letter']);

        // HTML con Bootstrap
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                @media print {
                    h1, h2, h3, h4, h5, h6 {
                        page-break-after: avoid;
                    }
                }
                .container {
                    margin: 20px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1 class="text-center">Título del PDF</h1>
                <p class="lead">Este es un ejemplo de un PDF generado con mPDF y Bootstrap.</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Encabezado 1</th>
                            <th>Encabezado 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Datos 1</td>
                            <td>Datos 2</td>
                        </tr>
                        <tr>
                            <td>Datos 3</td>
                            <td>Datos 4</td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="text-primary">Sección Adicional</h2>
                <p>Más contenido aquí. Puedes agregar imágenes, listas, y otros elementos de Bootstrap.</p>
                <ul class="list-group">
                    <li class="list-group-item">Elemento de lista 1</li>
                    <li class="list-group-item">Elemento de lista 2</li>
                    <li class="list-group-item">Elemento de lista 3</li>
                </ul>
            </div>
        </body>
        </html>
        ';

        // Cargar el HTML en mPDF
        $mpdf->WriteHTML($html);

        // Salida del PDF
        $mpdf->Output("documento.pdf", 'D');
    }
    /*
    public function usuarios()
    {
        // Obtener los datos de los usuarios
        $usuarios = $this->Usuario_model->obtener_usuarios_activos();

        // Crear un nuevo documento PDF
        $pdf = new TCPDF();

        // Configurar el documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('CRENASA SRL');
        $pdf->SetTitle('Lista de Usuarios Activos');
        $pdf->SetMargins(15, 15, 15); // Ajustar márgenes
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage('P', 'A4');

        // Establecer el fondo
        $pdf->SetFillColor(255, 255, 255); // Color de fondo blanco
        $pdf->Rect(0, 0, 210, 297, 'F'); // Rellenar el fondo

        // Título
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->SetTextColor(0, 0, 0); // Color negro
        $pdf->Cell(0, 10, 'Lista de Usuarios Activos', 0, 1, 'C', 0, '', 0);
        $pdf->Ln(10); // Espacio debajo del título

        // Encabezados de la tabla
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(10, 10, 'ID', 1, 0, 'C', 1);
        $pdf->Cell(60, 10, 'Nombre Completo', 1, 0, 'L', 1);
        $pdf->Cell(40, 10, 'Correo Electrónico', 1, 0, 'L', 1);
        $pdf->Cell(25, 10, 'Teléfono', 1, 0, 'C', 1);
        $pdf->Cell(25, 10, 'Rol', 1, 0, 'C', 1);
        $pdf->Cell(25, 10, 'Estado', 1, 0, 'C', 1);
        $pdf->Ln();

        // Contenido de la tabla
        $pdf->SetFont('helvetica', '', 11);
        $fill = false;

        foreach ($usuarios as $usuario) {
            $pdf->Cell(10, 10, $usuario['usuario_id'], 1, 0, 'C', $fill);
            $pdf->Cell(60, 10, $usuario['nombre'] . ' ' . $usuario['primer_apellido'] . ' ' . $usuario['segundo_apellido'], 1, 0, 'L', $fill);
            $pdf->Cell(40, 10, $usuario['email'], 1, 0, 'L', $fill);
            $pdf->Cell(25, 10, $usuario['telefono'], 1, 0, 'C', $fill);
            $pdf->Cell(25, 10, $usuario['rol'], 1, 0, 'C', $fill);
            $pdf->Cell(25, 10, ($usuario['estado'] == 1 ? 'Activo' : 'Inactivo'), 1, 0, 'C', $fill);
            $pdf->Ln();
            $fill = !$fill; // Alternar color de fondo
        }

        // Salida del PDF
        $pdf->Output('lista_usuarios.pdf', 'D'); // 'D' para descargar, 'I' para mostrar en el navegador
    }

    public function clientes()
    {
        // Obtener los datos de los clientes activos
        $clientes = $this->Cliente_model->obtener_clientes_activos();

        // Crear un nuevo documento PDF
        $pdf = new TCPDF();

        // Configurar el documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('CRENASA SRL');
        $pdf->SetTitle('Lista de Clientes Activos');
        $pdf->SetMargins(15, 15, 15); // Ajustar márgenes
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage('P', 'A4');

        // Establecer el fondo
        $pdf->SetFillColor(255, 255, 255); // Color de fondo blanco
        $pdf->Rect(0, 0, 210, 297, 'F'); // Rellenar el fondo

        // Título
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->SetTextColor(0, 0, 0); // Color negro
        $pdf->Cell(0, 10, 'Lista de Clientes Activos', 0, 1, 'C', 0, '', 0);
        $pdf->Ln(10); // Espacio debajo del título

        // Encabezados de la tabla
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(20, 10, 'ID', 1, 0, 'C', 1);
        $pdf->Cell(70, 10, 'Nombre Completo', 1, 0, 'L', 1);
        $pdf->Cell(30, 10, 'CI', 1, 0, 'C', 1);
        $pdf->Cell(30, 10, 'Teléfono', 1, 0, 'C', 1);
        $pdf->Cell(50, 10, 'Correo Electrónico', 1, 0, 'L', 1);
        $pdf->Cell(30, 10, 'Estado', 1, 0, 'C', 1);
        $pdf->Ln();

        // Contenido de la tabla
        $pdf->SetFont('helvetica', '', 11);
        $fill = false;

        foreach ($clientes as $cliente) {
            $pdf->Cell(20, 10, $cliente['cliente_id'], 1, 0, 'C', $fill);
            $pdf->Cell(70, 10, $cliente['nombre'] . ' ' . $cliente['primer_apellido'] . ' ' . $cliente['segundo_apellido'], 1, 0, 'L', $fill);
            $pdf->Cell(30, 10, $cliente['ci'], 1, 0, 'C', $fill);
            $pdf->Cell(30, 10, $cliente['telefono'], 1, 0, 'C', $fill);
            $pdf->Cell(50, 10, $cliente['email'], 1, 0, 'L', $fill);
            $pdf->Cell(30, 10, ($cliente['estado'] == 1 ? 'ACTIVO' : 'INACTIVO'), 1, 0, 'C', $fill);
            $pdf->Ln();
            $fill = !$fill; // Alternar color de fondo
        }

        // Salida del PDF
        $pdf->Output('lista_clientes.pdf', 'D'); // 'D' para descargar, 'I' para mostrar en el navegador
    }
    public function garantes()
    {
        // Obtener los datos de los garantes activos
        $garantes = $this->Garante_model->obtener_garantes_activos();

        // Crear un nuevo documento PDF
        $pdf = new TCPDF();

        // Configurar el documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('CRENASA SRL');
        $pdf->SetTitle('Lista de Garantes Activos');
        $pdf->SetMargins(15, 15, 15); // Ajustar márgenes
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage('P', 'A4');

        // Establecer el fondo
        $pdf->SetFillColor(255, 255, 255); // Color de fondo blanco
        $pdf->Rect(0, 0, 210, 297, 'F'); // Rellenar el fondo

        // Título
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->SetTextColor(0, 0, 0); // Color negro
        $pdf->Cell(0, 10, 'Lista de Garantes Activos', 0, 1, 'C', 0, '', 0);
        $pdf->Ln(10); // Espacio debajo del título

        // Encabezados de la tabla
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(20, 10, 'ID', 1, 0, 'C', 1);
        $pdf->Cell(70, 10, 'Nombre Completo', 1, 0, 'L', 1);
        $pdf->Cell(30, 10, 'CI', 1, 0, 'C', 1);
        $pdf->Cell(30, 10, 'Teléfono', 1, 0, 'C', 1);
        $pdf->Cell(50, 10, 'Correo Electrónico', 1, 0, 'L', 1);
        $pdf->Cell(30, 10, 'Estado', 1, 0, 'C', 1);
        $pdf->Ln();

        // Contenido de la tabla
        $pdf->SetFont('helvetica', '', 11);
        $fill = false;

        foreach ($garantes as $garante) {
            $pdf->Cell(20, 10, $garante['garante_id'], 1, 0, 'C', $fill);
            $pdf->Cell(70, 10, $garante['nombre'] . ' ' . $garante['primer_apellido'] . ' ' . $garante['segundo_apellido'], 1, 0, 'L', $fill);
            $pdf->Cell(30, 10, isset($garante['ci']) ? $garante['ci'] : 'N/A', 1, 0, 'C', $fill); // Manejo de error
            $pdf->Cell(30, 10, isset($garante['telefono']) ? $garante['telefono'] : 'N/A', 1, 0, 'C', $fill);
            $pdf->Cell(50, 10, isset($garante['email']) ? $garante['email'] : 'N/A', 1, 0, 'L', $fill);
            $pdf->Cell(30, 10, ($garante['estado'] == 1 ? 'ACTIVO' : 'INACTIVO'), 1, 0, 'C', $fill);
            $pdf->Ln();
            $fill = !$fill; // Alternar color de fondo
        }

        // Salida del PDF
        $pdf->Output('lista_garantes.pdf', 'D'); // 'D' para descargar, 'I' para mostrar en el navegador
    }
    public function factura($prestamo_id)
{
    // Cargar el modelo necesario para obtener los detalles del préstamo
    $this->load->model('Prestamos_model'); // Asegúrate de que este modelo exista

    // Obtener los detalles del préstamo
    $prestamo = $this->Prestamos_model->obtener_detalle_prestamo($prestamo_id);

    // Crear un nuevo documento PDF
    $pdf = new TCPDF();

    // Configurar el documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('CRENASA SRL');
    $pdf->SetTitle('Factura de Préstamo');
    $pdf->SetMargins(15, 15, 15); // Ajustar márgenes
    $pdf->SetAutoPageBreak(TRUE, 15);
    $pdf->AddPage('P', 'A4');

    // Aquí se puede personalizar el contenido de la factura
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, 'Factura de Préstamo', 0, 1, 'C');
    $pdf->Ln(10);

    // Detalles del préstamo
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'ID del Préstamo: ' . $prestamo['prestamo_id'], 0, 1);
    $pdf->Cell(0, 10, 'Monto: ' . $prestamo['monto'], 0, 1);
    $pdf->Cell(0, 10, 'Tasa de Interés: ' . $prestamo['tasa_interes'] . '%', 0, 1);
    $pdf->Cell(0, 10, 'Fecha de Inicio: ' . $prestamo['fecha_inicio'], 0, 1);
    $pdf->Cell(0, 10, 'Fecha de Vencimiento: ' . $prestamo['fecha_vencimiento'], 0, 1);
    // Agrega más detalles según sea necesario

    // Salida del PDF
    $pdf->Output('factura_prestamo_' . $prestamo_id . '.pdf', 'D'); // 'D' para descargar
}
*/
}