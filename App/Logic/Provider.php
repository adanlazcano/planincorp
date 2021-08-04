<?php
namespace App\Logic;
defined("APPPATH") OR die("Access denied");
use \App\Functions\Functions as Fun,
     \App\Models\Provider as ProviderModel;

class Provider{
  
  public function __construct(){
   
  }

  //GET ALL CATEGORIES AND DRAW CATEGORIES TABLE
  public function getAll($limit,$offset,$search){

    $mProvider = new ProviderModel();

    $MlProvider = $mProvider->getAll($limit,$offset,$search);

    return $MlProvider;

  }

  //CREATE & UPDATE Provider
  public function create($request){

    $fFun = new Fun();
    $mProvider = new ProviderModel();
    $MlProvider="";

    extract(get_object_vars($request));

    $name = $fFun->removeTildes($provNombre);
    $desc = $fFun->removeTildes($provDescripcion);
    $dir = $fFun->removeTildes($provDireccion);
    $tel = $fFun->removeTildes($provTelefono);

    $name=trim(strtoupper($name));
    $desc=trim(strtoupper($desc));
    $dir=trim(strtoupper($dir));
    $tel=trim(strtoupper($tel));

    if(!$id){
      $MlProvider = $mProvider->create($name,$desc,$dir,$tel);
    }else{
      $MlProvider = $mProvider->update($compareField,$name,$desc,$dir,$tel,$id);
    }

    return $MlProvider;

  }

   // DELETE Provider BY ID
  public function delete($id){

    $mProvider = new ProviderModel();
    $MlProvider = $mProvider->delete($id);

    return $MlProvider;

  }
 
}
