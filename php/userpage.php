<?php
    // starts session
    session_start();
    $indexphp = '';
?>

<!DOCTYPE html>
<html xml:lang="en" lang="en">

    <head>
        <title>AquaWeb</title>
        <meta http-equiv="content-type" content="text/html;charset=utd-8" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/shop.css">
        <link rel="icon" type="image/vnd.microsoft.icon" href="http://test.anticitizen.space/favicon.ico">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <!--Favicon wird aktuell von Daniels Test-Server gezogen-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <?php // imports header
            include('templates/header.php');
        ?>

        <?php
            // gets userinformation for password validation (passwordold)
            $pdo = new PDO('mysql:host=51.15.100.196;dbname=aquaweb', 'aquaweb', 'webaqua123');
            $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
            $result = $statement->execute(array('id' => $_SESSION['userid']));
            $user = $statement->fetch();

            // if new password is entered correctly and old password is verified, the users password gets updated
            if(isset($_GET["update"]) && $_GET["update"] == 1) {
                if ((isset($_POST["passwordold"])) && (isset($_POST["password"])) && (isset($_POST["password2"]))) {
                    $passwordold = $_POST["passwordold"];
                    $password = $_POST["password"];
                    $password2 = $_POST["password2"];
    
                    if (($user != false) && (password_verify($passwordold, $user['password']))) {
                        if (($password2 != "") && ($password == $password2) && ($password != $passwordold)){
                            $password_hash = password_hash($password, PASSWORD_DEFAULT);
                        }
                    }
                }
                if(isset($password_hash)){
                    $request = "UPDATE users SET password='". $password_hash ."' WHERE id=". $_SESSION['userid'] ."";
                    $result = mysqli_query($db_connect, $request);
                } else {
                    // allerts register faild mmessage
                    echo '<script> alert("Please enter a correct old password and new password musst be both equals."); </script>';
                }
            }

            //deletes the correct users
            if(isset($_GET["delete"]) && $_GET["delete"] == 1) {
                $request = "DELETE FROM users WHERE id=". $_SESSION['userid'] ."";
                $result = mysqli_query($db_connect, $request);
                $request = "DELETE FROM users_fish WHERE users_id=". $_SESSION['userid'] ."";
                $result = mysqli_query($db_connect, $request);
                header('Location: /tinf20-aquaweb/php/forms/logout.php');
            }
        ?>

        <main>
            <h1><a href="/tinf20-aquaweb/php/userpage.php">User administration</a></h1>

            <!-- form to update user password -->
            <form id="formupdatepassword" action="?update=1" method="post">
                <table>
                    <tr>
                        <td class="label-column"><label for="passwordold">Verify with old password:</label></td>
                        <td><input type="password" id="passwordold" name ="passwordold" value=""></td>
                    </tr>
                    <tr>
                        <td class="label-column"><label for="password">New password:</label></td>
                        <td><input type="password" id="password" name ="password" value=""></td>
                    </tr>
                    <tr>
                        <td class="label-column"><label for="password2">Verify new password:</label></td>
                        <td><input type="password" id="password2" name ="password2" value=""></td>
                    </tr>
                    <tr>
                        <td class="label-column"></td>
                        <td><button type="submit" id="add" class="add-button">Set new password!</button> 
                    </tr>
                </table>
            </form>
            <!-- form to to delete user -->
            <form id="formdeletefisharticle" action="?delete=1" method="post">
                <button type="submit" id="delete" class="delete-button">Delete!</button> 
            </form>
        </main>
        <?php // imports footer
            include('../templates/footer.php');
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>

</html>

