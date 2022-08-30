<?php
class RoleModel extends Database {

    public function getRoles($username) {
        $sql = "SELECT * FROM `v_rolemap` WHERE `Username` ='".$username."'";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }

    public function insertRoles($id, $roles){
        foreach ($roles as $role){
            $sql = "INSERT INTO `tbl_rolemapping` SET `fk_user` = '".$id."', `fk_roles` = '".$role."'";
            $object = odbc_exec($this->connectToDatabase(), $sql);
        }
        return $object;
    }
}