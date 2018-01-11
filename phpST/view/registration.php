<html>
<head>
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Artista - Najdi umetnika v sebi</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?= CSS_URL . "bootstrap.min.css" ?>" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= CSS_URL . "shop-homepage.css" ?>" rel="stylesheet">
        <link href="<?= CSS_URL . "artista.css" ?>" rel="stylesheet">
        <link href="<?= CSS_URL . "portfolio.css" ?>" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "register.css" ?>">
    </head>
</head>
<body>
<!-- multistep form -->
<form id="msform">
    <!-- fieldsets -->
    <fieldset>
        <h2 class="fs-title">Ustvari račun.</h2>
        <h3 class="fs-subtitle">Artista - Najdi umetnika v sebi!</h3>
        <input type="text" name="fname" placeholder="Ime" />
        <input type="text" name="lname" placeholder="Priimek" />
        <input type="text" name="email" placeholder="Email" />
        <input type="password" name="pass" placeholder="Geslo" />
        <input type="password" name="cpass" placeholder="Potrdi geslo" />
        <input id="button" type="button" name="next" class="next action-button" value="Naprej" />
    </fieldset>
</form>
</body>
</html>