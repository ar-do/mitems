<?php
class Authorisation
{
    private $roleModel;
    private $empController;

    public function __construct() {
        $this->roleModel = new RoleModel();
    }

    public function setAuthorisations($username) {
        session_start();
        $result = $this->roleModel->getRoles($username);

        if(odbc_num_rows($result) != 0) {

            //Incase Users have mutliple Roles, authorisation will be mapped to the highest priviledge
            if(odbc_num_rows($result) > 1) {
                while(odbc_fetch_row($result)) {
                    if(isset($_SESSION['emp_create']) && $_SESSION['emp_create'] == 0 && odbc_result($result, "Emp_create") == 1) {
                        $_SESSION['emp_create'] = odbc_result($result, "Emp_create");
                    }
                    elseif(!isset($_SESSION['emp_create'])){
                        $_SESSION['emp_create'] = odbc_result($result, "Emp_create");
                    }else {
                        continue;
                    }

                    if(isset($_SESSION['emp_edit']) && $_SESSION['emp_edit'] == 0 && odbc_result($result, "Emp_edit")  == 1) {
                        $_SESSION['emp_edit'] = odbc_result($result, "Emp_edit");
                    }
                    elseif(!isset($_SESSION['emp_edit'])){
                        $_SESSION['emp_edit'] = odbc_result($result, "Emp_edit");
                    }else {
                        continue;
                    }

                    if(isset($_SESSION['emp_view']) && $_SESSION['emp_view'] == 0 && odbc_result($result, "Emp_view")  == 1) {
                        $_SESSION['emp_view'] = odbc_result($result, "Emp_view");
                    }
                    elseif(!isset($_SESSION['emp_view'])){
                        $_SESSION['emp_view'] = odbc_result($result, "Emp_view");
                    }else {
                        continue;
                    }

                    if(isset($_SESSION['items_create']) && $_SESSION['items_create'] == 0 && odbc_result($result, "Items_create")  == 1) {
                        $_SESSION['items_create'] = odbc_result($result, "Items_create");
                    }
                    elseif(!isset($_SESSION['items_create'])){
                        $_SESSION['items_create'] = odbc_result($result, "Items_create");
                    }else {
                        continue;
                    }

                    if(isset($_SESSION['items_assign']) && $_SESSION['items_assign'] == 0 && odbc_result($result, "Items_assign") == 1) {
                        $_SESSION['items_assign'] = odbc_result($result, "Items_assign");
                    }
                    elseif(!isset($_SESSION['items_assign'])){
                        $_SESSION['items_assign'] = odbc_result($result, "Items_assign");
                    }else {
                        continue;
                    }

                    if(isset($_SESSION['items_create']) && $_SESSION['items_create'] == 0 && odbc_result($result, "Items_create") == 1) {
                        $_SESSION['items_create'] = odbc_result($result, "Items_create");
                    }
                    elseif(!isset($_SESSION['items_create'])){
                        $_SESSION['items_create'] = odbc_result($result, "Items_create");
                    }else {
                        continue;
                    }

                    if(isset($_SESSION['items_edit']) && $_SESSION['items_edit'] == 0 && odbc_result($result, "Items_edit") == 1) {
                        $_SESSION['items_edit'] = odbc_result($result, "Items_edit");
                    }
                    elseif(!isset($_SESSION['items_edit'])){
                        $_SESSION['items_edit'] = odbc_result($result, "Items_edit");
                    }else {
                        continue;
                    }

                    if(isset($_SESSION['items_assign_remove']) && $_SESSION['items_assign_remove'] == 0 && odbc_result($result, "Items_assign_remove") == 1) {
                        $_SESSION['items_assign_remove'] = odbc_result($result, "Items_assign_remove");
                    }
                    elseif(!isset($_SESSION['items_assign_remove'])){
                        $_SESSION['items_assign_remove'] = odbc_result($result, "Items_assign_remove");
                    }else {
                        continue;
                    }

                    if(isset($_SESSION['user_edit']) && $_SESSION['user_edit'] == 0 && odbc_result($result, "User_edit") == 1) {
                        $_SESSION['user_edit'] = odbc_result($result, "User_edit");
                    }
                    elseif(!isset($_SESSION['user_edit'])){
                        $_SESSION['user_edit'] = odbc_result($result, "User_edit");
                    }else {
                        continue;
                    }

                    if(isset($_SESSION['self_view'] ) && $_SESSION['self_view']  == 0 && odbc_result($result, "Self_view") == 1) {
                        $_SESSION['self_view'] = odbc_result($result, "Self_view");
                    }
                    elseif(!isset($_SESSION['self_view'])){
                        $_SESSION['self_view'] = odbc_result($result, "Self_view");
                    }else {
                        continue;
                    }

                    if(isset($_SESSION['items_handin'] ) && $_SESSION['items_handin']  == 0 && odbc_result($result, "Items_handin") == 1) {
                        $_SESSION['items_handin'] = odbc_result($result, "Items_handin");
                    }
                    elseif(!isset($_SESSION['items_handin'])){
                        $_SESSION['items_handin'] = odbc_result($result, "Items_handin");
                    }else {
                        continue;
                    }
                }

            }else{
                // Incase User has only one role, role will simply be put into sessions
                $_SESSION['emp_create'] = odbc_result($result, "Emp_create");
                $_SESSION['emp_edit'] = odbc_result($result, "Emp_edit");
                $_SESSION['emp_view'] = odbc_result($result, "Emp_view");
                $_SESSION['items_create'] = odbc_result($result, "Items_create");
                $_SESSION['items_edit'] = odbc_result($result, "Items_edit");
                $_SESSION['items_assign'] = odbc_result($result, "Items_assign");
                $_SESSION['items_assign_remove'] = odbc_result($result, "Items_assign_remove");
                $_SESSION['user_edit'] = odbc_result($result, "User_edit");
                $_SESSION['self_view'] = odbc_result($result, "Self_view");
                $_SESSION['items_handin'] = odbc_result($result, "Items_handin");
            }
        }else{
            // Errorhandling, no Roles for this user...
            // User should contact Admin to recieve roles
        }
    }

    public function checkAuthorisation($task) {
        if(session_status() != 2) {
            session_start();
        }

        if(isset($_SESSION[$task]) && $_SESSION[$task] == 1) {
            return 1;
        }else {
            return 0;
        }
    }

}
