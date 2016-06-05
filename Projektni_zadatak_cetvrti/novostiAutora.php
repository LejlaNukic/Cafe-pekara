<?php

$idAutora = $_GET['autor'];
$brojVijesti=$_GET['x'];

$veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "wtuser", "wtpass");
$veza->exec("set names utf8");

$upit = $veza->prepare("SELECT id,naslov,slika,tekst,komentari,datum,autor FROM novost WHERE autor=? limit ? ;");
$upit->bindValue(1, $idAutora, PDO::PARAM_INT);
$upit->bindValue(2,(int)$brojVijesti, PDO::PARAM_INT);
$upit->execute();



print "{ \"novosti\": " . json_encode($upit->fetchAll()) . "}";

?>
