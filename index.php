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

        <?php if (isset($_GET['info'])) : ?>
			<div class="container">
				<span class="alert
				<?php
					if ($_GET['info'] == 'success') {
						echo 'alert-success';
					} else {
						echo 'alert-error';
					}
				?>
				animated fadeInDown">
					<?php
						$info = $_GET['info'];
						if ($info == 'success') {
							echo 'Operacja przebiegła <strong>prawidłowo</strong>!';
						} else if ($info == 'failure') {
							echo '<strong>Błąd</strong> przy wykonywaniu operacji!';
						} else {
							echo 'Wystąpił <strong>inny</strong> błąd!';
						}
					?>
					<i id="alert" class="alert-button far fa-times-circle fa-lg"></i>
				</span>
			</div>
		<?php endif; ?>

        <div class="container animated fadeIn">
            <div class="page-wrapper">
            <?php
                require_once('connection.php');
                $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
                if (!$connection) {
                    die('Błąd przy połączeniu z bazą danych: ' . mysqli_connect_error());
                }

               $result = mysqli_query($connection, "SELECT name, content, author, creation FROM pages ORDER BY creation");
               if (mysqli_num_rows($result) > 0) {
                   while ($row = mysqli_fetch_assoc($result)) {
                       echo '<div class="page">';
                       echo '<h2>' . $row['name'] . '</h2>';
                       echo '<span>';
                       echo '<p class="content">' . $row['content'] . '</p>';
                       echo '<i class="time">Ostatnia zmiana: ' . $row['creation'] . '</i>';
                       echo '<i class="author">Autor: <strong>' . $row['author'] . '</strong></i>';
                       echo '</span>';
                       echo '</div>';
                   }
               } else {
                    echo '<h3>Brak dodanych stron.</h3>';
               }

               mysqli_close($connection);
             ?>
            </div>
        </div>

        <?php if (isset($_SESSION['user_login'])) : ?>
            <a href="new_page.php" class="float bottom">
                <i class="fas fa-plus bottom-content animated rotateIn"></i>
            </a>
        <?php endif; ?>


        <script>
            function alertCallback() {
                document.getElementById('alert').onclick = function() {
                    this.parentNode.classList.add('fadeOutUp');
                    return false;
                };
            }

            setTimeout(function() {
                document.getElementById('alert').parentNode.classList.add('fadeOutUp');
                return false;
            }, 3000);

            window.onload = alertCallback();
        </script>
	</body>
</html>
