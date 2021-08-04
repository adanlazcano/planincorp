<?php
namespace App\Logic;
defined("APPPATH") OR die("Access denied");
use \App\Functions\Functions as Fun,
    \App\Models\Area as AreaModel;

class Area{
  
  public function __construct(){
   
  }

  //GET ALL AREAS AND DRAW AREA TABLE
  public function getAll($limit,$offset,$search){

    $mArea = new AreaModel();

    $MlArea = $mArea->getAll($limit,$offset,$search);

    return $MlArea;

  }

  //CREATE & UPDATE AREA
  public function create($request){
    
    $fFun = new Fun();
    $mArea = new AreaModel();
    $MlArea="";
    
    extract(get_object_vars($request));

    $area=$fFun->removeTildes($areaNombre);

    $area=trim(strtoupper($area));

    if(!$id){
      $MlArea = $mArea->create($area);
    }else{
      $MlArea = $mArea->update($area,$compareField,$id);
    }
    
     return $MlArea;

  }

   // DELETE AREA BY ID
  public function delete($id){

    $mArea = new AreaModel();
    $MlArea = $mArea->delete($id);

    return $MlArea;

  }
  
}
