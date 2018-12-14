<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php');
        die();
    }
?>

<html lang="pl">
	<head>
		<meta charset="utf-8">
		<title>Projektowanie aplikacji internetowych</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

	    <link href="https://fonts.googleapis.com/css?family=Raleway:300,700&amp;subset=latin-ext" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" />
		<link rel="stylesheet" type="text/css" href="css/skeleton.css" />
		<link rel="stylesheet" type="text/css" href="css/animate.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>

	<body>
        <nav class="nav-bar">
            <a href="dashboard.php"><strong>Strona domowa</strong></a>
            <a href="#discover.php">Przeglądaj</a>
            <a href="#profile.php" class="right">
                <i class="fas fa-user-circle fa-2x"></i>
            </a>
            <a href="logout.php" class="right">Wyloguj się</a>
        </nav>
	</body>
</html>
