<?php

require_once "DBInit.php";

class UserDB
{
    public static function getUser($userdata){
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT id, name, email, pwdhash, regTimestamp, type
                                     FROM user
                                     WHERE email = :email 
                                 ");
        $statement->bindParam(":email", $userdata["email"], PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch();
        if ($user != null) {
            return $user;
        }
    }

    public static function getUserByEmail($email){
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

    public static function getDescriptionById($id){
        $db = DBInit::getInstance();
        $statement = $db->prepare("select description from portfolio where seller = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_STR);
        $statement->execute();
        $description = $statement->fetch();

        return implode("|",$description);
    }

    public static function editportfolioinfo($name,$email,$description,$id){

        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE user SET name = :name, email = :email WHERE id = :id");
        $statement->bindParam(":name", $name);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":id", $id);
        $statement->execute();

        $statement = $db->prepare("UPDATE portfolio SET description = :description WHERE seller = :id");
        $statement->bindParam(":description", $description, PDO::PARAM_STR);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
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

        $statement = $db->prepare("SELECT id FROM user WHERE email = :email ");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();
        $id = $statement->fetch();
        /* TODO, napaka violata nek constraint
        $statement = $db->prepare("INSERT INTO seller (user,rating) VALUES (:id,0)");
        $statement->bindParam(":id", $id);
        $statement->execute();*/
    }



    /*public static function deleteAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("TRUNCATE users");
        $statement->execute();
    }*/
}