<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");

use \Core\View,
    \App\Logic\Provider as ProviderLogic,
     \Core\Controller,
     \App\Logic\Exceptions;

class Provider extends Controller{


    public function __construct(){
    
    }

             //RENDER Provider PAGE
             public function index (){

                $arJs = ['provider.js'];
            
                View::set('title','Proveedores');
                View::set("arJs",$arJs);
    
                View::render("provider");
            
            }
    
            //GET ALL Providers AND DRAW Providers TABLE
            public function getAll(){
    
                $limit = $_REQUEST["limit"];
                $offset = $_REQUEST["offset"];
                $search = (isset($_REQUEST["search"]))?$_REQUEST["search"]:"";
                 
                $logic = new ProviderLogic();
                $provider = $logic->getAll($limit,$offset,$search);
        
                $rows = array();
        
                foreach($provider["filter"] as $key => $value){
        
                        $rows[$key] = $value;
                        
                }
                    
                 $info = array('total'=>count($provider["general"]),'rows'=>$rows);
                 View::renderJson($info);
            }
    
            //CREATE & UPDATE provider
            public function create(){
    
                $logic= new ProviderLogic();
                $request = file_get_contents('php://input');
                $request = json_decode($request);
    
                $res = $logic->create($request);
            
                View::renderJson($res);
            }
    
            // DELETE Provider BY ID
            public function delete(){
    
                $logic = new ProviderLogic();
    
                $res = $logic->delete($_POST["id"]);
            
                View::renderJson($res);
            }
    }
