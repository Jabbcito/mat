<?php

    use PhpOffice\PhpSpreadsheet\IOFactory;

    function description($rutaArchivoExcel) {
        // Cargar el archivo Excel
        $documento = IOFactory::load($rutaArchivoExcel);
        $hoja = $documento->getActiveSheet();

        // Obtener los datos del Excel
        $datos = [];

        foreach ($hoja->getRowIterator() as $fila) {
            $celdas = [];
            foreach ($fila->getCellIterator() as $celda) {
                $celdas[] = $celda->getValue();
            }
            $datos[] = $celdas;
        }

        // ... Ahora $datos contiene la información del Excel
        return $datos;
    }
?>