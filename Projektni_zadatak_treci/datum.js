onload=function formatirajDatum(){
	var vremenaObjava=[];
	var nizDatuma=[];
    var vrijemeSada=new Date();
    var nizNovosti=[];
   
    var i=0;
	nizNovosti=document.getElementsByClassName("vrijemeObjave");

	for(i=0;i<nizNovosti.length;i++){
		nizDatuma[i]=new Date(nizNovosti[i].getAttribute('datetime'));

nizNovosti[i].innerHTML=izracunajRazlikuDatuma(nizDatuma[i],vrijemeSada);
	}

}




function izracunajRazlikuDatuma(d1,vrijemeSada){


	var razlika=vrijemeSada-d1;
	var prijeKoliko="";
	var broj;

	if(razlika/1000<60) prijeKoliko="prije par sekundi" 
	else if(razlika/1000>=60 && razlika/(1000*60)<60){broj=parseInt(razlika/(1000*60));  if(broj%10==1 && broj!=11) prijeKoliko="prije "+broj+" minutu";else if(broj>=10 && broj<=20 || broj%10==0) prijeKoliko="prije "+broj+" minuta";else if( (broj<4 || broj>20) && broj%10>=2 && broj%10<=4) prijeKoliko="prije "+broj+" minute";else prijeKoliko="prije "+broj+" minuta"; }
	else if(razlika/(1000*60)>=60 && razlika/(1000*60*60)<24){broj=parseInt(razlika/(1000*60*60));if(broj==1||broj==21) prijeKoliko="prije "+broj+" sat";else if(broj>=5 && broj<=20)prijeKoliko="prije "+broj+" sati";else if(broj==2||broj==3||broj==4||broj==22 ||broj==23) prijeKoliko="prije "+broj+" sata";}
    else if(razlika/(1000*60*60)>24 && razlika/(1000*60*60*24)<7){broj=parseInt(razlika/(1000*60*60*24)); if(broj==1) prijeKoliko="prije "+broj+" dan";else prijeKoliko="prije "+broj+" dana";}
    else if(razlika/(1000*60*60*24)>=7 && razlika/(1000*60*60*24*7)<=4){broj=parseInt(razlika/(1000*60*60*24*7)); if(broj==1) prijeKoliko="prije "+broj+" sedmicu";else prijeKoliko="prije "+broj+" sedmice";}
    else prijeKoliko=d1.getDate()+"."+(d1.getMonth()+1)+"."+d1.getFullYear()+".g";

    return prijeKoliko;

}