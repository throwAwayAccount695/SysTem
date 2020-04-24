<?php
    require_once("sys-config.php"); 
    require_once("classes/SysDB.php");

    $db = new \SysTem\SysDB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    //  DEBUG CODE  //

    echo '<br><pre>';
    print_r($db->get_row('cars', array('id' => 5, 'year' => 1953), 'ARRAY_N'));
    echo '</pre>';
    /* 
    echo '<br><pre>';
    print_r($db->get_results("SELECT * FROM CARS WHERE id < 10"));
    echo '</pre>';
*/

    //$db->update('test', array('name' => "value_2", 'password' => "4321"), array('id' => 97));

    // DEBUG CODE //
?>