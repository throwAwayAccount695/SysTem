<?php namespace SysTem;

    class SysDB{
        public function  __construct($db_host, $db_user, $db_pwd, $db_name){
            $conn = new mysqli($db_host, $db_user, $db_pwd, $db_name);
            return  $conn;
        }
    }
?>