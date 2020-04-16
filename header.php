<?php
    require_once("sys-config.php"); 
    require_once("classes/SysDB.php");

    $db = new \SysTem\SysDB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    echo '<br><pre>';
    print_r($db->get_row('cars', 'id = 5', 'OBJECT'));
    echo '</pre>';
    echo '<br><pre>';
    print_r($db->get_results("SELECT * FROM CARS WHERE id < 10"));
    echo '</pre>';
?>