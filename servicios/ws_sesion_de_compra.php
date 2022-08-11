<?php
require "../config.php";
require "../vars.php";

$accion = isset($_GET['accion']) ? $_GET['accion'] : "default";
$_SESSION["orderid"]=50;
    switch($accion){
        case "actualizarsuma":
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            if(isset($data)){
                $strsql="select SUM(c.precio*b.cantidad) as suma from cart_item b inner join productos c on b.idproducto=c.idproducto where b.orderid = $data->orderid;";
                if($stmt=$mysqli->prepare($strsql)){
                    $stmt->execute();
                    $stmt->store_result();
                    if($stmt->num_rows> 0){
                        $stmt->bind_result($suma);
                        $stmt->fetch();
                        $strsql = "UPDATE sesion_de_compra a SET a.total=? WHERE a.uid = '2200243';";
                        $stmt = $mysqli->prepare($strsql);
                        $stmt->bind_param("d",$suma);
                        $stmt->execute();
                        if($stmt->errno==0){
                        } else{
                            echo "No se pudo ejecutar la consulta";
                        }
                    }else{
                        $text="No se recibieron los parametros correctos";
                        
                    }
                }else{
                    echo "Error al preparar la consulta";
                }
                
            }else{
                $text="No se recibieron los parametros correctos";
                
            }
            break;
        case "eliminar":
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            if(isset($data)){
                $strsql = "DELETE FROM sesion_de_compra WHERE idorden = ?";
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
        case "editar":
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
            break;
        case "agregar":
            $json = file_get_contents('php://input');
        $data = json_decode($json);
            if(isset($data)){
                $strsql = "INSERT INTO `sesion_de_compra`(`uid`,`total`) VALUES (?,?)";
                $stmt = $mysqli->prepare($strsql);
                $stmt->bind_param("sd", $data->uid, $data->total);
                $stmt->execute();
                if($stmt->errno==0){
                    $text = "Orden realizada correctamente con ID: ".$mysqli->insert_id;
                    $oid = $mysqli->insert_id;
                    $_SESSION["orderid"]=intval($oid);

                    
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