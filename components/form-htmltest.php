<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

$resultados = $args['resultados'];
$resultado_global = $args['resultado_global'];
$ponderacion_total = $args['ponderacion_total'] ?? "none";

$social_media = get_field('social_media', 'option');
$contact = get_field('contact', 'option');

$redes = "";

foreach ($social_media as $index => $social) {
    $img_url = $social['icon'];
    $link = $social['link'];
    $padding_r = ($index != count($social))?'padding-right: 1em;':'';
    $redes .= "<li style='display: table-cell; $padding_r'>
                    <a href='$link' target='_blank'>
                        <img src='$img_url' alt='social media'>
                    </a>
                </li>";
}

$info_contact = "";
foreach ($contact as $index => $item) {
    $text = $item['text'];
    $icon_url = $item['icon'];
    $info_contact .= "<li style='display: table; padding-bottom:1em'>
                        <img style='display: table-cell; ' src='$icon_url' alt=''>
                        <p style='display: table-cell; vertical-align: middle; padding-left: .5em'>
                            $text
                        </p>
                    </li>";
}

date_default_timezone_set('America/Mexico_City');
$meses = [
    "January" => "Enero", "February" => "Febrero", "March" => "Marzo",
    "April" => "Abril", "May" => "Mayo", "June" => "Junio",
    "July" => "Julio", "August" => "Agosto", "September" => "Septiembre",
    "October" => "Octubre", "November" => "Noviembre", "December" => "Diciembre"
];

$mes = date("F");
$mes_es = $meses[$mes];

$thead = "<thead >
            <tr>
                <td style='border-top: 3px solid #116FC7;border-right: 1px solid #116FC7;'></td>
                <td style='border-top: 3px solid #116FC7; width: 60%'></td>
                <td style='border-top: 3px solid #116FC7; border-left: 1px solid #116FC7;width:25%'></td>
            </tr>
        </thead>";

$tfoot = "<tfoot style='display: table-footer-group;'>
            <tr>
                <td style='border-bottom: 3px solid #116FC7;border-right: 1px solid #116FC7;'></td>
                <td style='border-bottom: 3px solid #116FC7; width: 60%'></td>
                <td style='border-bottom: 3px solid #116FC7; border-left: 1px solid #116FC7;width:25%'></td>
            </tr>
        </tfoot>";

$tables = "";

foreach ($resultados as $area => $resultados_area) {
    $tables .= "<div style='margin-bottom: 3em'>
                    <h3 style='text-transform: capitalize;text-align: center;font-size: 1em; margin-bottom: .8em; color: #226fc7; font-weight: bold'>$area</h3>
                    <table style='width: 100%; border-left: 3px solid #116FC7; border-right: 3px solid #116FC7; border-radius: 7px;position: ralative'>
                    ".$thead."
                        <tbody>
                    ";
    foreach($resultados_area as $index =>$resultados){
        $border_bottom = ($index != count($resultados_area)) ?"; border-bottom: 1px solid #116FC7":"";
        $tables .= " <tr>
                        <td style='padding: 0 $border_bottom;border-right: 1px solid #116FC7; vertical-align: middle; text-align:center; font-weight: bold; color: #116FC7'>
                            $index
                        </td>
                        <td style='padding: 1em $border_bottom; width: 60%'>
                            <p style='font-size: .86em; line-height: 1.3em'>
                            ".$resultados['consecuencia']."
                            </p>
                        </td>
                        <td style='padding: 1em; border-left: 1px solid #116FC7; width:25%'></td>
                    </tr>";
    }

    $tables .= "        </tbody>
                    ".$tfoot."
                    </table>
                </div>";
}


echo "
<html>
<head>
    <style>
        *{
            color: #242424;
            font-family: Arial, Helvetica, sans-serif;
        }
        body *{
            margin: 0;
            padding: 0;
        }
        h1{
            font-size: 1.5em;
        }
        
        h2{
            font-size: 1.2em;
        }
        table{
            position: relative;
            border-spacing: 0;
            width: 100%;
            page-break-inside: auto
        }
        thead {
            display: table-header-group;
        }        
        tfoot {
            display: table-footer-group;
        }        
        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        td, th {
            padding: 5px;
            page-break-inside: avoid;
        }
        ul{
            list-style: none;
        }
    </style>
</head>
<body>
<div>
        <header style='margin-bottom:3em'>
            <h1 style='text-align: center;margin-bottom: .6em'>Diagnostico empresarial</h1>
            <p style='text-align: center; color:#787878; font-size: .85em'>Formulario llenado el ".date("d")." de ".$mes_es." de ".date("Y")."</p>
        </header>
        <table style='width: 100%; border: 3px solid #FF9E0F; border-radius:8px'>
            <tr>
                <td style='width: 75%; vertical-align: top; padding:1em 1.4em'>
                    <h2 style='margin-bottom: .3em;'>Resultado global: $ponderacion_total de 5 </h2>
                    <p style='line-height: 1.3em'>
                    ".$resultado_global."
                    </p>
                </td>
                <td style='width: 25%; vertical-align: top; padding:1em 1.4em; border-left: 1px solid #FF9E0F'>
                    <img src='ruta-a-la-imagen.png' alt='grafica' style='width: 90%; display: block; margin: auto;'>
                </td>                
            </tr>
        </table>
        <div style='margin-top: 4em;'>
            <h2 style='text-align: center; margin-bottom:1em'>Basado en tus respuestas</h2>

            ".$tables."

        </div>
        <div class='note' style='margin-top: 4em; position: relative; width:80%;left:50%; transform: translateX(-50%); border-left: 3px solid #116FC7; padding: 2em 0 2em 1em'>
            <p style='font-weight:bold; line-height: 1.5em'>
                Si quieres conocer en mayor profundidad el resultado, puedes comunicarte con nosotros al celular tal o mándanos
                un WhatsApp con tu nombre para que nos pongamos en contacto contigo.
            </p>
        </div>

        
        <footer style='margin-top: 4em; width:70%; position: relative; left:50%; transform: translateX(-50%)'>
            <div style='width:80%; border-top:2px solid #242424; padding-top:2em; position: relative; left:50%; transform: translateX(-50%)'>
                <ul style='display: table;position: relative;left: 50%; transform: translateX(-50%);'>
                    $redes
                </ul>
            </div>
            
            <ul class='list-data' style='margin-top:3em; display: table'>
                $info_contact
            </ul>
        </footer>
    </div>
</body>
</html>";

?>