<?php
    session_start();

    require_once('connection.php');
    check_ip();
?>

<html lang="pl">
	<head>
		<meta charset="utf-8">
        <title>Mikroblog | PAI</title>
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
                        <div class="nav-content nav-button right"><strong>Zaloguj się</strong></div>
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

                mysqli_query($connection, users_table_create());
                mysqli_query($connection, pages_table_create());

               $result = mysqli_query($connection, "SELECT id, name, content, author, creation FROM pages ORDER BY creation DESC");
               if (mysqli_num_rows($result) > 0) {
                   while ($row = mysqli_fetch_assoc($result)) {
                       echo '<div class="page">';

                        if (isset($_SESSION['user_login'])) {
                            echo '<form action="modify_page.php" method="post">';
                            echo '<button type="submit" name="delete" value="' . $row['id'] . '" class="fa-button">';
                            echo '<i class="far fa-times-circle fa-2x"></i>';
                            echo '</button>';
                            echo '<button type="submit" name="modify" value="' . $row['id'] . '" class="fa-button">';
                            echo '<i class="far fa-edit fa-2x"></i>';
                            echo '</button>';
                            echo '</form>';
                        }

                        echo '<h2>' . $row['name'] . '</h2>';
                        echo '<span>';
                        echo '<p class="content">' . $row['content'] . '</p>';
                        echo '<i class="time">Ostatnia zmiana: ' . $row['creation'] . '</i>';
                        echo '<i class="author">Autor: <strong>' . $row['author'] . '</strong></i>';
                        echo '</span>';
                        echo '</div>';
                   }
               } else {
                    echo '<div class="center-title">';
                    echo '<h3>Brak stron.</h3>';
                    if (isset($_SESSION['user_login'])) {
                        echo '<h5 class="subtitle">Dodaj pierwszą stronę klikając na znak plusa w prawym dolnym rogu.</h5>';
                    } else {
                        echo '<h5 class="subtitle">Zaloguj się, aby dodać pierwszą stronę.</h5>';
                    }
                    echo '</div>';
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
