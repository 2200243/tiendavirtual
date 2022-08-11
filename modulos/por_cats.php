<?php 
global $mysqli;
global $urlweb;
?>

<div class=" container mt-4 p-1 z-depth-1 bg-c3-l25 rounded-corners ">
			<h5 class="center-align uppercase mb-4">El libro para ti</h5>
			<div id="porcategoria" class="m-2 p-2">
                <?php $strsql="SELECT a.idcategoria, a.nombre_categoria FROM categorias a;";
                if($stmt=$mysqli->prepare($strsql)){
                    $stmt->execute();
                    $stmt->store_result();
                    if($stmt->num_rows>0){
                        $stmt->bind_result($idcategoria,$nombre_categoria);
                        while ($stmt->fetch()){
                            ?>
                           <h4 class="center"><?php echo $nombre_categoria?></h4>
                           <div class="divider mb-1"></div>
                            <div  class="d-around p-1">
                <?php $strsql2="SELECT b.idproducto, b.nombre_producto,b.url_imagen,b.precio FROM categorias a inner join productos b on b.idcategoria=a.idcategoria where b.idcategoria=$idcategoria;";
                if($stmt2=$mysqli->prepare($strsql2)){
                    $stmt2->execute();
                    $stmt2->store_result();
                    if($stmt2->num_rows>0){
                        $stmt2->bind_result($idproducto,$nombre_producto,$url_imagen,$precio);
                        while ($stmt2->fetch()){
                            ?>
                            <a class="item " href="?modulo=producto_detalles&idproducto=<?php echo $idproducto?>">
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
                        echo "No tenemos libros de esta categoria por el momento.";
                    }
                }else{
                    echo "Error al preparar la consulta";
                }
                ?>
                </div>
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