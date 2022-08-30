<?php

    foreach (glob("../../../Model/*.php") as $models)
    {
        include_once $models;
    }
    foreach (glob("../../../Controller/*.php") as $controllers)
    {
        include_once $controllers;
    }

    $user = new User();
    $user->updateUser($_GET['id'], $_POST['username'], $_POST['fname'], $_POST['name']);
?>