<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="GET">

        <input type = "text" name = "Film_id" value = <?php $movieName; ?>>
        <input type = "submit" name = "submitButton" value = "Delete">

</form>

<?php 
	header("Access-Control-Allow-Origin: *"); // Replace '*' with the specific origin if needed
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require_once(__DIR__ . "/../logic/DeleteMovie.php");

    if (isset($_GET['submitButton'])){
       // $movieID = $_GET['Film_id'];
       $movieID = filter_input(INPUT_GET, 'Film_id', FILTER_VALIDATE_INT);
       var_dump($movieID);
        if ($movieID === false) {
            echo "Incorrect ID"; } else {
        $searchMovie = new DeleteMovie($movieID);
        print_r($searchMovie->delete($movieID));
            }
    }
 

    ?>

</body>
</html>