 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cafe pekara</title>
	<link rel="stylesheet" type="text/css" href="stil.css">
	<link href='https://fonts.googleapis.com/css?family=Dosis:600' rel='stylesheet' type='text/css'>

<?php
session_start();
//print md5("lnukic");
$veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "wtuser", "wtpass");
$veza->exec("set names utf8");

if (isset($_SESSION['korisnik'])) $korisnik = $_SESSION['korisnik'];

else if (isset($_REQUEST['korisnik'])){

$upit = $veza->query("select password from korisnik where username='".htmlEntities($_REQUEST['korisnik'],ENT_QUOTES)."';");

if(isset($_REQUEST['korisnik'])&&isset($_REQUEST['sifra'])){
$korisnik = $_REQUEST['korisnik'];
 $sifra = md5($_REQUEST['sifra']);
if($sifra == $upit->fetchColumn()) {
  $_SESSION['korisnik'] = $korisnik;
 // print "Uspjesna prijava!";
  echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesna prijava!</div>';
  header('Location: '."index.php",true,303);
   }
	

 else echo '<div style="padding:4px; border:1px solid red; color:red;">Niste unijeli ispravne podatke!</div>';
}
}
   

if(isset($_REQUEST['logout'])) {
	session_unset();
	header('Location: '."index.php",true,303);
	die();
}
	

?>

</head>
<body>




<div id="logo">

	<div id="baza">

		<div class="kockice" id="desna-kockica"></div>
		<div class="kockice" id="lijeva-kockica"></div>
	</div>

	<div id="sredina">
		<div id="desno-krilo"></div>
		<div id="lijevo-krilo"></div>
		<div id="srednja-elipsa">
			<div id="poklopac">
				<div id="linija"></div>
			</div>
		</div>

		<div id="razdvojnica"></div>
        
		<div id="ruckica">
			<div id="linijice-gornja"></div>
			<div id="linijice-donja"></div>

		</div>
	</div>
    
    


</div>


<nav class="opcija">
<a href="index.php">Naslovna</a>
<a href="tabela.php">Tabelarni podaci</a>
<a href="link.php">Lista linkova</a>
<a href="forma.php">Forma</a>




</nav>


<div class="tijelo">

<h1 id="Podnaslov">Prijava</h1>

<form method="post" action="login.php">
   
  <div id="formdiv">

    <div class="okvir">
		
		<div class="red-login">

              <label class="labela-login" >Korisnicko ime:</label><br/>
              <input class="polje-unos-login" placeholder="Korisnicko ime" name="korisnik"><br/>
        </div>

        <div class="red-login">
              <label class="labela-login" >Korisnicka sifra:</label><br/>
              <input class="polje-unos-login" placeholder="Korisnicka sifra" type="password" name="sifra"><br/>
         </div>

        <button id="dugme-prijava" onclick="">Prijava</button>
      
    </div>
  </div>
</form>


</div>


<div id="podnozje"><p >Copyright &copy; Web tehnologije 2015/2016.</p></div>


</body>
</html>