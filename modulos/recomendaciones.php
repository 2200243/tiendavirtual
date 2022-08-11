<?php 
global $mysqli;
global $urlweb;
?>

<div class=" container mt-4 p-1 z-depth-1 bg-c3-l25 rounded-corners">
			<h5 class="center-align uppercase mb-4">Recomendaciones</h5>
            <p class="center-align uppercase mb-4">Productos A Punto de Agotar Existencias</p>
            <div class="divider p-1 mb-4 container white" ></div>
                <div class="d-around px-1 fcont mb-2 " >
                    <?php $strsql="SELECT productos.idproducto, productos.nombre_producto, categorias.nombre_categoria, productos.descripcion, productos.precio, productos.cantidad, productos.url_imagen FROM `productos` INNER JOIN categorias ON categorias.idcategoria=productos.idcategoria where productos.cantidad<5 order by productos.nombre_producto;";
                    if($stmt=$mysqli->prepare($strsql)){
                        $stmt->execute();
                        $stmt->store_result();
                        if($stmt->num_rows>0){
                            $stmt->bind_result($idproducto,$nombre_producto,$idcategoria,$descripcion,$precio,$cantidad,$url_imagen);
                            while ($stmt->fetch()){
                                ?>
                        <a class="item p-1 mx-1" href="?modulo=producto_detalles&idproducto=<?php echo $idproducto?>">
                                <div class="item-product  center-align">
                                    <div class="item-product-img">
                                        <img src="<?php echo $url_imagen?>" alt="" class="item-img responsive-img" />
                                    </div>
                                    <p class="item-name accent-c1-25"> <?php echo strtoupper($nombre_producto)?></p>
                                    <p class="item-amount accent-c5"><?php echo "Cantidad: " .$cantidad ?></p>
                                    <p class="item-price accent-c5"><?php echo "L " .number_format($precio,2) ?></p>
                                </div>
                        </a>
                    <?php
                            }
                        } else{
                            echo "No hay datos para mostrar";
                        }
                    }else{
                        echo "Error al preparar la consulta";
                    }
                    ?>
                        
                </div>
<!-- SAGAS -->
        <p class="center-align uppercase my-4">Sagas</p>
        <div class="divider p-1 mb-4 container white"></div>
        <div class="d-around px-1 fcont mb-2" >
                    <?php $strsql="SELECT `idproducto`, `nombre_producto`, `idcategoria`, `descripcion`, `precio`, `cantidad`, `url_imagen` FROM `productos` where tipo=2"; 
                    if($stmt=$mysqli->prepare($strsql)){
                        $stmt->execute();
                        $stmt->store_result();
                        if($stmt->num_rows>0){
                            $stmt->bind_result($idsaga,$nombre_saga,$idcategoria,$descripcion,$precio,$cantidad,$url_imagen);
                            while ($stmt->fetch()){
                                ?>
                        <a class="item p-1 mx-1" href="?modulo=saga_detalles&idsaga=<?php echo $idsaga?>">
                                <div class="item-product  center-align">
                                    <div class="item-product-img">
                                        <img src="<?php echo $url_imagen?>" alt="" class="item-img responsive-img" />
                                    </div>
                                    <p class="item-name accent-c1-25"> <?php echo strtoupper($nombre_saga)?></p>
                                    <p class="item-amount accent-c5"><?php echo "Cantidad: " .$cantidad ?></p>
                                    <p class="item-price accent-c5"><?php echo "L " .number_format($precio,2) ?></p>
                                </div>
                        </a>
                    <?php
                            }
                        } else{
                            echo "No hay datos para mostrar";
                        }
                    }else{
                        echo "Error al preparar la consulta";
                    }
                    ?>
                        
                </div>

</div>