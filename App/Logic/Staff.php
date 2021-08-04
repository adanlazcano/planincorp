<?php
namespace App\Logic;
defined("APPPATH") OR die("Access denied");
use \App\Functions\Functions as Fun,
    \App\Models\Staff as StaffModel;
    

class Staff{
  
  public function __construct(){
   
  }
  
  //GET ALL STAFF AND DRAW STAFF TABLE
  public function getAll($limit,$offset,$search){

    $mStaff = new StaffModel();

    $MlStaff = $mStaff->getAll($limit,$offset,$search);

    return $MlStaff;

  }

  //CREATE & UPDATE STAFF
  public function create($request){

    $fFun= new Fun();
    $mStaff = new StaffModel();
    $MlStaff="";

    extract(get_object_vars($request));

    $name = $fFun->removeTildes($staffNombre);
    $apP = $fFun->removeTildes($staffApPaterno);
    $apM = $fFun->removeTildes($staffApMaterno);
    $puesto = $fFun->removeTildes($staffPuesto);

    if(!$id){
    
      $MlStaff = $mStaff->create($staffArea,trim(strtoupper($name)),trim(strtoupper($apP)),trim(strtoupper($apM)),trim(strtolower($staffMail)),trim(strtoupper($puesto)));
    
    }else{
    
      $MlStaff = $mStaff->update($compareField,$staffArea,trim(strtoupper($name)),trim(strtoupper($apP)),trim(strtoupper($apM)),trim(strtolower($staffMail)),trim(strtoupper($puesto)),$id);
    }

    return $MlStaff;

  }

  

  // DELETE STAFF BY ID
  public function delete($id){

    $mStaff = new StaffModel();
    $MlStaff = $mStaff->delete($id);

    return $MlStaff;

  }
  
}
