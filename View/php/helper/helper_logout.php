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
    $controllerObj->logout();
    header("Location: http://localhost/mitems/index.php");
?>