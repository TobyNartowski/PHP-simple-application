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
        <div class="wrapper">
            <div class="container">
                <h1>Brak dostępu</h1>
                <h5 class="subtitle">Twoje ip "
                    <?php
                        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                          echo $_SERVER['HTTP_CLIENT_IP'];
                        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                          echo $_SERVER['HTTP_X_FORWARDED_FOR'];
                        } else {
                          echo $_SERVER['REMOTE_ADDR'];
                        }
                    ?>
                    " jest niedozwolone.</5h>
            </div>
        </div>

	</body>
</html>
