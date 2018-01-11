<!DOCTYPE html>
<html>
<head>
<title>Moji napredki</title>
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

	
	<h1 id="naslovStrani">Moji napredki</h1>
	

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
<table>
    <thead>
        <tr>
            <th><strong>Datum</strong></th>
            <th><strong>Telesna Teža</strong></th>
            <th><strong>Procent telesne maščobe</strong></th>
            <th><strong>Ocena športne priravljenosti</strong></th>
        </tr>
    </thead>
    <tbody>
        
        <?php foreach (operacije::pridobiSamoMoje() as $napredek): ?>
        <tr>
            <td><?= $napredek['date'] ?></td>
            <td><?= $napredek['weight'] ?></td>
            <td><?= $napredek['bodyfat'] ?></td>
            <td><?= $napredek['readiness'] ?></td>
         </tr>
         <?php endforeach;?>
        
    </tbody>
</table>
	
    

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