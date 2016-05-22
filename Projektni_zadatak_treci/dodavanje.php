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
if (isset($_SESSION['korisnik'])) $korisnik = $_SESSION['korisnik'];

else if (isset($_REQUEST['korisnik'])){
	$nizRedova=file("podaci.csv");

    foreach ($nizRedova as $value) {

    	 $podaciURedu=explode(",",$value);
   if(isset($_REQUEST['sifra']) && $_REQUEST['korisnik']==$podaciURedu[0] &&  md5($_REQUEST['sifra'])==$podaciURedu[1])
    {$korisnik = $_REQUEST['korisnik'];
     $_SESSION['korisnik'] = $korisnik;
     print "Uspjesna prijava!";
     header('Location: '."index.php",true,303);
     break;
    }
  }

  print "Niste unijeli ispravne podatke!";
}
   
   else if(!isset($_REQUEST['korisnik'])){
   	header('Location: '."index.php",true,303);
   }

if(isset($_REQUEST['logout'])) {
	session_unset();
	header('Location: '."index.php",true,303);
	die();
}

if(isset($_REQUEST['naslov']) && isset($_REQUEST['slika']) && isset($_REQUEST['tekst']) && isset($_REQUEST['drzava']) && isset($_REQUEST['telefon']))	
{
	
	if(!empty($_REQUEST['naslov']) && !empty($_REQUEST['slika']) && !empty($_REQUEST['tekst']) && !empty($_REQUEST['drzava']) && !empty($_REQUEST['telefon'])){
	$novost = array(date('D M d Y H:i:s O'),htmlEntities($_REQUEST['naslov'],ENT_QUOTES),htmlEntities($_REQUEST['slika'],ENT_QUOTES),htmlEntities($_REQUEST['tekst'],ENT_QUOTES),htmlEntities($_REQUEST['drzava'],ENT_QUOTES),htmlEntities($_REQUEST['telefon'],ENT_QUOTES));

	$file=fopen("novosti.csv","a");
	if(fputcsv($file,$novost)){
		fclose($file);
		echo "Uspjesno ste dodali novost!";
	}
	else {
		fclose($file);
		echo "Neuspjesno dodavanje novosti!";
	}

     }

     else {
	echo "Niste popunili sva polja!";
}

}



?>

</head>
<body>


<script src="validacijaNovosti.js"></script>


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
	print "<a href='login.php?logout=1'>Odjava</a>";
}
else{
	print "<a href='login.php'>Prijava</a>";
}

?>
</nav>


<div class="tijelo">

<h1 id="Podnaslov">Dodavanje novosti</h1>

<form method="post" action="dodavanje.php">
   
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