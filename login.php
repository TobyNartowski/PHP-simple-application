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
		<a href="index.php" class="float top animated fadeInLeft">
			<i class="fas fa-arrow-left top-content animated rotateIn"></i>
		</a>

		<div class="wrapper animated fadeIn">
		    <div class="container">
		        <div class="row">
					<h1>Zaloguj się</h1>
			        <h5 class="subtitle">do swojego konta administratora</h5>
				</div>

				<form action="authorization.php" method="post">
					<div class="row">
						<label for="loginForm">Login</label>
						<input class="u-full-width" type="text" placeholder="Wpisz tutaj swój login"
						 id="loginForm" name="login"/>
					</div>
					<div class="row">
						<label for="passwordForm">Hasło</label>
						<input class="u-full-width" type="password" placeholder="Wpisz tutaj swoje hasło"
						 id="passwordForm" name="password"/>
					</div>
					</br>
					<div class="row">
						<div class="four columns">
							<a class="button full-width" href="register.php">Zarejestruj się</a>
						</div>
						<div class="eight columns">
							<input class="button-primary full-width" type="submit" value="Zaloguj się" />
						</div>
					</div>
				</form>

		    </div>
		</div>

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
						if ($info == 'empty') {
							echo 'Uzupełnij <strong>wszystkie</strong> pola!';
						} else if ($info == 'wrong') {
							echo 'Podane dane są <strong>nieprawidłowe</strong>!';
						} else if ($info == 'success') {
							echo 'Rejestracja przebiegła <strong>pomyślnie</strong>. Możesz się teraz zalogować na swoje konto.';
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
