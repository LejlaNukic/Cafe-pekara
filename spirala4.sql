-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2016 at 12:56 AM
-- Server version: 5.7.12-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spirala4`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `novost` int(11) NOT NULL,
  `odgovor` int(11) DEFAULT NULL,
  `nov` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `novost` (`novost`),
  KEY `odgovor` (`odgovor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=47 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `autor`, `tekst`, `novost`, `odgovor`, `nov`) VALUES
(1, 'Gost', 'Komentar na vijest.', 7, NULL, 1),
(2, 'Gost', 'Komentar na komentar.', 7, 1, 1),
(11, 'lnukic', 'Novi komentar.', 7, NULL, 1),
(13, 'autor1', 'Novi komentar.', 6, NULL, 1),
(15, 'autor1', 'Moj komentar.', 6, NULL, 1),
(36, 'lnukic', 'Preukusno.', 8, NULL, 0),
(41, 'autor1', 'Sve je super!', 7, NULL, 1),
(42, 'autor1', 'I ovo isto.', 7, 1, 1),
(43, 'autor1', 'Hvalaaaaaaa', 7, 41, 1),
(46, 'lnukic', 'Prejakooo', 7, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `username`, `password`, `admin`) VALUES
(1, 'lnukic', '69cfc2c9c053638d6ee0184182e0dd34', 1),
(2, 'autor1', '02efafd2e074f4fbb258c3e07c76fba9', 0),
(3, 'autor3', '9df22f196a33acd0b372fe502de51211', 0);

-- --------------------------------------------------------

--
-- Table structure for table `novost`
--

CREATE TABLE IF NOT EXISTS `novost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `slika` text COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `komentari` tinyint(1) NOT NULL,
  `datum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `autor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `autor` (`autor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `novost`
--

INSERT INTO `novost` (`id`, `naslov`, `slika`, `tekst`, `komentari`, `datum`, `autor`) VALUES
(6, 'Naslov A', 'http://static.chefkoch-cdn.de/ck.de/rezepte/233/233001/826996-960x720-schoko-cookies-vegan.jpg', 'Veggie riegel u prodaji! Nasim kupcima vec poznati Vegi Pan hljeba - beskvasni dugotrajni hljeb sa sjemenkama, sada i u obliku peciva. Veggie riegel je pogodan za vegansku ishranu, bez kvasca i laktoze. Sadrzi sjemenke suncokreta, lana i tikve, zobenene pahuljice, pirove pahuljice, psenicna vlakna, vlakna jabuke. Vise informacija o brandu Vegipan procitajte na http://www.vegipan.com', 1, '2016-06-05 00:24:50', 2),
(7, 'Naslov B', 'https://scontent-vie1-1.xx.fbcdn.net/hphotos-xpf1/v/t1.0-9/11138093_796203327173911_5754070265581828333_n.jpg?oh=0c0dfa47329f700ffad6664dbf0fecc3&amp;oe=5793AE5E', 'S ponosom objavljujemo da su croissants, pain aux chocolat i pain aux rasins spremni za prodaju. Croissant se pravi sa originalnim francuskim puterom i brasnom, po originalnom receptu sa vremenom spravljanja preko 8 sati. Pain aux chocolat je tijesto originalnog croissanta sa puterom punjen sa cokoladnim stapicima. Pain aux rasins je ukusni puz od francuskog lisnatog tijesta sa slasticarskom kremom i grozdjicama. ', 1, '2016-06-02 14:35:12', 2),
(8, 'Naslov C', 'https://scontent-vie1-1.xx.fbcdn.net/hphotos-xpt1/v/t1.0-9/12495260_807440106050233_312814095121193871_n.jpg?oh=28f1d68798c326a5e4502b74b24a8c71&amp;oe=578BCBDE', 'Ovim putem Vas obavjestavamo da samo jos danas nase macaronse prodajemo u ogranicenim kolicinama. Upucujemo Vam najiskrenije izvinjenje i molbu za razumijevanje za protekla 3 dana sto niste u svako doba mogli naci najdraze kolacice u nasoj Mrvici. Zbog specificnog nacina izrade macaronsa i njihovog vremena pripreme, morali smo ograniciti kolicine da bili onako slatki i perfektni za Vas. ', 0, '2016-06-03 23:58:49', 2),
(9, 'Naslov D', 'http://im0.olx.biz.id/images_olxid/34317621_1_644x461_mums-secrets-bakery-banjarmasin-kota_rev010.jpg', 'Mrvica tim vrijedno je radio kako bi za Vas pripremio jos jedno iznenadjenje. Rijec je o slatkoj kutiji koju mozete koristiti da obradujete Vase najdraze. Print se radi po Vasoj zelji i osjecajte se slobodnim da svoje ideje pretvorite u ova slatka iznenadjenja. Mrvica tim je spreman da odgovori na sve Vase zahtjeve. Vasi zahtjevi su nas izazov. Sve narudzbe realizujemo u roku od sat vremena.', 0, '2016-06-02 00:31:30', 2),
(10, 'Naslov E', 'http://media.foody.vn/res/g5/44969/s/foody-thao-bakery-345-635698148095263960.jpg', 'Iz vremena kad je med bio glavno sladilo stižu nam medenjaci. Iako su naizgled jednostavni potreban je pravi recept i vje&scaron;ta ruka da bi se postigla željena tekstura i medenjaci ostali mekani. Nas tim je vrijedno radio da bi ovu recepturu doveo do savrsenstva. Posjetite nas i sami procijeniti da li smo u tome uspjeli. S nestrpljenjem Vas iscekujemo. ', 1, '2016-06-05 00:14:21', 2),
(11, 'Naslov F', 'http://pix4.agoda.net/hotelimages/230/230696/230696_15012605550024824118.jpg?s=800x600', 'Sjeća&scaron; li se đačkih ekskurzija? Sjeća&scaron; li se kako smo se radovali minijaturnim pakovanjima džema, meda, maslaca i mirisnoga kruha? Pa negdje sa strane poredanih kri&scaron;ki divnoga sira i &scaron;unke? Nismo vi&scaron;e mali, ali nas jo&scaron; raduju male stvari. Probaj klasični doručak na Mrvica način. Zaboravi na brojanje kalorija. Uživaj. Jednostavno, zar ne? ', 0, '2016-06-02 00:32:56', 2),
(12, 'Naslov G', 'http://www.jtb.co.jp/kaigai_opt/img/front/srh/309700_base_14334671113060.jpg', 'Jo&scaron; jednom prizivamo ljeto sa novim voćnim mje&scaron;avinama. Grilovana voćna salata sa super prelivom je ne&scaron;to novo &scaron;to jednostano morate isprobati. Vjerujemo da jo&scaron; niste probavali da pravite voćnu salatu sa voćem sa grila, ali ukus je tako magičan da joj nećete moći odoljeti. Ideju i recept za ovu divnu salatu smo prona&scaron;li u Parizu na Sjamu vocnih salata.', 0, '2016-06-02 00:33:39', 2),
(13, 'Naslov H', 'http://icube.milliyet.com.tr/YeniAnaResim/2016/03/29/islim-kebabi-tarifi-6802250.Jpeg', ' Kremasta, a čvrsta tekstura jednog od najpoznatijih svjetskih sireva, čiji je blagi okus obogaćen cherry paradajzom, zelenom salatom, per&scaron;unom, čarobnim mirisnim bosiljkom i soja sosom, učinit će da poleti&scaron; u euforiji najukusnije salate koja se ikada na&scaron;la na Tvome stolu. ', 0, '2016-06-02 00:34:24', 2),
(14, 'Naslov I', 'http://www.achurchforyou.org/images/r/breakfast/c960x540g0-2-624-353/breakfast.jpg', ' Tko može odoljeti lijepo pečenim, sočnim američkim palačinkama. Mekane, sončne, slasne - to su američke palačinke. One možda nisu uobičajene za na&scaron;e krajeve, ali te&scaron;ko da im itko može odoljeti. Idealne su za doručak, marendu, gablec, večeru... ', 0, '2016-06-02 00:35:18', 2),
(15, 'Naslov J', 'http://a3.fanbread.com/uploads/image/file/56742/extra_large_5.jpg?fba5c5485d28ba8210a18332a52f504b', ' U posljednjoj fazi je tehnologija proizvodnje kruha bez kvasca i laktoze, pogodna za vegansku ishranu. Svi na&scaron;i proizvodi se prave po klasičnim, starinskim recepturama, imamo zaokružen proces proizvodnje u sklopu same pekare, pravu manufakturu, koju čini tim od osamnaest ljudi, spremnih da odgovore svim Va&scaron;im gurmanskim zahtjevima. ', 0, '2016-06-02 00:36:11', 2),
(16, 'Naslov K', 'https://scontent-vie1-1.xx.fbcdn.net/hphotos-xla1/v/t1.0-9/12376362_825970150863895_5197422902008130691_n.jpg?oh=c7e6f0207b22a72da283d1194b83983a&amp;oe=57823E02', 'Mrvica slavi 1. rodjendan! 27.03.2016. od 10 h pripremili smo razna iznenadjenja za Vas. Photobooth BiH - Kabine za slikanje ce biti instalirana od 10.00 h u Mrvici i svi gosti ce imati besplatne vesele fotke sa naseg rodjednana :) Dodjite i proslavite sa nama nas uspjeh i ulazak u novu godinu postojanja! Osjetite car rodjendanske atmosfere koju smo za Vas pripremili. Welcome all !!! :) ', 0, '2016-06-02 00:37:04', 2),
(17, 'Naslov L', 'http://footage.framepool.com/shotimg/qf/235705289-whipped-cream-birthday-cake-match-tasty.jpg', 'Dragi gosti i prijatelji Mrvice, hvala Vam na predivnom danu! Nadamo se da sta uzivali zajedno sa nama i da cete proslaviti jos dosta rodjendana skupa sa nama! Svoje fotografije mozete pogledati i na nasoj facebook stranici. Uzivajte u specijalitetima koje pripremamo u novoj godini naseg postojanja. Tu smo da Vas cinimo sretnim. Hvala na povjerenju koje nam ukazujete! Vas Mrvica tim. ', 0, '2016-06-02 00:37:47', 2),
(18, 'Naslov R', 'http://pix4.agoda.net/hotelimages/230/230696/230696_15012605550024824118.jpg?s=800x600', 'Sjeća&scaron; li se đačkih ekskurzija? Sjeća&scaron; li se kako smo se radovali minijaturnim pakovanjima džema, meda, maslaca i mirisnoga kruha? Pa negdje sa strane poredanih kri&scaron;ki divnoga sira i &scaron;unke? Nismo vi&scaron;e mali, ali nas jo&scaron; raduju male stvari. Probaj klasični doručak na Mrvica način. Zaboravi na brojanje kalorija. Uživaj. Jednostavno, zar ne? ', 0, '2016-06-02 00:38:33', 2),
(19, 'Naslov T', 'http://im0.olx.biz.id/images_olxid/34317621_1_644x461_mums-secrets-bakery-banjarmasin-kota_rev010.jpg', 'Mrvica tim vrijedno je radio kako bi za Vas pripremio jos jedno iznenadjenje. Rijec je o slatkoj kutiji koju mozete koristiti da obradujete Vase najdraze. Print se radi po Vasoj zelji i osjecajte se slobodnim da svoje ideje pretvorite u ova slatka iznenadjenja. Mrvica tim je spreman da odgovori na sve Vase zahtjeve. Vasi zahtjevi su nas izazov. Sve narudzbe realizujemo u roku od sat vremena', 0, '2016-06-02 00:39:17', 2),
(20, 'Naslov U', 'http://media.foody.vn/res/g5/44969/s/foody-thao-bakery-345-635698148095263960.jpg', 'Iz vremena kad je med bio glavno sladilo stižu nam medenjaci. Iako su naizgled jednostavni potreban je pravi recept i vje&scaron;ta ruka da bi se postigla željena tekstura i medenjaci ostali mekani. Nas tim je vrijedno radio da bi ovu recepturu doveo do savrsenstva. Posjetite nas i sami procijeniti da li smo u tome uspjeli. S nestrpljenjem Vas iscekujemo. ', 0, '2016-06-02 00:39:59', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`novost`) REFERENCES `novost` (`id`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`odgovor`) REFERENCES `komentar` (`id`);

--
-- Constraints for table `novost`
--
ALTER TABLE `novost`
  ADD CONSTRAINT `novost_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `korisnik` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
