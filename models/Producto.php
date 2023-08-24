<?php
require_once 'Conexion.php';

class Productos extends Conexion{

private $access;

public function __CONSTRUCT(){
  $this->access = parent::getConnection();
}

// LISTAR
public function list_product(){
  try{
    $query = $this->access->prepare("CALL spu_listar_product()");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);

  }catch(Exception $e){
    die($e->getMessage());
  }
 }

 //REGISTRAR 
 public function register_product($data = []){
  try{
    $query = $this->access->prepare("call spu_registrar_product(?,?,?,?,?,?)");
    $query->execute(
      array(
        $data['tipo'],
        $data['descripcion'],
        $data['precio'],
        $data['fechavencimiento'],
        $data['presentacion'],
        $data['lote']
      )
    ); 

  }catch(Exception $e){
    die($e->getMessage());
  }
 }

 //ACTUALIZAR 

 public function update_product($data = []){
  try{
    $query = $this->access->prepare("CALL spu_producto_update(?,?,?,?,?,?,?)");
    $query->execute(
      array(
        $data['idproducto'],
        $data['tipo'],
        $data['descripcion'],
        $data['precio'],
        $data['fechavencimiento'],
        $data['presentacion'],
        $data['lote']
      )
    ); 

  }catch(Exception $e){
    die($e->getMessage());
  }
 }

 //MOSTRAR
 public function getdata($data = []){
  try{

    $query = $this->access->prepare("CALL spu_get_producto(?)");
    $query->execute(array($data['idproducto']));
    return $query->fetchAll(PDO::FETCH_ASSOC);

  }catch(Exception $e){
  die($e->getCode());
  }

 }

 //ELIMINAR 

 public function delete($data = []){
  try{

    $query = $this->access->prepare("CALL spu_producto_delete(?)");
    $query->execute(array($data['idproducto']));
    
  }catch(Exception $e){
  die($e->getCode());
  }

 }
 


}

?>