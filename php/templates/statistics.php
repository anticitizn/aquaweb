<?php
require_once("php/database/connection.php");
$abfrage = "SELECT * FROM fish";

$result = mysql_query($abfrage);

while($row = mysqli_fetch_assoc($result)){
echo $row["id"] . ", " .
    $row["name"] . ", " .
    $row["price"] . ", " .
    "";
}

mysql_close($db_connection);
?>