<?php 
session_start();
$pdo = new PDO('mysql:host=51.15.100.196;dbname=aquaweb', 'aquaweb', 'webaqua123');
$indexphp = '../';
$user;
$password;

if(isset($_GET['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $result = $statement->execute(array('username' => $username));
    $user = $statement->fetch();
}

//<p>https://www.php-einfach.de/experte/php-codebeispiele/loginscript/</p>
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
        <h1>Login</h1>

        <?php 
            if(isset($errorMessage)) {
                echo $errorMessage;
            }
            echo '<div class="form">';
            //check password
            if(isset($user) && isset($password)){
                if ($user !== false && password_verify($password, $user['password'])) {
                    $_SESSION['userid'] = $user['id'];
                    header('Location: /tinf20-aquaweb/php/aquarium.php');
                }
            }
        ?>

            <form action="?login=1" method="post">
                <p>Benutzername:</p>
                <input type="text" size="40" maxlength="250" name="username"><br><br>

                <p>Dein Passwort:</p>
                <input type="password" size="40"  maxlength="250" name="password"><br>
                <br>
                <input type="submit" value="Anmelden">
            </form>
        </div>
    </main>

    <?php include('../templates/footer.php');?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>