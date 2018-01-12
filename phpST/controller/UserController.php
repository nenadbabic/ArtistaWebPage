<?php


require_once("model/UserDB.php");
require_once("model/ProjectDB.php");
require_once("ViewHelper.php");

class UserController
{



    public static function getUserTest($email){
        $user = [ UserDB::getUser($email)];
        ViewHelper::render("view/portfolio.php", $user);
    }

    public static function getAll() {
        # Reads books from the database
        $variables = [
            "users" => UserDB::getAllUsers()
        ];

        # Renders the view and sets the $variables array into view's scope
        ViewHelper::render("view/loginRegister.php", $variables);
    }

    public static function showHomepage(){
        $variable = [
            "user" => ""
        ];
        ViewHelper::render("view/homepage.php", $variable);
    }


    public static function showAbout(){
        $variable = [
            "user" => ""
        ];
        ViewHelper::render("view/about.php", $variable);
    }
    public static function showLoginRegister(){
        $variables = [
            "user" => ""
        ];
        ViewHelper::render("view/loginRegister.php", $variables);
    }


    public static function login() {

        $postOkay =  isset($_POST["loginUsername"]) && !empty($_POST["loginUsername"]) &&
            isset($_POST["loginPassword"]) && !empty($_POST["loginPassword"]);

        if ($postOkay){
            $username = $_POST["loginUsername"];
            $password = $_POST["loginPassword"];

            $variable =  UserDB::getUser($username);
            $userFetched = isset($variable);

            if ($userFetched){
                $usr = $variable["Username"];
                $passwd = $variable["Password"];
                $variables = [
                    "user" => $variable
                ];
                if ($username == $usr && $password == $passwd){

                    $_SESSION["login"] = "true";
                    $_SESSION["username"] = $usr;
                    $projects = [
                        "projects" => ProjectDB::getAllProjects()
                    ];
                    ViewHelper::render("view/editPortfolio.php", $projects);

                }else{
                    echo "Napaka";
                    ViewHelper::redirect(BASE_URL . "login");
                }
            }
        }else{
            self::showLoginRegister();
        }
    }

    public static function register(){
        $postOkay =  isset($_POST["Name"]) && !empty($_POST["Name"]) &&
            isset($_POST["Lastname"]) && !empty($_POST["Lastname"]) &&
            isset($_POST["Username"]) && !empty($_POST["Username"])&&
            isset($_POST["Email"]) && !empty($_POST["Email"])&&
            isset($_POST["Password"]) && !empty($_POST["Password"]); //&&
//            isset($_POST["ProfilePicture"]) && !empty($_POST["ProfilePicture"]);

        if ($postOkay){
            UserDB::createUser($_POST["Username"],$_POST["Password"],$_POST["Name"],$_POST["Lastname"],$_POST["ProfilePicture"],$_POST["Email"]);
            echo "<script type='text/javascript'>alert('User created');</script>";
            ViewHelper::render("view/editPortfolio.php", ["user" => ""]);
        }else{
            self::showLoginRegister();
        }

    }
}