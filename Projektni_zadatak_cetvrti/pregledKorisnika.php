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
   	$id_korisnika=htmlEntities($_REQUEST['brisanje'],ENT_QUOTES);
   	$upitZaUsername=$veza->query("select username from korisnik where id='".$id_korisnika."';");
   	$username=$upitZaUsername->fetchColumn();
   	$jeLiAdmin= $veza->query("select admin from korisnik where id='".$id_korisnika."';");
   	if($jeLiAdmin->fetchColumn()!=1){
   	$upitZaIdNovosti=$veza->query("select id from novost where autor='".$id_korisnika."';");
   	$novostiAutora=$upitZaIdNovosti->fetchAll();
   	if(count($novostiAutora)!=0){
   	for($i=0;$i<count($novostiAutora);$i++){
   	 $veza->query("delete from komentar where novost=".$novostiAutora[$i][0]." AND odgovor IS NOT NULL;");
   	 $veza->query("delete from komentar where novost=".$novostiAutora[$i][0]." AND odgovor IS NULL;");
     
   	}
    $veza->query("delete from novost where autor='".$id_korisnika."';");
}
    $veza->query("delete from korisnik where id='".$id_korisnika."';");
    //print "Uspjesno ste obrisali korisnika sa id: ".$id_korisnika."!";
     echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesno ste obrisali korisnika sa id:'.$id_korisnika.'</div>';
   	}
   	else{
   		//print "Ne mozete obrisati administratora!";
   		 echo '<div style="padding:4px; border:1px solid red; color:red;">Ne mozete obrisati administratora!</div>';
   	}
  
   }



}
else{
	print "<a href='login.php'>Prijava</a>";
}
?>
</nav>

<div id="table-div">
<?php
if(isset($_REQUEST['poruka'])){
   echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesno ste promijenili korisnicke podatke!</div>';
}
?>
<h1 id="Podnaslov"> Korisnici </h1>
<table class="tabela">
   <tr>
   		<th>ID korisnika</th>
		<th>Korisnicko ime</th>
		<th>Opcija</th>
		
   </tr>

<?php

 $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "wtuser", "wtpass");
  $veza->exec("set names utf8");
  $korisnici = $veza->query("select * from korisnik;");
  foreach ($korisnici as $kor){
  print "<tr>
		<td>".$kor['id']."</td>
		<td>".$kor['username']."</td>
		<td><a href='izmjenaKorisnika.php?izmjena=".$kor['id']."'>Izmijeni</a> <a href='pregledKorisnika.php?brisanje=".$kor['id']."'>Obrisi</a></td>
	</tr>";
  }

?>		
	
</table>

</div>
<div id="podnozje"><p>Copyright &copy; Web tehnologije 2015/2016.</p></div>


</body>
</html>