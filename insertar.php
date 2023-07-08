<?php
if(isset($_POST['guardar'])){
    require_once("conect.php");
    $pozo = new Pozos();

    $pozo->setNombre($_POST['nombre']);
$pozo->setEstado($_POST['selectEstado']);
$pozo->setPSI($_POST['PSI']);
$pozo->setFecha($_POST['fecha']);
$pozo->setHora($_POST['hora']);

// Verificar si el nombre ya existe en la base de datos
$nombreExistente = $pozo->verificarNombreExistente();
if ($nombreExistente) {
    echo "<script> alert('El nombre ya existe en la base de datos'); document.location='index.php'</script>";
    exit; // Detener la ejecución si el nombre ya existe
}

$pozo->insertarDatos();

echo "<script> alert('Datos guardados correctamente'); document.location='listadoPozos.php'</script>";
}
?>