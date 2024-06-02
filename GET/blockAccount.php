<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="GET">

        <input type = "text" name = "user_id" value = <?php $movieName; ?>>
        <input type = "submit" name = "submitButton" value = "Block">

</form>
<?php 
	header("Access-Control-Allow-Origin: *"); // Replace '*' with the specific origin if needed
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type"); 
require_once(__DIR__ . "/../logic/BlockAccount.php");

    if (isset($_GET['submitButton'])){
       $userID = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);
       var_dump($userID);
        if ($userID === false) {
            echo "Incorrect ID"; } else {
        $blockUser = new BlockAccount($userID);
        print_r($blockUser->blockAccount($userID));
            }
    }
 

    ?>

</body>
</html>