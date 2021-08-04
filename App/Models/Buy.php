<?php
namespace App\Models;
defined("APPPATH") OR die("Access denied");

use \Core\DB;
    
class Buy{

        // GET ALL PURCHASES QUERY WITH FILTER FOR SEARCH
        public static function getAll($limit,$offset,$search){
           
          
            $where = ($search!="")?" WHERE CONCAT(c.idCompra,' ',CONCAT(per.nombre,' ',per.apPaterno,' ',per.apMaterno),' ',a.nombre,' ',c.total,' ',c.tipoPago,' ',prov.nombre,' ',DATE_FORMAT(c.updatedAt, '%d/%m/%Y'),' ',c.status) LIKE '%$search%'":"";
                
            $sql = "SELECT 
            c.idCompra AS buyId, c.idProveedor AS buyIdProv ,prov.nombre AS buyNomProv,
            c.idPersonal AS buyIdPersonal,CONCAT(per.nombre,' ',per.apPaterno,' ',per.apMaterno) AS buyNomStaff,a.nombre AS buyArea,c.unidades AS buyUnits,c.total AS buyTotal,
            c.tipoPago AS buyPayType,c.status AS buyStatus,DATE_FORMAT(c.updatedAt, '%d/%m/%Y') AS createdAt
            FROM 
            compra c
            LEFT JOIN
            proveedor prov
            ON
            c.idProveedor = prov.idProveedor
            LEFT JOIN
            personal per
            ON
            c.idPersonal = per.idPersonal
            LEFT JOIN
            area a
            ON
            per.idArea = a.idArea  
            $where
            ORDER BY c.updatedAt DESC";

           

                $general = DB::records($sql);
                $sql.=" LIMIT ".$offset.",".$limit;
                $filter =  DB::records($sql);
            
            return array("general"=>$general,"filter"=>$filter);	
        }

        //SAVE BUY,MOVEMENT & UPDATE STOCK
        public function createBuy($request){

            extract(get_object_vars($request));
          
            $sqlBuy="INSERT INTO compra (idPersonal,idProveedor,unidades,total,tipoPago) VALUES ($idPersonal,$idProveedor,$totalUnit,$total,'$tipoPago')";

            $idCompra = DB::insertId($sqlBuy);

            foreach($productos as $value){

                extract(get_object_vars($value));

                $valueDetails[] = "($idCompra,$id,$unit,$price,$total)";

                $addstock = $unit + $stock; 

                $valueStock[] = "WHEN $id THEN $addstock";

                $valueId[] = $id;
                            
            }

            $sqlDetail="INSERT INTO detalle_compra (idCompra,idProducto,cantidad,precio,importe) VALUES ".implode(',',$valueDetails)."";

           

            $sqlStock="UPDATE stock SET cantidad = (CASE idProducto ".implode(' ',$valueStock)." END) WHERE idProducto IN(".implode(',',$valueId).")";
           
            DB::query($sqlDetail);
            DB::query($sqlStock);


            return array("message"=>"Compra # <b> $idCompra </b> realizada satisfactoriamente.","status"=>true);

        }

        //GET DETAIL LIST
        public function getDetails($idCompra){

            $sql="SELECT 
            dc.idDetalleCompra AS id, dc.idCompra ,p.idProducto,dc.cantidad AS detailUnit,CONCAT(p.nombre,' ',p.marca) AS detailProduct,dc.precio AS detailPrice ,dc.importe AS detailTotal, s.idStock, s.cantidad AS stock
            FROM 
            detalle_compra dc
            LEFT JOIN
            producto p
            ON
            dc.idProducto = p.idProducto
            LEFT JOIN
            stock s
            ON 
            s.idProducto = p.idProducto
            WHERE
            dc.idCompra = $idCompra";

            return DB::records($sql);

        }

        // SAVE DELIVERY & UPDATE PURCHASE STATUS
        public function createDelivery($id,$nameStaff){

            $sqlBuy = "UPDATE compra SET status='E',updatedAt = CURRENT_TIMESTAMP WHERE idCompra =$id";

            DB::query($sqlBuy);

            return array("message"=>"Compra # <b> $id </b> entregada a <b> $nameStaff </b>","status"=>0);
        }

        //DELETE DETAIL
         public function deleteDetail($request){

             extract(get_object_vars($request));

           
            $sqlBuy = "UPDATE compra SET unidades=$totalProd, total=$allTotal, updatedAt = CURRENT_TIMESTAMP WHERE idCompra=$idCompra";

            
            $sqlDetail="UPDATE detalle_compra SET cantidad=$unit, importe=$total WHERE idDetalleCompra=$id";
            
            
            $minStock = $stock - 1;
            
            $sqlStock="UPDATE stock SET cantidad=$minStock WHERE idStock=$idStock";
            
            
            DB::query($sqlBuy);
            DB::query($sqlDetail);
            DB::query($sqlStock);

            if($unit==0){

                $sqlDelete = "DELETE FROM detalle_compra WHERE idDetalleCompra=$id";

                DB::query($sqlDelete);
               
            }

            if($totalProd==0){
                $sqlBuy = "DELETE FROM compra WHERE idCompra=$idCompra";

                DB::query($sqlBuy);
            }
                return $minStock;
        }

          //DELETE ALL BUY
         public function deleteAllBuy($id,$idDetail,$stockProduct,$productId){

            $sqlDelete = "DELETE FROM detalle_compra WHERE idDetalleCompra IN $idDetail";

            DB::query($sqlDelete);

            $sqlBuy = "DELETE FROM compra WHERE idCompra=$id";

            DB::query($sqlBuy);

            $sqlStock="UPDATE stock SET cantidad =(CASE idProducto $stockProduct END) WHERE idProducto IN ($productId)";

             DB::query($sqlStock);

         }
}
