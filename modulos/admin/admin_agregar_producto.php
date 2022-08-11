<?php 
global $mysqli;
global $urlweb;
?>
<div class="container">
    <h4 class="center">Nuevo Producto</h4>
    <div class="form white p-3 mb-5 z-depth-1 rounded-corners">
<form  action="javascript:add()" >
        <div class="row">
            <div class="input-field col s12">
            <input id="nombre_producto" type="text" class="validate" required>
            <label for="nombre_producto">Nombre de Producto</label>
            </div>
        </div>

        
        <div class="row">
        <div class="input-field col s12">
            <select id="categoria">
            <option value="" disabled selected required>Escoge la categoria: </option>
            <?php $strsql="SELECT a.idcategoria, a.nombre_categoria FROM categorias a;";
                if($stmt=$mysqli->prepare($strsql)){
                    $stmt->execute();
                    $stmt->store_result();
                    if($stmt->num_rows>0){
                        $stmt->bind_result($idcategoria,$nombre_categoria);
                        while ($stmt->fetch()){
                            ?>   
            <option id="cat-<?php echo $idcategoria?>" value="<?php echo $idcategoria?>"><?php echo $nombre_categoria?></option>
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
            <input id="descripcion" type="text" class="validate"  size="100" required>
            <label for="descripcion">Descripcion</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
            <input id="cantidad"  type="number" class="validate" required>
            <label for="cantidad">Cantidad</label>
            </div>
            <div class="input-field col s6">
            <input id="precio" type="number" class="validate" required>
            <label for="precio">Precio</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
            <input id="url_imagen" type="url" class="validate" size="100" required>
            <label for="url_imagen">Link de Imagen</label>
            </div>
        </div>
        <button type="submit" class=" btn-flat acc-c5-bg-c3">Agregar Producto</button>
    </form>
<div class="mt-4"></div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous"></script>
<script src="<?php echo $urlweb ?>app/js/jQuery.tabable-required-focus.min.js"></script>

<script >
     
    
 $(document).ready(function(){
  $.tabableRequiredFieldsFocus();
 });
    function add(){
        var url = '<?php echo $urlweb?>servicios/ws_producto_detalles.php?accion=agregar';
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
            "nombre_producto": document.getElementById("nombre_producto").value,
            "idcategoria": document.getElementById("categoria").selectedIndex,
            "descripcion": document.getElementById("descripcion").value,
            "cantidad":  parseInt(document.getElementById("cantidad").value),
            "precio": parseFloat(document.getElementById("precio").value),
            "url_imagen": document.getElementById("url_imagen").value,
            "tipo":1
            })
        })
        .then((res)=>res.json())
        .then((data) =>{
            M.toast({html: data.text});
            window.setTimeout(function () {
                window.location.href = '?modulo=admin_productos';
            }, 2000);
        })
        .catch((err)=>{console.log(err);
            M.toast({html: "Revise todos los datos"});
        })
    
    }
    function test(){
        alert( document.getElementById("categoria").selectedIndex);
    }
</script>

