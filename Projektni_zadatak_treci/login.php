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