<?php 
global $mysqli;
global $urlweb;
?>
<div class="container">
    <h4 class="center">Nueva Categoria</h4>
    <div class="form white p-3 mb-5 z-depth-1 rounded-corners">
<form  action="javascript:addCat()" >
        <div class="row">
            <div class="input-field col s12">
            <input id="nombre_categoria" type="text" class="validate" required>
            <label for="nombre_categoria">Nombre de Categoria</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
            <input id="descripcion" type="text" class="validate"  size="100" required>
            <label for="descripcion">Descripcion</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
            <input id="url_imagen" type="url" class="validate" size="100" required>
            <label for="url_imagen">Link de Imagen</label>
            </div>
        </div>
        <button type="submit" class=" btn-flat acc-c5-bg-c3">Agregar Categoria</button>
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
    function addCat(){
        var url = '<?php echo $urlweb?>servicios/ws_categoria_detalles.php?accion=agregar';
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
            "nombre_categoria": document.getElementById("nombre_categoria").value,
            "descripcion": document.getElementById("descripcion").value,
            "url_imagen": document.getElementById("url_imagen").value
            })
        })
        .then((res)=>res.json())
        .then((data) =>{
            M.toast({html: data.text});
            window.setTimeout(function () {
                window.location.href = '?modulo=admin_categorias';
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

