<?php 
	header("Access-Control-Allow-Origin: *"); // Replace '*' with the specific origin if needed
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once(__DIR__ . "/../logic/AddMovie.php");


function addMovie($data) {
    $movieTitle = $data["Tytul"];
    $movieYear = $data["Rok_Produkcji"];
    $movieCategory = $data["Kategoria"];
    $movieBrutality = $data["Brutalnosc"];
    $movieType = $data["Typ"];

    $movieRating = filter_var($data["Ocena"], FILTER_VALIDATE_FLOAT);
    $movieViews = filter_var($data["Wyswietlenia"], FILTER_VALIDATE_FLOAT);
    $movieRevenue = filter_var($data["Przychod"], FILTER_VALIDATE_FLOAT);

    if ($movieRating === false) {
        $movieRating = null;
    }

    if ($movieViews === false) {
        $movieViews = null;
    }

    if ($movieRevenue === false) {
        $movieRevenue = null;
    }

    if (!empty($movieTitle)) {
        $movie = new AddMovie($movieTitle, $movieYear, $movieCategory, $movieBrutality, $movieType, $movieRating, $movieViews, $movieRevenue);
        var_dump($movieRating);
        var_dump($movieViews);
        var_dump($movieRevenue);
        var_dump($movie);
        $movie->addMovie();
    } else {
        echo "Movie Name cannot be empty";
    }
}

// Retrieve the JSON data from the request body
$jsonData = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($jsonData, true); // Use true to get an associative array

// Call your existing function with the decoded data
addMovie($data);
?>