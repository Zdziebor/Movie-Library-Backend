<?php


require_once(__DIR__ . "/dbconnect.php");

class DeleteMovie extends DataBaseConnection {
    
private $movieID;



public function __construct(int $movieID)
{
    $this->movieID = $movieID;
   

  
 
}

function delete(int $movieID)
{
 
   $db = new DataBaseConnection();
   $dbConnected = $db->openDBConnection();

    $query = 'DELETE FROM Film WHERE Film_id = :id';
    $stmt = $dbConnected->prepare($query);

    $stmt->bindParam(':id', $movieID, PDO::PARAM_INT);


    $stmt->execute();


}

}