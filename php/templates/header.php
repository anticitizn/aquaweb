<?php
$connectionpath = $indexphp . 'database/connection.php';
include($connectionpath); 
if ($db_connect && (isset($_SESSION['userid']))) {
    $request = "SELECT * FROM users WHERE id =" . $_SESSION['userid'] ."";
    $result = mysqli_query($db_connect,$request);
    $row = mysqli_fetch_assoc($result);
    $displayedusername = $row['username'];
    $userid = $row['id'];
}
?>

<!--Header-->
<header>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-black bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/tinf20-aquaweb/">AquaWeb</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <?php
                    if(isset($_SESSION['userid']) && $_SESSION['userid'] == 1) { ?>
                    <li class="nav-item active">
                        <a class="nav-link active" href="/tinf20-aquaweb/">Administration</a>
                    </li>
                    <?php } ?>

                    <li class="nav-item active">
                        <a class="nav-link active" href="/tinf20-aquaweb/">Home</a>
                    </li>

                    <?php
                    if(!isset($_SESSION['userid'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/tinf20-aquaweb/php/forms/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tinf20-aquaweb/php/forms/register.php">Registrierung</a>
                    </li>
                    <?php } else { ?>
                        <li class="nav-item">
                        <a class="nav-link" href="/tinf20-aquaweb/php/aquarium.php">My aquarium</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tinf20-aquaweb/php/statistics.php">Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tinf20-aquaweb/php/shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tinf20-aquaweb/php/forms/logout.php">Log out</a>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link" id="username"> <?php echo $displayedusername; ?></span>
                        <span class="nav-link" id="userid" hidden> <?php echo $displayedusername; ?></span>
                    </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
</header>