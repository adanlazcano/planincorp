<?php
namespace App\Logic;
defined("APPPATH") OR die("Access denied");
use \App\Models\Inventory as InventoryModel;

class Inventory{
  
  public function __construct(){
   
  }

    //GET ALL Inventory AND DRAW Inventory TABLE
    public function getAll($limit,$offset,$search){

      $mInventory = new InventoryModel();

      $MlInventory = $mInventory->getAll($limit,$offset,$search);

      return $MlInventory;

    }


}
