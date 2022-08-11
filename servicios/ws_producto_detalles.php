<?php
require "../config.php";
$accion = isset($_GET['accion']) ? $_GET['accion'] : "default";

    switch($accion){
        case "eliminar":
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $data->idproducto;
            if(isset($data)){
                $strsql = "DELETE FROM productos WHERE idproducto = ?";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("i",$data->idproducto);
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
            $data->idproducto;
            if(isset($data)){
                $strsql = "UPDATE `productos` SET nombre_producto='$data->nombre_producto',idcategoria= $data->idcategoria, descripcion='$data->descripcion', precio=$data->precio, cantidad=$data->cantidad, url_imagen='$data->url_imagen' WHERE `idproducto`=?";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("i", $data->idproducto);
               // $stmt->bind_param("sisdisi", $data->nombre_producto, $data->idcategoria, $data->descripcion, $data->precio, $data->cantidad, $data->url_imagen,$data->idproducto);
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
                $strsql = "INSERT INTO productos( `nombre_producto`, `idcategoria`, `descripcion`, `precio`, `cantidad`,`tipo`, `url_imagen`) VALUES ('$data->nombre_producto', $data->idcategoria,' $data->descripcion', $data->precio, $data->cantidad,$data->tipo, '$data->url_imagen')";
                $stmt = $mysqli->prepare($strsql);
                // $stmt->bind_param("sisdisi", $data->nombre_producto, $data->idcategoria, $data->descripcion, $data->precio, $data->cantidad, $data->url_imagen,$data->idproducto);
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