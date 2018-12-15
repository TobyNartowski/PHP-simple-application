<?php
    session_start();
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
        <?php if (isset($_SESSION['user_login'])) : ?>
            <nav class="nav-bar logged">
                <div class="nav-content">Tryb administratora |
                    <strong>
                        <?php echo $_SESSION['user_login']; ?>
                    </strong>
                </div>
                <a href="logout.php">
                    <div class="nav-content nav-button right">Wyloguj się</div>
                </a>
            </nav>
        <?php else : ?>
                <nav class="nav-bar unlogged">
                    <div class="nav-content">
                        <strong>Mikroblog</strong> | PAI
                    </div>
                    <a href="login.php">
                        <div class="nav-content nav-button right">Zaloguj się</div>
                    </a>
                </nav>
        <?php endif; ?>

        <div class="container animated fadeIn">
            <div class="page-wrapper">
                <div class="page">
                    <h2>Heading one</h2>
                    <span>
                        <p class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus at ligula eu erat egestas fermentum. Maecenas facilisis magna id lectus vestibulum laoreet. Ut nibh urna, porta nec finibus vehicula, eleifend vitae magna. Vivamus sodales, risus nec pellentesque porta, ex nisi volutpat nulla, sit amet ornare orci ligula nec erat.</p>
                        <i class="time">Ostatnia zmiana: 14 grudnia 2018</i>
                        <i class="author">Autor: <strong>Author</strong></i>
                    </span>
                </div>
                <div class="page">
                    <h2>Heading two</h2>
                    <span>
                        <p class="content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus at ligula eu erat egestas fermentum. Maecenas facilisis magna id lectus vestibulum laoreet. Ut nibh urna, porta nec finibus vehicula, eleifend vitae magna. Vivamus sodales, risus nec pellentesque porta, ex nisi volutpat nulla, sit amet ornare orci ligula nec erat.</p>
                        <i class="time">Ostatnia zmiana: 14 grudnia 2018</i>
                        <i class="author">Autor: <strong>Different</strong></i>
                    </span>
                </div>
            </div>
        </div>
	</body>
</html>
