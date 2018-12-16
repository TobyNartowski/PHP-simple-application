<?php
    session_start();

    if (!isset($_SESSION['user_login'])) {
        header("Location: index.php");
        die();
    }
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
        <a href="index.php" class="float top animated fadeInLeft">
            <i class="fas fa-arrow-left top-content animated rotateIn"></i>
        </a>

        <div class="wrapper">
            <div class="container
                <?php
                    if (!isset($_GET['info'])) {
                        echo 'animated fadeInLeft';
                    }
                ?>
            ">
                <form action="add_page.php?modify=true" method="post">
                    <h1>Edytuj stronę "<?php echo $_SESSION['page_name']; ?>"</h1>
                    <div class="row">
                        <label for="pageName">Nazwa</label>
                        <input class="u-full-width" type="text" value="<?php echo $_SESSION['page_name']; ?>"
                         id="pageName" name="name" style="line-height: 1.5;"/>
                    </div>
                    <div class="row">
                        <label for="pageContent">Treść</label>
                        <textarea class="u-full-width" id="pageContent"
                        name="content" maxlength="65536"><?php echo $_SESSION['page_content']; ?></textarea>
                    </div>
                    <div class="row">
                        <input class="button-primary full-width" type="submit" value="Edytuj stronę" />
                    </div>
                </form>
            </div>
        </div>

        <?php if (isset($_GET['info'])) : ?>
			<div class="container">
				<span class="alert alert-error animated fadeInDown">
					<?php
						$info = $_GET['info'];
						if ($info == 'empty') {
							echo 'Uzupełnij <strong>wszystkie</strong> pola!';
						} else {
							echo 'Wystąpił <strong>inny</strong> błąd!';
						}
					?>
					<i id="alert" class="alert-button far fa-times-circle fa-lg"></i>
				</span>
			</div>
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
