<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Zum Aufbau der Verbindung zur Datenbank

// Zum Aufbau der Verbindung zur Datenbank
// die Daten erhalten Sie von Ihrem Provider
define ( 'MYSQL_HOST',      '51.15.100.196' );

// bei XAMPP ist der MYSQL_Benutzer: root
define ( 'MYSQL_BENUTZER',  'aquaweb' );
define ( 'MYSQL_KENNWORT',  'webaqua123' );

//Unsere Datenbank aquaweb
define ( 'MYSQL_DATENBANK', 'aquaweb' );

$db_connect= mysqli_connect (MYSQL_HOST, MYSQL_BENUTZER,  MYSQL_KENNWORT,  MYSQL_DATENBANK);
?>

<!DOCTYPE html>
<html xml:lang="en" lang="en">

<head>
	<title>AquaWeb</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="icon" type="image/vnd.microsoft.icon" href="http://test.anticitizen.space/favicon.ico">  <!--Favicon wird aktuell von Daniels Test-Server gezogen-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php include('templates/header.php');?>

<main>
    <h1>Shop</h1>
    
    <div class="filter">
        <p>Filter</p>
    <!--
        <form class="sql_filter" method="post" action="<?=$_SERVER['PHP_SELF']?>">
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
            <?php if ( $db_connect) {
                    $request = "SELECT * FROM fish";
                    $result = mysqli_query($db_connect,$request);
                    while($row = mysqli_fetch_assoc($result)){
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
                                            <td><p>' . $row["price"] . '</p></td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>' ;
                    }
                }
            ?>
        </table>
    </div>

    <aside class="balance-cart">
        <p>balance and Cart</p>
    </aside>

</main>

    <?php include('templates/footer.php');?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/aquariumAnimation.js"></script>

</body>
</html>