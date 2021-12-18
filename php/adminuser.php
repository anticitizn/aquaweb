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
    // adds ne user if add button was hit
    if(isset($_GET["add"]) && $_GET["add"] == 1) {
        $password_hash = password_hash($_POST["addpassword"], PASSWORD_DEFAULT);
        $request = "INSERT INTO users (username, password, creation_date, balance) VALUE ('". $_POST["addusername"] ."', '". $password_hash ."', now(), " . $_POST["addbalance"] . ")";
        $result = mysqli_query($db_connect, $request);
    }

    // itterates through all users
    $statement = "SELECT * FROM users";
    $response = mysqli_query($db_connect, $statement);
    while ($row = mysqli_fetch_assoc($response)) {
        $update = $row["id"] . "update";
        $delete = $row["id"] . "delete";
        $balance = $row["id"] . "balance";
        $id = $row["id"] . "id";
        $username = $row["id"] . "username";
        $password = $row["id"] . "password";
        if (isset($_POST[$password])) {
            if ($_POST[$password] != ""){
                $password_hash = password_hash($_POST[$password], PASSWORD_DEFAULT);
            }
        }
        // updates the correct user with the new values
        if(isset($_GET[$update]) && $_GET[$update] == 1) {
            if(isset($password_hash)){
                $request = "UPDATE users SET username='". $_POST[$username] ."', password='". $password_hash ."', balance=". $_POST[$balance] ." WHERE id=". $_POST[$id] ."";
            } else {
                $request = "UPDATE users SET username='". $_POST[$username] ."', balance=". $_POST[$balance] ." WHERE id=". $_POST[$id] ."";
            }
            $result = mysqli_query($db_connect, $request);
        }

        //deletes the correct users
        if(isset($_GET[$delete]) && $_GET[$delete] == 1) {
            $request = "DELETE FROM users WHERE id=". $_POST[$id] ."";
            $result = mysqli_query($db_connect, $request);
        }
    }
    ?>
    
    <main>
        <h1><a href="/tinf20-aquaweb/php/adminuser.php">User administration</h1></a>
        <div class="articles">
            <table>
                <tr>
                    <td>
                        <!-- form to add a new user -->
                        <form id="formaddfisharticle" action="?add=1" method="post">
                            <table>
                                <tr>
                                    <td class="label-column"><label for="addusername">Userame:</label></td>
                                    <td><input type="name" id="addusername" name ="addusername"></td>
                                </tr>
                                <tr>
                                    <td class="label-column"><label for="addpassword">Password:</label></td>
                                    <td><input type="password" id="addpassword" name ="addpassword" value=""></td>
                                </tr>
                                <tr>
                                    <td class="label-column"><label for="addbalance">Balance:</label></td>
                                    <td><input type="number" id="addbalance"name ="addbalance"></td>
                                </tr>
                                <tr>
                                    <td class="label-column"></td>
                                    <td><button type="submit" id="add" class="add-button">Add!</button> 
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
                <?php
                    // generates the filtered userforms
                    if ($db_connect) {
                    $request = "SELECT * FROM users";
                    $result = mysqli_query($db_connect, $request);
                    while ($row = mysqli_fetch_assoc($result)) {?>
                        <tr>
                            <td>
                                <div class="fishdescription">
                                    <form id=<?php echo $row["id"] . "formupdatefisharticle"; ?> action="?<?php echo $row['id'];?>update=1" method="post">
                                        <table>
                                            <tr >
                                                <td class="label-column" ><label for="id" >ID:</label></td>
                                                <td ><input type="id" id=<?php echo $row["id"] . "id"; ?> name ="<?php echo $row['id'];?>id" value=<?php echo $row["id"]?> readonly></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"><label for=<?php echo $row["id"] . "-username"?> >Name:</label></td>
                                                <td><input type="name" id=<?php echo $row["id"] . "username"; ?> name ="<?php echo $row['id'];?>username" value=<?php echo $row["username"]?>></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"><label for="<?php echo $row["id"] . "-password"; ?>">Password:</label></td>
                                                <td><input type="password" id=<?php echo $row["id"] . "password"; ?> name ="<?php echo $row['id'];?>password" value=""></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"><label for="<?php echo $row["id"] . "-balance";?>">Balance:</label></td>
                                                <td><input type="number" id=<?php echo $row["id"] . "balance"; ?> name ="<?php echo $row['id'];?>balance" value=<?php echo $row["balance"]?>></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"></td>
                                                <td><button type="submit" id=<?php echo $row["id"] . "update"; ?> class="update-button">Update!</button> 
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <form id=<?php echo $row["id"] . "formdeletefisharticle"; ?> action="?<?php echo $row['id'];?>delete=1" method="post">
                                    <label for="id" hidden>ID:</label>
                                    <input type="id" id=<?php echo $row["id"] . "-id"; ?> name ="<?php echo $row['id'];?>id" value=<?php echo $row["id"]?> readonly hidden>
                                    <button type="submit" id=<?php echo $row["id"] . "-delete"; ?> class="delete-button">Delete!</button> 
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                }
                ?>
            </table>
        </div>

    </main>

    <?php // imports footer
        include('templates/footer.php');
    ?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>