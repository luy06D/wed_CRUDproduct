<?php

require_once '../models/Producto.php';
$producto = new Productos();

if(isset($_POST['operacion'])){

  if($_POST['operacion'] == 'register'){
    $regist= [
      "tipo"        => $_POST['tipo'],
      "descripcion" => $_POST['descripcion'],
      "precio"      => $_POST['precio'],
      "fechavencimiento" => $_POST['fechavencimiento'],
      "presentacion" => $_POST['presentacion'],
      "lote"         => $_POST['lote']
    ];
    $producto->register_product($regist);

  }

  if($_POST['operacion'] == 'update'){
    $regist= [
      "idproducto"        => $_POST['idproducto'],
      "tipo"              => $_POST['tipo'],
      "descripcion"       => $_POST['descripcion'],
      "precio"            => $_POST['precio'],
      "fechavencimiento"  => $_POST['fechavencimiento'],
      "presentacion"      => $_POST['presentacion'],
      "lote"              => $_POST['lote']
    ];
    $producto->update_product($regist);

  }

    
  if($_POST['operacion'] == 'delete'){
      $producto->delete(
        [
          'idproducto' => $_POST['idproducto']
        ]
        );
  }

}





//Listar
if(isset($_GET['operacion'])){

  if($_GET['operacion'] == 'list_product'){
    echo json_encode($producto->list_product());
    }
  
  
    if($_GET['operacion'] == 'getdata'){
      echo json_encode(
        $producto->getdata(
          [
            'idproducto' => $_GET['idproducto']
          ]
          )
        );
    }





}

?>