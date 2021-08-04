<?php
namespace App\Logic;
defined("APPPATH") OR die("Access denied");
use \App\Functions\Functions as Fun, 
    \App\Models\Category as CategoryModel;

class Category{
  
  public function __construct(){
   
  }

  //GET ALL CATEGORIES AND DRAW CATEGORIES TABLE
  public function getAll($limit,$offset,$search){

    $mCategory = new CategoryModel();

    $MlCategory = $mCategory->getAll($limit,$offset,$search);

    return $MlCategory;

  }

  //CREATE Category
  public function create($request){
    
    $fFun = new Fun();
    $mCategory = new CategoryModel();
    $MlCategory="";

    extract(get_object_vars($request));

    $category=$fFun->removeTildes($catNombre);
    $category = trim(strtoupper($category));

    if(!$id){
      $MlCategory = $mCategory->create($category);
    }else{
      $MlCategory = $mCategory->update($category,$compareField,$id);
    }

    return $MlCategory;

  }

  // DELETE Category BY ID
  public function delete($id){

    $mCategory = new CategoryModel();
    $MlCategory = $mCategory->delete($id);

    return $MlCategory;

  }
 
}
