<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Zum Aufbau der Verbindung zur Datenbank

// Zum Aufbau der Verbindung zur Datenbank
// die Daten erhalten Sie von Ihrem Provider
define ( 'MYSQL_HOST',      '51.15.100.196' );

// bei XAMPP ist der MYSQL_Benutzer: root
define ( 'MYSQL_BENUTZER',  'aquaweb' );
define ( 'MYSQL_KENNWORT',  'webaqua123' );

//Unsere Datenbank aquaweb
define ( 'MYSQL_DATENBANK', 'aquaweb' );

$db_connect= mysqli_connect (MYSQL_HOST, MYSQL_BENUTZER,  MYSQL_KENNWORT,  MYSQL_DATENBANK);

/*if ( $db_connect)
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
  
}*/


?>