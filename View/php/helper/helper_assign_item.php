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
    $itemController->assignItems($_GET['empid'], $_GET['itemid']);
?>