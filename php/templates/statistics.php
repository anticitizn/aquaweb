<!DOCTYPE html>
<html xml:lang="en" lang="en">

<head>
    <title>AquaWeb</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_statistics.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/vnd.microsoft.icon" href="http://test.anticitizen.space/favicon.ico">
    <!--Favicon wird aktuell von Daniels Test-Server gezogen-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>


<body>
    
    <?php include('../templates/header.php'); ?>

    <?php include('../database/connection.php'); ?>
 
    <div class="headline" style="position: relative;"><?php echo "<h1>Your aquarium statistics </h1>";?></div>

    <form class="sql_sort" method="post" action="<?=$_SERVER['PHP_SELF']?>">
        <input type="radio" id="sort1" name="sortingOption" value="sortByName">
        <label for="sort1">Sort by Name</label><br>
        <input type="radio" id="sort2"  name="sortingOption" value="sortByPrice">
        <label for="sort1">Sort by Price</label><br>
        <input type="radio" id="sort3" name="sortingOption" value="sortByAmount">
        <label for="sort1">Sort by Amount</label><br>
        <input type="submit" value="sort">
    </form>
 
    <?php
   


    $sortingOption = $_POST["sortingOption"];


    switch($sortingOption){
        case "sortByName": 
            $abfrage = "SELECT fish.id, fish.name, fish.price, account_fish.amount, account_fish.day_of_Purchase, account_fish.lastFed 
            FROM account_fish
            INNER JOIN fish ON fish.id = account_fish.fish_id
            ORDER BY fish.name";
            break;
        case "sortByPrice":
            $abfrage = "SELECT fish.id, fish.name, fish.price, account_fish.amount, account_fish.day_of_Purchase, account_fish.lastFed 
            FROM account_fish
            INNER JOIN fish ON fish.id = account_fish.fish_id
            ORDER BY fish.price";
            break;
        case "sortByAmount":
            $abfrage = "SELECT fish.id, fish.name, fish.price, account_fish.amount, account_fish.day_of_Purchase, account_fish.lastFed 
            FROM account_fish
            INNER JOIN fish ON fish.id = account_fish.fish_id
            ORDER BY account_fish.amount";
            break;
        default:
            $abfrage = "SELECT fish.id, fish.name, fish.price, account_fish.amount, account_fish.day_of_Purchase, account_fish.lastFed 
            FROM account_fish
            INNER JOIN fish ON fish.id = account_fish.fish_id";
            break;
    }

  
    $result = mysqli_query($db_connect, $abfrage);

    echo "<table class='table table-striped'>
            <thead>
            <th>id</th>
            <th>name</th>
            <th>price</th>
            <th>amount</th>
            <th>day_of_Purchase</th>
            <th>lastFed</th>
            </thead>";

    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["amount"] . "</td>";
        echo "<td>" . $row["day_of_Purchase"] . "</td>";
        echo "<td>" . $row["lastFed"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    ?>



    <?php include('../templates/footer.php'); ?>
</body>

</html>