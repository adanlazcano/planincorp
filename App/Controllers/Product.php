<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");

use \Core\View,
    \App\Logic\Product as ProductLogic,
    \App\Logic\Category as CategoryLogic,
     \Core\Controller,
     \App\Logic\Exceptions;

class Product extends Controller{


    public function __construct(){
    
    }
        // RENDER PRODUCT PAGE
        public function index (){

            $arJs = ['product.js'];
        
            View::set('title','Productos');
            View::set("arJs",$arJs);

            View::render("product");
        
        }

         //GET ALL Products AND DRAW Products TABLE
         public function getAll(){
    
            $limit = $_REQUEST["limit"];
            $offset = $_REQUEST["offset"];
            $search = (isset($_REQUEST["search"]))?$_REQUEST["search"]:"";
             
            $logic = new ProductLogic();
            $Product = $logic->getAll($limit,$offset,$search);
    
            $rows = array();
    
            foreach($Product["filter"] as $key => $value){
    
                    $rows[$key] = $value;
                    
            }
                
             $info = array('total'=>count($Product["general"]),'rows'=>$rows);
             View::renderJson($info);
        }

        // GET AREA LIST
        public function getCategories(){
               
                $logic = new CategoryLogic();
    
                $category = $logic->getAll(0,0,'');
        
                View::renderJson($category["general"]);
        }

        //CREATE & UPDATE Product
        public function create(){

            $logic= new ProductLogic();
            $request = file_get_contents('php://input');
            $request = json_decode($request);

            $res=$logic->create($request);
           
            View::renderJson($res);
        }

        // DELETE Product BY ID
        public function delete(){

            $logic = new ProductLogic();

            $res = $logic->delete($_POST["id"]);
        
            View::renderJson($res);
        }
}


