<?php
error_reporting(E_ALL);

// Zum Aufbau der Verbindung zur Datenbank

// Zum Aufbau der Verbindung zur Datenbank
// die Daten erhalten Sie von Ihrem Provider
define ( 'MYSQL_HOST',      'localhost' );

// bei XAMPP ist der MYSQL_Benutzer: root
define ( 'MYSQL_BENUTZER',  'root' );
define ( 'MYSQL_KENNWORT',  '' );

//Unsere Datenbank aquaweb
define ( 'MYSQL_DATENBANK', 'aquaweb' );

$db_connect= mysqli_connect (MYSQL_HOST, MYSQL_BENUTZER,  MYSQL_KENNWORT,  MYSQL_DATENBANK);

if ( $db_connect)
{
    echo 'Verbindung erfolgreich: '."<br>";
    

    $abfrage = "SELECT * FROM fish";

    $result = mysqli_query($db_connect,$abfrage);

    while($row = mysqli_fetch_assoc($result)){
    echo $row["id"] . ", " .
        $row["name"] . ", " .
        $row["price"] . " <br> " .
        "";
    }
  
}


?>