<?php

require_once("conect.php");
$datos = new Pozos();
$todos = $datos->traerDatos();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado de los pozos</title>
    <link rel="stylesheet" href="style/lista.css">
</head>
<body>

    <h2>Lista de los pozos añadidos al sistema</h2>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>ESTADO</th>
            <th>PSI</th>
            <th class="fecha">FECHA</th>
            <th>HORA</th>
            <th>ELIMINAR</th>
            <th>EDITAR</th>
        </tr>
        <?php foreach($todos as $key => $pozo):?>
        <tr>
            <td><?=$pozo['nombre']?></td>
            <td><?=$pozo['estado']?></td>
            <td><?=$pozo['PSI']?></td>
            <td><?=$pozo['fecha']?></td>
            <td><?=$pozo['hora']?></td>
            <td class="acciones">
            <a href="eliminar.php?id=<?php echo $pozo['id']?>&req=delete" class="btn-eliminar">Eliminar</a>
            </td> 
            <td class="acciones">
            <a href="editar.php?id=<?php echo $pozo['id']?>" class="btn-editar">Editar</a>
            </td>
        </tr>
        <?php endforeach ?>
    </table>
    <div class="container">
        <button onclick="location.href='index.php'" class="btn-volver">Volver atrás</button>
        <button onclick="location.href='grafico.php'" class="btn-grafico">Gráfico Comparativo</button>
    </div>
</body>
</html>