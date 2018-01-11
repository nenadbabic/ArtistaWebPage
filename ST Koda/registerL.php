<?php 
session_start();
require_once("ViewHelper.php");

$name = $_POST['registracijaName'];
$lastname = $_POST['registracijaSurname'];
$nickname = $_POST['registracijaNickname'];
$passwd1 = $_POST['registracijaPassword'];
$passwd2 = $_POST['registracijaPasswordDva'];

if($passwd1 != $passwd2) {
	$_GET['error'] = 2;
	ViewHelper::render("login.php");
}else {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seminarska";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$stmt = $conn->prepare("INSERT INTO users (name, surname, nickname, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $lastname, $nickname, $passwd1);

if ($stmt->execute()) {
	$_SESSION['prijavljen'] = true;
    $_SESSION['uporabnik'] = $name;
	header('Location: napredki.php');
} else {
	$_GET['error'] = 3;
    ViewHelper::render("login.php");
	
}

$conn->close();

}
?>

