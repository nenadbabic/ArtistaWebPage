<?php

/**
 * Created by PhpStorm.
 * User: sinti
 * Date: 4. 06. 2017
 * Time: 22:15
 */
require_once "DBInit.php";

class UserDB
{
    public static function getUser($username){
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT ID_User, Username, Password, Name, Lastname, ProfilePicture, Email
                                     FROM users
                                     WHERE Username = :username 
                                 ");
        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch();
        if ($user != null) {
            return $user;
        }
    }

    public static function getAllUsers() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT ID_User, Username, Password, Name, Lastname, ProfilePicture, Email
                                     FROM users
                                 ORDER BY ID_User ASC");
        $statement->execute();

        return $statement->fetchAll();
    }



    public static function createUser($Username, $Password, $Name, $Lastname, $ProfilePicture, $Email) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO users (Username, Password, Name, Lastname, ProfilePicture, Email) VALUES (:Username, :Password, :Name, :Lastname, :ProfilePicture, :Email)");
        $statement->bindParam(":Username", $Username);
        $statement->bindParam(":Password", $Password);
        $statement->bindParam(":Name", $Name);
        $statement->bindParam(":Lastname", $Lastname);
        $statement->bindParam(":ProfilePicture", $ProfilePicture);
        $statement->bindParam(":Email", $Email);
        $statement->execute();
    }



    public static function deleteAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("TRUNCATE users");
        $statement->execute();
    }
}