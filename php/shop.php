
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php include('templates/header.php'); ?>
    
    <main>
        <h1>Shop</h1>
        <?php include('database/connection.php'); ?>
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
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                                <td>
                                    <div class="fishimg">';
                        include('../assets/images/fish.svg');
                        echo '</div>
                                    <div class="fishdescription">
                                        <table>
                                            <tr>
                                                <td><p>' . $row["name"] . '</p></td>
                                            </tr>
                                            <tr>
                                            <td>
                                            <form action="./shopping_cart.php" method="post" >
                                                <label for="price">Price:</label>
                                                <input type="number" id="price" name ="price" value=' . $row["price"] . ' readonly><br>
                                                <label for="quantity">Amount:</label>
                                                <input type="number" id="quantity" name="quantity" min="1">
                                                <input type="submit" value ="Add to cart">
                                                </form>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>';
                    }
                }
                ?>
            </table>
        </div>

        <aside class="balance-cart">
            <p>balance and Cart</p>
        </aside>

    </main>

    <?php include('templates/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/aquariumAnimation.js"></script>

</body>

</html>