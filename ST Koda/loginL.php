<?php 

session_start();
require_once("ViewHelper.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seminarska";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$result = $stmt = $conn->prepare("SELECT nickname, password FROM users WHERE nickname = ? AND password = ?");
$stmt->bind_param("ss", $_POST['prijavaUsername'], $_POST['prijavaPassword']);
$stmt->execute();
$stmt->store_result();
$value = $stmt->num_rows;

if ($value == 1) {
	$_SESSION['prijavljen'] = true;
    $_SESSION['uporabnik'] = $_POST['prijavaUsername'];
	header('Location: napredki.php');
	die();
} else {
	$_GET['error'] = 1;
    ViewHelper::render("login.php");
	
}

$conn->close();
	
?>