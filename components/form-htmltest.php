<?php
$resultados = $args['resultados'];
$resultado_global = $args['resultado_global'];
$ponderacion_total = $args['ponderacion_total'] ?? "none";
$resultados_area = $args['resultados_area'];
$social_media = get_field('social_media', 'option');
$contact = get_field('contact', 'option');

$porcentage_total = ($ponderacion_total / 5) *100;

$rangos = [
    1 => '20',
    2 => '40',
    3 => '60',
    4 => '80',
    5 => '100'
];

$promedios = [];
foreach($resultados_area as $area => $array){
    $promedios[$area] = round($array['promedio'], 2);
}


$graficas_total = get_field('graficas_total', 'option');
$indice = min(5, max(1, ceil($ponderacion_total))); // Asegura que esté entre 1 y 5
$url_grafica = $graficas_total[$rangos[$indice]];

$redes = "";
$graficas = get_field('graficas', 'option');

foreach ($social_media as $index => $social) {
    $img_url = $social['icon'];
    $link = $social['link'];
    $link_pdf = $social['link_pdf'];
    $padding_r = ($index != count($social))?'padding-right: 2em;':'';
    $redes .= "<li style='display: table-cell; $padding_r'>
                    <a href='$link' target='_blank' style='text-decoration:none; color: #242424; position: relative; width: 6em; display: inline-block'>
                        <img src='$img_url' alt='social media' style='display: block; left: 50%; transform: translateX(-50%); position: relative'>
                        <span style='display: block; font-size: .6em; position: relative; text-align: center; margin-top: .4em'>$link_pdf</span>
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
                <td style='border-top: 3px solid #116FC7;border-right: 1px solid #116FC7;border-left: 3px solid #116FC7; height: 1em; border-radius: 8px 0 0 0'></td>
                <td style='border-top: 3px solid #116FC7; width: 60%'></td>
                <td style='border-top: 3px solid #116FC7; border-left: 1px solid #116FC7;border-right: 3px solid #116FC7;width:25%;border-radius: 0 8px 0 0'></td>
            </tr>   
        </thead>";

$tfoot = "<tfoot style='display: table-footer-group;'>
            <tr>
                <td style='border-bottom: 3px solid #116FC7;border-right: 1px solid #116FC7;border-left: 3px solid #116FC7; border-radius: 0 0 0 8px'></td>
                <td style='border-bottom: 3px solid #116FC7; width: 60%'></td>
                <td style='border-bottom: 3px solid #116FC7; border-left: 1px solid #116FC7;width:25%; border-right: 3px solid #116FC7; border-radius: 0 0 8px 0'></td>
            </tr>
        </tfoot>";

$tables = "";
$firts_area = true;
$header_title = "<tr>
                    <td colspan='3'>
                        <h2 style='text-align: center; margin-bottom:1em'>Basado en tus respuestas</h2>
                    </td>
                </tr>";
foreach ($resultados as $area => $resultados_area) {
    $title_table = $firts_area ? $header_title:'';
    $tables .= "<div style='margin-bottom: 3em'>
                    
                    <table style='width: 100%; border-radius: 7px;position: relative'>
                        ".$title_table."
                        <tr>
                            <td colspan='3'>
                            <h3 style='width: 100%; text-transform: capitalize;text-align: center;font-size: 1em; margin-bottom: .8em; color: #226fc7; font-weight: bold; position: relative; left 50%'>$area</h3>
                            </td>
                        </tr>
                    ".$thead."
                        <tbody>
                    ";
    $firts_area = false;
    foreach($resultados_area as $index =>$resultados){
        $border_bottom = ($index != count($resultados_area)) ?"; border-bottom: 1px solid #116FC7":"; border-bottom: 3px solid #116FC7;";
        $bl_radius = ($index != count($resultados_area))?"":";border-radius: 0 0 0 8px";
        $border_bottom_grafic = ($index != count($resultados_area))? "":"; border-bottom: 3px solid #116FC7; border-radius: 0 0 8px 0";
        $grafic = "";
        $ponderacion_parcial = "";
        if ($index == 1) {
            if($area == "recursos humanos"){
                $ponderacion_parcial = $promedios['recursos_humanos'];
                $indice_parcial = min(5, max(0, ceil($ponderacion_parcial))); // Asegura que esté entre 1 y 5
                $url_grafica_parcial = $graficas[$rangos[$indice_parcial]];
            }else{
                $ponderacion_parcial = $promedios[$area];
                $indice_parcial = min(5, max(0, ceil($ponderacion_parcial))); // Asegura que esté entre 1 y 5
                $url_grafica_parcial = $graficas[$rangos[$indice_parcial]];
            }
            
            $grafic = "<img src='$url_grafica_parcial' alt='grafica' style='width: 50%;position: relative; left:50%; transform: translateX(-50%)'>".
            "<div style='text-align:center; margin-top:1.3em;width:100%'>$ponderacion_parcial de 5</div>";
        }

        $tables .= " <tr style='position:relative'>
                        <td style='padding: 0 $border_bottom $bl_radius;border-right: 1px solid #116FC7; vertical-align: middle; text-align:center; font-weight: bold; color: #116FC7; border-left: 3px solid #116FC7'>
                            $index
                        </td>
                        <td style='padding: 1em $border_bottom; width: 60%; vertical-align:middle'>
                            <p style='font-size: .86em; line-height: 1.3em; '>
                            ".$resultados['consecuencia']."
                            </p>
                        </td>
                        <td style='padding: 1em; border-left: 1px solid #116FC7; width:25%; position:relative; border-right: 3px solid #116FC7 $border_bottom_grafic'>  
                        $grafic
                        </td>
                    </tr>";
    }

    $tables .= "        </tbody>
                    </table>
                </div>";
}


echo "
<div>
    <header style='margin-bottom:3em'>
        <h1 style='text-align: center;margin-bottom: .6em'>Diagnostico empresarial</h1>
        <p style='text-align: center; color:#787878; font-size: .85em'>Formulario llenado el ".date("d")." de ".$mes_es." de ".date("Y")."</p>
    </header>
    <table style='width: 100%; border: 3px solid #FF9E0F; border-radius:8px'>
        <tr>
            <td style='width: 75%; vertical-align: top; padding:1em 1.4em; vertical-align:middle'>
                <h2 style='margin-bottom: .3em;'>Resultado global: $ponderacion_total de 5 </h2>
                <p style='line-height: 1.3em'>
                ".$resultado_global."
                </p>
            </td>
            <td style='width: 25%; vertical-align: top; padding:1em 1.4em; border-left: 1px solid #FF9E0F'>
                <img src='$url_grafica' alt='grafica' style='width: 60%; display: block; margin: auto;'>
                <div style='text-align:center; margin-top:1.3em;width:100%'>$porcentage_total%</div>
            </td>                
        </tr>
    </table>
    <div style='margin-top: 4em;'>
        ".$tables."

    </div>
    

        
    <footer style='display:table; page-break-inside: auto;margin-top: 4em; width:70%; position: relative; left:50%; transform: translateX(-50%)'>
        <div class='note' style='margin-bottom: 4em; position: relative; width:100%;left:50%; transform: translateX(-50%); border-left: 3px solid #116FC7; padding: 2em 0 2em 1em'>
            <p style='font-weight:bold; line-height: 1.5em; font-size:.75em'>
                Si quieres conocer en mayor profundidad el resultado, puedes comunicarte con nosotros al celular 2215845267 o mándanos un WhatsApp con tu nombre para que nos pongamos en contacto contigo.
            </p>
        </div>

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
";

?>