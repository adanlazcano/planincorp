<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");

use \Core\View,
    \App\Logic\Category as CategoryLogic,
     \Core\Controller,
     \App\Logic\Exceptions;

class Category extends Controller{


    public function __construct(){
    
    }

             //RENDER CATEGORY PAGE
             public function index (){

                $arJs = ['category.js'];
            
                View::set('title','Categorías');
                View::set("arJs",$arJs);
    
                View::render("category");
            
            }
    
            //GET ALL category AND DRAW category TABLE
            public function getAll(){
    
                $limit = $_REQUEST["limit"];
                $offset = $_REQUEST["offset"];
                $search = (isset($_REQUEST["search"]))?$_REQUEST["search"]:"";
                 
                $logic = new CategoryLogic();
                $category = $logic->getAll($limit,$offset,$search);
        
                $rows = array();
        
                foreach($category["filter"] as $key => $value){
        
                        $rows[$key] = $value;
                }
                    
                 $info = array('total'=>count($category["general"]),'rows'=>$rows);
                 View::renderJson($info);
            }
    
            //CREATE & UPDATE category
            public function create(){
    
                $logic= new CategoryLogic();
                $request = file_get_contents('php://input');
                $request = json_decode($request);
    
                $res = $logic->create($request);
            
                View::renderJson($res);
            }
    
            // DELETE Category BY ID
            public function delete(){
    
                $logic = new CategoryLogic();
    
                $res = $logic->delete($_POST["id"]);
            
                View::renderJson($res);
            }
    }
