<?php

function obtenerRutasImg($rutaCarpetaImagenes, $tipoArchivo) {
    // Obtener la lista de archivos en la carpeta de imágenes (suponiendo que todas las imágenes son archivos jpg)
    $imagenes = glob($rutaCarpetaImagenes . '*.' . $tipoArchivo);
    natsort($imagenes);
  
    // Verificar si se encontraron imágenes
    if ($imagenes) {
        // Recorrer la lista de imágenes y almacenar las rutas en un array
        $rutasImagenes = [];

        foreach ($imagenes as $imagen) {
            $rutasImagenes[] = $imagen;
            
        }
        // Ahora $rutasImagenes contiene las rutas de todas las imágenes en la carpeta
        return $rutasImagenes;
    } else {
        echo "No se encontraron imágenes en la carpeta.";
        return null;
    }
}

function addDescription($imagen, $tamanoTexto, $posicionTextoX, $posicionTextoY, $colorSombra, $fuente, $descripcion, $colorTexto) {
    // Agregar la sombra a la imagen con el nuevo tamaño de texto
    imagettftext($imagen, $tamanoTexto, 0, $posicionTextoX + 2, $posicionTextoY + 2, $colorSombra, $fuente, $descripcion);

    // Agregar la descripción a la imagen
    imagettftext($imagen, $tamanoTexto, 0, $posicionTextoX, $posicionTextoY, $colorTexto, $fuente, $descripcion);
}
?>