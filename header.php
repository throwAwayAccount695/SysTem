<?php
    require_once("sys-config.php"); 
    require_once("classes/sysDB.php");

    $db = new SysTem\SysDB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
?>