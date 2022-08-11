<?php
global $mysqli
?>
<!-- slider -->

<div class="container mt-3">
			<div class="carousel carousel-slider center mx-auto">
				<div class="carousel-fixed-item center">
				    <a href="?modulo=ofertasdiarias" class="btn waves-effect white grey-text">Ofertas Diarias</a>
				</div>
				<div class="carousel-item white-text " id="cal-1" href="#one!">
					<div class="carousel-text pt-5">
						<h2 class="py-2">Día Internacional del Libro</h2>
						<p class="white-text mt-3">23 de Abril</p>
					</div>
						
				</div>
				<div class="carousel-item amber white-text" id="cal-2" href="#two!">
                    <div class="carousel-text pt-5">
                        <h2 class="py-2">Argentina Diaz Lozano</h2>
                        <p class="white-text mt-3">Escritora del Mes</p>
				    </div>
			    </div>
			
		</div>
</div>

        <!-- end slider -->
<div class=" container mt-4 p-1 z-depth-1 bg-c3-l25 rounded-corners">
			<h5 class="center-align uppercase mb-4">El libro para ti</h5>
			<div class="row">
                <?php $strsql="SELECT `idproducto`, `nombre_producto`, `idcategoria`, `descripcion`, `precio`, `cantidad`, `url_imagen`, `fecha_creacion` FROM `productos` where tipo=1 GROUP BY `idcategoria` LIMIT 4 ;";
                if($stmt=$mysqli->prepare($strsql)){
                    $stmt->execute();
                    $stmt->store_result();
                    if($stmt->num_rows>0){
                        $stmt->bind_result($idproducto,$nombre_producto,$idcategoria,$descripcion,$precio,$cantidad,$url_imagen,$fecha_creacion);
                        while ($stmt->fetch()){
                            ?>
                            <a href="?modulo=producto_detalles&idproducto=<?php echo $idproducto?>">
                        <div class="item-product item col m3 s6 center-align">
                            <div class="item-product-img">
                                <img src="<?php echo $url_imagen?>" alt="" class="item-img responsive-img" />
                            </div>
                            <p class="item-name accent-c1-25"> <?php echo $nombre_producto?></p>
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

		
		<!-- Seccion 2 -->
		<div class="container my-4 p-1 z-depth-1">
			<h5 class="center-align uppercase mb-4">Las mejores sagas</h5>
			<div class="row container">
                  <?php $strsql="SELECT `idproducto`, `nombre_producto`, `idcategoria`, `descripcion`, `precio`, `cantidad`, `url_imagen`, `fecha_creacion` FROM `productos` where tipo=2 LIMIT 2 ;";
                if($stmt=$mysqli->prepare($strsql)){
                    $stmt->execute();
                    $stmt->store_result();
                    if($stmt->num_rows>0){
                        $stmt->bind_result($idsaga,$nombre_saga,$idcategoria,$descripcion,$precio,$cantidad,$url_imagen,$fecha_creacion);
                        while ($stmt->fetch()){
                            ?>
                      <a href="?modulo=producto_detalles&idproducto=<?php echo $idsaga?>">
                        <div class="item col m6 s12 center-align">
					<img src="<?php echo $url_imagen?>" alt="" class="item-img responsive-img" />
					<p class="item-name accent-c1-25"> <?php echo $nombre_saga?></p>
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

            <h5 class="center-align uppercase mb-4">Oferta Especial Para Ti</h5>
            <div class="row">
                <?php $strsql="SELECT `idproducto`, `nombre_producto`, `idcategoria`, `descripcion`, `precio`, `cantidad`, `url_imagen`, `fecha_creacion` FROM `productos` where tipo=3  LIMIT 1 ;";
                if($stmt=$mysqli->prepare($strsql)){
                    $stmt->execute();
                    $stmt->store_result();
                    if($stmt->num_rows>0){
                        $stmt->bind_result($idoferta,$nombre_oferta,$idcategoria,$descripcion,$precio,$cantidad,$url_imagen,$fecha_creacion);
                        while ($stmt->fetch()){
                            ?>
                            <a href="?modulo=producto_detalles&idproducto=<?php echo $idoferta?>">
                        <div class="item col s12 center-align mx-auto">
					<img src="<?php echo $url_imagen?>" alt="" class="item-img responsive-img" />
					<p class="item-name accent-c1-25"> <?php echo $nombre_oferta?></p>
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
            
                <section id="image-carousel"  class="splide" aria-labelledby="carousel-heading">
                    <h5 id="carousel-heading " class="center-align uppercase mb-4">Compra por Categoria</h5>
                    
  <div class="splide__track ">
		<ul class="splide__list">
                    <?php $strsql="SELECT `idcategoria`, `nombre_categoria`, `descripcion`, `url_imagen`, `fecha_creacion` FROM `categorias` ;";
                if($stmt=$mysqli->prepare($strsql)){
                    $stmt->execute();
                    $stmt->store_result();
                    if($stmt->num_rows>0){
                        $stmt->bind_result($idcategoria,$nombre_categoria,$descripcion,$url_imagen,$fecha_creacion);
                        while ($stmt->fetch()){
                            ?>
                     <li class="splide__slide">
                         <div class="splide__slide__container center-align">
                            <a href="?modulo=producto_por_categoria&idcategoria=<?php echo $idcategoria?>">
                            
                            <img src="<?php echo $url_imagen?>" alt="" class="item-img" />

                        </a>
                        </div>
					<div class="item-name accent-c1-25 center-align"> <?php echo $nombre_categoria?></div>
                            </li>
                 <?php
                        }
                    } else{
                        echo "No hay datos para mostrar";
                    }
                }else{
                    echo "Error al preparar la consulta";
                }
                ?>

                </section>
            
		</div>
            </div>

            <script type="text/javascript">
                document.addEventListener( 'DOMContentLoaded', function () {
                    new Splide( '#image-carousel', {
                        type       : 'loop',
                        height     : '25rem',
                        perPage    : 3,
                        pagination : false,
                        breakpoints: {
                            1200: {
                                height: '20rem',
                                perPage    : 2,
                            },
                        640: {
                            height: '50vh',
                            perPage    : 1,
                        },
                        },
                    } ).mount();
                } );

            </script>