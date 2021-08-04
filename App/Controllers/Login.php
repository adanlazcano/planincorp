<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");

use \Core\View,
     \Core\Controller,
     \App\Logic\Exceptions;

class Login extends Controller{


    public function __construct(){
    
    }

        public function index (){

            session_start();
            $_SESSION["new"] = "start";
            header("Location: ./home");
        
        }
}
      