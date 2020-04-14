<?php namespace SysTem;
use Mysqli;

    class SysDB{
        public $conn;
        public function  __construct($db_host, $db_user, $db_pwd, $db_name){
            $conn = new mysqli($db_host, $db_user, $db_pwd, $db_name);
            $this->conn = $conn;
        }

        public function get_row($table_name, $where, $data = 'OBJECT'){
            $sql = "SELECT * FROM $table_name WHERE $where";
            $result = $this->conn->query($sql);
            switch ($data) {
                case 'OBJECT':
                    return $result->fetch_object();
                    break;
                case 'ARRAY_A':
                    return $result->fetch_assoc();
                    break;
                case 'ARRAY_N':
                    return $result->fetch_array();
                    break;
            }
        }
    }
?>