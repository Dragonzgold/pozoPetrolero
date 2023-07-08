<?php

//incluimos el archivo que contiene la clase
require_once("conect.php");

$record = new Pozos();

//controlomas si se presiono eliminar

if(isset($_GET['id']) && isset($_GET['req'])){
    $record->setId($_GET['id']);
    $record->eliminarPozo();

    echo "<script> alert('Datos eliminados correctamente');document.location='listadoPozos.php'</script>";
}

?>