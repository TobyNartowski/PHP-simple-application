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
		<div class="wrapper animated fadeIn">
		    <div class="container">
		        <div class="row">
					<h1>Zarejestruj się</h1>
			        <h5 class="subtitle">wpisując swoje dane</h5>
				</div>

				<form action="new_account.php" method="post">
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
                    <div class="row">
						<label for="repeatForm">Powtórz hasło</label>
						<input class="u-full-width" type="password" placeholder="Powtórz wpisane hasło"
						 id="repeatForm" name="repeat"/>
					</div>
					</br>
					<div class="row">
						<div class="four columns">
							<a class="button full-width" href="index.php">Anuluj</a>
						</div>
						<div class="eight columns">
							<input class="button-primary full-width" type="submit" value="Zarejestruj się" />
						</div>
					</div>
				</form>
		    </div>
		</div>

		<?php if (isset($_GET['error'])) : ?>
			<div class="container">
				<span class="alert alert-error animated fadeInDown">
					<?php
						$error = $_GET['error'];
						if ($error == 'empty') {
							echo 'Uzupełnij <strong>wszystkie</strong> pola!';
						} else if ($error == 'different') {
                            echo 'Podane hasła <strong>nie mogą</strong> się różnić!';
						} else if ($error == 'wrong') {
							echo 'Użytkownik o podanym loginie <strong>już istnieje</strong>!';
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
