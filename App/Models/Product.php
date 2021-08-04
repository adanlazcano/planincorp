<?php
namespace App\Models;
defined("APPPATH") OR die("Access denied");

use \Core\DB;

class Product{

    // GET ALL PRODUCTS QUERY WITH FILTER FOR SEARCH
    public static function getAll($limit,$offset,$search){
    
        $where = " WHERE prod.status=1";    
        $where .= ($search!="")?" AND CONCAT(prod.idProducto,prod.nombre,prod.marca,prod.precio,IF(cat.status=1,cat.nombre,'SIN ASIGNAR'),DATE_FORMAT(prod.updatedAt, '%d/%m/%Y')) LIKE '%$search%'":"";
            
        $sql = "SELECT prod.idProducto AS prodId, prod.nombre AS prodNombre, prod.marca AS prodMarca, prod.precio AS prodPrecio,
        DATE_FORMAT(prod.updatedAt,'%d/%m/%Y') AS createdAt,cat.idCategoria AS prodCat,IF(cat.status=1,cat.nombre,'SIN ASIGNAR') AS catNombre,s.cantidad AS prodStock
        FROM 
        producto prod
        LEFT JOIN
        categoria cat
        ON
        prod.idCategoria = cat.idCategoria
        LEFT JOIN
        stock s
        ON
        prod.idProducto = s.idProducto
        $where
        ORDER BY 
        prod.updatedAt DESC";

            $general = DB::records($sql);
            $sql.=" LIMIT ".$offset.",".$limit;
            $filter =  DB::records($sql);
        
        return array("general"=>$general,"filter"=>$filter);	
    }

     // COMPARE PRODUCT NAME IF THE NAME IS AVAILABLE TO CREATE PRODUCT
     public function compare($name){

        $sql = "SELECT prod.idProducto,prod.nombre,prod.precio FROM producto prod WHERE CONCAT(prod.nombre,' ',prod.marca)='$name' AND prod.status=1";

         return DB::singleRecord($sql);
    }

    // CREATE PRODUCT
    public function create($prodNombre,$prodMarca,$prodPrecio,$prodCat){

        $response = array("message"=>"<i class='fas fa-exclamation-triangle'></i><b> $prodNombre $prodMarca </b>ya se encuentra registrado(a).","status"=>false,"field"=>"$prodNombre $prodMarca");

         $res = $this->compare("$prodNombre $prodMarca");

         $res?$response["id"] = $res["idProducto"]:"";
         $res?$response["precio"] = $res["precio"]:"";

        if(!$res){

            $sql="INSERT INTO producto (nombre,marca,precio,idCategoria) VALUES ('$prodNombre','$prodMarca',$prodPrecio,'$prodCat')";

             $id = DB::insertId($sql);

             $sqlStock="INSERT INTO stock (idProducto) VALUES ($id)";
             
             DB::query($sqlStock);

          
            $response["message"] = "<i class='fas fa-check-circle'></i><b> $prodNombre $prodMarca </b> registrado(a) al sistema exitosamente.";
            $response["status"] = true;
            $response["id"] = $id;
            $response["price"] = $prodPrecio;
        }

        return $response;
    }
    
    //UPDATE PRODUCT
    public function update($compareField,$prodNombre,$prodMarca,$prodPrecio,$prodCat,$id){
       
        $field='';
        $res='';
        
        $response = array("message"=>"<i class='fas fa-exclamation-triangle'></i><b> $prodNombre $prodMarca  </b> ya existe en el sistema.","status"=>false);
           
        $res = $compareField!= "$prodNombre $prodMarca"?$this->compare("$prodNombre $prodMarca"):'';
        
        if(!$res){

            $response["message"] = "<i class='fas fa-check-circle'></i><b> $prodNombre $prodMarca </b> actualizado(a) exitosamente.";
            $response["status"] = true;
            $field= "nombre='$prodNombre',marca='$prodMarca',";
        }
   
          $sql="UPDATE producto SET $field precio=$prodPrecio,idCategoria='$prodCat', updatedAt=CURRENT_TIMESTAMP WHERE idProducto=$id";
       
          DB::query($sql);
     
          return $response;
    }
    
    //DELETE PRODUCT BY ID
    public function delete($id){
      
        $response=array("message"=>'',"status"=>false);

        $sql="UPDATE producto SET status=0, updatedAt=CURRENT_TIMESTAMP WHERE idProducto=$id";
        $res = DB::query($sql);
        
        $sqlStock="UPDATE stock SET cantidad=0, updatedAt=CURRENT_TIMESTAMP WHERE idProducto=$id";
        $res = DB::query($sqlStock);
        
        $sqlMov="INSERT INTO movimiento (idProducto,tipo) VALUES ($id,'BAJA')";
        $res = DB::query($sqlMov);

        if($res){

            $response["message"]='eliminado(a) con éxito';
            $response["status"]=true;
        }

        return $response;
    }

}
