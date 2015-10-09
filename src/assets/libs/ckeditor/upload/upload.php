<?php

// CONFIGURACIÓN
$rutaFinalImagenes = __DIR__."/../imagenescontenido";
$rutaSinRaiz = substr($rutaFinalImagenes, strlen($_SERVER["DOCUMENT_ROOT"]));

if (isset($_FILES['upload'])) {
    // RECOGER EL FICHERO TEMPORAL
    $filen = $_FILES['upload']['tmp_name'];
    // NOMBRE FICHERO
    $nombreFichero = $_FILES['upload']['name'];
    $nombreFichero = nombreFinalArchivo($rutaFinalImagenes, $nombreFichero);
    //echo '<p>' . $nombreFichero . '</p>';

    // DESTINO
    $con_images = $rutaFinalImagenes . "/" . $nombreFichero;
    // MOVER FICHERO
    move_uploaded_file($filen, $con_images);
    $url = $rutaSinRaiz . "/" . $nombreFichero;
    $funcNum = $_GET['CKEditorFuncNum'];
    // Optional: instance name (might be used to load a specific configuration file or anything else).
    $CKEditor = $_GET['CKEditor'];
    // Optional: might be used to provide localized messages.
    $langCode = $_GET['langCode'];
    // Usually you will only assign something here if the file could not be uploaded.
    $message = '';
    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
}
?>

<?php

function nombreFinalArchivo($public_path, $nombre) {

    $extension = substr($nombre, strripos($nombre, "."));
    $nombresinextension = substr($nombre, 0, strripos($nombre, "."));
    $directorio = opendir($public_path);
    $arrayNombresComunes = array();
    while ($archivo = readdir($directorio)) {
        if (!is_dir($archivo)) {
            if (strpos($archivo, $nombresinextension . "-") !== false || strpos($archivo, $nombre) !== false) {
                $start = strpos($archivo, "-");
                if ($start != false) {
                    $numFichero = substr($archivo, $start + 1, strripos($archivo, ".") - $start - 1);
                    $arrayNombresComunes[] = $numFichero;
                } else {
                    $arrayNombresComunes[] = 0;
                }
            }
        }
    }
    if (count($arrayNombresComunes) > 0) {
        $valorActual = extraerMayor($arrayNombresComunes) + 1;
        $nombre = $nombresinextension;
        $nombre = $nombre . "-" . strval(extraerMayor($arrayNombresComunes) + 1) . $extension;
    }

    return $nombre;
}

function extraerMayor($arrayValores) {
    arsort($arrayValores);
    return $arrayValores[count($arrayValores) - 1];
}
?>