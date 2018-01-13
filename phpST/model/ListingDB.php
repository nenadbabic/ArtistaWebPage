<?php
/**
 * Created by PhpStorm.
 * User: sinti
 * Date: 12-Jan-18
 * Time: 11:05 PM
 */
require_once "DBInit.php";
class ListingDB
{
    public static function getAllListings(){
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT listing.ID, Listing.Seller, Listing.Price, Listing.Description, listing.timestamp, listing.category, user.id, user.name
                                            FROM Listing INNER JOIN user ON Listing.seller = user.id
                                 ");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getListingById($id){
        $db = DBInit::getInstance();
        $statement = $db->prepare("Select * from listing
                                     WHERE id = :id 
                                 ");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
        $listing = $statement->fetch();
        if ($listing != null) {
            return $listing;
        }
    }



}