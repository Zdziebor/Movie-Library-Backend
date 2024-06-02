<?php 
header("Access-Control-Allow-Origin: *"); // Replace '*' with the specific origin if needed
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require_once("../logic/UserLogin.php");
//require_once("C:/xampp/htdocs/projekt-grupowy/logic/dbconnect.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = new UserLogin($username, password_hash($password, PASSWORD_DEFAULT));

    var_dump($login->isUserBlocked());


if ($login->authenticateUser()) {
    echo "Login successful!";
} else {
    echo "Login failed. Please check your username and password.";
}


?>