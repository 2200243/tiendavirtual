<?php 
global $mysqli;
global $urlweb;
?>

<h3 class="center" >Administrador de Ordenes</h3>
<div class="divider container white p-1 mb-3"></div>
<table class="container white z-depth-1 mb-2 responsive-table" id="adminorden">
    <thead>
        <tr>
            <th>Orden #ID</th>
            <th>Id de Usuario</th>
            <th>Usuario</th>
            <th>Total</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $strsql= "SELECT a.idorden,a.uid, b.usuario,a.total  FROM `orden` a inner join usuarios b on a.uid=b.idusuario;";
       if($stmt = $mysqli->prepare($strsql)){
           $stmt->execute();
           $stmt->store_result();
           if($stmt->num_rows>0){
               $stmt->bind_result($idorden,$uid,$usuario,$total);
               while ($stmt->fetch()){
                   ?>
                   <tr id="<?php echo $idorden?>">
                       <td><?php echo $idorden?></td>
                       <td><?php echo $uid?></td>
                       <td><?php echo $usuario?></td>
                       <td><?php echo "L " .number_format($total,2)?></td>
                       <td><a class="btn green modal-trigger" href="?modulo=admin_ver_orden&idorden=<?php echo $idorden?>">Ver Orden</a></td>
            <td><a class="btn red" href="javascript:eliminar(<?php echo $idorden?>)">Eliminar</a></td>
                   </tr>

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

    function eliminar(idorden)
    {
        var url = '<?php echo $urlweb?>servicios/ws_carrito_orden.php?accion=eliminar';
        
        
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
            "idorden": idorden
            })
        })
        .then((res)=>res.json())
        .then((data) =>{
            M.toast({html: data.text})
            const row = document.getElementById(idorden);
            row.remove();
        })
        .catch(console.error);
    }

</script>