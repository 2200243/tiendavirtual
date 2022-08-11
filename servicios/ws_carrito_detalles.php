<?php
require "../config.php";
$accion = isset($_GET['accion']) ? $_GET['accion'] : "default";
// $idorden = isset($_GET['idorden']) ? $_GET['idorden'] : "default";

    switch($accion){
        case "eliminar":
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            if(isset($data)){
                $strsql = "DELETE FROM cart_item WHERE idproducto = ? AND orderid = ?";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("ii",$data->idproducto,$data->idorden);
                $stmt->execute();
                if($stmt->errno==0){
                    $text = "Producto eliminado correctamente del carrito de compras";
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
                $strsql = "UPDATE cart_item SET cantidad= $data->cantidad WHERE `idproducto`=? AND orderid = ?;";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("ii",$data->idproducto,$data->orderid);
               // $stmt->bind_param("sisdisi", $data->nombre_producto, $data->idcategoria, $data->descripcion, $data->precio, $data->cantidad, $data->url_imagen,$data->idproducto);
                $stmt->execute();
                if($stmt->errno==0){
                    $text = "Producto agregado nuevamente al carrito de compras";
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
                $strsql = "INSERT INTO cart_item(`orderid`, `idproducto`, `cantidad`) VALUES (?,?,?)";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("iii", $data->orderid, $data->idproducto, $data->cantidad);
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