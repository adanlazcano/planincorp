<?php
namespace App\Logic;
defined("APPPATH") OR die("Access denied");
use Exception;

class Exceptions extends Exception{

   
    public function __construct($message, $code = 0, Exception $previous = null) {
        
        parent::__construct($message, $code, $previous);
    }

     public function mensaje() {
        return " [{$this->code}]: {$this->message}\n";
    }

  
}