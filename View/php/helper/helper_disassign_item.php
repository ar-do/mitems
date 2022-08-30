<?php

    foreach (glob("../../../Model/*.php") as $models)
    {
        include_once $models;
    }
    foreach (glob("../../../Controller/*.php") as $controllers)
    {
        include_once $controllers;
    }

    $itemController = new ItemController;
    $itemController->disassignItems($_GET['id'], $_GET['empid']);
    
?>