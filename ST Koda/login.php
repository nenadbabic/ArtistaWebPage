<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <link href="./style/prijava.css" rel="stylesheet" type="text/css" />
    <title>FitTrack - Login</title>
</head>

<body>

<?php 
	$_SESSION['uporabnik'] = 'gost';
?>
    


<div id="top">
    <h1 id="naslov">FitTrack</h1>
    <a href="napredki.php" id="vstopGost">Vstopi kot gost!</a>
</div>






<div id="bottom" style="width:800px; margin:0 auto;">
    <br>
    <br>
<form action="loginL.php" method="post" id="left">
    <p>
        <label class="prijavaTekst">Uporabniško ime:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="prijavaUsername" maxlength="20" autocomplete="off" pattern="[ a-zA-ZšđčćžŠĐČĆŽ\.\-]+" required autofocus /></label><br><br>
        <label class="prijavaTekst">Geslo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="prijavaPassword"
        maxlength="20" required /></label>
        <br><br>
        <button class="button" id="buttonPrijava">Prijava</button>
    </p>
</form>
<br>
<br>
<br>
<br>

<form action="registerL.php" method="post" id="right">
    <p>
        <label class="registracijaTekst">Ime:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" maxlength="20" name="registracijaName" autocomplete="off" pattern="[ a-zA-ZšđčćžŠĐČĆŽ\.\-]+" required autofocus />
        </label>
        <br>
        <br>
        <label class="registracijaTekst">Priimek:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" maxlength="20" pattern="[ a-zA-ZšđčćžŠĐČĆŽ\.\-]+" name="registracijaSurname" autocomplete="off" required autofocus />
        </label>
        <br>
        <br>
        <label class="registracijaTekst">Uporabniško ime:&nbsp;&nbsp;&nbsp;<input type="text" maxlength="20" pattern="[ a-zA-ZšđčćžŠĐČĆŽ\.\-]+" autocomplete="off" name="registracijaNickname" required autofocus />
        </label>
        <br>
        <br>
        <label class="registracijaTekst">Geslo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" maxlength="20" name="registracijaPassword" required />
        </label>
        <br>
        <br>
        <label class="registracijaTekst">Geslo(ponovno):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" maxlength="20" name="registracijaPasswordDva" required />
        </label>
        <br>
        <br>
        <button type="submit" class="button" id="buttonRegistracija">Registracija</button>
    </p>
</form>
</div>


<?php if(isset($_GET['error']) && $_GET['error'] == 1) { ?>
		<div id="error">Ta uporabnik ne obstaja!</div>
<?php	}?>

<?php if(isset($_GET['error']) && $_GET['error'] == 2) { ?>
		<div id="errorP">Gesli nista enaki!</div>
<?php	}?>

<?php if(isset($_GET['error']) && $_GET['error'] == 3) { ?>
		<div id="error">Napaka v registraciji!</div>
<?php	}?>




</body>
</html>