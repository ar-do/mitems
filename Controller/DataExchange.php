<?php
class DataExchange
{
    private $empController;
    private $itemController;
    private $user;
    private $roles;

    public function __construct() {
        $this->empController = new EmpController();
        $this->itemController = new ItemController();
        $this->roles = new Roles();
        $this->user = new User();
    }

    public function csvExportEmployees() {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=export_emp.csv');
        $result = $this->empController->getAllEmployees();
        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Nachname', 'Vorname', 'Abteilung', 'Funktion', 'E-Mail', 'Vorgesetzter'. 'Eintritt', 'Austritt']);
        while(odbc_fetch_row($result)) {
            $content = array(odbc_result($result, "id"), odbc_result($result, "sname"), odbc_result($result, "fname"), odbc_result($result, "department"), odbc_result($result, "function"), odbc_result($result, "email"), odbc_result($result, "manager"), odbc_result($result, "start"), odbc_result($result, "end"));
            fputcsv($output, $content);
        }
        return;
    } 

    public function csvExportItem() {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=export_item.csv');
        $result = $this->itemController->getAllItems();
        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Typ', 'Identifikation', 'Name/Hersteller']);
        while(odbc_fetch_row($result)) {
                $content = array(odbc_result($result, "id"), odbc_result($result, "type"), odbc_result($result, "factorynr"), odbc_result($result, "name"));
                fputcsv($output, $content);
        }
        return;
    }

    public function csvExportUser(){
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=export_users.csv');
        $result = $this->user->getAllUsers();
        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Benutzername', 'Nachname', 'Vorname', 'Rolle']);
        while(odbc_fetch_row($result)) {
                $roleresult = $this->roles->getRoles(odbc_result($result, "username"));
                $content = array(odbc_result($result, "id"), odbc_result($result, "username"), odbc_result($result, "sname"), odbc_result($result, "fname"), odbc_result($roleresult, "Role"));
                fputcsv($output, $content);
        }
        return;
    }

    public function csvExportOffboardings(){
        if(session_status() != 2) {
            session_start();
        }
        $username = $_SESSION['userobj'];
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=export_offboardings.csv');
        $result = $this->empController->getOffboardedEmpBasedOnManager($username);
        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Vorname', 'Nachname', 'Abteilung', 'Funktion', 'E-Mail', 'Vorgesetzter', 'Eintritt', 'Austritt', 'Status']);
        while(odbc_fetch_row($result)) {
                $content = array(odbc_result($result, "id"), 
                                odbc_result($result, "sname"), 
                                odbc_result($result, "fname"), 
                                odbc_result($result, "department"), 
                                odbc_result($result, "function"), 
                                odbc_result($result, "email"),
                                odbc_result($result, "manager"),
                                odbc_result($result, "start"),
                                odbc_result($result, "end"));
                fputcsv($output, $content);
        }
        return;
    }

    public function csvExportMyEmp(){
        if(session_status() != 2) {
            session_start();
        }
        $username = $_SESSION['userobj'];
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=export_myemp.csv');
        $result = $this->empController->getManagerEmployees($username);
        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Vorname', 'Nachname', 'Abteilung', 'Funktion', 'E-Mail', 'Vorgesetzter', 'Eintritt', 'Austritt', 'Status']);
        while(odbc_fetch_row($result)) {
                $content = array(odbc_result($result, "id"), 
                                odbc_result($result, "sname"), 
                                odbc_result($result, "fname"), 
                                odbc_result($result, "department"), 
                                odbc_result($result, "function"), 
                                odbc_result($result, "email"),
                                odbc_result($result, "manager"),
                                odbc_result($result, "start"),
                                odbc_result($result, "end"));
                fputcsv($output, $content);
        }
        return;
    }

    public function csvExportMyItems(){
        if(session_status() != 2) {
            session_start();
        }
        $username = $_SESSION['userobj'];
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=export_myitems.csv');
        $result = $this->empController->getOffboardedEmpBasedOnManager($username);
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Typ', 'Identifikation', 'Name/Hersteller', 'Zugewiesen am', 'Retourniert am', 'Status']);
        while(odbc_fetch_row($result)) {
                $content = array(odbc_result($result, "type"), 
                                odbc_result($result, "factorynr"), 
                                odbc_result($result, "name"), 
                                odbc_result($result, "recieved"), 
                                odbc_result($result, "returned"), 
                                odbc_result($result, "status"));
                fputcsv($output, $content);
        }
        return;
    }

    public function csvExportItemsOfUser($id){
        if(session_status() != 2) {
            session_start();
        }
        $resultEmployee = $this->empController->getEmployeeBasedOnId($id);
        $username = $_SESSION['userobj'];
        if(strtolower(odbc_result($resultEmployee, "manager")) == strtolower($username)) {
            $result = $this->itemController->getMyItems(odbc_result($resultEmployee, "email"));
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=export_'.odbc_result($resultEmployee, "sname").'_'.odbc_result($resultEmployee, "fname").'.csv');
            $output = fopen('php://output', 'w');
            fputcsv($output, ['Typ', 'Identifikation', 'Name/Hersteller', 'Zugewiesen am', 'Retourniert am', 'Status']);
            while(odbc_fetch_row($result)) {
                    $content = array(odbc_result($result, "type"), 
                                    odbc_result($result, "factorynr"), 
                                    odbc_result($result, "name"), 
                                    odbc_result($result, "recieved"), 
                                    odbc_result($result, "returned"), 
                                    odbc_result($result, "status"));
                    fputcsv($output, $content);
            }
        }
        return;
    }

}
