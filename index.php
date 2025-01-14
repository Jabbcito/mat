<?php

require 'vendor/autoload.php';
require './function/exel_read.php';
require './function/img_read.php';
require './function/metaDatos.php';

function marcar($tamanoTexto, $exelName) {
    // Ruta del archivo Excel
    $rutaArchivoExcel = './description/'.$exelName.'.xlsx';
    //$rutaArchivoExcel = $exelName;

    // Fuente para el texto de la descripción
    $fuente = './font/arial.ttf';

    // Obtenemos las rutas de las imágenes
    try {
        $imgArray = json_encode(obtenerRutasImg('./main_img/', 'jpg'));
        $imgArray = json_decode($imgArray);
        
    } catch (Exception $e) {
        die("Error al obtener rutas de imágenes: " . $e->getMessage());
    }

    $tamaño = count($imgArray);

    // obtenemos las descripciones
    try {
        $datos = description($rutaArchivoExcel);
    } catch (Exception $e) {
        die("Error al obtener descripciones desde el archivo Excel: " . $e->getMessage());
    }

    for ($i = 0; $i < $tamaño; $i++) {
        try {
            // Ruta de la imagen principal
            $imagenPrincipal = $imgArray[$i];

            // Verificar la extensión del archivo
            $extension = strtolower(pathinfo($imagenPrincipal, PATHINFO_EXTENSION));

            // Crear instancia de la imagen principal
            switch ($extension) {
                case 'png':
                    $imagen = @imagecreatefrompng($imagenPrincipal);
                    break;
                case 'jpeg':
                case 'jpg':
                    $imagen = @imagecreatefromjpeg($imagenPrincipal);
                    break;
                case 'gif':
                    $imagen = @imagecreatefromgif($imagenPrincipal);
                    break;
                default:
                    throw new Exception("Formato de archivo no compatible: $imagenPrincipal");
            }

            if (!$imagen) {
                throw new Exception("Error al crear instancia de imagen desde $imagenPrincipal");
            }

            // Color de texto para la descripción (blanco en este caso)
            $colorTexto = imagecolorallocate($imagen, 255, 255, 255);
            $colorSombra = imagecolorallocate($imagen, 0, 0, 0);

            // Obtener dimensiones de la imagen principal y la subimagen
            $imagenAncho = imagesx($imagen);
            $imagenAlto = imagesy($imagen);

            // Coordenadas para la descripción (en este caso, en la esquina inferior izquierda con un margen de 10 píxeles)
            $posicionTextoX = 10;
            $posicionTextoY = $imagenAlto - 120;

            // Obtener la información específica de cada columna
            $fila = $datos[$i];
            $municipalidad = $fila[0];
            $vivienda = $fila[1];
            $fechaHora = $fila[2];
            $zona = $fila[3];
            $este = $fila[4];
            $norte = $fila[5];
            $altitud = $fila[6];

            // Crear la descripción concatenando la información
            $descripcion = "$municipalidad\n$vivienda\n$fechaHora\n$zona $este $norte $altitud m";

            // Añadir marca de agua
            addDescription($imagen, $tamanoTexto, $posicionTextoX, $posicionTextoY, $colorSombra, $fuente, $descripcion, $colorTexto);

            // Guardar la nueva imagen
            $rutaImagen =  "./img_modificada/".$vivienda.".jpg";
            imagejpeg($imagen, $rutaImagen);
            
            //Modificamos los metadatos
            editFiletimeImg($rutaImagen, $fechaHora);

            // Liberar memoria
            imagedestroy($imagen);
        } catch (Exception $e) {
            die("Error en la iteración $i: " . $e->getMessage());
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
    <script>
        // Función para ocultar el popup
        function hidePopup() {
            // Ocultar los elementos del popup y overlay
            const popup = document.querySelector('.ok');
            const error = document.querySelector('.error');
            const overlay = document.querySelector('.overlay');
            if (popup && overlay) {
                popup.style.display = 'none';
                overlay.style.display = 'none';
            } else if (error && overlay) {
                error.style.display = 'none';
                overlay.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <form method="post" action="" enctype="multipart/form-data" class="main-form">
            <input class="input-text" type="text" name="tamanoTexto" placeholder="Ingrese el tamaño del texto">
            <input type="file" name="archivoExcel" accept=".xlsx" class="input-file">
            <button type="submit" class="a_darle">A darle!!!</button>
        </form>
        <div class="main-form">
            <p>
                Las imagenes modificadas apareceran el la carpeta:
                "<strong>img_modificada</strong>"
                la cual esta en el directorio del script
            </p>
        </div>
    </div>


    <?php
    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tamanoTexto = $_POST["tamanoTexto"];
    
        // Validar que el tamaño del texto es un número
        if (!is_numeric($tamanoTexto)) {
            echo "<div class='overlay'></div>";
            echo "<div class='error'>Ingrese un número válido para el tamaño del texto. <button class='again' onclick='hidePopup()'>Hacerlo de nuevo</button></div>";
        } elseif (isset($_FILES["archivoExcel"]) && $_FILES["archivoExcel"]["error"] === UPLOAD_ERR_OK) {
            $archivoTmp = $_FILES["archivoExcel"]["tmp_name"];
            $nombreArchivo = $_FILES["archivoExcel"]["name"];
    
            // Verificar la extensión del archivo
            $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
            if ($extension !== 'xlsx') {
                echo "<div class='overlay'></div>";
                echo "<div class='error'>Solo se permiten archivos .xlsx. <button class='again' onclick='hidePopup()'>Hacerlo de nuevo</button></div>";
            } else {
                // Mover el archivo a una ubicación temporal
                $rutaDestino = './description/' . $nombreArchivo;
                if (move_uploaded_file($archivoTmp, $rutaDestino)) {
                    // Llamar a la función marcar con el archivo subido
                    marcar($tamanoTexto, pathinfo($nombreArchivo, PATHINFO_FILENAME));
    
                    echo "<div class='overlay'></div>";
                    echo "<div class='ok'>Imágenes marcadas con éxito. <button class='again' onclick='hidePopup()'>Hacerlo de nuevo</button></div>";
                } else {
                    echo "<div class='overlay'></div>";
                    echo "<div class='error'>Error al mover el archivo. <button class='again' onclick='hidePopup()'>Hacerlo de nuevo</button></div>";
                }
            }
        } else {
            echo "<div class='overlay'></div>";
            echo "<div class='error'>Error al cargar el archivo. <button class='again' onclick='hidePopup()'>Hacerlo de nuevo</button></div>";
        }
    }
    
    ?>
</body>
</html>
