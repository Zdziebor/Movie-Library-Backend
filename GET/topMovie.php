<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="get">
    
        <input type = "text" name = "ratingType" value = <?php $ratingType; ?>>
        <input type = "text" name = "sortType" value = <?php $sortType; ?>>
        <input type = "text" name = "limit" value = <?php $limit; ?>>
        <input type = "text" name = "page" value = <?php $page; ?>>
        <input type = "submit" name = "submitButton" value = "Search">
</form>
</body>
</html>

<?php 
	header("Access-Control-Allow-Origin: *"); // Replace '*' with the specific origin if needed
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require_once(__DIR__ . "/../logic/TopMovie.php");
if (isset($_GET['submitButton'])){
        $ratingType = $_GET['ratingType'];
        $sortType = $_GET['sortType'];
        $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);

        if ($limit === false){
            $limit = 5;
      
           }
    
           if ($page === false || $page == null){
            $page = 1;
           }
 
          
    $topMovie = new TopMovies($ratingType, $sortType, $limit);

       print_r ($topMovie->getTopRecord($page));
    }

?>
