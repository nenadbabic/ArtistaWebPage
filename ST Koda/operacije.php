<?php 


class operacije {
	public static function pridobiVse() {

	$servername = "localhost";
	$username = "root";
	$password = "";

	try {
    	$conn = new PDO("mysql:host=$servername;dbname=seminarska", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
	catch(PDOException $e){
    	echo "Connection failed: " . $e->getMessage();
    }

		$stmt = $conn->prepare("SELECT users.name, users.surname, progression.nickname, progression.date, progression.weight, progression.bodyfat, progression.readiness FROM progression INNER JOIN users ON progression.nickname=users.nickname");
		$stmt->execute();
		return $stmt->fetchAll();
		
	}
	
	
	public static function pridobiSamoMoje() {

	$servername = "localhost";
	$username = "root";
	$password = "";

	try {
    	$conn = new PDO("mysql:host=$servername;dbname=seminarska", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
	catch(PDOException $e){
    	echo "Connection failed: " . $e->getMessage();
    }
		$stmt = $conn->prepare("SELECT progression.date, progression.weight, progression.bodyfat, progression.readiness FROM progression WHERE nickname=:user");
        //$stmt->bindParam(":user", $_SESSION['username']);
        $a = $_SESSION['uporabnik'];
		$stmt->bindParam(":user", $a);
		$stmt->execute();
		return $stmt->fetchAll();
		
	}
	
	
	
	public static function pridobiNajboljse() {
        //return self::pridobiVse();
            
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=seminarska", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }

            $stmt = $conn->prepare("SELECT users.name, users.surname, progression.nickname, progression.date, progression.weight, progression.bodyfat, progression.readiness FROM progression INNER JOIN users ON progression.nickname=users.nickname ORDER BY progression.bodyfat ASC LIMIT 3");
            $stmt->execute();
            return $stmt->fetchAll();
        }
	
	
	
	
	
}




?>