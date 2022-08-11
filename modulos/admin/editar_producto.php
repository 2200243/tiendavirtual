<?php 
global $mysqli;
global $urlweb;
?>

<div id="modaleditarproducto-<?php echo $idproducto?>" class="modal">
    <div class="modal-content center">
      <h4>Editar Producto <?php echo $idproducto?></h4>
      <div class="img">
         <img src="<?php echo $url_imagen?>" alt=""  />
     </div>
      <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="nombre_producto" type="text" class="validate" value="<?php echo $nombre_producto?>">
          <label for="nombre_producto">Nombre de Producto</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="categoria" type="text" class="validate" value="<?php echo $nombre_categoria?>" size="100">
          <label for="categoria">Categoria</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="descripcion" type="text" class="validate" value="<?php echo $descripcion?>" size="100">
          <label for="descripcion">Descripcion</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="cantidad" value="10" type="number" class="validate">
          <label for="cantidad">Cantidad</label>
        </div>
        <div class="input-field col s6">
          <input id="precio" value="10" type="number" class="validate">
          <label for="precio">Precio</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="url_imagen" type="url" class="validate" value="<?php echo $url_imagen?>" size="100">
          <label for="url_imagen">Link de Imagen</label>
        </div>
      </div>
      
     
    </form>
    <div class="modal-footer">
        <a href="" class="modal-close waves-effect waves-green btn-flat">Editar</a>
      </div>
  </div>
        
	</div>
</div>
