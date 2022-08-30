<?php
class EmpController 
{
    private $empModel;
    private $authorisation;

    public function __construct() {
        $this->empModel = new EmpModel();
        $this->authorisation = new Authorisation();
    }

    public function getAllEmployees(){
        return $this->empModel->getAllEmployees();
    }

    public function getManagerEmployees($username){ 
        return $this->empModel->getManagerEmployees($username);
    }

    public function getEmployeeBasedOnId($id){
        return $this->empModel->getEmployeeBasedOnId($id);
    }

    public function editEmp($id,$sname,$fname,$department,$function,$mail,$manager,$start,$end) {
        session_start();

        $inputs = [$sname,$fname,$department,$function];
        foreach ($inputs as $input) {
            if(empty($input) || preg_match('~[^a-z\d]~i', $input)) {
                $validation_err = 1;
                break;
            }
        }
        if(!isset($validation_err)){
            if($this->authorisation->checkAuthorisation("emp_edit") == 1) {
                if($this->empModel->editEmp($id,$sname,$fname,$department,$function,$mail,$manager,$start,$end))
                {
    
                    $_SESSION['edit_emp_status'] = 1;
                    header("Location: http://localhost/mitems/index.php?view=editemp&id=".$id."");
                }
                else {
                    $_SESSION['edit_emp_status'] = 0;
                    header("Location: http://localhost/mitems/index.php?view=editemp&id=".$id."");
                }
            }else{
                $_SESSION['edit_emp_status'] = 2;
                header("Location: http://localhost/mitems/index.php?view=editemp&id=".$id."");
            }

        }else{
            $_SESSION['validation'] = 0;
            header("Location: http://localhost/mitems/index.php?view=editemp&id=".$id."");
        }


    }

    public function createEmp($fname,$sname,$department,$function,$mail,$manager,$start,$end){
        session_start();
        
        $inputs = [$sname,$fname,$department,$function];
        foreach ($inputs as $input) {
            if(empty($input) || preg_match('~[^a-z\d]~i', $input)) {
                $validation_err = 1;
                break;
            }
        }

        if(!isset($validation_err)){
            if($this->authorisation->checkAuthorisation("emp_create") == 1) {
                if($this->empModel->createEmp($fname,$sname,$department,$function,$mail,$manager,$start,$end))
                {
    
                    $_SESSION['create_emp_status'] = 1;
                    header("Location: http://localhost/mitems/index.php?view=createemp");
                }
                else {
                    $_SESSION['create_emp_status'] = 0;
                    header("Location: http://localhost/mitems/index.php?view=createemp");
                }
            }else{
                $_SESSION['create_emp_status'] = 2;
                header("Location: http://localhost/mitems/index.php?view=createemp");
            }
        }else{
            $_SESSION['validation'] = 0;
            header("Location: http://localhost/mitems/index.php?view=createemp");
        }
    
    }

    public function getOffboardedEmpBasedOnManager($manager){
       return $this->empModel->getOffboardedEmpBasedOnManager($manager);
    }
}