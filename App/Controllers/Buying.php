<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");

use \Core\Controller,
    \Core\View,
    \App\Logic\Buy as BuyLogic,
    \App\Logic\Staff as StaffLogic,
    \App\Logic\Provider as ProviderLogic,
    \App\Logic\Product as ProductLogic,
     
     \App\Logic\Exceptions;

class Buying extends Controller{


    public function __construct(){
    
    }

         //RENDER BUYING PAGE
         public function index (){

            $arJs = ['buying.js'];
        
            View::set('title','Compras');
            View::set("arJs",$arJs);

            View::render("buying");
        
        }

        //GET ALL PURCHASES AND DRAW PURCHASES TABLE
        public function getAll(){

            $limit = $_REQUEST["limit"];
            $offset = $_REQUEST["offset"];
            $search = (isset($_REQUEST["search"]))?$_REQUEST["search"]:"";
             
            $logic = new BuyLogic();
            $Buy = $logic->getAll($limit,$offset,$search);
    
            $rows = array();
    
            foreach($Buy["filter"] as $key => $value){
    
                    $rows[$key] = $value;
                    
            }
                
             $info = array('total'=>count($Buy["general"]),'rows'=>$rows);
             View::renderJson($info);
        }
               
        // GET STAFF LIST
        public function getStaff(){

            $logic = new StaffLogic();
            
            $staff = $logic->getAll(0,0,'');
            
            View::renderJson($staff["general"]);
        }

        // GET PROVIDERS LIST
        public function getProviders(){

            $logic = new ProviderLogic();
            
            $prov = $logic->getAll(0,0,'');
            
            View::renderJson($prov["general"]);
        }
        
        // GET PRODUCTS LIST
        public function getProducts(){

            $logic = new ProductLogic();
            
            $prod = $logic->getAll(0,0,'');
            
            View::renderJson($prod["general"]);
        }

        // CREATE QUICK PROVIDER
        public function createProvider(){

            $provider = $_POST["provider"];
            $logic = new BuyLogic();

            $prov = $logic->createProv($provider);

            View::renderJson($prov);
        }
       
        // CREATE QUICK PRODUCT
        public function createProduct(){

           $request = file_get_contents('php://input');
           $request = json_decode($request);

           $logic = new BuyLogic();

            $prov = $logic->createProduct($request);

            View::renderJson($prov);
        }

        // CREATE BUY
        public function createBuy(){

            $request = file_get_contents('php://input');
            $request = json_decode($request);

            $logic = new BuyLogic();

            $buy = $logic->createBuy($request);
            
            View::renderJson($buy);
        }

        // GET DETAILS
        public function getDetails(){

            $idCompra = $_GET["id"];

            $logic = new BuyLogic();

            $details = $logic->getDetails($idCompra);

            View::renderJson($details);
        }

        // CREATE DELIVERY
        public function createDelivery(){

            $logic = new BuyLogic();

            $delivery = $logic->createDelivery($_POST);

            View::renderJson($delivery);
        }

        //DELETE DETAIL
        public function deleteDetail(){

            $request = file_get_contents('php://input');
            $request = json_decode($request);

            $logic = new BuyLogic();

            $newStock = $logic->deleteDetail($request);

            View::renderJson($newStock);

        }

        //DELETE ALL BUY
        public function deleteAllBuy(){

            $logic = new BuyLogic();

            $logic->deleteAllBuy($_POST);

        }
}