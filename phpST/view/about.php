<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Artista - Najdi umetnika v sebi</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= CSS_URL . "bootstrap.css" ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= CSS_URL . "shop-homepage.css" ?>" rel="stylesheet">
    <link href="<?= CSS_URL . "artista.css" ?>" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header bg-art">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img href="<?= BASE_URL . "homepage"?>" class="navbar-image" src="<?= PIC_URL . "logo.png" ?>" id="logo" href="#">
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse bg-art" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav ">
                <li class="bg-art"><a href="<?= BASE_URL . "homepage"?>">Domov</a></li>
                <li class="bg-art"><a href="<?= BASE_URL . "about"?>">O nas</a></li>
                <?php
                if (isset($_SESSION["login"])){
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle " data-toggle="dropdown">Moj Profil <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?= BASE_URL . "upload"?>">Dodaj nov izdelek</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= BASE_URL . "editportfolio"?>">Uredi profil</a></li>
                            <li class="divider"></li>
                            <li><a href="<?= BASE_URL . "portfolio"?>">Moj Portfolio</a></li>
                        </ul>
                    </li>
                <?php } ?>

            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>


            <?php
            if (isset($_SESSION["login"])){
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="<?= BASE_URL . "logout" ?>" ><b>Odjava</b></a>
                    </li>

                </ul>
                <?php
            }else{
                ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><p class="navbar-text">Že imate račun?</p></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Prijava</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        or
                                        <form class="form" role="form" method="post" action="<?= BASE_URL . "login" ?>" accept-charset="UTF-8" id="login-nav">
                                            <div class="form-group">
                                                <label class="sr-only" for="email">Email address</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email naslov" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="pwdhash">Password</label>
                                                <input type="password" class="form-control" id="pwdhash" name="pwdhash" placeholder="Geslo" required>

                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Prijava</button>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="bottom text-center">
                                        <a href="<?= BASE_URL . "registrationpage" ?>"><b>Registracija</b></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <?php
            }
            ?>



        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>



<div class="art-container">
    <div class="col-lg-12">
        <div class="row">
            <h1>Smo skupina študentov FRI</h1>
            <h2>To je projekt, ki smo ga izdelali za predmet Tehnologija programske opreme</h2>
            <p>Pri projektu smo sodelovali:</p>
            <ul>
                <li>Nenad Babić</li>
                <li>Rok Dolinar</li>
                <li>Tomaž Lunder</li>
                <li>Gregor Sintič</li>
            </ul>
        </div>

    </div>




</div>


</div>


<!-- /.container -->

<div class="container">
    <hr>
    <!-- Footer
    <footer class="art-footer">

            <div class="col-lg-12" style="bottom: 0;">
                <p>Copyright &copy; Artista 2017</p>
            </div>

    </footer>-->

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="<?= js_URL . "jquery.js" ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?= js_URL . "bootstrap.min.js" ?>"></script>

</body>

</html>
