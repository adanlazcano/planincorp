<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");

use \Core\View,
    \App\Logic\Inventory as InventoryLogic,
     \Core\Controller,
     \App\Logic\Exceptions;

class Inventory extends Controller{


    public function __construct(){

    }

       // RENDER INVENTORY PAGE
        public function index(){
        
            $arJs = ['inventory.js'];
            
            View::Set('title',"Inventario");
            View::set("arJs",$arJs);
            
            View::render("inventory");
        }

        //GET ALL Inventory AND DRAW Inventory TABLE
        public function getAll(){
            
            $limit = $_REQUEST["limit"];
            $offset = $_REQUEST["offset"];
            $search = (isset($_REQUEST["search"]))?$_REQUEST["search"]:"";
            
            $logic = new InventoryLogic();
            $inventory = $logic->getAll($limit,$offset,$search);

            $rows = array();

            foreach($inventory["filter"] as $key => $value){

                    $rows[$key] = $value;
                    
            }
                
            $info = array('total'=>count($inventory["general"]),'rows'=>$rows);
            View::renderJson($info);
        }

        // GET DATA TO EXPORT
         public function getAllData(){
               
            $logic = new InventoryLogic();
        
            $information = $logic->getAll(0,0,'');
        
            View::renderJson($information["general"]);
        }

}
