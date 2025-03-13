<?php


$html = "
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
            <h1 style='text-align: center;'>Diagnostico empresarial</h1>
            <p style='text-align: center; color:#787878; font-size: .85em'>Formulario llenado el 10 de Marzo de 2025</p>
        </header>
        <table style='width: 100%; border: 3px solid #FF9E0F; border-radius:8px'>
            <tr>
                <td style='width: 75%; vertical-align: top; padding:1em 1.4em'>
                    <h2 style='margin-bottom: .3em;'>Resultado global: 2.26 de 5</h2>
                    <p>La empresa cuenta con grandes fortalezas y requiere algunos ajustes para potenciar su desempeño. Su fortalecimiento y crecimiento tienen bases importantes.</p>
                </td>
                <td style='width: 25%; vertical-align: top; padding:1em 1.4em; border-left: 1px solid #FF9E0F'>
                    <img src='ruta-a-la-imagen.png' alt='grafica' style='width: 90%; display: block; margin: auto;'>
                </td>                
            </tr>
        </table>
        <div style='margin-top: 4em;'>
            <h2 style='text-align: center; margin-bottom:1em'>Basado en tus respuestas</h2>

            <div>
                <h3 style='text-align: center;font-size: 1em; margin-bottom: .8em; color: #226fc7'>Administración</h3>
                
               <table style='width: 100%; border-left: 3px solid #116FC7; border-right: 3px solid #116FC7; border-radius: 7px;position: ralative'>
                    <thead >
                        <tr>
                            <td style='border-top: 3px solid #116FC7;border-right: 1px solid #116FC7;'></td>
                            <td style='border-top: 3px solid #116FC7; width: 60%'></td>
                            <td style='border-top: 3px solid #116FC7; border-left: 1px solid #116FC7;width:25%'></td>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr>
                            <td style='padding: 0; border-bottom: 1px solid #116FC7; border-right: 1px solid #116FC7;'></td>
                            <td style='padding: 5em; border-bottom: 1px solid #116FC7; width: 60%'></td>
                            <td style='padding: 5em; border-left: 1px solid #116FC7; width:25%'></td>
                        </tr>
                        <tr>
                            <td style='padding: 0; border-bottom: 1px solid #116FC7; border-right: 1px solid #116FC7;'></td>
                            <td style='padding: 5em; border-bottom: 1px solid #116FC7; width: 60%'></td>
                            <td style='padding: 5em; border-left: 1px solid #116FC7; width:25%'></td>
                        </tr>
                        <tr>
                            <td style='padding: 0; border-bottom: 1px solid #116FC7; border-right: 1px solid #116FC7;'></td>
                            <td style='padding: 5em; border-bottom: 1px solid #116FC7; width: 60%'></td>
                            <td style='padding: 5em; border-left: 1px solid #116FC7; width:25%'></td>
                        </tr>
                        <tr>
                            <td style='padding: 0; border-bottom: 1px solid #116FC7; border-right: 1px solid #116FC7;'></td>
                            <td style='padding: 5em; border-bottom: 1px solid #116FC7; width: 60%'></td>
                            <td style='padding: 5em; border-left: 1px solid #116FC7; width:25%'></td>
                        </tr>
                        <tr>
                            <td style='padding: 0; border-bottom: 1px solid #116FC7; border-right: 1px solid #116FC7;'></td>
                            <td style='padding: 5em; border-bottom: 1px solid #116FC7; width: 60%'></td>
                            <td style='padding: 5em; border-left: 1px solid #116FC7; width:25%'></td>
                        </tr>
                        <tr>
                            <td style='padding: 0; border-bottom: 1px solid #116FC7; border-right: 1px solid #116FC7;'></td>
                            <td style='padding: 5em; border-bottom: 1px solid #116FC7; width: 60%'></td>
                            <td style='padding: 5em; border-left: 1px solid #116FC7; width:25%'></td>
                        </tr>
                        
                    </tbody>
                    <tfoot style='display: table-footer-group;'>
                        <tr>
                            <td style='border-bottom: 3px solid #116FC7;border-right: 1px solid #116FC7;'></td>
                            <td style='border-bottom: 3px solid #116FC7; width: 60%'></td>
                            <td style='border-bottom: 3px solid #116FC7; border-left: 1px solid #116FC7;width:25%'></td>
                        </tr>
                    </tfoot>
                </table>
                
            </div>

        </div>
        <div class='note' style='margin-top: 4em; position: relative; width:80%;left:50%; transform: translateX(-50%); border-left: 3px solid #116FC7; padding: 2em 0 2em 1em'>
            <p style='font-weight:bold; line-height: 1.5em'>
                Si quieres conocer en mayor profundidad el resultado, puedes comunicarte con nosotros al celular tal o mándanos
                un WhatsApp con tu nombre para que nos pongamos en contacto contigo.
            </p>
        </div>

        
        <footer style='margin-top: 4em; width:70%; position: relative;left:50%; transform: translateX(-50%);'>
            <div style='width:80%; border-top:2px solid #242424; padding-top:2em; position: relative'>
                <ul style='display: table;position: relative;left: 50%; transform: translateX(-50%);'>
                    <li style='display: table-cell; padding-right: 1em;'>
                        <a href=''>
                            <img src='assets/images/instagram.png' alt=''>
                        </a>
                    </li>
                    <li style='display: table-cell; padding-right: 1em;'>
                        <a href=''>
                            <img src='assets/images/facebook.png' alt=''>
                        </a>
                    </li>
                    <li style='display: table-cell;'>
                        <a href=''>
                            <img src='./assets/images/whatsapp.png' alt=''>
                        </a>
                    </li>
                </ul>
            </div>
            
            <ul class='list-data' style='margin-top:3em; display: table'>
                <li style='display: table; padding-bottom:1em'>
                    <img style='display: table-cell; ' src='./assets/images/map-solid-36.png' alt=''>
                    <p style='display: table-cell; vertical-align: middle; padding-left: .5em'>
                        Plaza Marsala, sobre Vía Atlixcáyotl 3246-2º Piso, local 203B San
                        Martinito, Puebla
                    </p>
                </li>
                <li style='display: table'>
                    <img style='display: table-cell; vertical-align: top' src='./assets/images/phone-solid-36.png' alt=''>
                    <p style='display: table-cell; vertical-align: middle; padding-left: .5em'>
                        Teléfono/whatsapp: 2215845267
                    </p>
                </li>
            </ul>
        </footer>
    </div>
</body>
</html>
"
?>