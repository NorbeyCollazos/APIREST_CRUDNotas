<?php

require_once "clases/respuestas.class.php";
require_once "clases/notas.class.php";

$_respuestas = new respuestas();
$_notas = new notas();

if($_SERVER['REQUEST_METHOD']=='GET'){
    
    if(isset($_GET['page'])){
        $pagina = $_GET['page'];
        $listaNotas = $_notas->listaNotas($pagina);
        header('Content-Type: application/json');
        echo json_encode($listaNotas);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $notaid = $_GET['id'];
        $datosnota = $_notas->obtenerNota($notaid);
        header('Content-Type: application/json');
        echo json_encode($datosnota);
        http_response_code(200);
    }
    

}else if($_SERVER['REQUEST_METHOD']=='POST'){

    //se reciben los datos enviados
    $postBody = file_get_contents("php://input");
    //ahora se envian los datos al manejador
    $datosArray = $_notas->post($postBody);
    //ahora se devuelve la respuesta
    header('Content-Type: application/json');
    if(isset($datosArray["result"]["error_id"])){
        $responseCode = $datosArray["result"]["error_id"];
        http_response_code($responseCode);
    }else{
        http_response_code(200);
    }
    echo json_encode($datosArray);

    
}else if($_SERVER['REQUEST_METHOD']=='PUT'){

    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
    //enviamos datos al manejador
    $datosArray = $_notas->put($postBody);
      //delvovemos una respuesta 
   header('Content-Type: application/json');
   if(isset($datosArray["result"]["error_id"])){
       $responseCode = $datosArray["result"]["error_id"];
       http_response_code($responseCode);
   }else{
       http_response_code(200);
   }
   echo json_encode($datosArray);

    
}else if($_SERVER['REQUEST_METHOD']=='DELETE'){

   $headers = getallheaders();

   if(isset($headers["id"])){
        $send = [
            "id" => $headers["id"]
        ];
        $postBody = json_encode($send);

   }else{
    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
   }

    //enviamos datos al manejador
    $datosArray = $_notas->delete($postBody);
    //delvovemos una respuesta 
   header('Content-Type: application/json');
   if(isset($datosArray["result"]["error_id"])){
       $responseCode = $datosArray["result"]["error_id"];
       http_response_code($responseCode);
   }else{
       http_response_code(200);
   }
   echo json_encode($datosArray);

    
}else{
    header('Content-Type: application/json');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
}


?>