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
    if(isset($_POST['role_user'])){
        $roles[] = $_POST['role_user'];
    }
    if(isset($_POST['role_hr'])){
        $roles[] = $_POST['role_hr'];
    }
    if(isset($_POST['role_manager'])){
        $roles[] = $_POST['role_manager'];
    }
    if(isset($_POST['role_itemadmin'])){
        $roles[] = $_POST['role_itemadmin'];
    }
    if(isset($_POST['role_plattformadmin'])){
        $roles[] = $_POST['role_plattformadmin'];
    }
    $user->createUser($_POST['username'], $_POST['password'],$_POST['fname'], $_POST['name'], $roles);   

?>