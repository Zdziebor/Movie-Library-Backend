<?php

require_once(__DIR__ . "/dbconnect.php");

class SearchMovie extends DataBaseConnection {
private $partialName;
private $year;
private $genre;
private $limit;


public function __construct(string $partialName = "", string $year = "", string $genre = "", int $limit = 5 )
{
    $this->partialName = $partialName;
    $this->year = $year;
    $this->genre = $genre;
    $this->limit = $limit;
 
}


function search(int $page) 
{
 
    $db = new DataBaseConnection();
   $dbConnected = $db->openDBConnection();

    $query = 'SELECT * FROM Film WHERE Tytul LIKE :title AND Kategoria LIKE :category AND Rok_Produkcji LIKE :year LIMIT :limit OFFSET :offset';
    $stmt = $dbConnected->prepare($query);

    $titlePattern = "%". $this->partialName . "%";
    $yearPattern = $this->year . "%";
    $categoryPattern = "%". $this->genre . "%";
    $offsetValue = ($page - 1) * $this->limit; 


    $stmt->bindParam(':title', $titlePattern, PDO::PARAM_STR);
    $stmt->bindParam(':category', $categoryPattern, PDO::PARAM_STR);
    $stmt->bindParam(':year', $yearPattern, PDO::PARAM_STR);
    $stmt->bindParam(':limit', $this->limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offsetValue, PDO::PARAM_INT);

    $stmt->execute();

    $top_json = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);

    return $top_json;
}

}