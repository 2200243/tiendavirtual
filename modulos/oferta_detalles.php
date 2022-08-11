<?php
global $mysqli;
$idoferta = $_GET['idoferta'];
$strsql="SELECT `idoferta`, `nombre_oferta`, `idcategoria`, `descripcion`, `precio`, `cantidad`, `url_imagen` FROM `ofertas` where `idoferta` = ?;";
if($stmt=$mysqli->prepare($strsql)){
    $stmt->bind_param("i",$idoferta);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows> 0){
        $stmt->bind_result($idoferta,$nombre_oferta,$idcategoria,$descripcion,$precio,$cantidad,$url_imagen);
        $stmt->fetch();
    }else{
        echo "No hay datos para mostrar";
    }
}else{
    echo "Error al preparar la consulta";
}
?>

<div class="row container mt-3">
    <div class="col l6 m6 s12">
    <img class="prod-img" src="<?php echo $url_imagen?>" alt="">
    </div>
    <div class="col l6 m6 s12">
        <h4><?php echo $nombre_oferta?></h4>
        <p>Descripcion del producto: <b><span><?php echo $descripcion?></span></b></p>
        <p>Cantidad en existencia: <b><span><?php echo $cantidad?></span></b></p>
        <h5>Precio: <b><?php echo $precio?></b></h5>
        <a class="btn acc-c5-bg-c3"><i class="material-icons left">add_shopping_cart</i>Agregar al carrito</a>
    </div>
</div>