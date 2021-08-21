<?php

    class conexion{
        private $server;
        private $user;
        private $password;
        private $database;
        private $port;

        private $conexion;

        public function __construct(){
            $listadatos = $this->datosConexion();
            foreach ($listadatos as $key => $value){
                $this->server = $value['server'];
                $this->user = $value['user'];
                $this->password = $value['password'];
                $this->database = $value['database'];
                $this->port = $value['port'];
            }

            $this->conexion = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
            if($this->conexion->connect_errno){
                echo "No se pudo conectar";
            }else{
                
            }
        }

        private function datosConexion(){
            $direccion = dirname(__FILE__);
            $jsondata = file_get_contents($direccion. "/" . "datosconexion");
            return json_decode($jsondata, true);
        }

        //funcion para convertir caracteres a UTF-8 en la base de datos
        private function convertirUTF8($array) {
            array_walk_recursive($array, function (&$item,$key){
                if(!mb_detect_encoding($item, 'utf-8', true)){
                    $item = utf8_encode($item);
                }
            });
            return $array;
        }

        //metodo para obtener los datos 
        public function obtenerDatos($query){
            $results = $this->conexion->query($query);
            $resultArray = array();
            foreach ($results as $key) {
                $resultArray[] = $key;
            }
            return $this->convertirUTF8($resultArray);
        }

        //metodos para guardar 
        //esta funcion nos devuelve el numero de fials afectadas
        public function nonQuery($query){
            $results = $this->conexion->query($query);
            return $this->conexion->affected_rows;
        }

        //esta funcion nos devuelve el ultimos id de la fila que guardemos
        public function nonQueryId($query){
            $results = $this->conexion->query($query);
            $filas = $this->conexion->affected_rows;
            if($filas >= 1){
                return $this->conexion->insert_id;
            }else{
                return 0;
            }
        }


    }
