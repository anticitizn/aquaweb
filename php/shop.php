<?php
session_start();
$indexphp = '';
?>

<!DOCTYPE html>
<html xml:lang="en" lang="en">

<head>
    <title>AquaWeb</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
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
            <!--
        <form class="sql_filter" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
            <label for="sort1">Sort by Name</label><input type="text" id="namefilter"  name="namefilter" value="sortByPrice"><br>
            <input type="radio" id="sort2"  name="sortingOption" value="sortByPrice">
            <label for="sort1">Sort by Price</label><br>
            <input type="radio" id="sort3" name="sortingOption" value="sortByAmount">
            <label for="sort1">Sort by Amount</label><br>
            <input type="submit" value="sort">
        </form>
    -->
        </div>

        <div class="articles">
            <table>
                <?php if ($db_connect) {
                    $request = "SELECT * FROM fish";
                    $result = mysqli_query($db_connect, $request);
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                                <td>
                                    <div class="fishimg">';
                        include('../assets/images/fish.svg');
                        ?>
                        </div>
                                    <div class="fishdescription">
                                    <form id=<?php echo "formaddcartfish-".$i; ?> action="#" method="post" >
                                        <table>
                                            <tr>
                                                <td class="label-column"><label for="name">Name:</label></td>
                                                <td><input type="name" id=<?php echo "name-".$i; ?> name ="name" value=<?php echo $row["name"]?> readonly></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"><label for="price">Price:</label></td>
                                                <td><input type="number" id=<?php echo "price-".$i; ?> name ="price" value=<?php echo $row["price"]?> readonly></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"><label for="quantity">Amount:</label></td>
                                                <td><input type="number" id=<?php echo "quantity-".$i; ?> name="quantity" min="1"></td>
                                            </tr>
                                            <tr>
                                                <td class="label-column"></td>
                                                <td><button type="button" id=<?php echo "add-".$i; ?> class="add-button" onclick="start(this)">Add to cart!</button> 
                                            </tr>
                                        </table>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                    <?php $i +=1;
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
                    <td>Guthaben:</td>
                    <td id="balance" ><?php echo $balance; ?></td>
                </tr>
            </table>
            <table id="shoppingcart" style.display = "none">
            </table>
        </aside>

    </main>

    <?php include('templates/footer.php');?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>