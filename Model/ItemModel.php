<?php
class ItemModel extends Database {

    public function getAllItems(){
        $sql = "CALL sps_selectAllItems()";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }

    public function getMyItems($username){
        $sql = "CALL sps_selectItemsOfUser('".$username."')";
        //$sql = "SELECT * FROM `v_itemmap` WHERE `email` ='".$username."'";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }

    public function getItemBasedOnId($id){
        $sql = "CALL sps_selectItemsBasedOnId('".$id."')";
        //$sql = "SELECT * FROM `tbl_items` WHERE `id` = '".$id."'";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }

    public function createItem($type, $factory, $name){
        $sql = "CALL sps_insertItems('".$type."', '".$factory."', '".$name."')";
        //$sql = "INSERT INTO `tbl_items` (`type`, `factorynr`, `name`) VALUES ('".$type."', '".$factory."', '".$name."')";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }

    public function editItem($id, $type, $factory, $name){
        $sql = "CALL sps_updateItems('".$id."','".$type."', '".$factory."', '".$name."')";
        //$sql = "UPDATE `tbl_items` SET `type` = '".$type."', `factorynr` = '".$factory."', `name` = '".$name."' WHERE `id` = '".$id."'";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }

    public function selectItemStatus($username){
        $sql = "SELECT `status` FROM `v_itemmap` WHERE `email` = '".$username."'";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }

    public function getUnusedItems(){
        $sql ="SELECT * FROM `tbl_items` i
        WHERE i.id NOT IN (SELECT m.fk_item FROM `tbl_emp_item_mapping` m)";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;

    }

    public function assignItems($idemp, $iditem){
        $sql = "INSERT INTO `tbl_emp_item_mapping` SET `fk_emp` = '".$idemp."', `fk_item` = '".$iditem."', `status` = 'Offen', `recieved` = '".date('Y-m-d')."', `returned` = '0000-00-00' ";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }

    public function disassignItems($id){
        $sql = "UPDATE `tbl_emp_item_mapping` SET `status` = 'Abgegeben', `returned` = '".date('Y-m-d')."' WHERE `id` = '".$id."'";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }

}