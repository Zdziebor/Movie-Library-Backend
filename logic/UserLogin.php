<?php
require_once(__DIR__ . "/dbconnect.php");

class UserLogin extends DataBaseConnection
{
    private $username;
    private $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticateUser(): bool
    {
        $db = new DataBaseConnection();
        $dbConnected = $db->openDBConnection();

        $query = 'SELECT Password FROM Uzytkownicy WHERE Username = :username';
        $stmt = $dbConnected->prepare($query);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->execute();
        $storedPassword = $stmt->fetchColumn();

        $db->closeDBConnection();

        if ($storedPassword !== false && password_verify($this->password, $storedPassword) && $this->isUserBlocked() === false) {
        
            $this->setLoginCookie();
            return true; // Authentication successful
        } else {
            return false; // Authentication failed
        }
    }

    public function isUserBlocked() : bool{
        $db = new DataBaseConnection();
        $dbConnected = $db->openDBConnection();

        $query = 'SELECT is_blocked FROM Uzytkownicy WHERE Username = :username';
        $stmt = $dbConnected->prepare($query);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->execute();

        $userRole = $stmt->fetchColumn();

        if ($userRole == "0"){
            return false;
        } else {
            return true;
        }

    }

    public function getUserRole(): string
    {

        $db = new DataBaseConnection();
        $dbConnected = $db->openDBConnection();

        $query = 'SELECT role FROM Uzytkownicy WHERE Username = :username';
        $stmt = $dbConnected->prepare($query);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->execute();
        $userRole = $stmt->fetchColumn();

        return $userRole;
    }

    private function setLoginCookie()
    {

        switch ($this->getUserRole()) {
            case "user":
                $cookieName = "role_user";
                $cookieValue = base64_encode($this->username); // You can encode the username or use a unique identifier
                $cookieExpiration = time() + (86400 * 30); // 30 days
                setcookie($cookieName, $cookieValue, $cookieExpiration, "/");
                break;
            case "admin":
                $cookieName = "role_admin";
                $cookieValue = base64_encode($this->username); // You can encode the username or use a unique identifier
                $cookieExpiration = time() + (86400 * 30); // 30 days
                setcookie($cookieName, $cookieValue, $cookieExpiration, "/");
                break;
            case "moderator":
                $cookieName = "role_moderator";
                $cookieValue = base64_encode($this->username); // You can encode the username or use a unique identifier
                $cookieExpiration = time() + (86400 * 30); // 30 days
                setcookie($cookieName, $cookieValue, $cookieExpiration, "/");
        }
    }


}

// Example usage:
// $username = "username1"; // Replace with actual username
// $password = "password1"; // Replace with actual password

// $login = new UserLogin($username, $password);

// var_dump($login->isUserBlocked());


// if ($login->authenticateUser()) {
//     echo "Login successful!";
// } else {
//     echo "Login failed. Please check your username and password.";
// }

