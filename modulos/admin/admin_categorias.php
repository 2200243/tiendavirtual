<?php 
global $mysqli;
global $urlweb;
?>

<h3 class="center" >Administrador de Categorias</h3>
<div class="center mb-3">
    <a class="blue btn mx-auto center" href="?modulo=admin_agregar_categoria"><i class="material-icons right">add</i>Nueva Categoria</a>
</div>
<div class="divider p-1 mb-4 container"></div>
<table class="container white z-depth-1 mb-2 responsive-table" id="adminprod">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Imagen</th>
            <th>Categoria</th>
            <th>Descripcion</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $strsql= "SELECT `idcategoria`, `nombre_categoria`, `descripcion`, `url_imagen` FROM `categorias`";
        if($stmt = $mysqli->prepare($strsql)){
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows>0){
                $stmt->bind_result($idcategoria,$nombre_categoria,$descripcion,$url_imagen);
               while ($stmt->fetch()){
                   ?>
                   <tr id="<?php echo $idcategoria?>">
                       <td><?php echo $nombre_categoria?></td>
                       <td><div class="img">

                           <img src="<?php echo $url_imagen?>" alt="" class="responsive-img img" />
                       </div>
                       </td>
                       <td><?php echo $descripcion?></td>
                       
                       <td><a class="btn green modal-trigger" id="modal-<?php echo $idcategoria?>" href="#modaleditarproducto-<?php echo $idcategoria?>">Editar</a></td>
            <td><a class="btn red" href="javascript:eliminar(<?php echo $idcategoria?>)">Eliminar</a></td>
                   </tr>
                   <div id="modaleditarproducto-<?php echo $idcategoria?>" class="modal modaleditarproducto">
                        <div class="modal-content center">
                        <h4>Editar Producto <?php echo $idcategoria?></h4>
                        <div class="img">
                            <img src="<?php echo $url_imagen?>" alt=""  />
                        </div>
                        <div class="row">
                        <form class="col s12" action="javascript:editar(<?php echo $idcategoria?>)">
                                <div class="row">
                                    <div class="input-field col s12">
                                    <input id="nombre_categoria-<?php echo $idcategoria?>" type="text" class="validate" value="<?php echo $nombre_categoria?>" required>
                                    <label for="nombre_categoria-<?php echo $idcategoria?>">Nombre de Categoria</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                    <input id="descripcion-<?php echo $idcategoria?>" type="text" class="validate" value="<?php echo $descripcion?>" size="100" required>
                                    <label for="descripcion-<?php echo $idcategoria?>">Descripcion</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                    <input id="url_imagen-<?php echo $idcategoria?>" type="url" class="validate" value="<?php echo $url_imagen?>" size="100" required>
                                    <label for="url_imagen-<?php echo $idcategoria?>">Link de Imagen</label>
                                    </div>
                                </div>
                                <button type="submit" class=" btn-flat acc-c5-bg-c3">Editar</button>
                        </form>
                        <div class="modal-footer">
                            <a href="javascript:editar(<?php echo $idcategoria?>)" class="modal-close waves-effect waves-green btn-flat">Editar</a>
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

    function eliminar(idcategoria)
    {
        var url = '<?php echo $urlweb?>servicios/ws_categoria_detalles.php?accion=eliminar';
        
        
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
            "idcategoria": idcategoria
            })
        })
        .then((res)=>res.json())
        .then((data) =>{
            M.toast({html: data.text})
            const row = document.getElementById(idcategoria);
            row.remove();
        })
        .catch(console.error);
    }

    function editar(idcategoria){
        var url = '<?php echo $urlweb?>servicios/ws_categoria_detalles.php?accion=editar';
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
            "idcategoria": idcategoria,
            "nombre_categoria": document.getElementById("nombre_categoria-"+idcategoria).value,
            "descripcion": document.getElementById("descripcion-"+idcategoria).value,
            "url_imagen": document.getElementById("url_imagen-"+idcategoria).value
            })
        })
        .then((res)=>res.json())
        .then((data) =>{
            M.toast({html: data.text});
            location.reload();
            //TODO: Quitar Reload y Actualizar la tabla
        })
        .catch(
            err => {
                console.log(err.message);
                console.log(err);

            }
        );
    
    }
</script>