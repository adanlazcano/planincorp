<?php
namespace App\Models;
defined("APPPATH") OR die("Access denied");

use \Core\DB;

class Inventory{

    public static function getAll($limit,$offset,$search){

        $where = " WHERE p.status=1 AND s.cantidad > 0";
        $where .= ($search!="")?" AND CONCAT(c.idCompra,' ',CONCAT(p.nombre,' ',p.marca),' ',IF(cat.nombre != '',cat.nombre,'SIN ASIGNAR'),' ',CONCAT(per.nombre,' ',per.apPaterno,' ',per.apMaterno),' ',per.puesto,' ',a.nombre,' ',DATE_FORMAT(c.updatedAt,'%d/%m/%Y')) LIKE '%$search%'":"";    
        
        $sql= "SELECT dc.cantidad, CONCAT(p.nombre,' ',p.marca) AS producto, 
        IF(cat.nombre != '',cat.nombre,'SIN ASIGNAR') AS categoria,
        CONCAT(per.nombre,' ',per.apPaterno,' ',per.apMaterno) AS responsable,per.puesto,
        a.nombre as area,DATE_FORMAT(c.updatedAt,'%d/%m/%Y') AS fecha 
        FROM  
        producto p
        LEFT JOIN 
        detalle_compra dc
        ON
        p.idproducto = dc.idproducto
        LEFT JOIN
        stock s
        ON
        p.idProducto = s.idProducto
        LEFT JOIN
        categoria cat
        ON
        p.idCategoria = cat.idCategoria
        LEFT JOIN 
        compra c 
        ON
        c.idCompra = dc.idCompra
        LEFT JOIN
        personal per
        ON
        per.idPersonal = c.idPersonal
        LEFT JOIN
        area a
        ON
        a.idArea = per.idArea
        $where
        ORDER BY
        c.updatedAt DESC";

        $general = DB::records($sql);
        $sql.=" LIMIT ".$offset.",".$limit;
        $filter =  DB::records($sql);

        return array("general"=>$general,"filter"=>$filter);

    }

}
