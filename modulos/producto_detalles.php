<?php
global $mysqli;
global $urlweb;
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
$strsql="SELECT a.idorden, a.uid FROM `sesion_de_compra` a WHERE a.uid='2200243';";
if($stmt=$mysqli->prepare($strsql)){
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows> 0){
        $stmt->bind_result($idorden,$uid);
        $stmt->fetch();
    }else{
        $strsql2 = "INSERT INTO `sesion_de_compra` ( `uid`) VALUES ('2200243');";
        $stmt = $mysqli->prepare($strsql2);
        $stmt->execute();
        if($stmt->errno==0){
            $idorden = $mysqli->insert_id;
        }else{
            echo "No se pudo ejecutar la consulta";
        }
        
    }
}else{
    echo "Error al preparar la consulta";
}
?>

<div class="row container mt-3">
    <div class="col l6 m6 s12">
     <img class="prod-img responsive-img materialboxed" src="<?php echo $url_imagen?>" alt="">
    </div>
    <div class="col l6 m6 s12" id="detalledelproducto">
        <h4><?php echo $nombre_producto?></h4>
        <p>Descripcion del producto: <b><span><?php echo $descripcion?></span></b></p>
        <p>Cantidad en existencia: <b><span><?php echo $cantidad?></span></b></p>
        <h5>Precio: <b><?php echo $precio?></b></h5>
        <p class="my-2">Cantidad A Comprar: <input type="number" min="1" value="1" class="browser-default" max="<?php echo $cantidad?>" id="cantidad" required disabled/></p>

<!-- Agregar o Editar -->
        <?php
        $strsql="SELECT a.idproducto FROM cart_item a where `idproducto` = ?;";
        if($stmt=$mysqli->prepare($strsql)){
            $stmt->bind_param("i",$idproducto);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows> 0){
                $stmt->fetch();
                ?>
                 <a class="btn acc-c5-bg-c3" href="javascript:editar(<?php echo $idorden?>,<?php echo $idproducto?>)"><i class="material-icons left">add_shopping_cart</i>Agregar al carrito</a>
                <?php
            }else{
               
                ?>
                <a class="btn acc-c5-bg-c3" href="javascript:add(<?php echo $idorden?>,<?php echo $idproducto?>)"><i class="material-icons left">add_shopping_cart</i>Agregar al carrito</a>
                <?php
            }
        }else{
            echo "Error al preparar la consulta";
        }
        ?>
       
    </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" 
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" 
        crossorigin="anonymous">
</script>
<script src="<?php echo $urlweb ?>app/js/jquery.nice-number.min.js"></script>

<script type="text/javascript">
    $(function(){

$('input[type="number"]').niceNumber();

});

    function add(orderid,idproducto){
    console.log("Funciona "+ parseInt(document.getElementById("cantidad").value))
        var url = '<?php echo $urlweb?>servicios/ws_carrito_detalles.php?accion=agregar';
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
            "idproducto": idproducto,
            "orderid": orderid,
            "cantidad":  parseInt(document.getElementById("cantidad").value)
            })
        })
        .then((res)=>res.json())
        .then((data) =>{
            M.toast({html: data.text});
            actualizarSuma(orderid);
        })
        .catch((err)=>{console.log(err);
            M.toast({html: "Revise todos los datos"});
        })

        
    
    }
    function editar(orderid,idproducto){
    
        var url = '<?php echo $urlweb?>servicios/ws_carrito_detalles.php?accion=editar';
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
            "idproducto": idproducto,
            "orderid": orderid,
            "cantidad":  parseInt(document.getElementById("cantidad").value)
            })
        })
        .then((res)=>res.json())
        .then((data) =>{
            M.toast({html: data.text});
            actualizarSuma(orderid);
        })
        .catch((err)=>{console.log(err);
            M.toast({html: "Revise todos los datos"});
        })
    
    }

    function actualizarSuma(orderid){
    
    var url = '<?php echo $urlweb?>servicios/ws_sesion_de_compra.php?accion=actualizarsuma';
    fetch(url, {
        method: 'POST',
        body: JSON.stringify({
        "orderid": orderid
        })
    })
    .then((res)=>res.json())
    .catch((err)=>{console.log(err);
    })

}
</script>