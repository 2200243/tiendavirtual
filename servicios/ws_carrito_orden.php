<?php
require "../config.php";
require "../vars.php";

$accion = isset($_GET['accion']) ? $_GET['accion'] : "default";

    switch($accion){
       
        case "eliminar":
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $data->idorden;
            if(isset($data)){
                $strsql = "DELETE FROM orden WHERE idorden = ?";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("i",$data->idorden);
                $stmt->execute();
                if($stmt->errno==0){
                    $text = "Orden eliminada correctamente";
                } else{
                    echo "No se pudo ejecutar la consulta";
                }
                
            }else{
                $text="No se recibieron los parametros correctos";
                
            }
            break;
        /* case "editar":
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            if(isset($data)){
                $strsql = "UPDATE sesion_de_compra SET uid=$data->uid, total=$data->total WHERE `idorden`=?";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("i", $data->idorden);
               // $stmt->bind_param("sisdisi", $data->nombre_producto, $data->idcategoria, $data->descripcion, $data->precio, $data->cantidad, $data->url_imagen,$data->idproducto);
                $stmt->execute();
                if($stmt->errno==0){
                    $text = "Producto agregado al carrito de compras";
                } else{
                    echo "No se pudo ejecutar la consulta";
                }
                
            }else{
                $text="No se recibieron los parametros correctos";
                
            }
            break; */
        case "agregar":
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            if(isset($data)){
                $strsql = "INSERT INTO orden(uid,total) SELECT uid, total FROM sesion_de_compra WHERE idorden=?;";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("i", $data->idorden);
                $stmt->execute();
                $last_id = $mysqli->insert_id;
                if($stmt->errno==0){
                    $strsql = "INSERT INTO `detalle_de_orden`(`orderid`, `idproducto`, `cantidad`) SELECT $last_id, `idproducto`, `cantidad` FROM cart_item b WHERE b.orderid=?;";
                    $stmt = $mysqli->prepare($strsql);
                    $stmt->bind_param("i", $data->idorden);
                    $stmt->execute();
                    if($stmt->errno==0){
                        $text = "Orden procesada correctamente ";
                        
                    } else{
                        echo "No se pudo ejecutar la consulta";
                    }
                    
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
        "text" => $text,
        "orderid" => $_SESSION["orderid"]
    );

    echo json_encode($jsonreturn);
?>