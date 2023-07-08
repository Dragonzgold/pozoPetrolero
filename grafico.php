<?php

require_once("conect.php");
$datos = new Pozos();
$todos = $datos->traerDatos();
$info = new Pozos();
$json = $info->archJson();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Modal Example</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <script src="ads/jquery-3.7.0.min.js"></script>
    <script src="ads/plotly-2.24.1.min.js"></script>
    <link rel="stylesheet" href="style/grafico.css">
</head>

<body>
    <div>

        <h2>Grafico de los pozos petroleros</h2>

        <div class="center-button">
            <button id="openModalButton">Abrir Modal</button>
        </div>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Lista de los pozos petroleros</h2>
                <table>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>PSI</th>
                        <th class="fecha">Fecha</th>
                        <th>Hora</th>
                        <th>Seleccionar</th>
                    </tr>
                    <?php foreach ($todos as $key => $pozo) : ?>
                        <tr>
                            <td><?= $pozo['nombre'] ?></td>
                            <td><?= $pozo['estado'] ?></td>
                            <td><?= $pozo['PSI'] ?></td>
                            <td><?= $pozo['fecha'] ?></td>
                            <td><?= $pozo['hora'] ?></td>
                            <td>
                                <button class="btn-3" onclick="agregarPozo(<?= $key ?>)">Seleccionar</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>

    <div id="resultado"></div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel panel-heading">
                        <h2 class="graph-title">Graficas de pozos seleccionados</h2>
                    </div>
                    <div class="panel panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="cargaLineal"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="graficaLineal"></div>

    <button onclick="location.href='listadoPozos.php'" class="btn-atras" id="btnAtras">Atrás</button>

    <script src="script.js"></script>
    <script>
        var pozosSeleccionados = [];

        function agregarPozo(index) {
            var pozo = <?php echo json_encode($todos); ?>[index]; // Obtener el objeto pozo seleccionado

            // Verificar si el pozo ya ha sido seleccionado previamente
            var pozoExistente = pozosSeleccionados.find(function(elemento) {
                return elemento.nombre === pozo.nombre; // se compara con el campo nombre
            });

            if (pozoExistente) {
                return; // Si el pozo ya existe, no hacer nada
            }

            // Agregar el pozo al arreglo de pozos seleccionados
            pozosSeleccionados.push(pozo);

            // Llamar a la función para actualizar la tabla y la gráfica
            graficarPozosSeleccionados();
        }

        function graficarPozosSeleccionados() {
            // Ordenar los pozos seleccionados por fecha ascendente
            pozosSeleccionados.sort(function(a, b) {
                return new Date(a.fecha) - new Date(b.fecha);
            });

            // Generar el contenido HTML para la tabla y los arreglos de datos
            var tablaHTML = "<table><tr><th>Nombre</th><th>Estado</th><th>PSI</th><th>Fecha</th><th>Hora</th></tr>";
            var psiSeleccionados = [];
            var fechasSeleccionadas = [];

            for (var i = 0; i < pozosSeleccionados.length; i++) {
                var pozo = pozosSeleccionados[i];
                tablaHTML += "<tr><td>" + pozo.nombre + "</td><td>" + pozo.estado + "</td><td>" + pozo.PSI + "</td><td>" + pozo.fecha + "</td><td>" + pozo.hora + "</td></tr>";
                psiSeleccionados.push(pozo.PSI);
                fechasSeleccionadas.push(pozo.fecha);
            }

            tablaHTML += "</table>";

            // Actualizar la tabla en el elemento con el ID "resultado"
            document.getElementById("resultado").innerHTML = tablaHTML;

            // Actualizar la gráfica con los datos seleccionados en el orden correcto
            var trace = {
                x: fechasSeleccionadas,
                y: psiSeleccionados,
                type: 'scatter'
            };

            var data = [trace];

            Plotly.newPlot('graficaLineal', data);
        }

        function graficarPozosSeleccionados() {
            // Generar el contenido HTML para la tabla
            var tablaHTML = "<table><tr><th>Nombre</th><th>Estado</th><th>PSI</th><th>Fecha</th><th>Hora</th></tr>";

            for (var i = 0; i < pozosSeleccionados.length; i++) {
                var pozo = pozosSeleccionados[i];
                tablaHTML += "<tr><td>" + pozo.nombre + "</td><td>" + pozo.estado + "</td><td>" + pozo.PSI + "</td><td>" + pozo.fecha + "</td><td>" + pozo.hora + "</td></tr>";
            }

            tablaHTML += "</table>";

            // Actualizar la tabla en el elemento con el ID "resultado"
            document.getElementById("resultado").innerHTML = tablaHTML;

            // Obtener los datos de PSI y fecha de los pozos seleccionados
            var psiSeleccionados = pozosSeleccionados.map(function(pozo) {
                return pozo.PSI;
            });

            var fechasSeleccionadas = pozosSeleccionados.map(function(pozo) {
                return pozo.fecha;
            });

            // Actualizar la gráfica con los datos seleccionados
            var trace = {
                x: fechasSeleccionadas,
                y: psiSeleccionados,
                type: 'scatter'
            };

            Plotly.newPlot('graficaLineal', [trace]);
        }
    </script>
</body>

</html>