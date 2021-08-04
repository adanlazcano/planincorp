<?php
namespace App\Models;
defined("APPPATH") OR die("Access denied");

use \Core\DB;

class Area{

        // GET ALL AREAS QUERY WITH FILTER FOR SEARCH
        public static function getAll($limit,$offset,$search){
           
            $where = " WHERE a.status=1";
            $where .= ($search!="")?" AND CONCAT(a.idArea,' ',a.nombre,' ',DATE_FORMAT(a.updatedAt, '%d/%m/%Y')) LIKE '%$search%'":"";
                
            $sql = "SELECT a.idArea AS areaId,a.nombre AS areaNombre,DATE_FORMAT(a.updatedAt, '%d/%m/%Y') as createdAt
            FROM area AS a
            $where
            ORDER BY a.updatedAt DESC";

                $general = DB::records($sql);
                $sql.=" LIMIT ".$offset.",".$limit;
                $filter =  DB::records($sql);
            
            return array("general"=>$general,"filter"=>$filter);	
        }

        // COMPARE AREA NAME IF THE NAME IS AVAILABLE TO CREATE AREA
        public function compare($name){

            $sql = "SELECT a.nombre FROM area a WHERE a.nombre='$name' AND a.status=1";
    
            return DB::singleRecord($sql);
        }

        // CREATE AREA
        public function create($area){

             $response = array("message"=>"<i class='fas fa-exclamation-triangle'></i><b> $area </b> ya se encuentra registrado(a).","status"=>false);
    
             $res = $this->compare($area);
    
            if(!$res){
   
                $sql="INSERT INTO area (nombre) VALUES ('$area')";
    
                DB::query($sql);
    
                $response["message"] = "<i class='fas fa-check-circle'></i><b> $area </b> registrado(a) al sistema exitosamente.";
                $response["status"] = true;
            }
    
            return $response;
        }
        
        //UPDATE AREA
        public function update($area,$compareField,$id){
    
            $field='';
            $res='';
            
            $response = array("message"=>"<i class='fas fa-exclamation-triangle'></i><b> $area </b> ya existe en el sistema.","status"=>false);
               
            $res = $compareField!= $area?$this->compare($area):'';
            
            if(!$res){
    
                $response["message"] = "<i class='fas fa-check-circle'></i><b> $area </b> actualizado(a) exitosamente.";
                $response["status"] = true;
                $field= "nombre='$area',";
            }
       
              $sql="UPDATE area SET $field updatedAt=CURRENT_TIMESTAMP WHERE idArea=$id";
    
             DB::query($sql);
         
             return $response;
        }
        
        //DELETE AREA BY ID
        public function delete($id){
          
            $response=array("message"=>'',"status"=>false);
    
            $sql="UPDATE area SET status=0, updatedAt=CURRENT_TIMESTAMP WHERE idArea=$id";
            $res = DB::query($sql);
    
            if($res){
    
                $response["message"]='eliminado(a) con éxito';
                $response["status"]=true;
            }
    
            return $response;
        }
}
