<?php 

session_start(); 

$ime = $_SESSION['uporabnik'];
$telesna = $_POST['vnosTelTeza'];
$mascoba = $_POST['vnosTelMascoba'];
$pripravljenost = $_POST['vnosSportPrip'];
$datum = date('Y-m-d');




$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seminarska";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$stmt = $conn->prepare("INSERT INTO progression (nickname, date, bodyfat, readiness, weight) VALUES (?,?,?,?,?)");
$stmt->bind_param("ssddd", $ime, $datum, $mascoba, $pripravljenost, $telesna);

if ($stmt->execute()) {
	header('Location: my.php');
}

$conn->close();

?>