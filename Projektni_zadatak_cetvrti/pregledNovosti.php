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

   if(isset($_REQUEST['brisanje'])){
   	$id_novosti=htmlEntities($_REQUEST['brisanje'],ENT_QUOTES);
   	$upitZaNovost=$veza->query("select * from novost where id='".$id_novosti."';");
   	$novost=$upitZaNovost->fetchAll();
   
   	$upitZaKomentar=$veza->query("select * from komentar where novost='".$id_novosti."';");
   	$komentari=$upitZaKomentar->fetchAll();
   	if(count($komentari)!=0){
   	
   	 $veza->query("delete from komentar where novost=".$id_novosti." AND odgovor IS NOT NULL;");
   	 $veza->query("delete from komentar where novost=".$id_novosti." AND odgovor IS NULL;");
     $veza->query("delete from novost where id=".$id_novosti.";");
     
   	//print "Uspjesno ste obrisali novost i komentare na novost!";
     echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesno ste obrisali novost i komentare na novost!</div>';
    
    }
    else{
     $veza->query("delete from komentar where novost=".$id_novosti.";"); 
     $veza->query("delete from novost where id=".$id_novosti.";");
     //print "Uspjesno ste obrisali novost!";
      echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesno ste obrisali novost!</div>';
    }
  
   }
if(isset($_REQUEST['izmjena'])){
  $id_novosti=htmlEntities($_REQUEST['izmjena'],ENT_QUOTES);
  $upitZaStatus=$veza->query("select komentari from novost where id='".$id_novosti."';");
  $statusKomentarisanja=$upitZaStatus->fetchColumn();
  if($statusKomentarisanja==0){
    $veza->query("update novost set komentari=1 where id='".$id_novosti."';");
    //print "Uspjesno ste promijenili status komentarisanja novosti!";
  echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesno ste promijenili status komentarisanja novosti!</div>';
   
  }
  else{
    $veza->query("update novost set komentari=0 where id='".$id_novosti."';");
    //print "Uspjesno ste promijenili status komentarisanja novosti!";
     echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesno ste promijenili status komentarisanja novosti!</div>';
  }
}


}
else{
	print "<a href='login.php'>Prijava</a>";
}
?>
</nav>

<div id="table-div">
<h1 id="Podnaslov"> Novosti </h1>
<table class="tabela">
   <tr>
   	<th>ID novosti</th>
		<th>Naslov novosti</th>
    <th>Tekst novosti</th>
    <th>Autor novosti</th>
    <th>Status novosti</th>
		<th>Opcija</th>
		
   </tr>

<?php

 $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "wtuser", "wtpass");
  $veza->exec("set names utf8");
  $novosti = $veza->query("select * from novost;");
  foreach ($novosti as $nov){
    $autorUpit=$veza->query("select username from korisnik where id=".$nov['autor'].";");
    $autor=$autorUpit->fetchColumn();
    $statusNovosti="Zatvorena za komentare";
    if($nov['komentari']==1){
      $statusNovosti="Otvorena za komentare";
    }
  print "<tr>
		<td>".$nov['id']."</td>
		<td>".$nov['naslov']."</td>
    <td>".$nov['tekst']."</td>
    <td>".$autor."</td>
    <td>".$statusNovosti."</td>
		<td><a href='pregledNovosti.php?izmjena=".$nov['id']."'>Promijeni status</a> <a href='pregledNovosti.php?brisanje=".$nov['id']."'>Obrisi</a></td>
	</tr>";
  }

?>		
	
</table>

</div>
<div id="podnozje"><p>Copyright &copy; Web tehnologije 2015/2016.</p></div>


</body>
</html>