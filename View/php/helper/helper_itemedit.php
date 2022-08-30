<?php

    foreach (glob("../../../Model/*.php") as $models)
    {
        include_once $models;
    }
    foreach (glob("../../../Controller/*.php") as $controllers)
    {
        include_once $controllers;
    }

    $itemController = new ItemController();
    $itemController->editItem($_GET['id'], $_POST['item_type'],$_POST['item_factory'],$_POST['item_name']);
?>