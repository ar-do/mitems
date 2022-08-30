<?php

    foreach (glob("../../../Model/*.php") as $models)
    {
        include_once $models;
    }
    foreach (glob("../../../Controller/*.php") as $controllers)
    {
        include_once $controllers;
    }
    $dataexchange = new DataExchange;
    $authCheck = new Authorisation();
    if($authCheck->checkAuthorisation("emp_view") == 1){
        if(isset($_GET["type"]) && $_GET["type"] == "emp"){
            $dataexchange->csvExportEmployees();
        }
    }

    if($authCheck->checkAuthorisation("items_create") == 1
    || $authCheck->checkAuthorisation("items_edit") == 1){
        if(isset($_GET["type"]) && $_GET["type"] == "item"){
            $dataexchange->csvExportItem();
        }
    }
    if($authCheck->checkAuthorisation("user_edit") == 1) { 
        if(isset($_GET["type"]) && $_GET["type"] == "users"){
            $dataexchange->csvExportUser();
        }
    }
 
    if(isset($_GET["type"]) && $_GET["type"] == "offboardings"){
        $dataexchange->csvExportOffboardings();
    }
    if(isset($_GET["type"]) && $_GET["type"] == "myemp"){
        $dataexchange->csvExportMyEmp();
    }
    if(isset($_GET["type"]) && $_GET["type"] == "myitems"){
        $dataexchange->csvExportMyItems();
    }
    if(isset($_GET["type"]) && $_GET["type"] == "empitems"){
        $dataexchange->csvExportItemsOfUser($_GET['id']);
    }


?>