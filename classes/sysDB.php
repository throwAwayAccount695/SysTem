<?php namespace SysTem;
use Mysqli;

    class SysDB{
        public $conn;
        public function  __construct($db_host, $db_user, $db_pwd, $db_name){
            $conn = new mysqli($db_host, $db_user, $db_pwd, $db_name);
            $this->conn = $conn;
        }
    }
?>