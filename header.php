<?php
    require_once("sys-config.php"); 
    require_once("classes/SysDB.php");

    $db = new \SysTem\SysDB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    //  DEBUG CODE  //
    /* 
    echo '<br><pre>';
    print_r($db->get_row('cars', 'id = 5', 'OBJECT'));
    echo '</pre>';

    echo '<br><pre>';
    print_r($db->get_results("SELECT * FROM CARS WHERE id < 10"));
    echo '</pre>';
*/
/*
    if($db->insert('test', array(array('name' => "'value1'", 'password' => "'1234'"), array('name' => "'value1_2'", 'password' => "'4321'")))){
        echo 'success!';
    } else {
        echo 'wrong!';
    }*/
    // DEBUG CODE //
?>