<?php

require_once(__DIR__ . "/dbconnect.php");

class TopMovies extends DataBaseConnection
{


    private $ratingType;
    private $limit;
    private $sortType;

    public function __construct(string $ratingType, string $sortType, int $limit)
    {
        $this->ratingType = $ratingType;
        $this->sortType = $sortType;
        $this->limit = $limit;
    }

    public function getTopRecord(int $page) : string
    {
        $db = new DataBaseConnection();
        $dbConnected = $db->openDBConnection();

        $queryViewsASC = 'SELECT * From Film WHERE Wyswietlenia IS NOT NULL ORDER BY Wyswietlenia ASC LIMIT :limit OFFSET :offset';
        $queryViewsDESC = 'SELECT * From Film WHERE Wyswietlenia IS NOT NULL ORDER BY Wyswietlenia DESC LIMIT :limit OFFSET :offset';

        $queryRatingASC = 'SELECT * From Film WHERE Ocena IS NOT NULL ORDER BY Ocena ASC LIMIT :limit OFFSET :offset';
        $queryRatingDESC = 'SELECT * From Film WHERE Ocena IS NOT NULL ORDER BY Ocena DESC LIMIT :limit OFFSET :offset';

        $queryIncomeASC = 'SELECT * From Film WHERE Przychod IS NOT NULL ORDER BY Przychod ASC LIMIT :limit OFFSET :offset';
        $queryIncomeDESC = 'SELECT * From Film WHERE Przychod IS NOT NULL ORDER BY Przychod DESC LIMIT :limit OFFSET :offset';

        $queryDefault = 'SELECT * From Film WHERE Wyswietlenia IS NOT NULL ORDER BY Wyswietlenia ASC LIMIT :limit OFFSET :offset';

        
        switch ($this->ratingType){
            case 'Wyswietlenia':
                $stmt = $dbConnected->prepare($this->sortType == 'ASC' ? $queryViewsASC : $queryViewsDESC);
            break;

            case 'Ocena':
                $stmt = $dbConnected->prepare($this->sortType == 'ASC' ? $queryRatingASC : $queryRatingDESC);
                break;

            case 'Przychod':
                $stmt = $dbConnected->prepare($this->sortType == 'ASC' ? $queryIncomeASC : $queryIncomeDESC);
                break;
            default:
            $stmt =  $dbConnected->prepare($queryDefault);
        }

        $offsetValue = ($page - 1) * $this->limit; 

        $stmt->bindParam(':limit', $this->limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offsetValue, PDO::PARAM_INT);

 
        $stmt->execute();


       return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
    }
}
