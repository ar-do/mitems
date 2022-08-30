<?php

    foreach (glob("../../../Model/*.php") as $models)
    {
        include_once $models;
    }
    foreach (glob("../../../Controller/*.php") as $controllers)
    {
        include_once $controllers;
    }

    $controllerObj = new Auth;
    $controllerObj->login($_POST['username'], $_POST['password']);
?>