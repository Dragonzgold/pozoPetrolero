<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pozo</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <div class="container">
        <h2>Registro de pozo</h2>
        <form action="insertar.php" method="post">

            <label for="">Nombre del pozo</label>
            <input type="text" name="nombre" placeholder="nombre de pozo" required>

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
            <input type="number" name="PSI" placeholder="Numerod de PSI del pozo" required min="0" max="150">

            <label for="">Fecha del registro</label>
            <input type="date" name="fecha" required>

            <label for="">Hora del registro</label>
            <input type="time" name="hora" required>

            <input type="submit" value="Guardar" class="btn" name="guardar">
        </form>
    </div>
    <div class="button-container">
        <button onclick="location.href='listadoPozos.php'">Mostrar todos los pozos</button>
    </div>
</body>
</html>