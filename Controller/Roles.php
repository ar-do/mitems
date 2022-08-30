<?php
class Roles
{
    private $roleModel;

    public function __construct() {
        $this->roleModel = new RoleModel();
    }

    public function getRoles($username) {
        return $this->roleModel->getRoles($username);
    }
}

