<?php
namespace Core;
defined("APPPATH") OR die("Access denied");

use \App\Interfaces\Admin;

class View
{
    /**
     * @var
     */
    protected static $data;

    /**
     * @var
     */
    const VIEWS_PATH = "../App/Views/";
    const VIEWS_PARTIALS_PATH = "../App/partials_views/views/";

    /**
     * @var
     */
    const EXTENSION_TEMPLATES = "php";
    const HEADER_PARTIAL      = "header";
    const FOOTER_PARTIAL      = "footer";

    /**
     * [render Views with data]
     * @param  [String]  [template name]
     * @return [html]    [render html]
     */
    public static function render($template)
    {
        session_start();

       if(!empty($_SESSION)){
        

            if(!file_exists(self::VIEWS_PATH . $template . "." . self::EXTENSION_TEMPLATES))
            {
                throw new \Exception("Error: El archivo " . self::VIEWS_PATH . $template . "." . self::EXTENSION_TEMPLATES . " no existe", 1);
            }

            

            ob_start();
            
            if(!empty(self::$data))
                extract(self::$data);

           
            include(self::VIEWS_PARTIALS_PATH .self::HEADER_PARTIAL . "." . self::EXTENSION_TEMPLATES);

            include(self::VIEWS_PATH . $template . "." . self::EXTENSION_TEMPLATES);
            
            
            include(self::VIEWS_PARTIALS_PATH .self::FOOTER_PARTIAL . "." . self::EXTENSION_TEMPLATES);
            $str = ob_get_contents();
            ob_end_clean();
            echo $str;
        
        }else{

        header("Location: ../");
        }
    }

    /**
     * [set Set Data form Views]
     * @param [string] $name  [key]
     * @param [mixed] $value [value]
     */
    public static function set($name, $value)
    {
        self::$data[$name]      = $value;
    }

    public static function renderJson($data){
        echo json_encode($data);
        exit;
    }

    public static function pre($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit;
    }
}
