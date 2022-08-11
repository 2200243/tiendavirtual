<?php
require "../config.php";
$accion = isset($_GET['accion']) ? $_GET['accion'] : "default";

    switch($accion){
        case "eliminar":
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $data->idcategoria;
            if(isset($data)){
                $strsql = "DELETE FROM categorias WHERE idcategoria = ?";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("i",$data->idcategoria);
                $stmt->execute();
                if($stmt->errno==0){
                    $text = "Categoria eliminado correctamente";
                } else{
                    echo "No se pudo ejecutar la consulta";
                }
                
            }else{
                $text="No se recibieron los parametros correctos";
                
            }
            break;
        case "editar":
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $data->idcategoria;
            if(isset($data)){
                $strsql = "UPDATE `categorias` SET nombre_categoria='$data->nombre_categoria', descripcion='$data->descripcion', url_imagen='$data->url_imagen' WHERE `idcategoria`=?";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("i", $data->idcategoria);
               // $stmt->bind_param("sisdisi", $data->nombre_categoria, $data->idcategoria, $data->descripcion, $data->precio, $data->cantidad, $data->url_imagen,$data->idcategoria);
                $stmt->execute();
                if($stmt->errno==0){
                    $text = "Categoria editada correctamente";
                } else{
                    echo "No se pudo ejecutar la consulta";
                }
                
            }else{
                $text="No se recibieron los parametros correctos";
                
            }
            break;
        case "agregar":
            $json = file_get_contents('php://input');
        $data = json_decode($json);
            if(isset($data)){
                $strsql = "INSERT INTO categorias( `nombre_categoria`,  `descripcion`,  `url_imagen`) VALUES (?, ?,?)";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("sss", $data->nombre_categoria,  $data->descripcion,  $data->url_imagen);
                $stmt->execute();
                if($stmt->errno==0){
                    $text = "Categoria agregada correctamente";
                } else{
                    echo "No se pudo ejecutar la consulta";
                }
                
            }else{
                $text="No se recibieron los parametros correctos";
                
            }
            break;
        case "default":
            echo "Accion no definida";
            break;
    }

    $jsonreturn = array(
        "text" => $text
    );

    echo json_encode($jsonreturn);
?>