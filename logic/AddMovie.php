<?php
require_once(__DIR__ . "/dbconnect.php");


class AddMovie extends DataBaseConnection
{


    private $movieTitle;
    private $movieYear;
    private $movieCategory;
    private $movieBrutality;
    private $movieType;
    private $movieRating;
    private $movieViews;
    private $movieRevenue;

    public function __construct(
        
        string $movieTitle,
        string $movieYear = null,
        string $movieCategory = null,
        string $movieBrutality = null,
        string $movieType = null,
        string $movieRating = null,
        string $movieViews = null,
        string $movieRevenue = null,
        
       
    ) {
        $this->movieTitle = $movieTitle;
        $this->movieYear = $movieYear;
        $this->movieCategory = $movieCategory;
        $this->movieBrutality = $movieBrutality;
        $this->movieType = $movieType;
        $this->movieRating = $movieRating;
        $this->movieViews = $movieViews;
        $this->movieRevenue = $movieRevenue;

    }

    public function addMovie()
{
    $db = new DataBaseConnection();
   $dbConnected =  $db->openDBConnection();


    $query = 'INSERT INTO Film (Tytul, Rok_Produkcji, Kategoria, Brutalnosc, Typ, Ocena, Wyswietlenia, Przychod) 
    VALUES (:title, :year, :category, :brutality, :type, :rating, :views, :revenue)';

    $stmt = $dbConnected->prepare($query);



    $stmt->bindParam(':title', $this->movieTitle, PDO::PARAM_STR);
    $stmt->bindParam(':year', $this->movieYear, PDO::PARAM_STR);
    $stmt->bindParam(':category', $this->movieCategory, PDO::PARAM_STR);
    $stmt->bindParam(':brutality', $this->movieBrutality, PDO::PARAM_STR);
    $stmt->bindParam(':type', $this->movieType, PDO::PARAM_STR);
    $stmt->bindParam(':rating', $this->movieRating, PDO::PARAM_INT);
    $stmt->bindParam(':views', $this->movieViews, PDO::PARAM_INT);
    $stmt->bindParam(':revenue', $this->movieRevenue, PDO::PARAM_INT);

    $stmt->execute();



    $db->closeDBConnection();
    

  
}
}