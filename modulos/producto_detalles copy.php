<?php
global $mysqli;
$idproducto = $_GET['idproducto'];
$strsql="SELECT `idproducto`, `nombre_producto`, `idcategoria`, `descripcion`, `precio`, `cantidad`, `url_imagen`, `fecha_creacion` FROM `productos` where `idproducto` = ?;";
if($stmt=$mysqli->prepare($strsql)){
    $stmt->bind_param("i",$idproducto);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows> 0){
        $stmt->bind_result($idproducto,$nombre_producto,$idcategoria,$descripcion,$precio,$cantidad,$url_imagen,$fecha_creacion);
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
    <img class="prod-img materialboxed" src="<?php echo $url_imagen?>" alt="">
    </div>
    <div class="col l6 m6 s12">
        <h4><?php echo $nombre_producto?></h4>
        <p>Descripcion del producto: <b><span><?php echo $descripcion?></span></b></p>
        <p>Cantidad en existencia: <b><span><?php echo $cantidad?></span></b></p>
        <h5>Precio: <b><?php echo $precio?></b></h5>
        <a class="btn acc-c5-bg-c3"><i class="material-icons left">add_shopping_cart</i>Agregar al carrito</a>
    </div>
</div>

<script type="text/javascript">
     document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.materialboxed');
    var instances = M.Materialbox.init(elems);
  });
</script>