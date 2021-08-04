<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");

use \Core\View,
    \App\Logic\Home as HomeLogic,
     \Core\Controller,
     \App\Logic\Excepciones;

class Home extends Controller{


    public function __construct(){

    
    }
   
        public function index (){

            $arJs = ['home.js'];

            View::set('title','Bienvenid@');
            View::set('arJs',$arJs);

            View::render("home");
        
    }

    // GET ALL INFORMATION TO DRAW HOME
    public function getAllInformation(){
               
        $logic = new HomeLogic();
        
        $allInformation = $logic->getAllInformation();
            
        View::renderJson($allInformation);
    }

}

