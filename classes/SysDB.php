<?php namespace SysTem;
use Mysqli;
use Exception;

    /**
     * starts connection to database on creation
     * 
     * The main database class of the project
     */
    class SysDB{
        /**
         * variable that holds the connection to the database
         */
        private $conn;
        /**
         * @param constant $db_host The server name for the database
         * @param constant $db_user The username used to login to the database
         * @param constant $db_pwd The password used to login to the database
         * @param constant $db_name The name of the database you want to connect to
         */
        public function  __construct($db_host, $db_user, $db_pwd, $db_name){
            $conn = new mysqli($db_host, $db_user, $db_pwd, $db_name);
            $this->conn = $conn;
        }
        /**
         * Get a single row from a given table as either an associative array, numbered array or an object.
         * 
         * @param string $table_name table_name is the name of the table you want to search in.
         * @param string $where where you want the row from, usually by id (typing WHERE is not needed).
         * @param string $data data is what you want the data to be contained in. your choices are; OBJECT (default), ARRAY_N (numbered array) or ARRAY_A (assoc array). 
         * 
         * @return array $result is return as one of three choosen array types.
         */
        public function get_row($table_name, $where, $data = 'OBJECT'){
            $sql = "SELECT * FROM $table_name WHERE $where";
            $result = $this->conn->query($sql);
            if(!empty($result)){
                switch ($data) {
                    case 'OBJECT':
                        return $result->fetch_object();
                        break;
                    case 'ARRAY_A':
                        return $result->fetch_assoc();
                        break;
                    case 'ARRAY_N':
                        return $result->fetch_array(MYSQLI_NUM);
                        break;
                }
            } else {
                return FALSE;
            }
        }

        /**
         * Get a single column or mutliple column from a given table.
         * 
         * @param string $col_name col_name is the name of the wanted column or columns (split column names with a comma).
         * @param string $table_name table_name is the table you want to search in.
         * 
         * @return array $data is return as an numbered array.
         */
        public function get_col($col_name, $table_name){
            $sql = "SELECT $col_name FROM $table_name";
            $result = $this->conn->query($sql);
            if(!empty($result)){
                $data = array();
                while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return FALSE;
            }
        }

        /**
         * Make a custom SQL string
         * 
         * @param string $sql_string The function has no SQL premade, all SQL have to be given in this parameter.
         * 
         * @return array $data is returned as an numbered array of objects.
         */
        public function get_results($sql_string){
            $result = $this->conn->query($sql_string);
            try{
                if(!empty($result)){
                    $data = array();
                    while($row = mysqli_fetch_object($result)){
                        $data[] = $row;
                    }
                    return $data;
                } else {
                    throw new  Exception("The inputted string is not valid something went wrong :(");
                }
            }
            catch(Exception $e){
                echo 'Message ' . $e->getMessage();
                return FALSE;
            }
        }

        /**
         * Insert data into the database.
         * 
         * @param string $table_name The table that the data should be inserted into.
         * @param array $data A numbered array containing associative arrays with the data that you want inserted.
         * 
         * @return bool Insert will return TRUE on completion and FALSE on failure.
         */
        public function insert($table_name, $data){
            $bool_arr = array();
            for ($i = 0; $i < count($data); $i++) { 

                $prepare = null;
                $type = null;
                $values_arr = array();
                $columns = implode(', ', array_keys($data[$i]));

                foreach ($data[$i] as $key => $value) {
                    array_push($values_arr, $value);
                    switch (gettype($value)) {
                        case 'string':
                            $type .= 's';
                            break;
                        case 'integer':
                            $type .= 'i';
                            break;
                        case 'double':
                            $type .= 'd';
                            break;
                    }
                }
                for($j = 0; $j < count($values_arr); $j++){
                    if($j == count($values_arr) - 1){
                        $prepare .= '?';
                    } else {
                        $prepare .= '?, ';
                    }
                }
                $stmt = $this->conn->prepare("INSERT INTO $table_name ($columns) VALUES ($prepare)");
               /* if($stmt = $this->conn->prepare("INSERT INTO $table_name ($columns) VALUES ($prepare)") === FALSE){
                    $bool_arr[$i] = "FAILURE! Row $i didn't go through something is wrong with the data!";
                    echo '<pre>';
                    print_r($bool_arr);
                    echo '</pre>';
                    return FALSE;
                } else {
                    $bool_arr[$i] = "SUCCESS! Row $i went thorugh and got added to the database!";
                }
                NOTE :  NEEDS TO FIND A WAY TO RETURN FALSE!
                */
                $stmt->bind_param($type, ...$values_arr);
                $stmt->execute();
                $stmt->close();
            }
            return TRUE;
        }
    }
?>
