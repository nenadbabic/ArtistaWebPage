<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lestvica</title>
<link href="./style/napredkiCSS.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php session_start();
    
$array = array(
    "foo" => "bar",
    "bar" => "foo",
);
    
require_once ("operacije.php");
?>
<div id="vrh">

	
	<h1 id="naslovStrani">Lestvica</h1>
	

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
            <p id="ime"><?php echo $_SESSION['uporabnik'] ?></p> 
    <?php } ?> 
	
	</div>
    
    

</div>


<div id="tabela">
<table>
    <thead>
        <tr>
            <th><strong>Vzdevek</strong></th>
            <th><strong>Datum</strong></th>
            <th><strong>Telesna Teža</strong></th>
            <th><strong>Procent telesne maščobe</strong></th>
            <th><strong>Ocena športne priravljenosti</strong></th>
        </tr>
    </thead>
    <tbody>
        
        <?php foreach (operacije::pridobiNajboljse() as $napredek): ?>
        <tr>
            <td><?= $napredek['nickname'] ?></td>
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

    <a href="napredki.php"><div class="navgumb">Vsi napredki</div></a>

</div>



</body>
</html>