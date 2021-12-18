<?php
// starts session
session_start();
$indexphp = '../';
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
    <?php // imports header
        include('../templates/header.php');
    ?>
    <main>
        <?php
            $showFormular = true; //Variable if Registrierform is shown

            // checks if register is triggerd
            if(isset($_GET['register'])) {
                $error = false;
                $username = $_POST["username"];
                $password = $_POST["password"];
                $password2 = $_POST["password2"];

                // checks password length
                if(strlen($password) == 0) {
                    echo '<p>Bitte ein Passwort angeben</p>';
                    $error = true;
                }

                // checks passwords are equal
                if(($password != $password2) && (strlen($password2) == 0)){
                    echo 'Die Passwörter müssen übereinstimmen<br>';
                    $error = true;
                }

                //check if username is allready registered
                if(!$error) { 
                    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
                    $result = $statement->execute(array('username' => $username));
                    $user = $statement->fetch();

                    // popup message if username is already used
                    if($user !== false) {
                        echo '<div id="registerError" class="modal fade">
                        <div class="modal-dialog modal-confirm">
                            <div class="modal-header">
                                <div class="icon-box">
                                    <i class="material-icons">&#xE5CD;</i>
                                </div>				
                                <h4 class="modal-title">Beim Abspeichern ist leider ein Fehler aufgetreten</h4>	
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Username is already taken</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                      </div>';
                        $error = true;
                    }
                }

                //no errors -> user will be registered
                if(!$error) {    
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);

                    $statement = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                    $result = $statement->execute(array('username' => $username, 'password' => $password_hash));

                    // shows register was succsessful message
                    if($result) {        
                        echo '<p>Your registry was succsessful. <a href="login.php">Please login.</a></p>';
                        $showFormular = false;
                    } else {
                        // shows register faild mmessage
                        echo '<div id="registerError" class="modal fade">
                                <div class="modal-dialog modal-confirm">
                                    <div class="modal-header">
                                        <div class="icon-box">
                                            <i class="material-icons">&#xE5CD;</i>
                                        </div>				
                                        <h4 class="modal-title">Something went wrong</h4>	
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Username is already taken</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
                                    </div>
                                </div>
                              </div>';
                    }
                } 
            }

            // check if registerform has to be shown
            if($showFormular) {
        ?>
                <div class="loginBox">
                    <h3>Register</h3>
                    <form action="?register=1" method="post">
                        <div class="inputBox">
                            <label for="userName"></label><input id="userName" type="text" name="username" placeholder="Username" />
                            <label for="password"><input id="password" type="password" name="password" placeholder="Password" />
                            <label for="password"></label><input id="password" type="password" name="password2" placeholder="Repeat password" />
                        </div>
                        <input type="submit" value="Register">
                    </form>
                </div>
        <?php
            }
        ?>
    </main>
    <?php // imports footer
        include('../templates/footer.php');
    ?>
    
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