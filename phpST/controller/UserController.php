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

    public static function logout(){
        $_SESSION["login"] = null;
        session_destroy();
        ViewHelper::redirect(BASE_URL . "homepage");
    }


    public static function login() {

        $postOkay =  isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["pwdhash"]) && !empty($_POST["pwdhash"]);

        if ($postOkay){
            $email = $_POST["email"];
            $pwdhash = $_POST["pwdhash"];

            $userdata =  UserDB::getUser($email);
            $userFetched = isset($userdata);

            if ($userFetched){


                $usr = $userdata["email"];
                $passwd = $userdata["pwdhash"];
                $variables = [
                    "user" => $userdata
                ];
                if ($email == $usr && $pwdhash == $passwd){

                    $_SESSION["login"] = "true";
                    echo $userdata["name"];
                    $_SESSION["user_name"] = $userdata["name"];

                    ViewHelper::render("view/homepage.php", $userdata);

                }else{
                    echo "Napaka";
                    ViewHelper::redirect(BASE_URL . "homepage");
                }
            }
        }else{
            self::showHomepage();
        }
    }

    public static function register(){
        echo "V registru";
        $postOkay =  isset($_POST["fname"]) && !empty($_POST["fname"]) &&
            isset($_POST["lname"]) && !empty($_POST["lname"]) &&
            isset($_POST["regEmail"]) && !empty($_POST["regEmail"])&&
            isset($_POST["pass"]) && !empty($_POST["pass"])&&
            isset($_POST["cpass"]) && !empty($_POST["cpass"]) && ($_POST["pass"] == $_POST["cpass"]); // + preverjanje ce sta gesli enaki

        if ($postOkay){
            echo "Post je okaj";
            UserDB::createUser($_POST["fname"].' '.$_POST["lname"],$_POST["regEmail"],$_POST["pwdhash"],0);
            echo "<script type='text/javascript'>alert('Uporabnik ustvarjen!');</script>";
            ViewHelper::render("view/editPortfolio.php", ["user" => ""]);
        }else{
            self::showLoginRegister();
        }

    }
}