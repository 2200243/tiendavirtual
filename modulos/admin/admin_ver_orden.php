<?php
global $mysqli;
$idorden = $_GET['idorden'];

?>

<!-- Modal Structure -->
<div class="container white z-depth-1 rounded-corners mt-4 pb-5">
    
    <h5 class="center pt-2">Orden #<?php echo $idorden?></h5>
<table class="white p-4 container responsive-table mx-auto  d-center-imp " >
                  
                  <thead  >
                      <tr >
                          <th>Producto</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                      </tr>
                  </thead>
                  <tbody  >
                      <?php
                      $total=0;
                  $strsql= "SELECT b.nombre_producto, a.cantidad, b.precio FROM `detalle_de_orden` a inner join productos b on a.idproducto=b.idproducto where a.orderid=$idorden;";
                  if($stmt = $mysqli->prepare($strsql)){
                      $stmt->execute();
                      $stmt->store_result();
                      if($stmt->num_rows>0){
                          $stmt->bind_result($nombre_producto,$cantidad,$precio);
                          while ($stmt->fetch()){
                              ?>
                          <tr >
                              <td><?php echo $nombre_producto?></td>
                              <td><?php echo $cantidad?></td>
                              <td><?php echo "L " .number_format($precio*$cantidad,2)?></td> 
                              <?php $total+=$precio*$cantidad;?>
                              <?php

                                  }
                              } else{
                                ?>
                                <tr >
                                 <td colspan="3" class="center">No hay datos para mostrar</td></tr>
                                 <?php
                              }
                              } else{
                                  echo "Error al preparar la consulta";
                              }
                              ?>
                          
                      </tbody>
                      <tfoot>
                    <tr >
                        <th scope="row">Total</th>
                        <td></td>
                        <td><?php echo "L " .number_format($total)?></td>
                    </tr>
    </tfoot>
               
</table>
</div>