<?php
include('database/connection.php');
$visitor_query = "DELETE FROM users_visitors WHERE last_visit < (NOW() - INTERVAL 1 HOUR)";
$visitor_result = mysqli_query($db_connect, $visitor_query);
echo $visitor_result;

$dead_fish_query = "DELETE FROM users_fish WHERE lastFed < (NOW() - INTERVAL 3 DAY)";
$dead_fish_result = mysqli_query($db_connect, $dead_fish_query);

echo $dead_fish_result;
?>