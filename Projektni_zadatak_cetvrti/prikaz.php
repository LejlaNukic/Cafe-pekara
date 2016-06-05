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
}
else{
	print "<a href='login.php'>Prijava</a>";
}
$autorKom="Gost";

  if(isset($_SESSION['korisnik'])){
    $autorKom=$_SESSION['korisnik'];

  }


if(isset($_REQUEST['odgovorNaVijest']) && !isset($_REQUEST['odgovorNaKomentar'])){
  if(isset($_REQUEST['tekst-komentara-name']) && !empty($_REQUEST['tekst-komentara-name'])){
  $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "wtuser", "wtpass");
  $veza->exec("set names utf8");
  $upit= $veza->query("insert into komentar set autor='".$autorKom."',tekst='".htmlentities($_REQUEST['tekst-komentara-name'],ENT_QUOTES)."',novost=".$_REQUEST['odgovorNaVijest'].",odgovor=NULL,nov=1;"); 
 // print "Uspjesno dodavanje komentara!";
  echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesno dodavanje komentara!</div>';
  }
  else {
    print "Doslo je do greske!Niste dodali komentar!";
  }
}

if(isset($_REQUEST['odgovorNaKomentar'])){
  $odgovor=$_REQUEST['odgovorNaKomentar'];
  if(isset($_REQUEST['tekst-komentara-name']) && !empty($_REQUEST['tekst-komentara-name'])){
  $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "wtuser", "wtpass");
  $veza->exec("set names utf8");
  $upit= $veza->query("insert into komentar set autor='".$autorKom."',tekst='".htmlentities($_REQUEST['tekst-komentara-name'],ENT_QUOTES)."',novost=".$_REQUEST['odgovorNaVijest'].",odgovor='".$odgovor."',nov=1;"); 
 // print "Uspjesno dodavanje komentara!";
  echo '<div style="padding:4px; border:1px solid white; color:white;">Uspjesno dodavanje komentara!</div>';
  }
  else {
   // print "Doslo je do greske!Niste dodali komentar!";
    echo '<div style="padding:4px; border:1px solid red; color:red;">Doslo je do greske!Niste dodali komentar!</div>';
  }
}

?>

</nav>


<div class="tijelo">
<h1 id="Podnaslov">Detaljan prikaz novosti</h1>







     <?php
     

  $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "wtuser", "wtpass");
  $veza->exec("set names utf8");
  if(isset($_REQUEST['novostId'])){
  	$id=$_REQUEST['novostId'];
  	$upit= $veza->query("select * from novost where id='".$id."';"); 
  	$novost=$upit->fetch();
  	      if (!$novost) {
          $greska = $veza->errorInfo();
          print '<p class="poruka">Ne postoji vijest!</p>';
          exit();
     }
    $upitAutor= $veza->query("select username from korisnik where id='".$novost['autor']."';"); 
  	$autor=$upitAutor->fetchColumn();
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']==$autor){
      $veza->query("update komentar set nov=0 where novost='".$id."';");
    }
  	print '<div class="red-novosti" >';
    
    print '<div class="novost" id"=novost_'.$id.'">';
    $datum="";
    $datum=date_create($novost['datum']);
   // $datum=str_replace(" ","T",$datum);
    
    print "<p class='vrijeme'>Autor: <a href='index.php?autor=".$novost['autor']."'>".$autor."</a></p>" ;
	print	'<p class="vrijeme">Vrijeme objave novosti: '.date_format($datum,"H:i:s d.m.Y").'.godine</p>';
    
    print   '<span>'.$novost['naslov'].'</span>';
    print   '<img src="'.$novost['slika'].'" alt="Slika">';
	print   '<p class="vijest">'.$novost['tekst'].'</p>';
	print '<hr>';
  
  $upitKomentar= $veza->query("select id,autor,tekst,novost, odgovor from komentar where novost='".$id."' and odgovor IS NULL;"); 
  $komentari=$upitKomentar->fetchAll();
  if(count($komentari)!=0){
    foreach ($komentari as $kom) {
      


      print '<div class="roditelj-komentar">';
     print "<p class='vrijeme'>Autor: ".$kom['autor']."</p>" ;
     print   '<p class="vijest">'.$kom['tekst'].'</p>';
     print '</div>';


     $upitOdgovor= $veza->query("select id,autor,tekst,novost, odgovor from komentar where odgovor='".$kom['id']."';"); 
  $odgovori=$upitOdgovor->fetchAll();
  if(count($odgovori)!=0){
   
     foreach ($odgovori as $odg) {
     print '<div class="uvucen-komentar">';
     print   '<p class="vrijeme">Odgovor:</p>';
     print "<p class='vrijeme'>Autor: ".$odg['autor']."</p>" ;
     print   '<p class="vijest">'.$odg['tekst'].'</p>';
     print '</div>';
     }
   
   }
 
  if($novost['komentari']==1){

    print '<div class="uvucen-komentar-forma">';
      print '<form method="post" action="prikaz.php?novostId='.$id.'&odgovorNaKomentar='.$kom['id'].'&odgovorNaVijest='.$id.'">
        

       <div class="okvir-komentar">

    <div class="red-login">
             <label class="labela-komentar" >Tekst komentara:</label><br/>
             <input class="polje-unos-komentar" placeholder="Tekst" name="tekst-komentara-name" id="tekst-komentara"><br/>
        </div>';
          
       print   '<input type="submit" id="dugme-dodavanje-komentar" value="Dodaj">
       
      <span style="clear:both"></span>
        </div>

    </form>';
    print '</div>';}
 }
    print '<hr>';
  }

	if($novost['komentari']==1){
		print '<form method="post"action="prikaz.php?novostId='.$id.'&odgovorNaVijest='.$id.'">
        

       <div class="okvir-komentar">

		<div class="red-login">
             <label class="labela-komentar" >Tekst komentara:</label><br/>
             <input class="polje-unos-komentar" placeholder="Tekst" name="tekst-komentara-name" id="tekst-komentara"><br/>
        </div>';
          
       print   '<input type="submit" id="dugme-dodavanje-komentar" value="Dodaj">
       
     	<span style="clear:both"></span>
        </div>

		</form>';
	}
    print '</div>'; 

  	print '</div>'; 
  }
 



     ?>

</div>

<div id="podnozje"><p >Copyright &copy; Web tehnologije 2015/2016.</p></div>


</body>
</html>