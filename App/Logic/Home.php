<?php
namespace App\Logic;
defined("APPPATH") OR die("Access denied");
 use \App\Models\Home as HomeModel;

class Home{
  
  public function __construct(){
   
  }

      // GET ALL INFORMATION TO DRAW HOME
      public function getAllInformation(){
               
        $mInventory  = new HomeModel();
    
        $MlInventory  = $mInventory->getAllInformation();
     
        return $MlInventory;
    
      }
  
}
