<?php
require "../config.php";
$accion = isset($_GET['accion']) ? $_GET['accion'] : "default";

    switch($accion){
        case "eliminar":
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $data->idoferta;
            if(isset($data)){
                $strsql = "DELETE FROM ofertas WHERE idoferta = ?";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("i",$data->idoferta);
                $stmt->execute();
                if($stmt->errno==0){
                    $text = "Producto eliminado correctamente";
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
            $data->idoferta;
            if(isset($data)){
                $strsql = "UPDATE `ofertas` SET nombre_oferta='$data->nombre_oferta',idcategoria= $data->idcategoria, descripcion='$data->descripcion', precio=$data->precio, cantidad=$data->cantidad, url_imagen='$data->url_imagen' WHERE `idoferta`=?";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("i", $data->idoferta);
               // $stmt->bind_param("sisdisi", $data->nombre_oferta, $data->idcategoria, $data->descripcion, $data->precio, $data->cantidad, $data->url_imagen,$data->idoferta);
                $stmt->execute();
                if($stmt->errno==0){
                    $text = "Producto editado correctamente";
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
                $strsql = "INSERT INTO ofertas( `nombre_oferta`, `idcategoria`, `descripcion`, `precio`, `cantidad`, `url_imagen`) VALUES ('$data->nombre_oferta', $data->idcategoria,' $data->descripcion', $data->precio, $data->cantidad, '$data->url_imagen')";
                $stmt = $mysqli->prepare($strsql);
                // $stmt->bind_param("sisdisi", $data->nombre_oferta, $data->idcategoria, $data->descripcion, $data->precio, $data->cantidad, $data->url_imagen,$data->idoferta);
                $stmt->execute();
                if($stmt->errno==0){
                    $text = "Producto agregado correctamente";
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