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

if(isset($_REQUEST['promjena']) && isset($_REQUEST['stara-sifra-ime']) && isset($_REQUEST['nova-sifra-ime'])&&isset($_REQUEST['ponovo-nova-sifra-ime']))	
{
	if(!empty($_REQUEST['stara-sifra-ime'])&&!empty($_REQUEST['nova-sifra-ime'])&&!empty($_REQUEST['ponovo-nova-sifra-ime'])){
  $upit = $veza->query("select password from korisnik where username='".$_SESSION['korisnik']."';");
  $upit_id = $veza->query("select id from korisnik where username='".$_SESSION['korisnik']."';");
  
  $sifra = md5($_REQUEST['stara-sifra-ime']);

  if($sifra==$upit->fetchColumn() && $_REQUEST['nova-sifra-ime']==$_REQUEST['ponovo-nova-sifra-ime']){
   $veza->query("update korisnik set password='".md5($_REQUEST['nova-sifra-ime'])."' where id='".$upit_id->fetchColumn()."';");
   echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesno ste promijenili sifru!</div>';
  }
    else {
     // echo "Niste ispravno popunili polja!";
      echo '<div style="padding:4px; border:1px solid red; color:red;">Niste ispravno popunili polja!</div>';
  }


  }
    

     else {
      //echo "Niste popunili sva polja!";
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

<h1 id="Podnaslov">Promjena korisnicke sifre</h1>

<form method="post" action="promjenaPodataka.php?promjena=1">
   
  <div id="formdiv">

    <div class="okvir">
		
		    <div class="red-login">

              <label class="labela-login" >Stara sifra:</label><br/>
              <input class="polje-unos-login" type="password" placeholder="Stara sifra" name="stara-sifra-ime"  id="stara-sifra"><br/>
        </div>
          <div class="red-login">

              <label class="labela-login" >Nova sifra:</label><br/>
              <input class="polje-unos-login" type="password" placeholder="Nova sifra" name="nova-sifra-ime"  id="nova-sifra"><br/>
        </div>

          <div class="red-login">

              <label class="labela-login" >Ponovljena nova sifra:</label><br/>
              <input class="polje-unos-login" type="password" placeholder="Ponovljena nova sifra" name="ponovo-nova-sifra-ime"  id="-ponovo-nova-sifra"><br/>
        </div>

        <input type="submit" id="dugme-izmjena" value="Izmijeni">
      
    </div>
  </div>
</form>


</div>


<div id="podnozje"><p >Copyright &copy; Web tehnologije 2015/2016.</p></div>


</body>
</html>