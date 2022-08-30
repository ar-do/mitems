<?php
class EmpModel extends Database {
    public function getAllEmployees(){
        $sql = "CALL sps_selectAllEmp()";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }
    public function getManagerEmployees($username){
        $sql = "CALL sps_selectEmpByManager('".$username."')";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }
    public function getEmployeeBasedOnId($id){
        $sql = "CALL sps_selectEmpByID('".$id."')";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }
    public function createEmp($sname,$fname,$department,$function,$mail,$manager,$start,$end){
        $sql = "CALL sps_insertEmp('".$sname."', '".$fname."', '".$department."', '".$function."', '".$mail."', '".$manager."', '".$start."', '".$end."')";
        //$sql = "INSERT INTO `tbl_emp` (`sname`, `fname`, `department`, `function`, `email`, `manager`, `start`, `end`) VALUES ('".$sname."', '".$fname."', '".$department."', '".$function."', '".$mail."', '".$manager."', '".$start."', '".$end."')";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }
    public function editEmp($id,$sname,$fname,$department,$function,$mail,$manager,$start,$end){
        $sql = "CALL sps_updateEmp('".$sname."', '".$fname."', '".$department."', '".$function."', '".$mail."', '".$manager."', '".$start."', '".$end."', '".$id."')";
        //$sql = "UPDATE `tbl_emp` SET `sname` = '".$sname."', `fname` = '".$fname."', `department` = '".$department."', `function` = '".$function."', `email` = '".$mail."', `manager` = '".$manager."', `start` = '".$start."', `end` = '".$end."' WHERE `id` = '".$id."'";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }
    public function getOffboardedEmpBasedOnManager($manager){
        $sql = "CALL sps_selectOffboardedEmp('".$manager."')";
        //$sql = "SELECT * FROM `tbl_emp` WHERE `end` < CURRENT_DATE() AND `end` != '0000-00-00' AND `manager` = '".$manager."'";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }


}