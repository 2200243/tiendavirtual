<?php 
global $mysqli;
global $urlweb;
?>

<div class=" container mt-4 p-1 z-depth-1 bg-c3-l25 rounded-corners">
			<h5 class="center-align uppercase mb-4">El libro para ti</h5>
			<div class="d-around px-1" id="pornombre">
                <?php $strsql="SELECT productos.idproducto, productos.nombre_producto, categorias.nombre_categoria, productos.descripcion, productos.precio, productos.cantidad, productos.url_imagen FROM `productos` INNER JOIN categorias ON categorias.idcategoria=productos.idcategoria order by productos.nombre_producto;";
                if($stmt=$mysqli->prepare($strsql)){
                    $stmt->execute();
                    $stmt->store_result();
                    if($stmt->num_rows>0){
                        $stmt->bind_result($idproducto,$nombre_producto,$idcategoria,$descripcion,$precio,$cantidad,$url_imagen);
                        while ($stmt->fetch()){
                            ?>
                            <a class="item" href="?modulo=producto_detalles&idproducto=<?php echo $idproducto?>">
                        <div class="item-product  center-align">
                            <div class="item-product-img">
                                <img src="<?php echo $url_imagen?>" alt="" class="item-img responsive-img" />
                            </div>
                            <p class="item-name accent-c1-25"> <?php echo strtoupper($nombre_producto)?></p>
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
		</div>
</div>