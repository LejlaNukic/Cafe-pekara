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
//print md5("autor1");

 if(!isset($_SESSION['korisnik'])){
   	header('Location: '."index.php",true,303);
   }



?>

</head>
<body>


<script src="validacijaNovosti.js"></script>

<script src="notifikacije.js"></script>
<?php
if(isset($_SESSION['korisnik'])){
print "<script>window.setInterval(function(){vratiBrojKomentara('".$_SESSION['korisnik']."')},200)</script>";
}
?>
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

<?php
if(isset($_SESSION['korisnik'])){
	print "<a href='dodavanje.php'>Dodaj novost</a>";

   $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "wtuser", "wtpass");
  $veza->exec("set names utf8");
  $upit = $veza->query("select admin from korisnik where username='".$_SESSION['korisnik']."';");
  if($upit->fetchColumn()==1){
  print "<a href='adminpanel.php?admin=1'>Admin panel</a>";
  }
  else{
    print "<a href='promjenaPodataka.php'>Promjena podataka</a>";
  }
     $upitID = $veza->query("select id from korisnik where username='".$_SESSION['korisnik']."';");
    $ID=$upitID->fetchColumn();
    print "<a href='sveNovostiAutora.php?autor=".$ID."'>Moje novosti <span style='color:red' id='broj-komentara'></span></a>";
	print "<a href='login.php?logout=1'>Odjava</a>";


}
else{
	print "<a href='login.php'>Prijava</a>";
}

?>
</nav>


<div class="tijelo">

<h1 id="Podnaslov">Opcije</h1>


  <div class="linkovi">

  <ul class="moja-lista">
    <li><a href="promjenaPodataka.php">Promjena podataka</a></li>
    <li><a href="pregledKorisnika.php">Pregled korisnika</a></li>
    <li><a href="dodavanjeKorisnika.php">Dodavanje korisnika</a></li>
    <li><a href="pregledKomentara.php">Pregled komentara</a></li>
   <li><a href="pregledNovosti.php">Pregled novosti</a></li>
 
  </ul>
</div>






</div>


<div id="podnozje"><p >Copyright &copy; Web tehnologije 2015/2016.</p></div>


</body>
</html>