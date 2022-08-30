<?php
class Database {
        private $dsn;
        private $username;
        private $password;

        private function getDatabaseCredentials() {
            $config = parse_ini_file('C:/xampp/htdocs/mitems/private/config.ini');

            $this->dsn = $config['dsn'];
            $this->username = $config['username'];
            $this->password = $config['password'];
        }

        public function connectToDatabase(){
            $this->getDatabaseCredentials(); 
            $conn = odbc_connect($this->dsn,$this->username,$this->password);
           
            if (!$conn)
            {
                
            }
            else
            {
                return $conn;
            }
  
        }

}