 <!DOCTYPE html>
 <?php
 session_start();
 
 ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cafe pekara</title>
	<link rel="stylesheet" type="text/css" href="stil.css">
	<link href='https://fonts.googleapis.com/css?family=Dosis:600' rel='stylesheet' type='text/css'>

</head>
<body>

<script src="datum.js"></script>
<script src="filter.js"></script>
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
<h1 id="Podnaslov">Novosti</h1>

<?php
if(!isset($_REQUEST['autor'])){
print'
 <select id="filter" onchange="filtriraj(this.value);">
			<option value="dan" id="danas">Danasnje novosti</option>
			<option value="sedmica" id="ove-sedmice">Novosti ove sedmice</option>
			<option value="mjesec" id="ovog-mjeseca">Novosti ovog mjeseca</option>
			<option value="sve" id="sve" selected="selected">Sve novosti</option>

</select> 
<label class="labela" >Sortiraj po: </label>
<a class="link-sortiranje" href="index.php?sortiranje=datum">DATUMU</a>
<a class="link-sortiranje" href="index.php">ABECEDI</a>';}

?>



     <?php
     
     function sortirajPoDatumu($d1,$d2){
     	$vrijeme1=strtotime($d1['datum']);
     	$vrijeme2=strtotime($d2['datum']);
     	return $vrijeme2-$vrijeme1;     	
     }

     function sortirajPoAbecedi($d1,$d2){
     	return strcmp($d1['naslov'],$d2['naslov']);
     }

  $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "wtuser", "wtpass");
  $veza->exec("set names utf8");
  $novosti= $veza->query("select id,datum,naslov,slika,tekst from novost;");  
  if(isset($_REQUEST['autor'])){
  	$novosti= $veza->query("select id,datum,naslov,slika,tekst from novost where autor='".$_REQUEST['autor']."';");
  };
  $nizNovosti=$novosti->fetchAll();
  //array_push($nizNovosti,$novosti->fetchColumn());
  //$nizNovosti=$novosti->fetchColumn();

  if(isset($_REQUEST['sortiranje']) && $_REQUEST['sortiranje']=="datum") usort($nizNovosti,"sortirajPoDatumu");
     else usort($nizNovosti,"sortirajPoAbecedi");

  
  $otvorendiv=false;
  $i=0;
  foreach ($nizNovosti as $novost) {
    $brojUpit=$veza->query("select count(*) from komentar where novost='".$novost['id']."' AND nov=1;");
    $neprocitaniKomentari=$brojUpit->fetchColumn();
  		if($i%3==0){
	 		print '<div class="red-novosti" >';
	 		$otvorendiv=true;
	 	}


    print   '<div class="novost" id="novost_'.$novost['id'].'" onclick="location.href=\'prikaz.php?novostId='.$novost['id'].'\';" style="cursor: pointer;">';
    $datum="";
    $datum=$novost['datum'];
    $datum=str_replace(" ","T",$datum);

	print	'<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="'.$datum.'"></time>.</p>';
    print   '<span>'.$novost['naslov'].'</span>';
    print '<p class="vrijeme">Broj neprocitanih komentara:<span style="color:red">'.$neprocitaniKomentari.'</span></p>';
    print   '<img src="'.$novost['slika'].'" alt="Slika">';
	print   '<p class="vijest">'.$novost['tekst'].'</p>';
	print '</div>'; 
        if($i%3==2){
	 		print '</div>';
	 		$otvorendiv=false;
	 	}
	 	$i++;
  }
  	if($otvorendiv){
     	print '</div>';
     }
	

     ?>

</div>

<div id="podnozje"><p >Copyright &copy; Web tehnologije 2015/2016.</p></div>


</body>
</html>