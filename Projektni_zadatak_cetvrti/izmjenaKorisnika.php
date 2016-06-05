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
   
$veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "wtuser", "wtpass");
$veza->exec("set names utf8");
   
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
<?php
$korisnik="";
if(isset($_REQUEST['izmjena'])){
  $idKorisnika=$_REQUEST['izmjena'];
  $korisnikUpit=$veza->query("select username from korisnik where id='".$idKorisnika."';");
  $korisnik=$korisnikUpit->fetchColumn();
}
if(isset($_REQUEST['kor-id-name'])){
   $korisnikUpit=$veza->query("select username from korisnik where id='".$_REQUEST['kor-id-name']."';");
  $korisnik=$korisnikUpit->fetchColumn();
  if(empty($_REQUEST['kor-ime-name'])||$_REQUEST['kor-ime-name']==""){
    //echo '<div style="padding:4px; border:1px solid red; color:red;">Korisnicko ime ne moze biti prazan string!</div>';
    header('Location: '."izmjenaKorisnika.php?izmjena=".$_REQUEST['kor-id-name']."&poruka=1",true,303);
  }

  else if($korisnik==$_REQUEST['kor-ime-name']){
    //echo '<div style="padding:4px; border:1px solid red; color:red;">Unijeli ste isto korisnicko ime!</div>';
    header('Location: '."izmjenaKorisnika.php?izmjena=".$_REQUEST['kor-id-name']."&poruka=2",true,303);
  }
  else {
    $postojiUsername=false;
    $idUpit=$veza->query("select id from korisnik where username='".$_REQUEST['kor-ime-name']."';");
    if(count($idUpit->fetchAll())!=0){
    // echo '<div style="padding:4px; border:1px solid red; color:red;">Korisnicko ime je zauzeto!</div>';
     $postojiUsername=true; 
     header('Location: '."izmjenaKorisnika.php?izmjena=".$_REQUEST['kor-id-name']."&poruka=3",true,303);
    
  }
  else{
    $veza->query("update korisnik set username='".$_REQUEST['kor-ime-name']."'where id=".$_REQUEST['kor-id-name'].";");
    echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesno ste promijenili korisnicke podatke!</div>';
    header('Location: '."pregledKorisnika.php?"."&poruka=4",true,303);
  }
}
}
?>

<div class="tijelo">
<?php
if(isset($_REQUEST['poruka'])){
  if($_REQUEST['poruka']==1){
    echo '<div style="padding:4px; border:1px solid red; color:red;">Korisnicko ime ne moze biti prazan string!</div>';
  }
  else if($_REQUEST['poruka']==2){
 echo '<div style="padding:4px; border:1px solid red; color:red;">Unijeli ste isto korisnicko ime!</div>';
  }
    else if($_REQUEST['poruka']==3){
 echo '<div style="padding:4px; border:1px solid red; color:red;">Korisnicko ime je zauzeto!</div>';
  }
  else{
     echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesno ste promijenili korisnicke podatke!</div>';
  }

}
?>

<h1 id="Podnaslov">Izmjena korisnika</h1>

<form method="post" action="izmjenaKorisnika.php">
   
  <div id="formdiv">

    <div class="okvir">
		    

         <div class="red-login">

            <label class="labela-login">Korisnicko ime:</label><br/>
            <input class="polje-unos-login" placeholder="Korisnicko ime" name="kor-ime-name"  id="korisnicko-ime" value="<?php print $korisnik; ?>"><br/>
        </div>
		  
          <input type="hidden" name="kor-id-name" value="<?php if(isset($_REQUEST['izmjena'])) print $_REQUEST['izmjena']; ?>">

        <input type="submit" id="dugme-izmjena" value="Izmijeni">
      
    </div>
  </div>
</form>


</div>


<div id="podnozje"><p >Copyright &copy; Web tehnologije 2015/2016.</p></div>


</body>
</html>