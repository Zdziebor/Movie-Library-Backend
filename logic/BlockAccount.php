<?php
require_once(__DIR__ . "/dbconnect.php");


class BlockAccount extends DataBaseConnection
{



    private $accountID;


    public function __construct(int $accountID) {
     
        $this->accountID = $accountID;

    }

    public function blockAccount()
{
    $db = new DataBaseConnection();
     $dbConnected =  $db->openDBConnection();


    $query = 'UPDATE Uzytkownicy SET is_blocked = 1 WHERE User_ID = :userID';

   $stmt = $dbConnected->prepare($query);



   $stmt->bindParam(':userID', $this->accountID, PDO::PARAM_INT);

    $stmt->execute();



    $db->closeDBConnection();
    

  
}
}