<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");

use \Core\View,
    \App\Logic\Staff as StaffLogic,
    \App\Logic\Area as AreaLogic,
     \Core\Controller,
     \App\Logic\Exceptions;

class Staff extends Controller{


    public function __construct(){
    
    }
        //RENDER STAFF PAGE
        public function index (){

            $arJs = ['staff.js'];
        
            View::set('title','Personal');
            View::set("arJs",$arJs);

            View::render("staff");
        
        }

        //GET ALL STAFF AND DRAW STAFF TABLE
        public function getAll(){

            $limit = $_REQUEST["limit"];
            $offset = $_REQUEST["offset"];
            $search = (isset($_REQUEST["search"]))?$_REQUEST["search"]:"";
             
            $logic = new StaffLogic();
            $staff = $logic->getAll($limit,$offset,$search);
    
            $rows = array();
    
            foreach($staff["filter"] as $key => $value){
    
                    $rows[$key] = $value;
                    
            }
                
             $info = array('total'=>count($staff["general"]),'rows'=>$rows);
             View::renderJson($info);
        }

        // GET AREA LIST
        public function getArea(){

            $logic = new AreaLogic();

            $area = $logic->getAll(0,0,'');

            View::renderJson($area["general"]);
        }

        //CREATE & UPDATE STAFF
        public function create(){

            $logic= new StaffLogic();
            $request = file_get_contents('php://input');
            $request = json_decode($request);

            $res = $logic->create($request);
        
            View::renderJson($res);
        }

        // DELETE STAFF BY ID
        public function delete(){

            $logic = new StaffLogic();

            $res = $logic->delete($_POST["id"]);
        
            View::renderJson($res);
        }

}

