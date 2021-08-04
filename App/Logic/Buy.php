<?php
namespace App\Logic;
defined("APPPATH") OR die("Access denied");
use \App\Functions\Functions as Fun,
    \App\Models\Provider as ProviderModel,
    \App\Models\Product as ProductModel,  
    \App\Models\Buy as BuyModel;

class Buy{
  
  public function __construct(){
   
  }

    //GET ALL PURCHASES AND DRAW PURCHASES TABLE
    public function getAll($limit,$offset,$search){

      $mBuy = new BuyModel();

      $MlBuy = $mBuy->getAll($limit,$offset,$search);

      return $MlBuy;

    }

    // CREATE QUICK PROVIDER
    public function createProv($provider){
      
      $fFun = new Fun();
      $mProvider = new ProviderModel();

      $prov = $fFun->removeTildes($provider);

      $prov = trim(strtoupper($prov));
      
      $MlBuy = $mProvider->create($prov,'','','');

      return $MlBuy;

    }

    // CREATE QUICK PROVIDER
    public function createProduct($request){

      extract(get_object_vars($request));

      $fFun = new Fun();
      $mProduct = new ProductModel();

      $name = $fFun->removeTildes($modalBuyNewName);
      $brand = $fFun->removeTildes($modalBuyNewMarca);
    
      $name = trim(strtoupper($name));
      $brand = trim(strtoupper($brand));
      
      $MlBuy = $mProduct->create($name,$brand,$modalBuyNewPrecio,0);

      return $MlBuy;

    }

    //CREATE BUY
    public function createBuy($request){

      $mBuy = new BuyModel();
      $MlBuy = $mBuy->createBuy($request);

      return $MlBuy;
    }

    //GET DETAILS
    public function getDetails($idCompra){

      $mBuy = new BuyModel();
      $MlBuy = $mBuy->getDetails($idCompra);

      return $MlBuy;

    }

    // CREATE DELIVERY
    public function createDelivery($request){

      $id = $_POST["id"];
      $nameStaff = $_POST["nameStaff"];
      
      $mBuy = new BuyModel();
      $mLBuy = $mBuy->createDelivery($id,$nameStaff);

      return $mLBuy;
    }

    //DELETE DETAIL
    public function deleteDetail($request){

      $mBuy = new BuyModel();

      $mLBuy = $mBuy->deleteDetail($request);

      return $mLBuy;

    }

    //DELETE ALL BUY
    public function deleteAllBuy($request){

      $id = $request["idCompra"];
      $idDetail = $request["detailId"];
      $stockProduct = $request["stockProduct"];
      $productId = $request["productId"];

      $mBuy = new BuyModel();

      $mBuy->deleteAllBuy($id,$idDetail,$stockProduct,$productId);

    }

}