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

<script src="datum.js"></script>
<script src="filter.js"></script>

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
<h1 id="Podnaslov">Novosti</h1>

<?php
if(!isset($_REQUEST['autor'])){
print'
 <select id="filter" onchange="filtriraj(this.value);">
			<option value="dan" id="danas">Danasnje novosti</option>
			<option value="sedmica" id="ove-sedmice">Novosti ove sedmice</option>
			<option value="mjesec" id="ovog-mjeseca">Novosti ovog mjeseca</option>
			<option value="sve" id="sve" selected="selected">Sve novosti</option>

</select> 
<label class="labela" >Sortiraj po: </label>
<a class="link-sortiranje" href="index.php?sortiranje=datum">DATUMU</a>
<a class="link-sortiranje" href="index.php">ABECEDI</a>';}
?>
<!--	<div class="red-novosti">
		<div class="novost"  >
			<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="2016-04-03T14:55:55"></time>.</p>
			<span>Naslov 1</span>
    		 <img src="http://static.chefkoch-cdn.de/ck.de/rezepte/233/233001/826996-960x720-schoko-cookies-vegan.jpg" alt="Slika">
			<p class="vijest">
			Veggie riegel u prodaji! Nasim kupcima vec poznati Vegi Pan hljeba - beskvasni dugotrajni hljeb sa sjemenkama, sada i u obliku peciva. Veggie riegel je pogodan za vegansku ishranu, bez kvasca i laktoze. Sadrzi sjemenke suncokreta, lana i tikve, zobenene pahuljice, pirove pahuljice, psenicna vlakna, vlakna jabuke. Vise informacija o brandu Vegipan procitajte na <a href="http://www.vegipan.com">http://www.vegipan.com</a>
			</p>
	
		</div>

		<div class="novost" >
		<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="2016-04-02T08:10:00"></time>.</p>
    		<span>Naslov 2</span>
    		 <img src="https://scontent-vie1-1.xx.fbcdn.net/hphotos-xpf1/v/t1.0-9/11138093_796203327173911_5754070265581828333_n.jpg?oh=0c0dfa47329f700ffad6664dbf0fecc3&oe=5793AE5E" alt="Slika">
			<p class="vijest">S ponosom objavljujemo da su croissants, pain aux chocolat i pain aux rasins spremni za prodaju. 
			Croissant se pravi sa originalnim francuskim puterom i brasnom, po originalnom receptu sa vremenom spravljanja preko 8 sati.
			Pain aux chocolat je tijesto originalnog croissanta sa puterom punjen sa cokoladnim stapicima.
			Pain aux rasins je ukusni puz od francuskog lisnatog tijesta sa slasticarskom kremom i grozdjicama.
			 </p>
	
		</div>

		<div class="novost"  >
		<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="2016-04-02T14:10:00"></time>.</p>
    		 <span>Naslov 3</span>
    		 <img src="https://scontent-vie1-1.xx.fbcdn.net/hphotos-xpt1/v/t1.0-9/12495260_807440106050233_312814095121193871_n.jpg?oh=28f1d68798c326a5e4502b74b24a8c71&oe=578BCBDE" alt="Slika">
			<p class="vijest">Ovim putem Vas obavjestavamo da samo jos danas nase macaronse prodajemo u ogranicenim kolicinama. Upucujemo Vam najiskrenije izvinjenje i molbu za razumijevanje za protekla 3 dana sto niste u svako doba mogli naci najdraze kolacice u nasoj Mrvici. Zbog specificnog nacina izrade macaronsa i njihovog vremena pripreme, morali smo ograniciti kolicine da bili onako slatki i perfektni za Vas.
			 </p>
	
		</div>

	</div>



	<div class="red-novosti">
		<div class="novost" >
		<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="2016-03-03T10:10:00"></time>.</p>
    		 <span>Naslov 4</span>
    		 <img src="http://im0.olx.biz.id/images_olxid/34317621_1_644x461_mums-secrets-bakery-banjarmasin-kota_rev010.jpg" alt="Slika">
			<p class="vijest">Mrvica tim vrijedno je radio kako bi za Vas pripremio jos jedno iznenadjenje. Rijec je o slatkoj kutiji koju mozete koristiti da obradujete Vase najdraze. Print se radi po Vasoj zelji i osjecajte se slobodnim da svoje ideje pretvorite u ova slatka iznenadjenja. Mrvica tim je spreman da odgovori na sve Vase zahtjeve. Vasi zahtjevi su nas izazov. Sve narudzbe realizujemo u roku od sat vremena.</p>
	
		</div>

		<div class="novost" >
		<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="2016-03-20T11:10:00"></time>.</p>
    		 <span>Naslov 5</span>
    		 <img src="http://media.foody.vn/res/g5/44969/s/foody-thao-bakery-345-635698148095263960.jpg" alt="Slika">
			<p class="vijest">Iz vremena kad je med bio glavno sladilo stižu nam medenjaci. Iako su naizgled jednostavni potreban je pravi recept i vješta ruka da bi se postigla željena tekstura i medenjaci ostali mekani.
			Nas tim je vrijedno radio da bi ovu recepturu doveo do savrsenstva. Posjetite nas i sami procijeniti da li smo u tome uspjeli. S nestrpljenjem Vas iscekujemo.
			 </p>
	
		</div>

		<div class="novost" >
		<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="2016-03-30T13:10:00"></time>.</p>
    		 <span>Naslov 6</span>
    		 <img src="http://pix4.agoda.net/hotelimages/230/230696/230696_15012605550024824118.jpg?s=800x600" alt="Slika">
			<p class="vijest">Sjećaš li se đačkih ekskurzija? Sjećaš li se kako smo se radovali minijaturnim pakovanjima džema, meda, maslaca i mirisnoga kruha? Pa negdje sa strane poredanih kriški divnoga sira i šunke? Nismo više mali, ali nas još raduju male stvari. Probaj klasični doručak na Mrvica način. Zaboravi na brojanje kalorija. Uživaj. Jednostavno, zar ne?
			 </p>
	
		</div>

	</div>


	<div class="red-novosti">
		<div class="novost">
<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="2016-03-27T14:58:00"></time>.</p>
    		<span>Naslov 7</span>
    		 <img src="http://www.jtb.co.jp/kaigai_opt/img/front/srh/309700_base_14334671113060.jpg" alt="Slika">
			<p class="vijest">Još jednom prizivamo ljeto sa novim voćnim mješavinama. Grilovana voćna salata sa super prelivom je nešto novo što jednostano morate isprobati.
            Vjerujemo da još niste probavali da pravite voćnu salatu sa voćem sa grila, ali ukus je tako magičan da joj nećete moći odoljeti. Ideju i recept za ovu divnu salatu smo pronašli u Parizu na Sjamu vocnih salata.</p>
	
		</div>

		<div class="novost" >
		<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="2016-04-01T23:59:00"></time>.</p>
    		 <span>Naslov 8</span>
    		 <img src="http://icube.milliyet.com.tr/YeniAnaResim/2016/03/29/islim-kebabi-tarifi-6802250.Jpeg" alt="Slika">
			<p class="vijest">Kremasta, a čvrsta tekstura jednog od najpoznatijih svjetskih sireva, čiji je blagi okus obogaćen cherry paradajzom, zelenom salatom, peršunom, čarobnim mirisnim bosiljkom i soja sosom, učinit će da poletiš u euforiji najukusnije salate koja se ikada našla na Tvome stolu.
			 </p>
	
		</div>

		<div class="novost" >
		<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="2016-03-26T22:10:00"></time>.</p>
    		 <span>Naslov 9</span>
    		 <img src="http://www.achurchforyou.org/images/r/breakfast/c960x540g0-2-624-353/breakfast.jpg" alt="Slika">
			<p class="vijest">Tko može odoljeti lijepo pečenim, sočnim američkim palačinkama.
Mekane, sončne, slasne - to su američke palačinke. One možda nisu uobičajene za naše krajeve, ali teško da im itko može odoljeti. Idealne su za doručak, marendu, gablec, večeru...

			 </p>
	
		</div>

	</div>


	<div class="red-novosti" >
		<div class="novost">
		<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="2016-04-03T17:52:00"></time>.</p>
    		 <span>Naslov 10</span>
    		 <img src="http://a3.fanbread.com/uploads/image/file/56742/extra_large_5.jpg?fba5c5485d28ba8210a18332a52f504b" alt="Slika">
			<p class="vijest">U posljednjoj fazi je tehnologija proizvodnje kruha bez kvasca i laktoze, pogodna za vegansku ishranu. Svi naši proizvodi se prave po klasičnim, starinskim recepturama, imamo zaokružen proces proizvodnje u sklopu same pekare, pravu manufakturu, koju čini tim od osamnaest ljudi, spremnih da odgovore svim Vašim gurmanskim zahtjevima. </p>
	
		</div>

		<div class="novost" >
		<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="2016-03-20T12:07:00"></time>.</p>
    		<span>Naslov 11</span>
    		 <img src="https://scontent-vie1-1.xx.fbcdn.net/hphotos-xla1/v/t1.0-9/12376362_825970150863895_5197422902008130691_n.jpg?oh=c7e6f0207b22a72da283d1194b83983a&oe=57823E02" alt="Slika">
			<p class="vijest">Mrvica slavi 1. rodjendan!
27.03.2016. od 10 h pripremili smo razna iznenadjenja za Vas. Photobooth BiH - Kabine za slikanje ce biti instalirana od 10.00 h u Mrvici i svi gosti ce imati besplatne vesele fotke sa naseg rodjednana :) Dodjite i proslavite sa nama nas uspjeh i ulazak u novu godinu postojanja! Osjetite car rodjendanske atmosfere koju smo za Vas pripremili.
Welcome all !!! :)
			 </p>
	
		</div>

		<div class="novost" >
		<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="2016-03-27T00:10:00"></time>.</p>
    		 <span>Naslov 12</span>
    		 <img src="http://footage.framepool.com/shotimg/qf/235705289-whipped-cream-birthday-cake-match-tasty.jpg" alt="Slika">
			<p class="vijest">Dragi gosti i prijatelji Mrvice, hvala Vam na predivnom danu! Nadamo se da sta uzivali zajedno sa nama i da cete proslaviti jos dosta rodjendana skupa sa nama! Svoje fotografije mozete pogledati i na nasoj facebook stranici. Uzivajte u specijalitetima koje pripremamo u novoj godini naseg postojanja. Tu smo da Vas cinimo sretnim. Hvala na povjerenju koje nam ukazujete! Vas Mrvica tim.
			 </p>
	
		</div>

	</div>-->


     <?php
     
     function sortirajPoDatumu($d1,$d2){
     	$vrijeme1=strtotime($d1['datum']);
     	$vrijeme2=strtotime($d2['datum']);
     	return $vrijeme2-$vrijeme1;     	
     }

     function sortirajPoAbecedi($d1,$d2){
     	return strcmp($d1['naslov'],$d2['naslov']);
     }

  $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "wtuser", "wtpass");
  $veza->exec("set names utf8");
  $novosti= $veza->query("select id,datum,naslov,slika,tekst from novost;");  
  if(isset($_REQUEST['autor'])){
  	$novosti= $veza->query("select id,datum,naslov,slika,tekst from novost where autor='".$_REQUEST['autor']."';");
  };
  $nizNovosti=$novosti->fetchAll();
  //array_push($nizNovosti,$novosti->fetchColumn());
  //$nizNovosti=$novosti->fetchColumn();

  if(isset($_REQUEST['sortiranje']) && $_REQUEST['sortiranje']=="datum") usort($nizNovosti,"sortirajPoDatumu");
     else usort($nizNovosti,"sortirajPoAbecedi");

  
  $otvorendiv=false;
  $i=0;
  foreach ($nizNovosti as $novost) {
  		if($i%3==0){
	 		print '<div class="red-novosti" >';
	 		$otvorendiv=true;
	 	}


    print   '<div class="novost" id="novost_'.$novost['id'].'" onclick="location.href=\'prikaz.php?novostId='.$novost['id'].'\';" style="cursor: pointer;">';
    $datum="";
    $datum=$novost['datum'];
    $datum=str_replace(" ","T",$datum);

	print	'<p class="vrijeme">Objavljeno <time class="vrijemeObjave" datetime="'.$datum.'"></time>.</p>';
    print   '<span>'.$novost['naslov'].'</span>';
    print   '<img src="'.$novost['slika'].'" alt="Slika">';
	print   '<p class="vijest">'.$novost['tekst'].'</p>';
	print '</div>'; 
        if($i%3==2){
	 		print '</div>';
	 		$otvorendiv=false;
	 	}
	 	$i++;
  }
  	if($otvorendiv){
     	print '</div>';
     }
	

     ?>

</div>

<div id="podnozje"><p >Copyright &copy; Web tehnologije 2015/2016.</p></div>


</body>
</html>