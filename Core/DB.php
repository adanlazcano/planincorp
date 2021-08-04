<?php
namespace Core;
defined("APPPATH") OR die("Access denied");

use \Core\App;
   

/**
 * @class Database
 */
class DB
{
    
    private static function defineConexion(){
        
        include APPPATH . '/Config/Config.php';

        $connection = new \mysqli($config["DB_HOST"], $config["DB_USERNAME"], $config["DB_PASSWORD"], $config["DB_DATABASE"]);
        $connection->set_charset('utf8');

        

        return $connection;
    }

    public static function records($sql){
        
        try{
            $con = self::defineConexion();
            $result = $con->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        catch(\Exception $e){

            print "Error!: " . $e->getMessage();
        }
 
    }

    public static function singleRecord($sql){

        try{  

             $con = self::defineConexion();
             $result = $con->query($sql);
             return $result->fetch_assoc();
        }
        
        catch(\Exception $e){

            print "Error!: " . $e->getMessage();
        }
    }

    public static function insertId($sql){
    	
        try 
        {
            $con = self::defineConexion();

            if( $con->query($sql))
                {
                   return $con->insert_id;
                }
        }

        catch(\Exception $e){
        
            print "Error!: " . $e->getMessage();
        } 	
	} 


    # se puede usar para DELETE, UPDATE, INSERT
    public static function query($sql){

        try{
        
            $con = self::defineConexion();
            $result = $con->query($sql);
            return $result;
        }
        
        catch(\Exception $e){
            print "Error!: " . $e->getMessage();
        }
    }

}


