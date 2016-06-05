<?php 

if(isset($_REQUEST['autor'])){
 $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "wtuser", "wtpass");
  $veza->exec("set names utf8");
  $upitZaIDAutora = $veza->query("select id from korisnik where username='".$_REQUEST['autor']."';");
  $ID=$upitZaIDAutora->fetchColumn();
  $upitZaNovosti = $veza->query("select id from novost where autor='".$ID."';");
  $novostiAutora=$upitZaNovosti->fetchAll();
  $brojKomentara=0;
  foreach ($novostiAutora as $novost) {
  	$upitZaBrojKomentara = $veza->query("select count(*) from komentar where novost='".$novost['id']."' AND nov=1;");
  	$brojKomentara+=$upitZaBrojKomentara->fetchColumn();
  }
  print $brojKomentara;
}

?>