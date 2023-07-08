<?php

require_once("conect.php");

$pozo = new Pozos();

//tomamos el id que viene de la pagina de listado
$id = $_GET['id'];
//al objeto pozo le cargamos el id
$pozo->setId($id);
//traemos de la BD el registro con dicho id ( nos devolvera un arreglo con un elemento)
$record = $pozo->traerUno();
$val= $record[0];

//controlamos si se presiono el boton actualizar
if(isset($_POST['actualizar'])){
    $pozo->setNombre(($_POST['nombre']));
    $pozo->setEstado(($_POST['selectEstado']));
    $pozo->setPSI(($_POST['PSI']));
    $pozo->setFecha(($_POST['fecha']));
    $pozo->setHora(($_POST['hora']));

    //ejecutamos el metodo que actualiza
    $pozo->actualizarPozo();

    echo "<script> alert('Datos actualizados correctamente');document.location='listadoPozos.php'</script>";
}



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Actualizar Datos</title>
    <link rel="stylesheet" href="style/editar.css">
</head>
<body>
    <div class="container">
        <h2>Actualización de datos</h2>
        <form action="" method="post">

            <label for="">Nombre del pozo</label>
            <input type="text" name="nombre" placeholder="nombre de pozo" required value="<?php echo $val['nombre']?>">

            <label for="">Estado del pozo</label>
            <select name="selectEstado">
                <option value="Amazonas">Amazonas</option>
                <option value="Anzoategui">Anzoategui</option>
                <option value="Apure">Apure</option>
                <option value="Aragua">Aragua</option>
                <option value="Barinas">Barinas</option>
                <option value="Bolivar">Bolivar</option>
                <option value="Carabobo">Carabobo</option>
                <option value="Cojedes">Cojedes</option>
                <option value="Caracas">Caracas</option>
                <option value="Delta">Delta Amacuro</option>
                <option value="Falcón">Falcón</option>
                <option value="Guárico">Guárico</option>
                <option value="Lara">Lara</option>
                <option value="Mérida">Mérida</option>
                <option value="Miranda">Miranda</option>
                <option value="Monagas">Monagas</option>
                <option value="Portuguesa">Portuguesa</option>
                <option value="Sucre">Sucre</option>
                <option value="Tachira">Tachira</option>
                <option value="Trujillo">Trujillo</option>
                <option value="Vargas">Vargas</option>
                <option value="Yaracuy">Yaracuy</option>
                <option value="Zulia">Zulia</option>
            </select>

            <label for="">PSI del pozo</label>
            <input type="number" name="PSI" placeholder="Numerod de PSI del pozo" required value="<?php echo $val['PSI']?>">

            <label for="">Fecha del registro</label>
            <input type="date" name="fecha" required value="<?php echo $val['fecha']?>">

            <label for="">Hora del registro</label>
            <input type="time" name="hora" required value="<?php echo $val['hora']?>">

            <input type="submit" value="Actualizar" class="btn" name="actualizar" >

        </form>
    </div>
    <div class="button-container">
        <button onclick="location.href='listadoPozos.php'">Volver atrás</button>
    </div>
</body>
</html>