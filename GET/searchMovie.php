<?php 
	header("Access-Control-Allow-Origin: *"); // Replace '*' with the specific origin if needed
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require_once(__DIR__ . "/../logic/Searchmovie.php");


        $movieName = $_GET['Tytul'];
        $movieYear = $_GET['Rok_Produkcji'];
        $movieGenre = $_GET['Kategoria'];
       $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
       $page = filter_input(INPUT_GET, 'strona', FILTER_VALIDATE_INT);

       if ($limit === false){
        $limit = 20;
  
       }

       if ($page === false){
        
        $page = 1;
       }



     
        $searchMovie = new SearchMovie($movieName, $movieYear, $movieGenre, $limit);
        $result = $searchMovie->search($page);
        print_r($result);
      

 

    ?>
