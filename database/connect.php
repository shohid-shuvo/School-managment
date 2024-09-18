<?php
// session_start();
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'oop_db');

class DB_Conn{

    public $dbStore;

    function __construct(){
                $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
                $this->dbStore = $conn;
            }

    // message for DATABASE connection 
    public function connectionMessage(){

                if (mysqli_connect_error()) {
                    $resullt = "database connection fail " . mysqli_connect_error();
                }else{
                    $resullt =  "Database Connection Succesfull";
                }
        return $resullt;
    }

    // insert data from SIGN UP page
    
    public function insertData($name, $email, $phone, $user_name, $has_pass, $regDate, $emailOtp, $isEmailVerify, $lastUpdationDate){
        $sql = mysqli_query($this->dbStore, "INSERT INTO sdl_user(name, email, phone, user_name, has_pass, regDate, emailOtp, isEmailVerify, lastUpdationDate) VALUES
        ('$name', '$email', '$phone', '$user_name', '$has_pass', '$regDate', '$emailOtp', '$isEmailVerify', '$lastUpdationDate')") ;
        
        return $sql;
    }  
}
