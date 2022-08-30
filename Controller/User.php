<?php
class User
{
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->authorisation = new Authorisation();
    }

    public function handleFormSubmit($data) {
        // Überprüfen der Formulardaten
        $isValid = true;

        if(!isset($data['username']) OR empty($data['username'])) {
            $isValid = false;
        }
        if(!isset($data['password']) OR empty($data['password']) OR $data['password'] !== $data['password_confirm']) {
            $isValid = false;
        }

        if($isValid) {
            $this->userModel->setUsername($data['username']);
            $this->userModel->setPassword($data['password']);

            $_SESSION['user'] = $this;


        }
    }

    public function getUsername() {
        return $this->userModel->getUsername();
    }

    public function getAllUsers() {
        return $this->userModel->getAllUsers();
    }
    public function getUserBasedOnId($id){
        return $this->userModel->getUserBasedOnId($id);
    }

    public function createUser($username, $password, $sname, $fname, $roles) {

        session_start();
        $inputs = [$sname, $fname];
        foreach ($inputs as $input) {
            if(empty($input) || preg_match('~[^a-z\d]~i', $input)) {
                $validation_err = 1;
                break;
            }
        }
        if(!isset($validation_err) && !empty($username) && !empty($password)){
            if($this->authorisation->checkAuthorisation("user_edit") == 1) {
                if($this->userModel->createUser($username, $password, $sname, $fname, $roles))
                {
                    
                    $_SESSION['create_user_status'] = 1;
                    header("Location: http://localhost/mitems/index.php?view=createuser");
                }
                else {
                    $_SESSION['create_user_status'] = 0;
                    header("Location: http://localhost/mitems/index.php?view=createuser");
                }
            }else{
                $_SESSION['create_user_status'] = 2;
                header("Location: http://localhost/mitems/index.php?view=createuser");
            }
        }else{
            $_SESSION['validation'] = 0;
            header("Location: http://localhost/mitems/index.php?view=createuser");
        }
    }

    public function updateUser($id, $username, $fname, $name) {
        session_start();

        $inputs = [$name, $fname];
        foreach ($inputs as $input) {
            if(empty($input) || preg_match('~[^a-z\d]~i', $input)) {
                $validation_err = 1;
                break;
            }
        }
        if(!isset($validation_err) && !empty($username)){
            if($this->authorisation->checkAuthorisation("user_edit") == 1) {
                if($this->userModel->updateUser($id, $username, $fname, $name))
                {
                    
                    $_SESSION['edit_user_status'] = 1;
                    header("Location: http://localhost/mitems/index.php?view=edituser&id=".$id."");
                }
                else {
                    $_SESSION['edit_user_status'] = 0;
                    header("Location: http://localhost/mitems/index.php?view=edituser&id=".$id."");
                }
            }else{
                $_SESSION['edit_user_status'] = 2;
                header("Location: http://localhost/mitems/index.php?view=edituser&id=".$id."");
            }
        }else{
            $_SESSION['validation'] = 0;
            header("Location: http://localhost/mitems/index.php?view=edituser&id=".$id."");
        }



      
    }
}