<?php
namespace App\Logic;
defined("APPPATH") OR die("Access denied");
use \App\Functions\Functions as Fun, 
    \App\Models\Product as ProductModel;

class Product{
  
  public function __construct(){
   
  }

  
  //GET ALL PRODUCTS AND DRAW PRODUCTS TABLE
  public function getAll($limit,$offset,$search){

    $mProduct = new ProductModel();

    $MlProduct = $mProduct->getAll($limit,$offset,$search);

    return $MlProduct;

  }

  //CREATE & UPDATE Product
  public function create($request){

    $fFun = new Fun();
    $mProduct = new ProductModel();
    $MlProduct = "";

    extract(get_object_vars($request));

    $name = $fFun->removeTildes($prodNombre);
    $marca = $fFun->removeTildes($prodMarca);

    $name = trim(strtoupper($name));
    $marca = trim(strtoupper($marca));
    
    if(!$id){
      $MlProduct = $mProduct->create($name,$marca,$prodPrecio,$prodCat);
    }else{
      $MlProduct = $mProduct->update($compareField,$name,$marca,$prodPrecio,$prodCat,$id);
    }
    
    return $MlProduct;

  }

  //UPDATE Product
  public function update($request){

    $mProduct = new ProductModel();
    $MlProduct = $mProduct->update($request);

    return $MlProduct;

  }

  // DELETE Product BY ID
  public function delete($id){

    $mProduct = new ProductModel();
    $MlProduct = $mProduct->delete($id);

    return $MlProduct;

  }

}
