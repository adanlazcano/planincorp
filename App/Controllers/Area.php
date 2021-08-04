<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");

use \Core\View,
    \App\Logic\Area as AreaLogic,
     \Core\Controller,
     \App\Logic\Exceptions;

class Area extends Controller{


    public function __construct(){
    
    }

         //RENDER AREA PAGE
         public function index (){

            $arJs = ['area.js'];
        
            View::set('title','Áreas');
            View::set("arJs",$arJs);

            View::render("area");
        
        }

        //GET ALL AREAS AND DRAW AREA TABLE
        public function getAll(){

            $limit = $_REQUEST["limit"];
            $offset = $_REQUEST["offset"];
            $search = (isset($_REQUEST["search"]))?$_REQUEST["search"]:"";
             
            $logic = new AreaLogic();
            $area = $logic->getAll($limit,$offset,$search);
    
            $rows = array();
    
            foreach($area["filter"] as $key => $value){
    
                    $rows[$key] = $value;
                    
            }
                
             $info = array('total'=>count($area["general"]),'rows'=>$rows);
             View::renderJson($info);
        }

        //CREATE & UPDATE AREA
        public function create(){

            $logic= new AreaLogic();
            $request = file_get_contents('php://input');
            $request = json_decode($request);

             $res = $logic->create($request);
        
            View::renderJson($res);
        }

        // DELETE Area BY ID
        public function delete(){

            $logic = new AreaLogic();

            $res = $logic->delete($_POST["id"]);
        
            View::renderJson($res);
        }
}

