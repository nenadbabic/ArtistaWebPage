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
                if (isset($_SESSION["login"])){ ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle " data-toggle="dropdown">Moj Profil <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= BASE_URL . "upload"?>">Dodaj nov izdelek</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= BASE_URL . "editportfolio"?>">Uredi profil</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= BASE_URL . "portfolio"?>">Moj Portfolio</a></li>
                    </ul>
                </li> <?php } ?>
            </ul>
            <form class="navbar-form navbar-left" role="search" method="post" action="<?= BASE_URL . "search" ?>">
                <div class="form-group">
                    <input id="searchbar" type="text" name="searchbar" class="form-control" placeholder="Išči...">
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


    <div class="row">
        <div class="col-md-2">
            <p class="lead"></p>
            <div class="list-group">
                <a href="<?= BASE_URL . "homepage" ?>" class="list-group-item">Vse</a>
                <a href="<?= BASE_URL . "slikarstvo" ?>" class="list-group-item">Slikarstvo</a>
                <a href="<?= BASE_URL . "kiparstvo" ?>" class="list-group-item">Kiparstvo</a>
                <a href="<?= BASE_URL . "drugo" ?>" class="list-group-item">Drugo</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">

                <?php
                    if (isset($_SESSION["login"])){
                        foreach ($listings as $listing){

                            ?><div class="col-sm-4 col-lg-4 col-md-4">

                            <div class="thumbnail">
                                <div>
                                    <h4><a  href="#"><?= $listing["name"] ?></a>
                                    </h4>
                                </div>

                                <img class="listing-img" src="<?= UPIC_URL . $listing["path"] ?>" alt="">
                                <div class="caption">
                                    <h4 class="pull-right"><?= $listing["price"] ?>€</h4>

                                    <h4><a href="#"><?= $listing["username"] ?></a>
                                    </h4>
                                    <p><?= $listing["description"] ?></p>
                                </div>
                                <div>
                                    <button id="buybutton"><a href="<?= BASE_URL . "purchase" ?>">Kupi zdaj!</a> </button>
                                </div>

                                <div class="ratings">
                                    <p class="pull-right">15 Ocen</p>
                                    <p>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                    </p>
                                </div>
                            </div>
                            </div>
                        <?php }
                    }else{
                        foreach ($listings as $listing){

                        ?>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                            <div>
                                <h4><a href="#"><?= $listing["name"] ?></a>
                                </h4>
                            </div>
                            <img class="listing-img" src="<?= UPIC_URL . $listing["path"] ?>" alt="">
                            <div class="caption">
                                <h4 class="pull-right"><?= $listing["price"] ?>€</h4>

                                <h4><a href="#"><?= $listing["username"] ?></a>
                                </h4>
                                <p><?= $listing["description"] ?></p>
                            </div>

                            <div class="ratings">
                                <p class="pull-right">15 Ocen</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                            </div>
                        </div>
                    <?php }
                     } ?>

            </div>

        </div>
    </div>
</div>


</div>


<!-- /.container -->


<!-- /.container -->

<!-- jQuery -->
<script src="<?= js_URL . "jquery.js" ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?= js_URL . "bootstrap.min.js" ?>"></script>

</body>

</html>
