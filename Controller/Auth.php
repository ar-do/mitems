<?php
class Auth
{
   // Credentials die vom User eingegeben wurden 
   private $username;
   private $password;

   // Variable für User Model Objekt
   private $userModel;
   private $authorisation;

   // Credentials die von der Datenbank zurückkommen
   private $uname;
   private $pword;
   
   // Informationen vom User
   private $fname;

   public function __construct() {
        $this->userModel = new UserModel();
        $this->authorisation = new Authorisation();
   }

   public function login($username, $password) {

    $this->username = strtolower($username);
    $this->password = $password;
    $result = $this->userModel->selectUser($this->username);

    $this->uname = strtolower(odbc_result($result, "username"));
    $this->pword = odbc_result($result, "password");
    $this->fname = odbc_result($result, "fname");
    if($this->uname == $this->username && password_verify($this->password, $this->pword)) {
        session_start();
        $_SESSION['auth'] = true;
        $_SESSION['userobj'] = $this->uname;
        $_SESSION['fname'] = $this->fname;
        $this->authorisation->setAuthorisations($this->uname);
        header("Location: http://localhost/mitems/index.php");
        session_write_close();
    }else{
        session_start();
        $_SESSION['login_fail'] = true;
        header("Location: http://localhost/mitems/View/php/login.php");

    }

   }

   public function logout() {
    session_start();
    session_unset();
   }
}
