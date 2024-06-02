<?php
require_once(__DIR__ . "/dbconnect.php");


class UserRegister extends DataBaseConnection
{

    private $mail;
    private $username;
    private $password;
    private $repeatedPassword;


    public function __construct(
        string $mail,
        string $username,
        string $password,
        string $repeatedPassword


    ) {
        $this->mail = $mail;
        $this->username = $username;
        $this->password = $password;
        $this->repeatedPassword = $repeatedPassword;
    }



    public function checkPassword(): bool {

        if (($this->password == $this->repeatedPassword) && strlen($this->password) >= 8){
            return true;
        } else return false;

    }

    public function checkUsername(): bool{

        $db = new DataBaseConnection();
        $dbConnected =  $db->openDBConnection();
        $query = 'SELECT 1 FROM Uzytkownicy WHERE Username = :username';
        $stmt = $dbConnected->prepare($query);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        $db->closeDBConnection();

        var_dump($count);

       return ($count != 1 && strlen($this->username) >= 3);
       


    }

    public function checkMail(): bool{
        $db = new DataBaseConnection();
        $dbConnected =  $db->openDBConnection();
        $query = 'SELECT 1 FROM Uzytkownicy WHERE Mail = :mail';
        $stmt = $dbConnected->prepare($query);
        $stmt->bindParam(':mail', $this->mail, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        $db->closeDBConnection();

        var_dump($count);

       
       return $count != 1;


    }

    public function registerUser()
    {
        $db = new DataBaseConnection();
        $dbConnected =  $db->openDBConnection();


        $query = 'INSERT INTO Uzytkownicy (Mail, Username, Password, is_blocked) 
    VALUES (:mail, :username, :password, 0)';
        $stmt = $dbConnected->prepare($query);

        $filtered_mail = filter_var($this->mail, FILTER_VALIDATE_EMAIL);
        $filtered_password = password_hash($this->password, PASSWORD_DEFAULT);


        $stmt->bindParam(':mail', $filtered_mail, PDO::PARAM_STR);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $filtered_password, PDO::PARAM_STR);


        if ($this->checkMail() && $this->checkUsername() && $this->checkPassword()) {
            $stmt->execute();
            var_dump( $filtered_password);
            echo "User Registered!";
        } else {
            echo "Please enter proper data into the fields.";
        }

        var_dump($this->checkMail());
        var_dump($this->checkPassword());
        var_dump($this->checkUsername());

       

        $db->closeDBConnection();
    }
}
