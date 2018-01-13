<?php


require_once("model/UserDB.php");
require_once("model/ListingDB.php");
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
        $listings = [
            "listings" => ListingDB::getAllListings()
        ];
        ViewHelper::render("view/homepage.php", $listings);
    }

    public static function showRegistrationPage(){
        ViewHelper::render("view/registration.php");
    }

    public static function showPortfolioPage(){
        $info = [
            "listings" => ListingDB::getMyListings($_SESSION["userData"]["id"]),
            "information" => UserDB::getUser($_SESSION["userData"]),
            "description" => UserDB::getDescriptionById($_SESSION["userData"]["id"])
        ];
        ViewHelper::render("view/portfolio.php", $info);
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

    public static function showMyProducts(){
        $listings = [
            "listings" => ListingDB::getMyListings($_SESSION["userData"]["id"])
        ];
        ViewHelper::render("view/myProducts.php", $listings);
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
            $email = $_POST["email"]; #email nastavi preden dobi userdata zato ne moremo spremeniti
            $pwdhash = $_POST["pwdhash"];

            $userdata =  UserDB::getUserByEmail($email); #Napaka on poslje email v getUser, a getUser potrebuje celoten userData TODO
            $userFetched = isset($userdata);

            if ($userFetched){


                $usr = $userdata["email"];
                $passwd = $userdata["pwdhash"];

                if ($email == $usr && $pwdhash == $passwd){

                    $_SESSION["login"] = "true";
                    $_SESSION["userData"] = $userdata;
                    $_SESSION["user_name"] = $userdata["name"];
                    $user = [
                        "user" => $userdata
                    ];
                    $listings = [
                       "listings" => ListingDB::getAllListings()
                    ];

                    ViewHelper::render("view/homepage.php", $listings);

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
        $postOkay =  isset($_POST["fname"]) && !empty($_POST["fname"]) &&
            isset($_POST["lname"]) && !empty($_POST["lname"]) &&
            isset($_POST["regEmail"]) && !empty($_POST["regEmail"])&&
            isset($_POST["pass"]) && !empty($_POST["pass"])&&
            isset($_POST["cpass"]) && !empty($_POST["cpass"]) && ($_POST["pass"] == $_POST["cpass"]); // + preverjanje ce sta gesli enaki

        if ($postOkay){
            UserDB::createUser($_POST["fname"].' '.$_POST["lname"],$_POST["regEmail"],$_POST["pass"],date("Y-m-d H:i:s"), 0);
            echo "<script type='text/javascript'>alert('Uporabnik ustvarjen!');</script>";
            ViewHelper::render("view/homepage.php", ["user" => ""]);
        }else{
            self::showLoginRegister();
        }

    }
}