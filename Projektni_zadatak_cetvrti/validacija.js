/*Na poruka se moze poslati i ako se unese samo e-mail ili telefon. Sva polja koja sadrze vrijednost moraju biti uspjesno validirana prije slanja.*/


function validiraj_mail(obj){

 var re=/[A-Za-z]+((\.|\_|\-){0,1}[A-Za-z0-9]+)*\@{1}([a-z]+\.)+[a-z]{2,3}/;
if(obj.value=="") document.getElementById("klijentov-mail").style.background="white"
 else if((obj.value).match(re)==null || obj.value!=(obj.value).match(re)[0]) document.getElementById("klijentov-mail").style.background="red"
 	else document.getElementById("klijentov-mail").style.background="white";

}

function validiraj_ime(obj){
 var re=/(.)*\s?(.)*/;

 if(obj.value=="") document.getElementById("ime").style.background="white"
 else if((obj.value).match(re)==null || obj.value!=(obj.value).match(re)[0] || (obj.value).length<2) document.getElementById("ime").style.background="red"
 	else document.getElementById("ime").style.background="white";

}

function validiraj_ocjenu(obj){
	
	if(obj.value=="" && obj.validity.valid==true) document.getElementById("ocjena").style.background="white";
	else if( obj.validity.valid==false || parseInt(obj.value)<1 || parseInt(obj.value)>10 ) document.getElementById("ocjena").style.background="red"
 	else document.getElementById("ocjena").style.background="white";
  // console.log((obj.value).match(re));
}

function validiraj_telefon(obj){
	//var re=/(\+?\s?[0-9]{2,5})?[\s|\/]?([0-9]{2})?[\s|\-|/]?[0-9]{3,4}[\s|\-]?[0-9]{3,4}/;
	var re=/0[0-9]{2}[\/|\s]?[0-9]{3,4}[\-|\s]?[0-9]{3}/;
    
	if(obj.value=="") document.getElementById("klijentov-telefon").style.background="white"
 else if((obj.value).match(re)==null || obj.value!=(obj.value).match(re)[0] || ((obj.value).replace(/[^0-9]/g,"").length)<9){ document.getElementById("klijentov-telefon").style.background="red"; }
 	else document.getElementById("klijentov-telefon").style.background="white";
}


function validiraj_poruku (obj) {
	 if(obj.value==""){ document.getElementById("poruka").style.background="white";document.getElementById("klijentov-mail").style.background="white";}
	 else if(((obj.value).replace(/[\s]/g,"")).length==0 || ((obj.value).replace(/[\s]/g,"").length)>1000) document.getElementById("poruka").style.background="red";

else document.getElementById("poruka").style.background="white";
}

/*Za uspjesno slanje poruke potrebno je unijeti e-mail ili telefon, ako se unese e-mail ne mora telefon i obratno.*/
function multiple_field_validacija(){
	var obj1=document.getElementById("klijentov-mail");
	var obj2=document.getElementById("klijentov-telefon");
	var obj3=document.getElementById("poruka");
	var obj4=document.getElementById("ime");
	var obj5=document.getElementById("ocjena");
	var duzina_poruke=(obj3.value).replace(/\s/g,"").length;
	var duzina_telefona=(obj2.value).replace(/\s/g,"").length;
	var duzina_maila=(obj3.value).replace(/\s/g,"").length;
	var ima_maila;
	var ima_telefona;

	if(document.getElementById("klijentov-mail").value==""){ ima_maila=false;document.getElementById("klijentov-mail").style.backgroundColor="white";}
	if(document.getElementById("klijentov-telefon").value=="") { ima_telefona=false;document.getElementById("klijentov-telefon").style.backgroundColor="white";}
    validiraj_ocjenu(obj5);
    validiraj_ime(obj1);
if(obj3.value!="" && duzina_poruke>0 && duzina_poruke<1000 && ima_telefona==false && ima_maila==false){
	obj1.style.background="red";
	obj2.style.background="red";
	alert("Potrebno je unijeti ili e-mail ili kontakt telefon.");
}





 if(obj3.value!="" && duzina_poruke>0 && duzina_poruke<1000 && obj1.value!="" && obj2.value!="" && obj1.style.backgroundColor=="red" && obj2.style.backgroundColor=="red")
{
	alert("Potrebno je ispravno unijeti kontakt telefon/mail.")
}
/*
else if(obj3.value!="" && duzina_poruke>0 && duzina_poruke<1000 && obj2.value!="" && obj2.style.backgroundColor=="red"){
	alert("Potrebno je ispravno unijeti broj telefona");
}
else if(obj3.value!="" && duzina_poruke>0 && duzina_poruke<1000 && obj1.value!="" && obj1.style.backgroundColor=="red"){
	alert("Potrebno je ispravno unijeti e-mail adresu");
}
*/

 if(obj3.value!="" && (obj3.value).replace(/\s/g,"").length>0 && (obj3.value).replace(/\s/g,"").length<1000 && (obj1.value!="" || obj2.value!="")&&obj1.style.backgroundColor=="white"&&obj2.style.backgroundColor=="white"&&obj3.style.backgroundColor=="white"&&obj4.style.backgroundColor=="white"&&obj5.style.backgroundColor=="white"){
       alert("Poruka uspjesno poslana.")}
       else alert("Validacija nije uspjesna.");
}
