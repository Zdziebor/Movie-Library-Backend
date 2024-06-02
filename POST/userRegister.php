<?php 
header("Access-Control-Allow-Origin: *"); // Replace '*' with the specific origin if needed
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type"); 

// require_once("C:/xampp/htdocs/projekt-grupowy/logic/UserRegister.php");
//require_once("C:/xampp/htdocs/projekt-grupowy/logic/dbconnect.php");
require_once(__DIR__ . "/../logic/UserRegister.php");

// The rest of your code remains unchanged
// echo __DIR__ . "/../logic/UserRegister.php";




    $mail = $_POST["mail"] ;
    $username = $_POST["username"] ;
    $password = $_POST["password"] ;
    $repeatedPassword = $_POST["repeatedPassword"] ;


    if (!empty($mail) && !empty($username) && !empty($password) && !empty($repeatedPassword) ) {
		if ($password == $repeatedPassword){
        $movie = new UserRegister($mail, $username, password_hash($password, PASSWORD_DEFAULT));
        $movie->registerUser();
		} else {
			echo "Password do not match";
		}
        
        

    } else {
        echo "Fields cannot be empty";
    }

?>
