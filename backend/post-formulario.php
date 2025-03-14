<?php
// Cargar DomPDF
require_once get_template_directory() . '/dompdf/autoload.inc.php';
require_once get_template_directory() . '/backend/form-html.php';
require_once get_template_directory() . '/backend/functions-html.php';
use Dompdf\Dompdf;
use Dompdf\Options;
$custom_logo_id = get_theme_mod('custom_logo');
$logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
// Definir porcentajes de áreas
$areas_percentaje = [
    'administracion' => 33.33,
    'ventas' => 22.22,
    'recursos_humanos' => 5.56,
    'finanzas' => 16.67,
    'familiar' => 22.22
];

$resultados = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar'])) {
    session_start();
    $is_familiar = $_SESSION['is_familiar'] ?? false;
    // Sanitizar inputs
    $correo = isset($_POST['correo']) ? sanitize_email($_POST['correo']) : '';
    $nombre = isset($_POST['nombre']) ? sanitize_text_field($_POST['nombre']) : '';
    $phone = isset($_POST['phone']) ? preg_replace('/[^0-9]/', '', $_POST['phone']) : '';
    
    // Procesar respuestas
    $respuestas = [];
    foreach ($_POST as $key => $value) {
        if (preg_match('/^response-(\d+)-(.+)$/', $key, $matches)) {
            $index = $matches[1];
            $area = $matches[2];
            $respuestas[$area][$index] = sanitize_text_field($value);
        }
    }
    $_SESSION['response'] = $respuestas;

    // Calcular promedios y ponderaciones
    
    $sum_not_fam = $is_familiar ? 0 : 5.555;
    foreach ($respuestas as $area => $puntuaciones) {
        $suma = array_sum(array_map('intval', $puntuaciones));
        $cantidad = count($puntuaciones);
        $promedio = $cantidad > 0 ? $suma / $cantidad : 0;
        
        $resultados[$area] = [
            "suma" => $suma,
            "promedio" => $promedio,
            "percentaje" => $areas_percentaje[$area] ?? 0,
            "ponderacion" => ($promedio * (($areas_percentaje[$area] ?? 0)+$sum_not_fam)) / 100
        ];
    }
    $_SESSION['resultados'] = $resultados;

    // Calcular ponderación total
    $ponderacion_total = round(array_sum(array_column($resultados, 'ponderacion')), 2);
    $_SESSION['ponderacion_total'] = round($ponderacion_total, 2);
    // Determinar resultado final
    $resultados_area = [];
    $resultado_global = 'no_init';
    foreach ($tabla_final as $rangos) {
        if ($ponderacion_total > $rangos['rango_inicial'] && $ponderacion_total <= $rangos['rango_final']) {
            $resultado_global = $rangos["resultado"];
            $_SESSION['resultado_global'] = $resultado_global;
        }
    }

    foreach ($all_questions as $area => $questions) {
        if ($area != 'familiar' || ($area == 'familiar' && $is_familiar)) {
            foreach ($questions as $index => $question) {
                foreach ($question['answers'] as $answer) {
                    if ($answer['question_weight'] == $respuestas[$area][$index]) {
                        $resultados_area[$questions[0]['area']][$index+1] = $answer;
                    }
                }                
            }
        }
    }
    $_SESSION['resultados_area'] = $resultados_area;
    $_SESSION['mensaje'] = "Prueba";
    // Generar y enviar el PDF
    if (!empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        // Generar el HTML para el PDF
        $html = get_html($resultados_area, $resultado_global, $ponderacion_total);
        $dompdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->render();
        
        $upload_dir = wp_upload_dir();
        $pdf_path = $upload_dir['path'] . '/resultados-' . $nombre . '.pdf';
        $pdf_url = $upload_dir['url'] . "/resultados-$nombre.pdf";
        file_put_contents($pdf_path, $dompdf->output());
        
        // Preparar el contenido HTML del correo
        // Usamos get_template_directory_uri() para obtener la URL pública del logo
        $logo_url = get_field('logo', 'option');
        $message = get_message($logo_url, $nombre);
        
        // Establecer cabeceras para enviar email en formato HTML
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: no-reply@.com'
        );
        
        $attachments = [$pdf_path];
        $subject = "Tus resultados del formulario";
        
        if (wp_mail($correo, $subject, $message, $headers, $attachments)) {
            $_SESSION['mensaje'] = "Hola $nombre, tus resultados fueron enviados correctamente al correo $correo";
            $_SESSION['form_true'] = false;
            $nuevo_post = [
                'post_title'  => 'Formulario de ' . $nombre,
                'post_status' => 'publish',
                'post_type'   => 'cuestionarios',
                'meta_input'  => [
                    'email' => $correo,
                    'nombre' => $nombre,
                    'telefono' => $phone,
                    'archivo_pdf' => $pdf_url
                ]
            ];
            wp_insert_post($nuevo_post);
        } else {
            $_SESSION['mensaje'] = "Hubo un error al enviar el correo.";
        }
        
    }
    
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['familiar-send'])){
    if (isset($_POST['familiar'])) {
        session_start();
        $_SESSION['form_true'] = true;

        $familiar = htmlspecialchars($_POST['familiar'], ENT_QUOTES, 'UTF-8');

        $is_familiar = $familiar == 'yes';
        session_start();
        $_SESSION['is_familiar'] = $is_familiar;
    }
}

// Manejo de sesiones
session_start();

$respuestas = $_SESSION['response'] ?? '';
unset($_SESSION['response']);
$resultados = $_SESSION['resultados'] ?? '';
unset($_SESSION['resultados']);
$resultados_area = $_SESSION['resultados_area'] ?? '';
unset($_SESSION['resultados_area']);
$resultado_global = $_SESSION['resultado_global'] ?? '';
unset($_SESSION['resultado_global']);
$ponderacion_total = $_SESSION['ponderacion_total'] ?? '';
unset($_SESSION['ponderacion_total']);


$form_true = $_SESSION['form_true']?? false;
unset($_SESSION['form_true']);
$is_familiar = $_SESSION['is_familiar'] ?? false;
$mensaje = $_SESSION['mensaje'] ?? '';
unset($_SESSION['mensaje']);

?>
