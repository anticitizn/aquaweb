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
    <!--Favicon wird aktuell von Daniels Test-Server gezogen-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/shop.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php include('templates/header.php'); ?>
    
    <main>
        <h1>Shop</h1>
        <div class="filter">
            <p>Filter</p>
        </div>

        <div class="articles">
            <table>
                <?php if ($db_connect) {
                    $request = "SELECT * FROM fish";
                    $result = mysqli_query($db_connect, $request);
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>
                                <div class="fishimg">
                                <?php include('../assets/images/fish.svg'); ?>
                                </div>
                                <div class="fishdescription">
                                    <form id=<?php echo $row["id"] . "-formaddcartdish-article"; ?> action="#" method="post" >
                                        <table>
                                            <tr hidden>
                                                <td class="label-column" hidden><label for="id" hidden>ID:</label></td>
                                                <td hidden><input type="id" id=<?php echo $row["id"] . "-id-article"; ?> name ="id" value=<?php echo $row["id"]?> readonly hidden></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"><label for="name">Name:</label></td>
                                                <td><input type="name" id=<?php echo $row["id"] . "-name-article"; ?> name ="name" value=<?php echo $row["name"]?> readonly></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"><label for="price">Price:</label></td>
                                                <td><input type="number" id=<?php echo $row["id"] . "-price-article"; ?> name ="price" value=<?php echo $row["price"]?> readonly></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"><label for="amount">Amount:</label></td>
                                                <td><input type="number" id=<?php echo $row["id"] . "-amount-article"; ?> name="amount" min="1"></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"></td>
                                                <td><button type="button" id=<?php echo $row["id"] . "-add-article"; ?> class="add-button" onclick="start(this, function() {printCart()})">Add to cart!</button> 
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                }
                ?>
            </table>
        </div>

        <aside class="balance-cart">
            <?php 
                $request = "SELECT * FROM users WHERE id =" . $_SESSION['userid'] ."";
                $result = mysqli_query($db_connect,$request);
                $row = mysqli_fetch_assoc($result);
                $balance = $row['balance'];
            ?>
            <h3>balance and Cart</h3>
            <table id="balancetable">
                <tr>
                    <td>balance:</td>
                    <td id="balance" ><?php echo $balance; ?></td>
                </tr>
            </table>
            <table class="shoppingcart" id="shoppingcart" style='display:none;'>
                <thead class="shoppingcart">
                    <tr class="shoppingcart">
                        <th class="shoppingcart" hidden>id</th>
                        <th class="shoppingcart">Name</th>
                        <th class="shoppingcart">Amount</th>
                        <th class="shoppingcart">Price</th>
                        <th class="shoppingcart">Total</th>
                    </tr>
                </thhead>
                <tbody class="shoppingcart" id="cart-table">
                </tbody>
                <tfoot class="shoppingcart">
                    <tr class="shoppingcart">
                        <td class="shoppingcart" hidden></th>
                        <td class="shoppingcart"></td>
                        <td class="shoppingcart"></td>
                        <td class="shoppingcart" id="shoppingcart-totalamount-label">Totalamount</td>
                        <td class="shoppingcart" id="shoppingcart-totalamount"></td>
                    </tr> 
                </tfoot>
            </table>

            <!-- formular fehlt noch das muss sich dann über die tabelle des shopping carts und balance erstrecken und checken ob man sich den einkauf leisten kann, wenn nicht fehler werfen oder cart leeren? muss entschieden werden php soll dann die sql querries durchführen -->
        </aside>

    </main>

    <?php include('templates/footer.php');?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>