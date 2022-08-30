<?php
class UserModel extends Database
{
    private $username;
    private $password;
    private $sname;
    private $fname;
    private $roles;
    private $roleModel;

    public function __construct() {
        $this->roleModel = new RoleModel();
    }


    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setSName($sname) {
        $this->sname = $sname;
    }

    public function setFName($fname) {
        $this->fname = $fname;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function getSName() {
        return $this->sname;
    }

    public function getFName() {
        return $this->fname;
    }

    public function selectUser($username) {
        $sql = "SELECT * FROM `tbl_user` WHERE `username` ='".$username."'";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM `tbl_user`";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }

    public function getUserBasedOnId($id) {
        $sql = "SELECT * FROM `tbl_user` WHERE `id` ='".$id."'";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }

    public function setRoles($roles) {
        $this->roles = $roles;
    }

    public function createUser($username, $password, $sname, $name, $roles){
        $password = password_hash($password , PASSWORD_DEFAULT);
        $username = strtolower($username);
        $sql = "INSERT INTO `tbl_user` SET `username` = '".$username."', `password` = '".$password."', `sname` = '".$sname."', `fname` = '".$name."'";
        $pobject = odbc_exec($this->connectToDatabase(), $sql);
        $result = $this->selectUser($username);
        $id = odbc_result($result, "id");
        $object = $this->roleModel->insertRoles($id, $roles);
        return $object;
    }

    public function updateUser($id, $username, $fname, $name) {
        $sql = "UPDATE `tbl_user` SET `username` = '".$username."', `sname` = '".$fname."', `fname` = '".$name."' WHERE `id` = '".$id."'";
        $object = odbc_exec($this->connectToDatabase(), $sql);
        return $object;
    }

}