<?php
session_start();
$indexphp = '';
$ip = $_SERVER['REMOTE_ADDR'];

$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$link_user_id = $params['user'];

// check if this IP has already visited the aquarium in the last hour
$ip_bin = inet_pton($ip);
$query = "SELECT * FROM users_visitors WHERE user_id = $link_user_id AND ip = $ip_bin";
$result = mysqli_query($db_connect, $query);

// if IP hasn't visited in the last hour, add money to the user and log the visit
if (mysqli_num_rows($result) < 1)
{
    $request = "UPDATE users SET balance = balance + 100 WHERE id=$link_user_id";
    $result = mysqli_query($db_connect, $request);
}
?>

<!DOCTYPE html>
<html xml:lang="en" lang="en">

<head>
	<title>AquaWeb</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/vnd.microsoft.icon" href="http://test.anticitizen.space/favicon.ico">  <!--Favicon wird aktuell von Daniels Test-Server gezogen-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<?php include('templates/header.php');?>
<button class="btn btn-primary" type="button">Feed!</button>
<main>
<?php
echo $link_user_id;
echo "\n";
echo $ip;
?>
<div id="aquariumContainer">
    <?php
        if (isset($link_user_id) && $link_user_id !== "")
        {
            $query = "SELECT * FROM users_fish WHERE users_id = $link_user_id";
            $result = mysqli_query($db_connect, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $imgurl = '../assets/images/' . $row['fish_id'] . '.png';
                echo '<div class="fish">';
                echo '<img src="' . $imgurl . '">';
                echo '</div>';
            }
        }
        else
        {
            echo '<div class="fish">';
            include('../assets/images/fish.svg');
            echo '</div>';
        }
    ?>
    
</div>
</main>

<?php include('templates/footer.php');?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="../js/aquariumAnimation.js"></script>

</body>
</html>
