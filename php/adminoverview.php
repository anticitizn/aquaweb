<?php
// starts session
session_start();
$indexphp = '';
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
    <?php // imports header
        include('templates/header.php');
    ?>
<main>
<div class="headline">
    <a href="/tinf20-aquaweb/php/adminoverview.php"><h1>Administration</h1></a>
</div>
<table>
    <tr>
        <!-- links to the administrative sides -->
        <td><a class="nav-link active" href="adminfish.php">Administrate the fishes.</a></td>
        <td><a class="nav-link active" href="adminuser.php">Administrate the users.</a></td>
    </tr>
</table>
</main>
<?php // imports footer
    include('templates/footer.php');
?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/aquariumAnimation.js"></script>

</body>
</html>
