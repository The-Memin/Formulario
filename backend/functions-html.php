<?php
function get_message($logo_url, $nombre){
     return '
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                /* Estilos inline para email */
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 20px auto;
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 2px 3px rgba(0,0,0,0.1);
                }
                .header {
                    text-align: center;
                    padding-bottom: 20px;
                }
                .header img {
                    max-width: 200px;
                }
                .content {
                    font-size: 16px;
                    line-height: 1.5;
                }
                .footer {
                    margin-top: 30px;
                    font-size: 12px;
                    text-align: center;
                    color: #888888;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <img src="' . $logo_url . '" alt="Logo de la Empresa">
                </div>
                <div class="content">
                    <h2>Hola ' . $nombre . ',</h2>
                    <p>A continuación, te enviamos los resultados de tu formulario. Adjunto encontrarás el PDF con el informe completo.</p>
                    <p>Gracias por confiar en nosotros.</p>
                </div>
                <div class="footer">
                    <p>&copy; ' . date("Y") . ' Tu Empresa. Todos los derechos reservados.</p>
                </div>
            </div>
        </body>
        </html>
        ';
}

?>