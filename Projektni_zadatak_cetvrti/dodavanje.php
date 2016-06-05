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
  $autor= $veza->query("select id from korisnik where username='".$_SESSION['korisnik']."';");  
  $autor_id=$autor->fetchColumn();
   
  if(!isset($_SESSION['korisnik'])){
   	header('Location: '."index.php",true,303);
   }
if(isset($_REQUEST['dodaj'])){
  if(isset($_REQUEST['naslov']) && isset($_REQUEST['slika']) && isset($_REQUEST['tekst']) && isset($_REQUEST['opcija-komentar'])){
    if(!empty($_REQUEST['naslov']) && !empty($_REQUEST['slika']) && !empty($_REQUEST['tekst'])){
    $mozeKomentar="";
    if($_REQUEST['opcija-komentar']=='Y'){
     $mozeKomentar="1";
    }
    else if($_REQUEST['opcija-komentar']=='N'){
      $mozeKomentar="0";
    }
    $datum=date("Y-m-d H:i:s");
   $novaNovost=$veza->query("insert into novost set naslov='".htmlEntities($_REQUEST['naslov'],ENT_QUOTES)."',slika='".htmlEntities($_REQUEST['slika'],ENT_QUOTES)."',tekst='".htmlEntities($_REQUEST['tekst'],ENT_QUOTES)."',komentari='".$mozeKomentar."',datum='".$datum."',autor='".$autor_id."';");
    //print "Uspjesno ste dodali novost!";
    echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesno ste dodali novost!</div>';
    }
    else {
      //print "Niste popunili sva polja!";
       echo '<div style="padding:4px; border:1px solid red; color:red;">Niste popunili sva polja!</div>';
    }
  }
  else{
    //print "Niste popunili sva polja!";
    echo '<div style="padding:4px; border:1px solid red; color:red;">Niste popunili sva polja!</div>';
  }
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

<h1 id="Podnaslov">Dodavanje novosti</h1>

<form method="post" action="dodavanje.php?dodaj=1">
   
  <div id="formdiv">

    <div class="okvir">
		
		<div class="red-login">

              <label class="labela-login" >Naslov za novost:</label><br/>
              <input class="polje-unos-login" placeholder="Naslov" name="naslov"  id="naslov-novosti"><br/>
        </div>
        <div class="red-login">

              <label class="labela-login" >URL slike za novost:</label><br/>
              <label class="labela-login" >(preporucuje se velicina slike: 960 × 540 piksela)</label><br/>
              <input class="polje-unos-login" placeholder="Link slike" name="slika" id="slika-novosti"><br/>
            
        </div>
        <div class="red-login">
              <label class="labela-login" >Tekst novosti:</label><br/>
              <input class="polje-unos-login" placeholder="Tekst" name="tekst" id="tekst-novosti"><br/>
         </div>

         <form action="">
		 <div class="red-login">
              <label class="labela-login" >Otvorena za komentare:</label><br/>
              <input type="radio" class="polje-opcija-komentar" name="opcija-komentar" id="moze-komentar" value="Y"><label class="opcije">Da</label><br/>
              <input type="radio" class="polje-opcija-komentar" name="opcija-komentar" id="ne-moze-komentar" value="N"><label class="opcije">Ne</label><br/>
         </div>
        </form>




         <div class="red-login">
              <label class="labela-login" >Drzava:</label><br/>
              <label class="labela-login" >(dvoslovni kod drzave sastavljen od malih slova)</label><br/>
              <input class="polje-unos-login" placeholder="Drzava" name="drzava" id="drzava-autora" onblur="validacijaKoda()"><br/>
         </div>

          <div class="red-login">
              <label class="labela-login" >Telefon:</label><br/>
              <input class="polje-unos-login" placeholder="Telefon" name="telefon" id="telefon-autora" onblur="validacijaKoda()"><br/>
         </div>


        <input type="submit" id="dugme-dodavanje" onclick="daLiJePrazno(event)" value="Dodaj">
      
    </div>
  </div>
</form>


</div>


<div id="podnozje"><p >Copyright &copy; Web tehnologije 2015/2016.</p></div>


</body>
</html>