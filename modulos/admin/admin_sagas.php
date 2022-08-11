<?php 
global $mysqli;
global $urlweb;
?>

<h3 class="center" >Administrador de Sagas</h3>
<div class="center mb-3">
    <a class="blue btn mx-auto center" href="?modulo=admin_agregar_saga"><i class="material-icons right">add</i>Nueva Saga</a>
</div>
<div class="divider"></div>
<table class="container white z-depth-1 mb-2 responsive-table" id="adminprod">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Imagen</th>
            <th>Categoria</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $strsql= "SELECT productos.idproducto, productos.nombre_producto, categorias.nombre_categoria, productos.descripcion, productos.precio, productos.cantidad, productos.url_imagen, productos.idcategoria FROM `productos` INNER JOIN categorias ON categorias.idcategoria=productos.idcategoria where productos.tipo=2 order by productos.fecha_creacion;";
       if($stmt = $mysqli->prepare($strsql)){
           $stmt->execute();
           $stmt->store_result();
           if($stmt->num_rows>0){
               $stmt->bind_result($idproducto,$nombre_producto,$nombre_categoria,$descripcion,$precio,$cantidad,$url_imagen,$idcategoria);
               while ($stmt->fetch()){
                   ?>
                   <tr id="<?php echo $idproducto?>">
                       <td><?php echo $nombre_producto?></td>
                       <td><div class="img">

                           <img src="<?php echo $url_imagen?>" alt="" class="responsive-img img" />
                       </div>
                       </td>
                       <td><?php echo $nombre_categoria?></td>
                       <td><?php echo $descripcion?></td>
                       
                       <td><?php echo "L " .number_format($precio,2)?></td>
                       <td><?php echo $cantidad?></td>
                       <td><a class="btn green modal-trigger" id="modal-<?php echo $idproducto?>" href="#modaleditarproducto-<?php echo $idproducto?>">Editar</a></td>
            <td><a class="btn red" href="javascript:eliminar(<?php echo $idproducto?>)">Eliminar</a></td>
                   </tr>
                   <div id="modaleditarproducto-<?php echo $idproducto?>" class="modal modaleditarproducto">
                        <div class="modal-content center">
                        <h4>Editar Producto <?php echo $idproducto?></h4>
                        <div class="img">
                            <img src="<?php echo $url_imagen?>" alt=""  />
                        </div>
                        <div class="row">
                        <form class="col s12" >
                                <div class="row">
                                    <div class="input-field col s12">
                                    <input id="nombre_producto-<?php echo $idproducto?>" type="text" class="validate" value="<?php echo $nombre_producto?>">
                                    <label for="nombre_producto-<?php echo $idproducto?>">Nombre de Producto</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                    <input id="cat-<?php echo $idproducto?>" type="text" class="validate" value="<?php echo $idcategoria?>" size="100" disabled>
                                    <label for="cat-<?php echo $idproducto?>">Categoria Previa</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select id="categoria-<?php echo $idproducto?>">
                                        <option value="" disabled selected required>Escoge la categoria: </option>
                                        <?php $strsql2="SELECT a.idcategoria, a.nombre_categoria FROM categorias a;";
                                            if($stmt2=$mysqli->prepare($strsql2)){
                                                $stmt2->execute();
                                                $stmt2->store_result();
                                                if($stmt2->num_rows>0){
                                                    $stmt2->bind_result($idcategoria2,$nombre_categoria2);
                                                    while ($stmt2->fetch()){
                                                        echo $idcategoria2." ".$nombre_categoria2;
                                                        ?>   
                                                          <option id="cat-<?php echo $idcategoria2?>" value="<?php echo $idcategoria2?>"><?php echo $idcategoria2?> - <?php echo $nombre_categoria2?></option>
                                                       <?php
                                                          }
                                                } else{
                                                    echo "No hay datos para mostrar";
                                                }
                                            }else{
                                                echo "Error al preparar la consulta";
                                            }
                                                    ?>
                                        </select>
                                        <label>Categoria</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                    <input id="descripcion-<?php echo $idproducto?>" type="text" class="validate" value="<?php echo $descripcion?>" size="100">
                                    <label for="descripcion-<?php echo $idproducto?>">Descripcion</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                    <input id="cantidad-<?php echo $idproducto?>" value="<?php echo $cantidad?>" type="number" class="validate">
                                    <label for="cantidad-<?php echo $idproducto?>">Cantidad</label>
                                    </div>
                                    <div class="input-field col s6">
                                    <input id="precio-<?php echo $idproducto?>" value="<?php echo $precio?>" type="number" class="validate">
                                    <label for="precio-<?php echo $idproducto?>">Precio</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                    <input id="url_imagen-<?php echo $idproducto?>" type="url" class="validate" value="<?php echo $url_imagen?>" size="100">
                                    <label for="url_imagen-<?php echo $idproducto?>">Link de Imagen</label>
                                    </div>
                                </div>
        
                        </form>
                        <div class="modal-footer">
                            <a href="javascript:editar(<?php echo $idproducto?>)" class="modal-close waves-effect waves-green btn-flat">Editar</a>
                         </div>
                </div>
        
	</div>
</div>

                   <?php

               }
           } else{
               echo "No hay datos para mostrar";
           }
         } else{
             echo "Error al preparar la consulta";
         }
       ?>
    </tbody>
</table>

<script type="text/javascript">

    function eliminar(idproducto)
    {
        var url = '<?php echo $urlweb?>servicios/ws_producto_detalles.php?accion=eliminar';
        
        
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
            "idproducto": idproducto
            })
        })
        .then((res)=>res.json())
        .then((data) =>{
            M.toast({html: data.text})
            const row = document.getElementById(idproducto);
            row.remove();
        })
        .catch(console.error);
    }

    function test(e,form) {
        fetch(form.action, {method:'post', body: new FormData(form)})
        .then((res)=>res.json())
        .then((data) =>{
            M.toast({html: data.text})
        })

        console.log('We send post asynchronously (AJAX)');
        e.preventDefault();
    }

    function editar(idproducto){
        var url = '<?php echo $urlweb?>servicios/ws_producto_detalles.php?accion=editar';
        
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
            "idproducto": idproducto,
            "nombre_producto": document.getElementById("nombre_producto-"+idproducto).value,
            "idcategoria": document.getElementById("categoria-"+idproducto).selectedIndex==0?parseInt(document.getElementById("cat-"+idproducto).value):document.getElementById("categoria-"+idproducto).selectedIndex,
            "descripcion": document.getElementById("descripcion-"+idproducto).value,
            "cantidad":  parseInt(document.getElementById("cantidad-"+idproducto).value),
            "precio": parseFloat(document.getElementById("precio-"+idproducto).value),
            "url_imagen": document.getElementById("url_imagen-"+idproducto).value
            })
        })
        .then((res)=>res.json())
        .then((data) =>{
            M.toast({html: data.text});
            location.reload();
            //TODO: Quitar Reload y Actualizar la tabla
        })
        .catch(console.error);
    
    }
</script>