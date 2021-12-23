<?php
//Checks Username and shows it on the right of the header
$connectionpath = $indexphp . 'database/connection.php';
include($connectionpath); 
if ($db_connect && (isset($_SESSION['userid']))) {
    $request = "SELECT * FROM users WHERE id =" . $_SESSION['userid'];
    $result = mysqli_query($db_connect,$request);
    $row = mysqli_fetch_assoc($result);
    $displayedusername = $row['username'];
    $userid = $row['id'];
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!--Header-->
<header>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/dhbw/tinf20-aquaweb/">AquaWeb</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <?php
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                    if (strpos($url, "aquarium.php") !== false) { ?>
                    <li class="nav-item">
                        <form action="#" method="POST">
                            <button type="submit" class="btn btn-secondary" name="feed-button" value="Feed">Feed</button>
                        </form>
                    </li>
                    <?php } ?>
                    <?php
                    if(isset($_SESSION['userid']) && $_SESSION['userid'] == 1) { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="/dhbw/tinf20-aquaweb/php/adminoverview.php">Administration</a>
                    </li>
                    <?php } ?>

                    <li class="nav-item active">
                        <a class="nav-link" href="/dhbw/tinf20-aquaweb/">Home</a>
                    </li>

                    <?php
                    if(!isset($_SESSION['userid'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/dhbw/tinf20-aquaweb/php/forms/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dhbw/tinf20-aquaweb/php/forms/register.php">Register</a>
                    </li>
                    <?php } else { ?>
                        <li class="nav-item">
                        <a class="nav-link" href="/dhbw/tinf20-aquaweb/php/aquarium.php?user=<?php echo $_SESSION['userid'];?>">My aquarium</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dhbw/tinf20-aquaweb/php/statistics.php">Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dhbw/tinf20-aquaweb/php/shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dhbw/tinf20-aquaweb/php/forms/logout.php">Log out</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="/dhbw/tinf20-aquaweb/php/userpage.php"> <?php echo $displayedusername; ?></a>
                    </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
</header>