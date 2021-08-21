<?php
require_once "conexion/conexion.php";
require_once "respuestas.class.php";

class notas extends conexion
{

    private $table = "notas";
    private $notasid = "";
    private $titulo = "";
    private $nota = "";


    public function listaNotas($pagina = 1)
    {
        $inicio = 0;
        $cantidad = 100;

        if ($pagina > 1) {
            $inicio = ($cantidad * ($pagina - 1)) + 1;
            $cantidad = $cantidad * $pagina;
        }

        $query = "SELECT * FROM " . $this->table . " limit $inicio,$cantidad";
        $datos = parent::obtenerDatos($query);
        return ($datos);
    }

    public function obtenerNota($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = '$id'";
        return parent::obtenerDatos($query);
    }

    public function post($json)
    {
        $_respuestas = new respuestas();
        $datos = json_decode($json, true);

        if (!isset($datos['titulo']) || !isset($datos['nota'])) {
            return $_respuestas->error_400();
        } else {
            $this->titulo = $datos['titulo'];
            $this->nota = $datos['nota'];
        
            /*if (isset($datos['telefono'])) {
                $this->telefono = $datos['telefono'];
            }*/
            
            $resp = $this->insertarNota();
            if ($resp) {
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "id" => $resp
                );
                return $respuesta;
            } else {
                return $_respuestas->error_500();
            }
        }
    }


    private function insertarNota()
    {
        $query = "INSERT INTO " . $this->table . " (titulo, nota)
        values
        ('" . $this->titulo . "','" . $this->nota ."')";
        $resp = parent::nonQueryId($query);
        if ($resp) {
            return $resp;
        } else {
            return 0;
        }
    }


    public function put($json)
    {
        $_respuestas = new respuestas();
        $datos = json_decode($json, true);

        if (!isset($datos['id']) || !isset($datos['titulo']) || !isset($datos['nota'])) {
            return $_respuestas->error_400();
        } else {
            $this->notasid = $datos['id'];
            $this->titulo = $datos['titulo'];
            $this->nota = $datos['nota'];
            
            $resp = $this->modificarNota();
            if ($resp) {
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "id" => $resp
                );
                return $respuesta;
            } else {
                return $_respuestas->error_500();
            }
        }
    }

    private function modificarNota()
    {
        $query = "UPDATE " . $this->table . " SET titulo ='" . $this->titulo . "', nota = '" . $this->nota .
            "' WHERE id = '" . $this->notasid . "'";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }

    public function delete($json)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($json, true);

        if (!isset($datos['id'])) {
            return $_respuestas->error_400();
        } else {
            $this->notasid = $datos['id'];
            $resp = $this->eliminarNota();
            if ($resp) {
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "id" => $this->notasid
                );
                return $respuesta;
            } else {
                return $_respuestas->error_500();
            }
        }
    }


    private function eliminarNota()
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = '" . $this->notasid . "'";
        $resp = parent::nonQuery($query);
        if ($resp >= 1) {
            return $resp;
        } else {
            return 0;
        }
    }
}
