<?php
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
    // itterates through all fishes
    $statement = "SELECT * FROM fish";
    $response = mysqli_query($db_connect, $statement);
    while ($row = mysqli_fetch_assoc($response)) {
        $buy = $row["id"] . "buy";
        $price = $row["id"] . "price";
        $id = $row["id"] . "id";
        // buys new fish (reduce users balance, insert new users_fish entry)
        if(isset($_GET[$buy]) && $_GET[$buy] == 1) {
            $day_of_Purchase = date("Y-m-d H:i:s");
            $request = "SELECT position FROM users_fish WHERE users_id = " . $_SESSION['userid'] . " ORDER BY position DESC LIMIT 1";
            $result = mysqli_query($db_connect, $request);
            $row = mysqli_fetch_assoc($result);
            if (isset($row['position'])) {
                $position = $row['position'] + 1;
            } else {
                $position = 0;
            }

            $request = "INSERT INTO users_fish (users_id, position, fish_id, amount, day_of_Purchase, lastFed) VALUE (". $_SESSION['userid'] . "," . $position . "," . $_POST[$id] . ",1, NOW(), NOW());";
            $result = mysqli_query($db_connect,$request);

            echo "<script>console.log('" . $buy . "')</script>";

            $request = "UPDATE users SET balance=balance-". $_POST[$price]." WHERE id = " . $_SESSION['userid'] . "";
            $result = mysqli_query($db_connect,$request);
        }
        // shows error message if fish is to expensive for the user
        if(isset($_GET[$buy]) && $_GET[$buy] == 0) {
            echo '<div class="cannotAfford"><p>You cannot afford this '. $row["name"].'.</p></div>';
        }
    }

        // gets balance from database
        $request = "SELECT * FROM users WHERE id =" . $_SESSION['userid'] ."";
        $result = mysqli_query($db_connect,$request);
        $row = mysqli_fetch_assoc($result);
        $balance = $row['balance'];

        // filters shown fishes;
        $namefilter = $_POST["namefilter"] ?? "";
        if(isset($_POST["pricetill"]) && $_POST["pricetill"] != ""){
            $pricetill = $_POST["pricetill"];
        } else {
            $pricetill = 2147483647;
        }
        $priceof = $_POST["priceof"] ?? 0;
    ?>
    
    <main>
        <h1>Shop</h1>
        <aside class="filterside">
            <div class="balance">
                <p>Balance: <?php echo $balance; ?></p>
            </div>
            <div class="filter">
                <p>Filter</p>
                <form id="filterform" action="#" method="POST">
                    <table>
                        <tr>
                            <td class="label-column"><label for="namefilter">Name:</label</td>
                            <td><label>
                                    <input type="text" name ="namefilter">
                                </label></td>
                        </tr>
                        <tr>
                            <td class="label-column"><label for="pricetill">Price till:</label</td>
                            <td><label>
                                    <input type="number" name ="pricetill" min="0" max="2147483647">
                                </label></td>
                        </tr>
                        <tr>
                            <td class="label-column"><label for="priceof">Price of:</label</td>
                            <td><label>
                                    <input type="number" name ="priceof" min="0" max="2147483647">
                                </label></td>
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
                <?php
                    //generates buy form for filtered fishes
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
                                    <?php 
                                        if($row["price"] <= $balance){
                                            ${"buy".$row["id"]} = 1;
                                        } else {
                                            ${"buy".$row["id"]} = 0;
                                        }
                                    ?>
                                    <form id=<?php echo $row["id"] . "formbuyfisharticle"; ?> action="?<?php echo $row['id'];?>buy=<?php echo ${"buy".$row["id"]} ?>" method="post">
                                        <table>
                                            <tr hidden>
                                                <td class="label-column" hidden><label for="id" hidden>ID:</label></td>
                                                <td hidden><input type="id" id=<?php echo $row["id"] . "-id-article"; ?> name ="<?php echo $row['id'];?>id" value=<?php echo $row["id"]?> readonly hidden></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"><label for="name">Name:</label></td>
                                                <td><input type="name" id=<?php echo $row["id"] . "-name-article"; ?> name ="name" value=<?php echo $row["name"]?> readonly></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"><label for="price">Price:</label></td>
                                                <td><input type="number" id=<?php echo $row["id"] . "-price-article"; ?> name ="<?php echo $row['id'];?>price" value=<?php echo $row["price"]?> readonly></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"></td>
                                                <td><button type="submit" id=<?php echo $row["id"] . "-buy-article"; ?> class="buy-button">Buy!</button> 
                                            </tr>
                                        </table>
                                    </form>
                                </div>
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