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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/vnd.microsoft.icon" href="http://test.anticitizen.space/favicon.ico">
    <!--Favicon wird aktuell von Daniels Test-Server gezogen-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php // imports header
        include('templates/header.php');
    ?>

    <?php
    // adds ne fish if add button was hit
    if(isset($_GET["add"]) && $_GET["add"] == 1) {
        $request = "INSERT INTO fish (name, price) VALUE ('" . $_POST["addname"] . "', " . $_POST["addprice"] . ")";
        $result = mysqli_query($db_connect, $request);
    }

    // itterates through all fishes
    $statement = "SELECT * FROM fish";
    $response = mysqli_query($db_connect, $statement);
    while ($row = mysqli_fetch_assoc($response)) {
        $update = $row["id"] . "update";
        $delete = $row["id"] . "delete";
        $price = $row["id"] . "price";
        $id = $row["id"] . "id";
        $name = $row["id"] . "name";
        // updates the correct fish with the new values
        if(isset($_GET[$update]) && $_GET[$update] == 1) {
            $request = "UPDATE fish SET name='". $_POST[$name] ."', price=". $_POST[$price] ." WHERE id=". $_POST[$id] ."";
            $result = mysqli_query($db_connect, $request);
        }
        //deletes the correct fish
        if(isset($_GET[$delete]) && $_GET[$delete] == 1) {
            $request = "DELETE FROM fish WHERE id=". $_POST[$id] ."";
            $result = mysqli_query($db_connect, $request);
        }
    }
        // fillters the shown fishes
        $namefilter = $_POST["namefilter"] ?? "";
        if(isset($_POST["pricetill"]) && $_POST["pricetill"] != ""){
            $pricetill = $_POST["pricetill"];
        } else {
            $pricetill = 2147483647;
        }
        $priceof = $_POST["priceof"] ?? 0;
    ?>
    
    <main>
        <h1><a href="/tinf20-aquaweb/php/adminfish.php">Fish administration</h1></a>
        <aside class="filterside">
            <div class="filter">
                <p>Filter</p>
                <form id="filterform" action="#" method="POST">
                    <table>
                        <tr>
                            <td class="label-column"><label for="namefilter">Name:</label</td>
                            <td><input type="text" name ="namefilter"></td>
                        </tr>
                        <tr>
                            <td class="label-column"><label for="pricetill">Price till:</label</td>
                            <td><input type="number" name ="pricetill" min="0" max="2147483647"></td>
                        </tr>
                        <tr>
                            <td class="label-column"><label for="priceof">Price of:</label</td>
                            <td><input type="number" name ="priceof" min="0" max="2147483647"></td>
                        </tr>
                        <tr>
                            <td><button type="reset">Reset</button></td>
                            <td><button type="submit">Filter</button></td>
                        </tr>
                    </table>
                </form>
            </div>
    </aside>

        <div class="articles">
            <table>
                <tr>
                    <td>
                        <!-- form to add a new fish -->
                        <form id="formaddfisharticle" action="?add=1" method="post">
                            fileupload für das fish picture fehlt noch
                            <table>
                                <tr>
                                    <td class="label-column"><label for="addname">Name:</label></td>
                                    <td><input type="name" id="addname" name ="addname"></td>
                                </tr>
                                <tr>
                                    <td class="label-column"><label for="addprice">Price:</label></td>
                                    <td><input type="number" id="addprice"name ="addprice"></td>
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
                    // generates the filtered fishforms
                    if ($db_connect) {
                    $request = "SELECT * FROM fish";
                    $result = mysqli_query($db_connect, $request);
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ((str_contains($row["name"], $namefilter)) && ($row["price"] <= $pricetill) && ($row["price"] >= $priceof)) {?>
                        <tr>
                            <td>
                                <div class="fishimg">
                                <?php include('../assets/images/fish.svg'); ?>
                                </div>
                                <div class="fishdescription">
                                    <form id=<?php echo $row["id"] . "formupdatefisharticle"; ?> action="?<?php echo $row['id'];?>update=1" method="post">
                                        <table>
                                            <tr >
                                                <td class="label-column" ><label for="id" >ID:</label></td>
                                                <td><input type="id" id=<?php echo $row["id"] . "-id"; ?> name ="<?php echo $row['id'];?>id" value=<?php echo $row["id"]?> readonly ></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"><label for="name">Name:</label></td>
                                                <td><input type="name" id=<?php echo $row["id"] . "-name"; ?> name ="<?php echo $row['id'];?>name" value=<?php echo $row["name"]?>></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"><label for="price">Price:</label></td>
                                                <td><input type="number" id=<?php echo $row["id"] . "-price"; ?> name ="<?php echo $row['id'];?>price" value=<?php echo $row["price"]?>></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"></td>
                                                <td><button type="submit" id=<?php echo $row["id"] . "-update"; ?> class="update-button">Update!</button> 
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
                    <?php }
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