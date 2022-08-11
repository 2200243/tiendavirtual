<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		
		<link
			href="https://fonts.googleapis.com/icon?family=Material+Icons"
			rel="stylesheet"
		/>
		<link
			type="text/css"
			rel="stylesheet"
			href="<?php echo $urlweb ?>app/css/materialize.min.css"
			media="screen,projection"
		/>
		<link rel="stylesheet" href="<?php echo $urlweb ?>app/css/styles.css" />

		<!-- PLUGINS -->
		<link
			href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/themes/splide-sea-green.min.css"
			rel="stylesheet"
		/>
		<link
			type="text/css"
			rel="stylesheet"
			href="<?php echo $urlweb ?>app/css/jquery.nice-number.min.css"
		/>
		<title>Libreria</title>
	</head>
	<body>

<!-- UPPER NAV -->
 <div id="upper-nav" class="row blue lighten-1 m-0 hide-on-med-and-down">
			<div class="col-80 mx-auto">
				<ul class="col s8 d-start">
					<li><a class="modal-trigger" href="#modal1">Bienvenido</a></li>
					<li><a href="?modulo=ofertasdiarias">Ofertas Diarias</a></li>
					<li><a href="https://www.abretelibro.com/foro/" target="_blank">Foro</a></li>
					<li><a href="?modulo=ayudaycontacto" >Ayuda y Contacto</a></li>
				</ul>
				<ul class="col s4 d-end">
					<li>
						<a  class="modal-trigger" href="#modal2"> <i class="small material-icons">notifications</i></a>
					</li>
					<li>
						<a href="?modulo=carrito"> <i class="small material-icons">shopping_cart</i></a>
					</li>
				</ul>
			</div>
</div>
<!-- LOWER NAV	 -->
	<nav class="container" id="lower-nav">
		<div class="nav-wrapper">
		<a href="<?php echo $urlweb ?>" class="brand-logo ml-2 logo-name"><img src="<?php echo $urlweb ?>app/img/LibreriaMoiras.png" alt="logo"  class="brand-logo ml-2 logo-name" ></a>
		<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		<ul class="right hide-on-med-and-down">
		<li><a href="?modulo=por_cats" >Por Categoria</a></li>
						<li><a href="?modulo=por_nombre" >Por Nombre</a></li>
						<li><a href="?modulo=recomendaciones">Recomendaciones</a></li>
		</ul>
		</div>
	</nav>

	<div class="sidenav" id="mobile-demo">
	<ul class="col s12 d-around">
					<li>
						<a class="modal-trigger" href="#modal2"> <i class="small material-icons">notifications</i></a>
					</li>
					<li>
						<a href="?modulo=carrito"> <i class="small material-icons">shopping_cart</i></a>
					</li>
					
				</ul>
		<ul >
		<li><div class="divider"></div></li>
			<li><a class="modal-trigger" href="#modal1">Bienvenido</a></li>
					<li><a href="?modulo=ofertasdiarias">Ofertas Diarias</a></li>
					<li><a href="https://www.abretelibro.com/foro/" target="_blank">Foro</a></li>
					<li><a href="?modulo=ayudaycontacto">Ayuda y Contacto</a></li>
	<li><div class="divider"></div></li>
	<li><a href="?modulo=por_cats">Por Categoria</a></li>
	<li><a href="?modulo=por_nombre">Por Nombre</a></li>
	<li><a href="?modulo=recomendaciones">Recomendaciones</a></li>
</ul>
</div>
		
<main class="mb-4">
<!-- Modal -->
<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content center">
      <h4>Bienvenido</h4>
      <p>A continuacion encontrara los modulos relacionados a esta pagina web</p>
	  <ul class="collapsible">
  	<li>
  		<div class="collapsible-header">
		  <i class="material-icons">store</i>Administrador de Productos
  		</div>
  		<div class="collapsible-body">
		  <a class="btn my-1 acc-c5-bg-c3" href="?modulo=admin_productos"><i class="material-icons left">add_circle</i>Administrar productos</a>
		  <a class="btn my-1 acc-c5-bg-c3" href="?modulo=admin_sagas"><i class="material-icons left">add_circle</i>Administrar sagas</a>
		  <a class="btn my-1 acc-c5-bg-c3" href="?modulo=admin_ofertas"><i class="material-icons left">add_circle</i>Administrar ofertas</a>
		</div>
  	</li>
  	<li>
  		<div class="collapsible-header">
		  <i class="material-icons">store</i>Administrador de Categorias
  		</div>
  		<div class="collapsible-body">
		  <a class="btn acc-c5-bg-c3" href="?modulo=admin_categorias"><i class="material-icons left">add_circle</i>Administrar categorias</a>
  		</div>
  	</li>
	  <li>
  		<div class="collapsible-header">
		  <i class="material-icons">store</i>Administrador de Ordenes
  		</div>
  		<div class="collapsible-body">
		  <a class="btn acc-c5-bg-c3" href="?modulo=admin_ordenes"><i class="material-icons left">add_circle</i>Administrar ordenes</a>
  		</div>
  	</li>
  </ul>
	</div>
</div>

<!-- End Modal -->
<!-- Modal Notifs-->
<div id="modal2" class="modal">
    <div class="modal-content center">
      <h4>Notificaciones</h4>
      <p>Estas son las ofertas de los ultimos 30 dias.</p>
	  <ul class="collection">
	  <?php $strsql="SELECT `idproducto`, `nombre_producto`,  `precio`, `url_imagen`, `fecha_creacion` FROM `productos`  where tipo=3 AND fecha_creacion >= DATE_FORMAT( CURRENT_DATE - INTERVAL 1 MONTH, '%Y/%m/01' ) order by fecha_creacion DESC;";
                if($stmt=$mysqli->prepare($strsql)){
                    $stmt->execute();
                    $stmt->store_result();
                    if($stmt->num_rows>0){
                        $stmt->bind_result($idoferta,$nombre_oferta,$precio,$url_imagen,$fecha_creacion);
                        while ($stmt->fetch()){
                            ?>
                     <li><a class="collection-item avatar center valign" href="?modulo=producto_detalles&idproducto=<?php echo $idoferta?>">
                        
                                <img src="<?php echo $url_imagen?>" alt="" class="circle" />
                           
                            <p class="item-name accent-c1-25"> <?php echo strtoupper($nombre_oferta)?></p>
                            <p class="item-price accent-c5"><?php echo "L " .number_format($precio,2) ?></p>
                    </a></li>
                 <?php
                        }
                    } else{
                        echo "No hay datos para mostrar";
                    }
                }else{
                    echo "Error al preparar la consulta";
                }
                ?>
       
      </ul>
	</div>
</div>

<!-- End Modal -->

<!-- Modulos -->
		<div>
			<?php $funciones->modulo($modulo); ?>
		</div>
<!-- End Modulos -->
</main>

        <footer class="p-1 page-footer mt-3">
            <div class="footer-copyright p-1">
                <div class="container">
                © 2022 Desarollo de Aplicaciones en Internet
                <a class="grey-text  right" href="#!">usap.edu</a>
                </div>
              </div>
        </footer>
		<script type="text/javascript" src="<?php echo $urlweb ?>app/js/materialize.min.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/combine/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js,npm/@splidejs/splide@4.0.7"></script>
		<script type="text/javascript" src="<?php echo $urlweb ?>app/js/script.js"></script>
	
		<script type="text/javascript">
			
		</script>
	</body>
</html>
