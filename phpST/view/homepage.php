<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DoGether</title>

    <link href="<?= CSS_URL . "bootstrap.min.css" ?>" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" href="<?= PNG_URL . "pageIcon.png" ?>" type="image/png">
    <link href="<?= CSS_URL . "myCSS.css" ?>" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

  </head>

  <body>
      <nav class="navbar navbar-inverse navbar-static-top">      
        <div class="container">
            <div class="navbar-header">
            <img class="navbar-brand" src="<?= PNG_URL . "logo.png" ?>">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

              <a class="navbar-brand" href="<?= BASE_URL . "homepage" ?>">DoGether</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                  <?php if (isset($_SESSION["login"]) && $_SESSION["login"] == "true") : ?>  <li><a href="<?= BASE_URL . "logout" ?>">Logout</a></li> <?php else :?> <li><a href="<?= BASE_URL . "login" ?>">Sign in</a></li> <?php endif; ?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?= BASE_URL . "projects" ?>">Projects</a></li>
                      <?php if (isset($_SESSION["login"]) && $_SESSION["login"] == "true") : ?>  <li><a href="<?= BASE_URL . "createProject" ?>">Create Project</a></li> <?php endif; ?>
                  </ul>
                </li>
                <li><a href="<?= BASE_URL . "about" ?>">About</a></li>
              </ul>
            </div>
        </div>
      </nav>
  
    <div class="jumbotron">
      <div class="container">
        <h1>Do. Together. DoGether.</h1>
        <p>Have an idea? Need motivated, enthusiastic people to work with you? </p>
        
        <br>
        <p><a class="btn btn-primary btn-lg" href="<?= BASE_URL . "login" ?>" role="button">Sign up here»</a>
      </div>
    </div>  
    <section class="call-to-action">
      <div class="row">
        <div class="col-md-4">         
          <img class="mainPagePng" src="<?= PNG_URL . "profile.png" ?>">
          <h3>Set up your profile</h3>
          <p>Setup your profile in a few minutes.</p>
        </div>
        <div class="col-md-4">
          <img class="mainPagePng" src="<?= PNG_URL . "connect.png" ?>">
          <h3>Connect</h3>
          <p>Have ideas? Create a new project. <br>Intrested in working on a project? Sign up for a project. </p>
          
        </div>
        <div class="col-md-4">
          <img class="mainPagePng" src="<?= PNG_URL . "work.png" ?>">
          <h3>Work!</h3>
          <p>Work with your new collegues.</p>
        </div>
      </div>
    </section>   
      
    
  

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?= js_URL . "bootstrap.min.js" ?>"></script>
  </body>
  <footer>
  <hr>
    <p>DoGether</p>
    <p>Gregor Sintič, student of UL FRI</p>
  </footer>
</html>