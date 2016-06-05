function vratiBrojKomentara(username){

	  var ajax = new XMLHttpRequest;
	
	ajax.onreadystatechange=function(){

		        if(ajax.readyState==4 && ajax.status==200){
          
                      //nizKomentara=JSON.parse(ajax.responseText);
                 document.getElementById("broj-komentara").innerHTML=ajax.responseText;
                 console.log(ajax.responseText);

                     
		        }
           
    
          }
    ajax.open("GET", "notifikacijeServis.php?autor="+username, true);
    //ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
     ajax.send();

}