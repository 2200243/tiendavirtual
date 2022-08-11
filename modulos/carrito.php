<?php
global $mysqli;
global $urlweb;
?>

<!-- Modal Structure -->
<div class="container white z-depth-1 rounded-corners mt-4 pb-5">

                      <?php
                        $total = 0;
                  $strsql= "SELECT  a.orderid,a.idproducto, b.nombre_producto, a.cantidad, b.precio FROM `cart_item` a inner join productos b on a.idproducto=b.idproducto inner join sesion_de_compra c on a.orderid=c.idorden where c.uid='2200243';";
                  if($stmt = $mysqli->prepare($strsql)){
                      $stmt->execute();
                      $stmt->store_result();
                      if($stmt->num_rows>0){
                        ?>
    
    <table class="white p-4 container responsive-table mx-auto  d-center-imp " id="cart-items" >
                  
                  <thead  >
                      <tr >
                          <th>Producto</th>
                          <th>Cantidad</th>
                            <th>Precio</th>
                          <th>Subtotal</th>
                          <th>Borrar</th>
                      </tr>
                  </thead>
                  <tbody  >
                        <?php
                          $stmt->bind_result($idorden,$idproducto,$nombre_producto,$cantidad,$precio);
                          while ($stmt->fetch()){
                              ?>
                          <tr id="<?php echo $idproducto?>">
                              <td><?php echo $nombre_producto?></td>
                              <td><?php echo $cantidad?></td>
                              <td><?php echo $precio?></td>
                              <td><?php echo "L " .number_format($precio*$cantidad,2)?></td> 
                              <td><a class="btn red" href="javascript:eliminar(<?php echo $idproducto?>,<?php echo $idorden?>)"><i class="material-icons white-text">clear</i></a></td>
                              
                             <?php
                          }
                            $stmt->close();
                            ?>
                          
                      </tbody>
                     
               
</table>

<div class="container center">

    <a class="btn acc-c5-bg-c3 " href="javascript:add(<?php echo $idorden?>)"><i class="material-icons left">add_shopping_cart</i>Procesar Mi Orden</a>
</div>

                            <?php
                               
                                
                              } else{
                                ?>
                                <h5 class="center-align">No hay productos en el carrito</h5>
                                 <?php
                              }
                              } else{
                                  echo "Error al preparar la consulta";
                              }
                              ?>
</div>

<script type="text/javascript">

    function eliminar(idproducto,idorden)
    {
        var url = '<?php echo $urlweb?>servicios/ws_carrito_detalles.php?accion=eliminar';
        
        
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
            "idproducto": idproducto,
            "idorden": idorden
            
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

    function add(ordenid){
        addOrden(ordenid);
        
    }


    function addOrden(ordenid){
        var url = '<?php echo $urlweb?>servicios/ws_carrito_orden.php?accion=agregar';
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
            idorden:  ordenid
            })
        })
        .then((res)=>res.json())
        .then((data) =>{
            M.toast({html: data.text});
            eliminarSesion(ordenid);
        })
        .catch((err)=>{console.log(err);
            M.toast({html: "Revise todos los datos"});
        })
    }

    function eliminarSesion(ordenid){
        var url = '<?php echo $urlweb?>servicios/ws_sesion_de_compra.php?accion=eliminar';
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({
            idorden:  ordenid

            })
        })
        .then((res)=>res.json())
        .then((data) =>{
            window.location.href = '<?php echo $urlweb?>?modulo=gracias';

        })
        .catch((err)=>{console.log(err);
            M.toast({html: "Revise todos los datos"});
        })
    }

</script>