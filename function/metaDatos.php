<?php

function editFiletimeImg($rutaImagen, $dataTime) {
    // Modificar solo el timestamp (FileDateTime) a una nueva fecha y hora
    // Data Time FORMAT: AA/MM/DD HH:MM
    $nuevaFechaHora = strtotime($dataTime); // Cambia la fecha y hora según tus necesidades
    touch($rutaImagen, $nuevaFechaHora);
}

function readMetaDataImg($rutaImagen) {
    // Obtener los metadatos de la imagen
    $metadatos = exif_read_data($rutaImagen);

    // Mostrar los metadatos actuales
    echo "Metadatos actuales:\n";
    echo '<pre>';
    print_r($metadatos);
    echo '</pre>';
} 

?>
