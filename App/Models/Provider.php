<?php
namespace App\Models;
defined("APPPATH") OR die("Access denied");

use \Core\DB;

class Provider{

    // GET ALL PROVIDERS QUERY WITH FILTER FOR SEARCH
    public static function getAll($limit,$offset,$search){
    
        $where = " WHERE prov.status=1";
        $where .= ($search!="")?" AND CONCAT(prov.idProveedor,prov.nombre,prov.descripcion,prov.direccion,prov.telefono,DATE_FORMAT(prov.updatedAt, '%d/%m/%Y')) LIKE '%$search%'":"";
            
        $sql = "SELECT prov.idProveedor AS provId,prov.nombre AS provNombre,prov.descripcion AS provDescripcion,prov.direccion as provDireccion,prov.telefono AS provTelefono,DATE_FORMAT(prov.updatedAt, '%d/%m/%Y') as createdAt
        FROM proveedor AS prov
        $where
        ORDER BY prov.updatedAt DESC";

            $general = DB::records($sql);
            $sql.=" LIMIT ".$offset.",".$limit;
            $filter =  DB::records($sql);
        
        return array("general"=>$general,"filter"=>$filter);	
    }

    // COMPARE PROVIDER NAME IF THE NAME IS AVAILABLE TO CREATE PROVIDER
    public function compare($name){

        $sql = "SELECT prov.idProveedor,prov.nombre FROM proveedor prov WHERE prov.nombre='$name' AND prov.status=1";

        return DB::singleRecord($sql);
    }

    // CREATE PROVIDER
    public function create($provNombre,$provDescripcion,$provDireccion,$provTelefono){

        $response = array("message"=>"<i class='fas fa-exclamation-triangle'></i><b> $provNombre </b>ya se encuentra registrado(a).","status"=>false,"field"=>$provNombre);

         $res = $this->compare($provNombre);

         $res?$response["id"]= $res["idProveedor"]:"";

        if(!$res){

            $sql="INSERT INTO proveedor (nombre,descripcion,direccion,telefono) VALUES ('$provNombre','$provDescripcion','$provDireccion','$provTelefono')";

             $id = DB::insertId($sql);

            $response["message"] = "<i class='fas fa-check-circle'></i><b> $provNombre </b> registrado(a) al sistema exitosamente.";
            $response["status"] = true;
            $response["id"] = $id;
        }

        return $response;
    }
    
    //UPDATE PROVIDER
    public function update($compareField,$provNombre,$provDescripcion,$provDireccion,$provTelefono,$id){

        $field='';
        $res='';
        
        $response = array("message"=>"<i class='fas fa-exclamation-triangle'></i><b> $provNombre </b> ya existe en el sistema.","status"=>false);
           
        $res = $compareField!= $provNombre?$this->compare($provNombre):"";
        
        if(!$res){

            $response["message"] = "<i class='fas fa-check-circle'></i><b> $provNombre </b> actualizado(a) exitosamente.";
            $response["status"] = true;
            $field= "nombre='$provNombre',";
        }
   
          $sql="UPDATE proveedor SET $field descripcion='$provDescripcion',direccion='$provDireccion',telefono='$provTelefono', updatedAt=CURRENT_TIMESTAMP WHERE idProveedor=$id";
       
          DB::query($sql);
     
          return $response;
    }
    
    //DELETE PROVIDER BY ID
    public function delete($id){
      
        $response=array("message"=>'',"status"=>false);

        $sql="UPDATE proveedor SET status=0, updatedAt=CURRENT_TIMESTAMP WHERE idProveedor=$id";
        $res = DB::query($sql);

        if($res){

            $response["message"]='eliminado(a) con éxito';
            $response["status"]=true;
        }

        return $response;
    }

}
