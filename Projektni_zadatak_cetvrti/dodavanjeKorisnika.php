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
  

 if(isset($_REQUEST['dodaj'])){

  if(isset($_REQUEST['kor-ime-name'])&&isset($_REQUEST['kor-sifra-name'])&& isset($_REQUEST['ponovo-kor-sifra-name'])){

  if(!empty($_REQUEST['kor-ime-name'])&&!empty($_REQUEST['kor-sifra-name'])&& !empty($_REQUEST['ponovo-kor-sifra-name']))   {
    $postojiKorisnickoIme = $veza->query("select count(*) from korisnik where username='".htmlEntities($_REQUEST['kor-ime-name'],ENT_QUOTES)."';");
    if($postojiKorisnickoIme->fetchColumn()==0){

      if($_REQUEST['kor-sifra-name']==$_REQUEST['ponovo-kor-sifra-name']){
      $novi_korisnik=$veza->query("insert into korisnik set username='".htmlEntities($_REQUEST['kor-ime-name'],ENT_QUOTES)."',password='".md5(htmlEntities($_REQUEST['kor-sifra-name'],ENT_QUOTES))."',admin='0';");
        echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesno ste dodali korisnika!</div>';
   
      }
      else{
        //print "Niste unijeli ispravnu ponovljenu sifru!";
         echo '<div style="padding:4px; border:1px solid red; color:red;">Niste unijeli ispravnu ponovljenu sifru!</div>';
   
      }
    }
    else{
      //print "Postoji korisnik sa unesenim korisnickim imenom!";
    echo '<div style="padding:4px; border:1px solid red; color:red;">Postoji korisnik sa unesenim korisnickim imenom!</div>';
   
    }

      }

  else {
    //print "Niste popunili sva polja!";
     echo '<div style="padding:4px; border:1px solid red; color:red;">Niste popunili  sva polja!</div>';
   
  }

  }
  else {
    //print "Niste popunili sva polja!";
    echo '<div style="padding:4px; border:1px solid red; color:red;">Niste popunili  sva polja!</div>';
  }

 }

}
else{
	print "<a href='login.php'>Prijava</a>";
}

?>
</nav>


<div class="tijelo">

<h1 id="Podnaslov">Dodavanje korisnika</h1>

<form method="post" action="dodavanjeKorisnika.php?dodaj=1">
   
  <div id="formdiv">

    <div class="okvir">
		
		<div class="red-login">

              <label class="labela-login" >Korisnicko ime:</label><br/>
              <input class="polje-unos-login" placeholder="Korisnicko ime" name="kor-ime-name"  id="kor-ime"><br/>
        </div>
       
        <div class="red-login">
              <label class="labela-login">Korisnicka sifra:</label><br/>
              <input class="polje-unos-login" type="password" placeholder="Korisnicka sifra" name="kor-sifra-name" id="kor-sifra"><br/>
         </div>
        
        <div class="red-login">
              <label class="labela-login">Ponovljena korisnicka sifra:</label><br/>
              <input class="polje-unos-login" type="password" placeholder="Ponovljena sifra" name="ponovo-kor-sifra-name" id="ponovo-kor-sifra"><br/>
         </div>



        <input type="submit" id="dugme-dodavanje-korisnika" value="Dodavanje">
      
    </div>
  </div>
</form>


</div>


<div id="podnozje"><p >Copyright &copy; Web tehnologije 2015/2016.</p></div>


</body>
</html>