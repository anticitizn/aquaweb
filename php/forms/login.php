<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>AquaWeb</title>
	
	<link href="../test.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">AquaWeb</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav">
                    <a class="nav-link active" href="#">Home</a>
                    <a class="nav-link" href="aquarium.php">My aquarium</a>
                    <a class="nav-link" href="php/templates/statistics.php">Statistics</a>
                    <a class="nav-link" href="shop.php">Shop</a>
                </div>
            </div>
        </div>
    </nav>

<div id='wrap'>
	<div class='loginform'>
		<form class='loginform' action='#' method='post'>
			<input type='text' placeholder='Benutzername' required name='first'><br>
			<input type='password' placeholder='Passwort' required name='pwd'><br>
			<button>Anmelden</button>
		</form>
    </div>

</div>
</body>
</html>