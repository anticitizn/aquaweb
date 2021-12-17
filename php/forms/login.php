<?php 
session_start();
$pdo = new PDO('mysql:host=51.15.100.196;dbname=aquaweb', 'aquaweb', 'webaqua123');
$indexphp = '../';
$user = null;
$LoginPassword = null;

if(isset($_GET['login'])) {
    $LoginUsername = $_POST['LoginUsername'];
    $LoginPassword = $_POST['LoginPassword'];
    
    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $result = $statement->execute(array('LoginUsername' => $LoginUsername));
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
        <?php 
            if(isset($errorMessage)) {
                echo $errorMessage;
            }
            echo '<div class="form">';
            //check password
            if(isset($user) && isset($LoginPassword)){
                if ($user !== false && password_verify($LoginPassword, $user['LoginPassword'])) {
                    $_SESSION['userid'] = $user['id'];
                    header('Location: /tinf20-aquaweb/php/aquarium.php');
                }
            }
        ?>
        <?php
        $showFormular = true; //Variable ob das Registrierungsformular angezeigt werden soll

            $error = false;
            $registerUsername = $_POST["registerUsername"];
            $registerPassword = $_POST["registerPassword"];
            $registerPassword2 = $_POST["registerPassword2"];

            if(strlen($registerPassword) == 0) {
                echo '<p>Bitte ein Passwort angeben</p>';
                $error = true;
            }
            if(($registerPassword != $registerPassword2) && (strlen($registerPassword2) == 0)){
                echo 'Die Passwörter müssen übereinstimmen<br>';
                $error = true;
            }

            //check if username is already registered
            if(!$error) {
                $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
                $result = $statement->execute(array('username' => $registerUsername));
                $user = $statement->fetch();

                if($user !== false) {
                    echo '<p>Diese Benutzername ist bereits vergeben ist bereits vergeben</p>';
                    $error = true;
                }
            }

            //no errors -> user will be registered
            if(!$error) {
                $password_hash = password_hash($registerPassword, PASSWORD_DEFAULT);

                $statement = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $result = $statement->execute(array('username' => $registerUsername, 'password' => $password_hash));

                if($result) {
                    echo '<p>Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a></p>';
                    $showFormular = false;
                } else {
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
                }
            }

        if($showFormular) {
        ?>
        <!--
        <div class="loginBox">
            <h3>Sign In</h3>
            <form action="?login=1" method="post">
                <div class="inputBox">
                    <label for="userName"></label><input id="userName" type="text" name="username" placeholder="Username" />
                    <label for="password"></label><input id="password" type="password" name="password" placeholder="Password" />
                </div>
                <input type="submit" value="Login">
            </form>
            <div class="text-center">
                <a href="register.php">Sign-Up</a>
            </div>
        </div>
        -->
        <div>
            <form action="?login=1" method="post">
                <a href="https://front.codes/" class="logo" target="_blank"> <img src="https://assets.codepen.io/1462889/fcy.png" alt=""> </a>
                <div class="section">
                    <div class="container">
                        <div class="row full-height justify-content-center">
                            <div class="col-12 text-center align-self-center py-5">
                                <div class="section pb-5 pt-5 pt-sm-2 text-center">
                                    <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6> <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" /> <label for="reg-log"></label>
                                    <div class="card-3d-wrap mx-auto">
                                        <div class="card-3d-wrapper">
                                            <div class="card-front">
                                                <div class="center-wrap">
                                                    <div class="section text-center">
                                                        <h4 class="mb-4 pb-3">Log In</h4>
                                                        <div class="form-group"> <input type="text" name="LoginUsername" class="form-style" placeholder="Your Username" id="userName" autocomplete="off"> <i class="input-icon uil uil-at"></i> </div>
                                                        <div class="form-group mt-2"> <input type="password" name="LoginPassword" class="form-style" placeholder="Your Password" id="password" autocomplete="off"><i class="input-icon uil uil-lock-alt"></i> </div>
                                                        <input type="submit" value="Submit" class="btn mt-4"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-back">
                                                <div class="center-wrap">
                                                    <div class="section text-center">
                                                        <h4 class="mb-4 pb-3">Sign Up</h4>
                                                        <div class="form-group"> <input type="text" name="registerUsername" class="form-style" placeholder="Your Username" id="logname" autocomplete="off"> <i class="input-icon uil uil-user"></i> </div>
                                                        <div class="form-group mt-2"> <input type="password" name="registerPassword" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off"> <i class="input-icon uil uil-at"></i> </div>
                                                        <div class="form-group mt-2"> <input type="password" name="registerPassword2" class="form-style" placeholder="Your Password Again" id="logpass" autocomplete="off"> <i class="input-icon uil uil-lock-alt"></i></div>
                                                        <input type="submit" value="Submit" class="btn mt-4"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
            <?php
        }
        ?>
    </main>

    <footer>
        <?php include('../templates/footer.php');?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>