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
    <link rel="stylesheet" href="../css/dropdown-filter.css">
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
    if (isset($_GET["add"]) && $_GET["add"] == 1) {
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
        if (isset($_GET[$update]) && $_GET[$update] == 1) {
            $request = "UPDATE fish SET name='" . $_POST[$name] . "', price=" . $_POST[$price] . " WHERE id=" . $_POST[$id] . "";
            $result = mysqli_query($db_connect, $request);
        }
        //deletes the correct fish
        if (isset($_GET[$delete]) && $_GET[$delete] == 1) {
            $request = "DELETE FROM fish WHERE id=" . $_POST[$id] . "";
            $result = mysqli_query($db_connect, $request);
        }
    }
    // fillters the shown fishes
    $namefilter = $_POST["namefilter"] ?? "";
    if (isset($_POST["pricetill"]) && $_POST["pricetill"] != "") {
        $pricetill = $_POST["pricetill"];
    } else {
        $pricetill = 2147483647;
    }
    $priceof = $_POST["priceof"] ?? 0;
    ?>
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Fish administration</h1>
            </div>
        </div>
    </header>
    <main>
        <aside class="filterside">
            <nav class="filter-nav">

                <label for="touch"><span class="shop-filter">Filter</span></label>
                <form id="filterform" action="#" method="POST">
                    <input type="checkbox" id="touch">
                    <ul class="slide">
                        <li><label for="namefilter" class="filter-label">Name:</label><input type="text" name="namefilter"></li>
                        <li><label for="pricetill" class="filter-label">Price till:</label><br><input type="number" name="pricetill" min="0" max="2147483647"></li>
                        <li><label for="priceof" class="filter-label">Price of:</label><br><input type="number" name="priceof" min="0" max="2147483647"></li>
                        <li><button type="reset" class="btn btn-outline-dark mt-auto">Reset</button></li>
                        <li><button type="submit" class="btn btn-outline-dark mt-auto">Filter</button></li>
                    </ul>
                    <form>
            </nav>
        </aside>

        <aside class="aside-right">
                <nav class="filter-nav">

                    <label for="touchAdd"><span class="shop-filter">Add</span></label>
                    <form id="formaddfisharticle" action="?add=1" method="post">
                        <input type="checkbox" id="touchAdd">
                        <ul class="slide">
                            <li><label for="addname" class="filter-label">Name:</label><input type="name" id="addname" name="addname"></li>
                            <li><label for="addprice" class="filter-label">Price:</label> <input type="number" id="addprice" name="addprice"></li>
                            <li><button type="submit" id="add" class="btn btn-outline-dark mt-auto">Add</button>></li>
                        </ul>
                        <form>
                </nav>
         
        </aside>



        <section class='py-5'>
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                    //generates buy form for filtered fishes
                    if ($db_connect) {
                        $request = "SELECT * FROM fish";
                        $result = mysqli_query($db_connect, $request);


                        while ($row = mysqli_fetch_assoc($result)) {
                            if (str_contains($row["name"], $namefilter) && ($row["price"] <= $pricetill) && ($row["price"] >= $priceof)) { ?>


                                <div class="col mb-5">
                                    <div class="card h-100">
                                        <!-- Product image-->
                                        <img class="card-img-top" src='../assets/images/<?php echo $row["id"] ?>.png' alt="..." />
                                        <!-- Product details-->
                                        <div class="card-body p-4 text-secondary">
                                            <div class="text-center">
                                                <form id=<?php echo $row["id"] . "formupdatefisharticle"; ?> action="?<?php echo $row['id']; ?>update=1" method="post">
                                                    <input type="id" id=<?php echo $row["id"] . "-id-article"; ?> name="<?php echo $row['id']; ?>id" value=<?php echo $row["id"] ?> readonly hidden>
                                                    <!-- Product name-->
                                                    <h5 class="fw-bolder"><input type="name" class="name-form" id=<?php echo $row["id"] . "-name"; ?> name="<?php echo $row['id']; ?>name" value=<?php echo $row["name"] ?>></h5>
                                                    <!-- Product price-->
                                                    <input type="number" class="number-buy-form" id=<?php echo $row["id"] . "-price"; ?> name="<?php echo $row['id']; ?>price" value=<?php echo $row["price"] ?>>
                                            </div>
                                        </div>
                                        <!-- Product actions-->
                                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                            <div class="text-center"><button type="submit" id=<?php echo $row["id"] . "-update"; ?> class="btn btn-outline-dark mt-auto">Update</button>

                                                </form>
                                                <form id=<?php echo $row["id"] . "formdeletefisharticle"; ?> action="?<?php echo $row['id']; ?>delete=1" method="post">
                                                    <label for="id" hidden>ID:</label>
                                                    <input type="id" id=<?php echo $row["id"] . "-id"; ?> name="<?php echo $row['id']; ?>id" value=<?php echo $row["id"] ?> readonly hidden>
                                                    <button type="submit" id=<?php echo $row["id"] . "-delete"; ?> class="btn btn-outline-dark mt-2">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                    <?php }
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>

    <?php // imports footer
    include('templates/footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>