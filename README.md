# Proyecto de Modificación de Imágenes

Este proyecto permite modificar imágenes almacenadas en una carpeta específica, basándose en los datos proporcionados en un archivo Excel. Las imágenes son procesadas y luego guardadas en una carpeta separada.

## Estructura del Proyecto

- **`main_img/`**: Esta carpeta debe contener las imágenes que deseas modificar. Las imágenes deben estar numeradas del 1 al 100 (por ejemplo: `1.jpg`, `2.jpg`, ..., `100.jpg`).
- **`img_modificada/`**: Las imágenes modificadas se guardarán en esta carpeta después de ser procesadas.
  
## Requisitos

Para que el proyecto funcione correctamente, necesitas seguir estos requisitos:

1. Las imágenes a modificar deben estar numeradas del 1 al 100 y ubicadas en la carpeta **`main_img`**.
2. El archivo Excel debe seguir un formato específico que se detallará más abajo.
3. El script tiene una capacidad aproximada de procesar **100 imágenes** a la vez.

## Formato del Archivo Excel

El archivo Excel debe tener los siguientes detalles:

- **Ubicación**: El archivo Excel debe ser subido desde el formulario de la aplicación.
- **Formato**: El archivo debe comenzar desde la celda `A1` y cada columna debe contener la siguiente información:
  - **Columna A**: *Municipalidad*  
    Ejemplo: `C.P. Jabcito`
  - **Columna B**: *Vivienda*  
    Ejemplo: `Vivienda V-1`
  - **Columna C**: *Fecha y Hora*  
    Ejemplo: `2023/12/14 08:29`
  - **Columna D**: *Zona*  
    Ejemplo: `18L`
  - **Columna E**: *Este*  
    Ejemplo: `171516`
  - **Columna F**: *Norte*  
    Ejemplo: `9,101,574`
  - **Columna G**: *Altitud*  
    Ejemplo: `3315`

### Ejemplo de los primeros registros en el Excel:

| **Municipalidad** | **Vivienda**  | **FechaHora**         | **Zona** | **Este** | **Norte**    | **Altitud** |
|-------------------|---------------|-----------------------|----------|----------|--------------|-------------|
| C.P. Jabcito      | Vivienda V-1  | 2023/12/14 08:29      | 18L      | 171516   | 9,101,574    | 3315        |
| C.P. Jabcito      | Vivienda V-2  | 2023/12/14 09:00      | 18L      | 171520   | 9,101,600    | 3320        |
  
## Cómo Usar

1. **Subir las Imágenes y el Archivo Excel**:
   - Coloca todas las imágenes que deseas modificar en la carpeta **`main_img/`** y asegúrate de que estén numeradas del 1 al 100.
   - Prepara el archivo Excel con el formato especificado y súbelo en el formulario junto con las imágenes.

2. **Modificar las Imágenes**:
   - Después de subir las imágenes y el archivo Excel, el script procesará las imágenes según los datos del archivo Excel.
   - Las imágenes modificadas se guardarán automáticamente en la carpeta **`img_modificada/`**.

3. **Ver los Resultados**:
   - Las imágenes modificadas estarán disponibles en la carpeta **`img_modificada/`** para su descarga o uso posterior.

## Capacidad de Modificación

- El script tiene una capacidad de procesamiento de **100 imágenes a la vez**. 
- Si deseas modificar más de 100 imágenes, será necesario realizar el proceso en múltiples pasos.

## Notas Adicionales

- **Formato de Fecha y Hora**: El formato de la fecha y hora debe ser exactamente como se muestra en el archivo Excel (por ejemplo: `2023/12/14 08:29`).
- **Recomendaciones**: Asegúrate de que las imágenes estén correctamente numeradas y que el archivo Excel siga el formato indicado para evitar errores en el procesamiento.

---

¡Listo para comenzar! Si tienes alguna pregunta o necesitas ayuda adicional, no dudes en contactarnos.
