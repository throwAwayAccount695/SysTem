<?php
    require_once("sys-config.php"); 
    require_once("classes/SysDB.php");

    $db = new \SysTem\SysDB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    print_r($db->get_row('cars', 'id = 20'));
    echo '<br>';
    print_r($db->get_col('id', 'cars'));
?>