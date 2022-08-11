<?php
global $mysqli;
?>

<h5 class="center-align uppercase mb-4">Ofertas Diarias</h5>
    <div class="d-around px-1" id="pornombre">
                <?php $strsql="SELECT `idproducto`, `nombre_producto`, `idcategoria`, `descripcion`, `precio`, `cantidad`, `url_imagen`, `fecha_creacion` FROM `productos` where tipo=3 order by fecha_creacion DESC;";
                if($stmt=$mysqli->prepare($strsql)){
                    $stmt->execute();
                    $stmt->store_result();
                    if($stmt->num_rows>0){
                        $stmt->bind_result($idoferta,$nombre_oferta,$idcategoria,$descripcion,$precio,$cantidad,$url_imagen,$fecha_creacion);
                        while ($stmt->fetch()){
                            ?>
                     <a class="item" href="?modulo=producto_detalles&idproducto=<?php echo $idoferta?>">
                        <div class="item-product  center-align">
                            <div class="item-product-img">
                                <img src="<?php echo $url_imagen?>" alt="" class="item-img responsive-img" />
                            </div>
                            <p class="item-name accent-c1-25"> <?php echo strtoupper($nombre_oferta)?></p>
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