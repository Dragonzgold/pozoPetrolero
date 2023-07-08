<?php

//definicion de los datos para la conexion del DB

//nombre del servidor
define("DB_HOST", "localhost");

//Nombre de la Base de Datos
define("DB_NAME", "pozospetroleros2");

//Contraseña de la Base de Datos
define("DB_PWD", "");

//nombre de usuario de la Base de Datos
define("DB_USER", "root");

class Pozos
{
    //propiedades

    private $id;
    private $nombre;
    private $estado;
    private $PSI;
    private $fecha;
    private $hora;

    //propiedad que maneja la conexión con la base de datos
    public $conn;

    //metodo constructor

    public function __construct($id = 0, $nombre = "", $estado = "", $PSI = 0, $fecha = "", $hora = "")
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->estado = $estado;
        $this->PSI = $PSI;
        $this->fecha = $fecha;
        $this->hora = $hora;

        //creamos la conexion a la base de datos

        $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        //verificamos la conexion
    }

    //Metodos setter para cada propeidad

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    public function setPSI($PSI)
    {
        $this->PSI = $PSI;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    //Metodos getters para cada propiedad

    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function getPSI()
    {
        return $this->PSI;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function getHora()
    {
        return $this->hora;
    }

    //Metodo para insertar en la Base de Datos

    public function insertarDatos()
    {
        try {
            $stm = $this->conn->prepare("INSERT INTO pozos (nombre, estado, PSI, fecha, hora) VALUES (?,?,?,?,?)");
            $stm->execute([$this->nombre, $this->estado, $this->PSI, $this->fecha, $this->hora]);
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }

    //Metodo para traer todos los datos de la Base de Datos
    public function traerDatos()
    {
        try {
            $stm = $this->conn->prepare("SELECT * FROM pozos");
            $stm->execute();
            return $stm->fetchAll();
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }

    //Metodo para buscar un pozo por Id
    public function traerUno()
    {
        try {
            $stm = $this->conn->prepare("SELECT * FROM pozos WHERE id=?");
            $stm->execute([$this->id]);
            return $stm->fetchAll();
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }

    //Meotodo para actualizar un pozo
    public function actualizarPozo()
    {
        try {
            $stm = $this->conn->prepare("UPDATE pozos SET nombre=?, estado=?, PSI=?, fecha=?, hora=? WHERE id=?");
            $stm->execute([$this->nombre, $this->estado, $this->PSI, $this->fecha, $this->hora, $this->id]);
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }

    //metodo para eliminar un pozo
    public function eliminarPozo()
    {
        try {
            $stm = $this->conn->prepare("DELETE FROM pozos Where ID=?");
            $stm->execute([$this->id]);
            return $stm->fetchAll();
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }

    //Metodo para obtener un archivo Json
    public function archJson()
    {
        try {
            $stm = $this->conn->prepare("SELECT * FROM pozos WHERE id=?");
            $stm->execute([$this->id]);
            $data = $stm->fetchAll();
            return json_encode($data);
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
    
    public function verificarNombreExistente()
    {
        try {
            $stm = $this->conn->prepare("SELECT COUNT(*) as count FROM pozos WHERE nombre = ?");
            $stm->execute([$this->nombre]);
            $result = $stm->fetch();

            return $result['count'] > 0; // Devuelve true si el nombre existe, false en caso contrario
        } catch (Exception $error) {
            return false; // O maneja el error de acuerdo a tus necesidades
        }
    }
}
