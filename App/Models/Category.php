<?php
namespace App\Models;
defined("APPPATH") OR die("Access denied");

use \Core\DB;

class Category{

    // GET ALL CATEGORIES QUERY WITH FILTER FOR SEARCH
    public static function getAll($limit,$offset,$search){
    
        $where = " WHERE cat.status=1";
        $where .= ($search!="")?" AND CONCAT(cat.idCategoria,' ',cat.nombre,' ',DATE_FORMAT(cat.updatedAt, '%d/%m/%Y')) LIKE '%$search%'":"";
            
        $sql = "SELECT cat.idCategoria AS catId,cat.nombre AS catNombre,DATE_FORMAT(cat.updatedAt, '%d/%m/%Y') as createdAt
        FROM categoria AS cat
        $where
        ORDER BY cat.updatedAt DESC";

            $general = DB::records($sql);
            $sql.=" LIMIT ".$offset.",".$limit;
            $filter =  DB::records($sql);
        
        return array("general"=>$general,"filter"=>$filter);	
    }

    // COMPARE CATEGORY NAME IF THE NAME IS AVAILABLE TO CREATE CATEGORY
    public function compare($name){

        $sql = "SELECT cat.nombre FROM categoria cat WHERE cat.nombre='$name' AND cat.status=1";

        return DB::singleRecord($sql);
    }

    // CREATE CATEGORY
    public function create($catNombre){

                     
        $response = array("message"=>"<i class='fas fa-exclamation-triangle'></i><b> $catNombre </b>ya se encuentra registrado(a).","status"=>false);

         $res = $this->compare($catNombre);

        if(!$res){


            $sql="INSERT INTO categoria (nombre) VALUES ('$catNombre')";

            DB::query($sql);

            $response["message"] = "<i class='fas fa-check-circle'></i><b> $catNombre </b> registrado(a) al sistema exitosamente.";
            $response["status"] = true;
        }

        return $response;
    }
    
    //UPDATE CATEGORY
    public function update($catNombre,$compareField,$id){

        $field='';
        $res='';
        
        $response = array("message"=>"<i class='fas fa-exclamation-triangle'></i><b> $catNombre </b> ya existe en el sistema.","status"=>false);
           
        $res = $compareField!= $catNombre?$this->compare($catNombre):'';
        
        if(!$res){

            $response["message"] = "<i class='fas fa-check-circle'></i><b> $catNombre </b> actualizado(a) exitosamente.";
            $response["status"] = true;
            $field= "nombre='$catNombre',";
        }
   
          $sql="UPDATE categoria SET $field updatedAt=CURRENT_TIMESTAMP WHERE idCategoria=$id";

         DB::query($sql);
     
         return $response;
    }
    
    //DELETE CATEGORY BY ID
    public function delete($id){
      
        $response=array("message"=>'',"status"=>false);

        $sql="UPDATE categoria SET status=0, updatedAt=CURRENT_TIMESTAMP WHERE idCategoria=$id";
        $res = DB::query($sql);

        if($res){

            $response["message"]='eliminado(a) con éxito';
            $response["status"]=true;
        }

        return $response;
    }

}
