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

        /**
         * Get a single column or mutliple column from a given table.
         * 
         * @param string $col_name col_name is the name of the wanted column or columns (split column names with a comma).
         * @param string $table_name table_name is the table you want to search in.
         */
        public function get_col($col_name, $table_name){
            $sql = "SELECT $col_name FROM $table_name";
            $result = $this->conn->query($sql);
            if(!empty($result)){
                $data = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return FALSE;
            }
        }
    }
?>