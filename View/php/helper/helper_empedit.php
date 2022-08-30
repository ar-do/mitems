<?php
    foreach (glob("../../../Model/*.php") as $models)
    {
        include_once $models;
    }
    foreach (glob("../../../Controller/*.php") as $controllers)
    {
        include_once $controllers;
    }

    $empController = new EmpController();

    $empController->editEmp($_GET['id'], $_POST['emp_fname'], $_POST['emp_sname'],$_POST['emp_department'],$_POST['emp_function'],$_POST['emp_mail'],$_POST['emp_manager'],$_POST['emp_start'],$_POST['emp_end']);
?>