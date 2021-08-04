<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");

use \Core\View,
     \Core\Controller,
     \App\Logic\Exceptions;

class Destroy extends Controller{


    public function __construct(){
    
    }

        public function index (){

            session_start();
            session_destroy();
             header("Location: ../");
        }


       
}
      