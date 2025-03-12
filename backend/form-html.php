<?php 
include 'form-style.php';
$html = "
<html>
<head>
<style>
        *{
            color: #242424;
            font-family: Arial, Helvetica, sans-serif;
        }
        h1{
            font-size: 1.4em;
        }
        
        h2{
            font-size: 1.15em;
        }
    </style>
</head>
<body>
    <div class='container-pdf'>
        <header style='margin-bottom:3em'>
            <h1 style='text-align: center;'>Diagnostico empresarial</h1>
            <p style='text-align: center; color:#787878; font-size: .85em'>Formulario llenado el 10 de Marzo de 2025</p>
        </header>
        <table style='width: 100%; border: 4px solid #FF9E0F; border-radius:8px'>
            <tr>
                <td style='width: 75%; vertical-align: top; padding:1em 1.4em'>
                    <h2 style='margin-bottom: .3em;'>Resultado global: 2.26 de 5</h2>
                    <p>La empresa cuenta con grandes fortalezas y requiere algunos ajustes para potenciar su desempeño. Su fortalecimiento y crecimiento tienen bases importantes.</p>
                </td>
                <td style='width: 25%; vertical-align: top; padding: 1em 1.4em; border-left: 2px solid #FF9E0F'>
                    <img src='ruta-a-la-imagen.png' alt='grafica' style='width: 90%; display: block; margin: auto;'>
                </td>                
            </tr>
        </table>
        <div class=''>
            <h2>Basado en tus respuestas</h2>

            <div class=''>
                <h3>Administración</h3>
                <div class='flex border-4 border-blue border-rounded w-100'>
                    <div class='w-75 column'>
                        <div class='flex row'>
                            <div class='num w-20'>
                                <span>1</span>
                            </div>
                            <div class='text w-80'>
                                <p>
                                    No tener objetivos ni saber cuál es el problema más grande de la
                                    empresa es una enorme área de oportunidad para reenfocarnos en lo
                                    verderamente importante para que la empresa pueda tener éxito.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class='w-25 column column-grafic'>
                        
                    </div>
                </div>
            </div>

        </div>
        <div class='note'>
            <p>
                Si quieres conocer en mayor profundidad el resultado, puedes comunicarte con nosotros al celular tal o mándanos
                un WhatsApp con tu nombre para que nos pongamos en contacto contigo.
            </p>
        </div>
        <footer>
            <ul class='list-social'>
                <li>
                    <a href=''>
                        <img src='assets/images/instagram.png' alt='instagram'>
                    </a>
                </li>
                <li>
                    <a href=''>
                        <img src='assets/images/facebook.png' alt='facebook'>
                    </a>
                </li>
                <li>
                    <a href=''>
                        <img src='./assets/images/whatsapp.png' alt=''>
                    </a>
                </li>
            </ul>
            <ul class='list-data'>
                <li>
                    <img src='./assets/images/map-solid-36.png' alt=''>
                    <p>
                        Plaza Marsala, sobre Vía Atlixcáyotl 3246-2º Piso, local 203B San
                        Martinito, Puebla
                    </p>
                </li>
                <li>
                    <img src='./assets/images/phone-solid-36.png' alt=''>
                    <p>
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