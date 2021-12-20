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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/style.css">
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
            if (isset($_GET['register'])) {
                $error = false;
                $username = $_POST["username"];
                $password = $_POST["password"];
                $password2 = $_POST["password2"];

                // checks password length
                if (strlen($password) == 0) {
                    echo '<p>Please enter password</p>';
                    $error = true;
                }

                // checks passwords are equal
                if ($password != $password2){
                    echo 'Passwords musst be euqals.<br>';
                    $error = true;
                }

                //check if username is allready registered
                if (!$error) { 
                    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
                    $result = $statement->execute(array('username' => $username));
                    $user = $statement->fetch();

                    // popup message if username is already used
                    if ($user != null) {
                        echo '
                        <script> alert("Username is allreadey in use."); </script>
                        ';
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
                        // allerts register faild mmessage
                        echo '<script> alert("Somthing went wrong. Please try again later."); </script>';
                    }
                } 
            }

            // check if registerform has to be shown
            if($showFormular) {
        ?>
                <div class="container-fluid vh-100" style="margin-top:300px">
                    <div class="" style="margin-top:200px">
                        <div class="rounded d-flex justify-content-center">
                            <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
                                <div class="text-center">
                                    <h3 class="text-primary">Register In</h3>
                                </div>
                                <form action="?register=1" method="post">
                                    <div class="p-4">
                                        <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                                class="bi bi-person-plus-fill text-white"></i></span>
                                            <label>
                                                <input name="username" type="text" class="form-control" placeholder="Username">
                                            </label>
                                        </div>
                                        <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                                class="bi bi-key-fill text-white"></i></span>
                                            <label>
                                                <input name="password" type="password" class="form-control" placeholder="Password">
                                            </label>
                                        </div>
                                        <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                                class="bi bi-key-fill text-white"></i></span>
                                            <label>
                                                <input name="password2" type="password" class="form-control" placeholder="Repeat password">
                                            </label>
                                        </div>
                                        <button class="btn btn-primary text-center mt-2" type="submit">
                                            Register
                                        </button>
                                        <p class="text-center mt-5 text-secondary">You have an account?
                                            <span class="text-primary">Log In</span>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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