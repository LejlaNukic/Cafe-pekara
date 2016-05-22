function daLiJePrazno(ev){
	var validno=true;
	if(document.getElementById("naslov-novosti").value==""){
		document.getElementById("naslov-novosti").style.background="red";
		validno=false;
		
	}
	else{
		document.getElementById("naslov-novosti").style.background="white";
	}

    if(document.getElementById("slika-novosti").value==""){
		document.getElementById("slika-novosti").style.background="red";
	    validno=false;
	}
	else{
	document.getElementById("slika-novosti").style.background="white";	
	}


	if(document.getElementById("tekst-novosti").value==""){
		document.getElementById("tekst-novosti").style.background="red";
		validno=false;
	}
	else{
		document.getElementById("tekst-novosti").style.background="white";
	}

	if(document.getElementById("drzava-autora").value=="" || !validiraj_drzavu(document.getElementById("drzava-autora"))){
		document.getElementById("drzava-autora").style.background="red";
		validno=false;
	}
	else{
		document.getElementById("drzava-autora").style.background="white";
	}
	if(document.getElementById("telefon-autora").value=="" || !validiraj_telefon(document.getElementById("telefon-autora"))){
		document.getElementById("telefon-autora").style.background="red";
		validno=false;
	}
	else{
		document.getElementById("telefon-autora").style.background="white";
	}

	/*if(!validacijaKoda()){
		document.getElementById("telefon-autora").style.background="red";
		document.getElementById("drzava-autora").style.background="red";
		validno=false;

	}*/

   if(validno===false){
   	ev.preventDefault();
   }
   else{
   	document.getElementById("naslov-novosti").style.background="white";
   	document.getElementById("slika-novosti").style.background="white";
   	document.getElementById("tekst-novosti").style.background="white";
   	document.getElementById("drzava-autora").style.background="white";
   	document.getElementById("telefon-autora").style.background="white";
   }
   return;
}


function  validiraj_telefon(obj){
	var ispravno=true;
	var re=/\+[0-9]+/;
 if((obj.value).match(re)==null || obj.value!=(obj.value).match(re)[0]){ ispravno=false; }
   return ispravno;
}

function validiraj_drzavu(obj){
	var ispravno=true;
	var re=/[a-z]{2}/;
 if((obj.value).match(re)==null || obj.value!=(obj.value).match(re)[0]){ ispravno=false; }
   return ispravno;
}


function validacijaKoda(){
	var kodDrzave=document.getElementById("drzava-autora");
	var telefon=document.getElementById("telefon-autora");
	var ajax = new XMLHttpRequest;
	var ispravno=false;
	ajax.onreadystatechange=function(){

		        if(ajax.readyState==4 && ajax.status==200){
          
                          nizDrzava=JSON.parse(ajax.responseText);
                    if(nizDrzava[0]!=null){
                          for(kod in nizDrzava[0]['callingCodes']){
          	                      if(telefon.value.startsWith('+'+nizDrzava[0]['callingCodes'][kod]))
          	                      {
          	                      	
                                    ispravno=true;
                                    
          	                       }
                           }
          
                    }
         
		        }
           
    }


	 ajax.open("GET", "https://restcountries.eu/rest/v1/alpha?codes="+kodDrzave.value, false);
     ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
     ajax.send();
     if(!ispravno){
     	document.getElementById("telefon-autora").style.background="red";
		document.getElementById("drzava-autora").style.background="red";
                 }

       else{
        document.getElementById("telefon-autora").style.background="white";
		document.getElementById("drzava-autora").style.background="white";

            }
        if(document.getElementById("telefon-autora").value==""||document.getElementById("drzava-autora").value==""){
            	
        if(document.getElementById("drzava-autora").value==""){
        document.getElementById("drzava-autora").style.background="white";	
        }

          if(document.getElementById("telefon-autora").value==""){
        document.getElementById("telefon-autora").style.background="white";	
        }
           	
            }
       
    return ispravno;
}