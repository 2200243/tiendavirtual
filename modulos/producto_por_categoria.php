<?php
global $mysqli;
$idcategoria = $_GET['idcategoria'];
$strsql="SELECT `idproducto`, `nombre_producto`, `idcategoria`, `descripcion`, `precio`, `cantidad`, `url_imagen`, `fecha_creacion` FROM `productos` where `idcategoria` = ?;";
if($stmt=$mysqli->prepare($strsql)){
    $stmt->bind_param("i",$idcategoria);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows> 0){
        $stmt->bind_result($idproducto,$nombre_producto,$idcategoria,$descripcion,$precio,$cantidad,$url_imagen,$fecha_creacion);
        while ($stmt->fetch()){
?>
<div class="row container mt-3  mx-auto center">
    <div class="col l6 m6 s12  mx-auto">
    <img class="prod-img cover-img w-100 mx-auto" src="<?php echo $url_imagen?>" alt="">
    </div>
    <div class="col l6 m6 s12">
        <h4><?php echo $nombre_producto?></h4>
        <p>Descripcion del producto: <b><span><?php echo $descripcion?></span></b></p>
        <p>Cantidad en existencia: <b><span><?php echo $cantidad?></span></b></p>
        <h5>Precio: <b><?php echo $precio?></b></h5>
        <a class="btn acc-c5-bg-c3"><i class="material-icons left">add_shopping_cart</i>Agregar al carrito</a>
    </div>
</div>
<?php
        }
    }else{
        echo "No hay datos para mostrar";
    }
}else{
    echo "Error al preparar la consulta";
}
?>

