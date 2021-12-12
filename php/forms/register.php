<?php

session_start();
$pdo = new PDO('mysql:host=51.15.100.196;dbname=aquaweb', 'aquaweb', 'webaqua123');

?>

<!DOCTYPE html>
<html xml:lang="en" lang="en">

<head>
	<title>AquaWeb</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/register-login.css">
    <link rel="icon" type="image/vnd.microsoft.icon" href="http://test.anticitizen.space/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php include('../templates/header.php');?>
    <main>
        <h1>Registrierung</h1>

        <?php
            $showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

            if(isset($_GET['register'])) {
                $error = false;
                $username = $_POST["username"];
                $password = $_POST["password"];
                $password2 = $_POST["password2"];

                if(strlen($password) == 0) {
                    echo '<p>Bitte ein Passwort angeben</p>';
                    $error = true;
                }
                if(($password != $password2) && (strlen($password2) == 0)){
                    echo 'Die Passwörter müssen übereinstimmen<br>';
                    $error = true;
                }

                //check if username is allready registered
                if(!$error) { 
                    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
                    $result = $statement->execute(array('username' => $username));
                    $user = $statement->fetch();

                    if($user !== false) {
                        echo '<p>Diese Benutzername ist bereits vergeben ist bereits vergeben</p>';
                        $error = true;
                    }
                }

                //no errors -> user will be registered
                if(!$error) {    
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);

                    $statement = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                    $result = $statement->execute(array('username' => $username, 'password' => $password_hash));

                    if($result) {        
                        echo '<p>Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a></p>';
                        $showFormular = false;
                    } else {
                        echo '<p>Beim Abspeichern ist leider ein Fehler aufgetreten</p>';
                    }
                } 
            }

            if($showFormular) {
        ?>
        <div class="form">
            <form action="?register=1" method="post">
                <p>Benutzername:</p>
                <input type="text" size="40" maxlength="250" name="username"><br><br>
                <p>Dein Passwort:</p>
                <input type="password" size="40"  maxlength="250" name="password"><br>
                <p>Passwort wiederholen:</p>
                <input type="password" size="40" maxlength="250" name="password2"><br><br>
                <input type="submit" value="Registrieren">
            </form>
        </div>
        <?php
            }
        ?>
    </main>
    <?php include('../templates/footer.php');?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>

<!--

	
<?php ?>
/*
session_start();
if(!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}
 
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
 
?>
-->