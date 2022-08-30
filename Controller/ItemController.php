<?php
class ItemController {
    private $itemModel;
    private $authorisation;
    private $empController;
    private $validation;

    public function __construct() {
        $this->itemModel = new ItemModel();
        $this->empController = new EmpController();
        $this->authorisation = new Authorisation();
    }

    public function getAllItems(){
        return $this->itemModel->getAllItems();
    }

    public function getMyItems($username){
        return $this->itemModel->getMyItems($username);
    }

    public function getItemBasedOnId($id){
        return $this->itemModel->getItemBasedOnId($id);
    }
    public function editItem($id, $type, $factory, $name) {
        session_start();
        $inputs = [$type, $factory, $name];
        foreach ($inputs as $input) {
            if(empty($input) || preg_match('~[^a-z\d]~i', $input)) {
                $validation_err = 1;
                break;
            }
        }
        if(!isset($validation_err)){
            if($this->authorisation->checkAuthorisation("items_edit") == 1) {
                if($this->itemModel->editItem($id, $type, $factory, $name))
                {
                    
                    $_SESSION['edit_item_status'] = 1;
                    header("Location: http://localhost/mitems/index.php?view=edititem&id=".$id."");
                }
                else {
                    $_SESSION['edit_item_status'] = 0;
                    header("Location: http://localhost/mitems/index.php?view=edititem&id=".$id."");
                }
            }else{
                $_SESSION['edit_item_status'] = 2;
                header("Location: http://localhost/mitems/index.php?view=edititem&id=".$id."");
            }
        }else{
            $_SESSION['validation'] = 0;
            header("Location: http://localhost/mitems/index.php?view=createitem");
        }
    }
    
    public function createItem($type, $factory, $name){
        session_start();

        $inputs = [$type, $factory, $name];
        foreach ($inputs as $input) {
            if(empty($input) || preg_match('~[^a-z\d]~i', $input)) {
                $validation_err = 1;
                break;
            }
        }
        if(!isset($validation_err)){
            if($this->authorisation->checkAuthorisation("items_create") == 1) {
                if($this->itemModel->createItem($type, $factory, $name))
                {
                    
                    $_SESSION['create_item_status'] = 1;
                    header("Location: http://localhost/mitems/index.php?view=createitem");
                }
                else {
                    $_SESSION['create_item_status'] = 0;
                    header("Location: http://localhost/mitems/index.php?view=createitem");
                }
            }else{
                $_SESSION['create_item_status'] = 2;
                
            }
        }else{
            $_SESSION['validation'] = 0;
            header("Location: http://localhost/mitems/index.php?view=createitem");
        }

    }

    public function selectItemStatus($username){
        return $this->itemModel->selectItemStatus($username);
  
    }

    public function getUnusedItems(){ 
        return $this->itemModel->getUnusedItems();
    }

    public function assignItems($idemp, $iditem){
        session_start();
        if($this->authorisation->checkAuthorisation("items_assign") == 1) {
            if($this->itemModel->assignItems($idemp, $iditem)) 
            {
                $_SESSION['assign_item_status'] = 1;
                header("Location: http://localhost/mitems/index.php?view=empitems&id=".$idemp."");
            }
            else {
                $_SESSION['assign_item_status'] = 0;
                header("Location: http://localhost/mitems/index.php?view=empitems&id=".$idemp."");
            }
        }else{
            $_SESSION['assign_item_status'] = 2;
            header("Location: http://localhost/mitems/index.php?view=empitems&id=".$idemp."");
        }
    }

    public function disassignItems($id, $idemp){
        session_start();
        if($this->authorisation->checkAuthorisation("items_assign_remove") == 1) {
            if($this->itemModel->disassignItems($id))
            {
                $_SESSION['disassign_item_status'] = 1;
                header("Location: http://localhost/mitems/index.php?view=empitems&id=".$idemp."");
            }
            else {
                $_SESSION['disassign_item_status'] = 0;
                header("Location: http://localhost/mitems/index.php?view=empitems&id=".$idemp."");
            }
        }else{
            $_SESSION['disassign_item_status'] = 2;
            header("Location: http://localhost/mitems/index.php?view=empitems&id=".$idemp."");
        }
    }
}