<?php
namespace App\Models;
defined("APPPATH") OR die("Access denied");

use \Core\DB;

class Home{

    
    // GET SQL COMBOS TO DRAW HOME
    public function getAllInformation(){

        $sqlTotal = "SELECT SUM(c.total) AS total FROM compra c";

        $sqlTotalProv = "SELECT (SELECT COUNT(p.idProveedor) AS proveedor FROM proveedor p) AS total UNION ALL (SELECT COUNT(prod.idProducto) AS producto FROM producto prod)";

        $sqlMaxBuy="SELECT s.idProducto,CONCAT(p.nombre,' ',p.marca) AS producto,s.cantidad AS cant
        FROM 
        producto p
        LEFT JOIN
        stock s
        ON
        p.idProducto = s.idProducto
        WHERE
        s.cantidad > 0
        ORDER BY s.cantidad DESC
        LIMIT 4";

        $sqlMaxStaff = "SELECT c.idPersonal,CONCAT(p.nombre,' ',p.apPaterno,' ',p.apMaterno) AS nombre,COUNT(c.idPersonal) AS cont 
        FROM compra c
        LEFT JOIN
        personal p
        ON
        c.idPersonal = p.idPersonal
        GROUP BY c.idPersonal
        ORDER BY COUNT(c.idPersonal) DESC
        LIMIT 4";
    
        return array("totalBuy"=>DB::singleRecord($sqlTotal),"totalProvd"=>DB::records($sqlTotalProv),"maxBuy"=>DB::records($sqlMaxBuy),"maxStaff"=>DB::records($sqlMaxStaff));
    }


}
