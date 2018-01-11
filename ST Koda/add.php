<!DOCTYPE html>
<html>
<head>
<title>Dodaj</title>
<link href="./style/napredkiCSS.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php session_start();
    
$array = array(
    "foo" => "bar",
    "bar" => "foo",
);
    
require_once ("operacije.php");
if (!isset($_SESSION['prijavljen']) && $_SESSION['prijavljen'] == false) {
    header('Location: login.php'); 
} 
  

  
   

?>
<div id="vrh">

	
	<h1 id="naslovStrani">Dodaj napredek</h1>
	

	<div id="desniKot">
    <?php
        //Ce je oseba prijavljena
        if (isset($_SESSION['prijavljen']) && $_SESSION['prijavljen'] == true) { ?> 
        <p id="ime"><?php echo $_SESSION['uporabnik'] ?></p> 
		<form action="logout.php" method="post" id="odjava">
        <button class="button" id="gumb">Odjava</button> 
        </form>

    <?php
        //Ce oseba ni prijavljena
        } else {  ?>

    <?php } ?> 
	
	</div>
    
    

</div>


<div id="tabela">
<form action="addL.php" method="post" id="dodaj">
    
    <label>Telesna teža: &nbsp;&nbsp;&nbsp;&nbsp;<input name="vnosTelTeza" min="10" max="200" type="number" name="vpisTelTeza" required autofocus /></label><br/><br/>
    
    <label>Procent telesne maščobe:&nbsp;&nbsp;&nbsp;&nbsp;<input name="vnosTelMascoba" min="7" max="30" type="number" name="vpisProcent" required autofocus /></label><br/><br/>
    
    <label>Ocena športne pripravljenosti: &nbsp;&nbsp;&nbsp;&nbsp;<input name="vnosSportPrip" max="10" min="0" type="number" required autofocus /></label><br/><br/>
    
     
     <p><button id="dodajGumb">Dodaj</button></p>
	
    

</form>
	
    

</div>



<div id="spodaj">

    <a href="ladder.php"><div class="navgumb">Lestvica</div></a>
    
    <?php
        //Ce je oseba prijavljena
        if (isset($_SESSION['prijavljen']) && $_SESSION['prijavljen'] == true) { ?> 
        <a href="my.php"><div class="navgumb">Moji napredki</div></a>
        <a href="add.php"><div class="navgumb">Dodaj napredek</div></a>

    <?php
        //Ce oseba ni prijavljena
        } else {  ?>
    <?php } ?> 

</div>



</body>
</html>