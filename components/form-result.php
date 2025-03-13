<?php
$resultados = $args['resultados'];
$resultado_global = $args['resultado_global'];
$ponderacion_total = $args['ponderacion_total'];
date_default_timezone_set('America/Mexico_City');
$meses = [
    "January" => "Enero", "February" => "Febrero", "March" => "Marzo",
    "April" => "Abril", "May" => "Mayo", "June" => "Junio",
    "July" => "Julio", "August" => "Agosto", "September" => "Septiembre",
    "October" => "Octubre", "November" => "Noviembre", "December" => "Diciembre"
];

$mes = date("F");
$mes_es = $meses[$mes];

$args = [
    'resultados'=>$resultados,
    'resultado_global'=>$resultado_global,
    'mes'=>$mes,
    'ponderacion_total'=>$ponderacion_total,
];
get_template_part('components/form', 'htmltest', $args);
?>