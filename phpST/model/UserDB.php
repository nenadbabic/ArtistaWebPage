<?php

require_once "DBInit.php";

class UserDB
{
    public static function getUser($email){
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT id, name, email, pwdhash, regTimestamp, type
                                     FROM user
                                     WHERE email = :email 
                                 ");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch();
        if ($user != null) {
            return $user;
        }
    }

    public static function getAllUsers() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, name, email, pwdhash, regTimestamp, type
                                     FROM user
                                 ORDER BY ID_User ASC");
        $statement->execute();

        return $statement->fetchAll();
    }



    public static function createUser($name, $email, $pwdhash, $type) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO user (name, email, pwdhash , type) VALUES (:name, :email, :pwdhash, :type)");
        $statement->bindParam(":name", $name);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":pwdhash", $pwdhash);
        $statement->bindParam(":type", $type);
        $statement->execute();
    }



    /*public static function deleteAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("TRUNCATE users");
        $statement->execute();
    }*/
}