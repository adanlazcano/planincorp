<?php
namespace App\Models;
defined("APPPATH") OR die("Access denied");

use \Core\DB;

class Staff{

    // GET ALL STAFF QUERY WITH FILTER FOR SEARCH
    public static function getAll($limit,$offset,$search){
    
        $where=" WHERE per.status=1";
        $where .= ($search!="")?" AND CONCAT(per.idPersonal,CONCAT(per.nombre,' ',per.apPaterno,' ',apMaterno),per.mail,IF(a.status=1,a.nombre,'AREA DADA DE BAJA'),per.puesto,DATE_FORMAT(per.updatedAt, '%d/%m/%Y')) LIKE '%$search%'":"";
            
        $sql = "SELECT per.idPersonal AS staffId,a.idArea AS staffArea,CONCAT(per.nombre,' ',per.apPaterno,' ',apMaterno) AS nombreCompleto, per.nombre AS staffNombre, per.apPaterno AS staffApPaterno, per.apMaterno AS staffApMaterno,per.mail AS staffMail, IF(a.status=1,a.nombre,'AREA DADA DE BAJA') AS nombreArea,per.puesto AS staffPuesto,DATE_FORMAT(per.updatedAt, '%d/%m/%Y') as createdAt 
        FROM
        personal per LEFT JOIN area a
        ON
        per.idArea = a.idArea
        $where
        ORDER BY per.updatedAt DESC";

            $general = DB::records($sql);
            $sql.=" LIMIT ".$offset.",".$limit;
            $filter =  DB::records($sql);
        
        return array("general"=>$general,"filter"=>$filter);	
    }

    // COMPARE STAFF EMAIL IF THE EMAIL IS AVAILABLE TO CREATE STAFF
    public function compare($mail){

        $sql = "SELECT per.mail FROM personal per WHERE per.mail='".trim($mail)."' AND per.status=1";

        return DB::singleRecord($sql);
    }

    // CREATE STAFF
    public function create($staffArea,$staffNombre,$staffApPaterno,$staffApMaterno,$staffMail,$staffPuesto){

        $response = array("message"=>"<i class='fas fa-exclamation-triangle'></i><b> $staffMail </b> ya se encuentra registrado(a).","status"=>false);

        $res = $this->compare($staffMail);

        if(!$res){

            $sql="INSERT INTO personal (idArea,nombre,apPaterno,apMaterno,mail,puesto) VALUES ('$staffArea','$staffNombre','$staffApPaterno','$staffApMaterno','$staffMail','$staffPuesto')";

            DB::query($sql);

            $response["message"] = "<i class='fas fa-check-circle'></i><b> $staffMail </b> registrado(a) al sistema exitosamente.";
            $response["status"] = true;
        }

        return $response;
    }
    
    //UPDATE STAFF
    public function update($compareField,$staffArea,$staffNombre,$staffApPaterno,$staffApMaterno,$staffMail,$staffPuesto,$id){

        $field='';
        $res='';
        
        $response = array("message"=>"<i class='fas fa-exclamation-triangle'></i><b> $staffMail </b> ya existe en el sistema.","status"=>false);
           
        $res = $compareField!= $staffMail?$this->compare($staffMail):'';
        
        if(!$res){

            $response["message"] = "<i class='fas fa-check-circle'></i><b> $staffMail </b> actualizado(a) exitosamente.";
            $response["status"] = true;
            $field= "mail='$staffMail',";
        }
   
        $sql="UPDATE personal SET idArea=$staffArea, nombre='$staffNombre', apPaterno='$staffApPaterno', apMaterno='$staffApMaterno',$field puesto='$staffPuesto',updatedAt=CURRENT_TIMESTAMP WHERE idPersonal=$id";

         DB::query($sql);
     
         return $response;
    }
    
    //DELETE STAFF BY ID
    public function delete($id){
      
        $response=array("message"=>'',"status"=>false);

        $sql="UPDATE personal SET status=0, updatedAt=CURRENT_TIMESTAMP WHERE idPersonal=$id";
        $res = DB::query($sql);

        if($res){

            $response["message"]='eliminado(a) con éxito';
            $response["status"]=true;
        }

        return $response;
    }

}
