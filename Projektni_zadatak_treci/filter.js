function filtriraj (opcija) {
	var nizNovosti=[];
	var danas=new Date();
	var nizDatuma=[];
	nizNovosti=document.getElementsByClassName("vrijemeObjave");
	var sveNovosti=document.getElementsByClassName("novost");
	

	if(opcija=="sve"){
		
       for(var i=0;i<sveNovosti.length;i++)
           sveNovosti[i].style.display="inline-block";}

       else if(opcija=="mjesec"){


       	 for(var i=0;i<sveNovosti.length;i++)
           sveNovosti[i].style.display="inline-block";
           for(i=0;i<nizNovosti.length;i++){
		nizDatuma[i]=new Date(nizNovosti[i].getAttribute('datetime'));
             if((nizDatuma[i].getMonth()+1)!=danas.getMonth()+1)
             	sveNovosti[i].style.display="none";
	                                       }
       }

       else if(opcija=="dan"){

    for(var i=0;i<sveNovosti.length;i++)
           sveNovosti[i].style.display="inline-block";


       	  for(i=0;i<nizNovosti.length;i++){
		nizDatuma[i]=new Date(nizNovosti[i].getAttribute('datetime'));
             if(((nizDatuma[i].getMonth()+1)==(danas.getMonth()+1)) &&(nizDatuma[i].getDate()==danas.getDate())&&(nizDatuma[i].getFullYear()==danas.getFullYear()))
             	sveNovosti[i].style.display="inline-block";
             else sveNovosti[i].style.display="none";
	                                       }
            }

	   else if(opcija=="sedmica"){


	   	 for(var i=0;i<sveNovosti.length;i++)
           sveNovosti[i].style.display="inline-block";
      
         var pocetniDatum=new Date();
        var krajnjiDatum=new Date();
         if(danas.getDay()==0) {
             pocetniDatum.setTime(danas.getTime()-6*24*3600*1000);
         krajnjiDatum.setTime(danas.getTime()+0*24*3600*1000);
         pocetniDatum.setUTCHours(0,0,0,0);
         krajnjiDatum.setUTCHours(23,59,59,999);

         }
         else {
         pocetniDatum.setTime(danas.getTime()-(danas.getDay()-1)*24*3600*1000);
         krajnjiDatum.setTime(danas.getTime()+(7-danas.getDay())*24*3600*1000);
         pocetniDatum.setUTCHours(0,0,0,0);
         krajnjiDatum.setUTCHours(23,59,59,999);

       }
      
	   	 for(i=0;i<nizNovosti.length;i++){
		nizDatuma[i]=new Date(nizNovosti[i].getAttribute('datetime'));
             if(nizDatuma[i]>=pocetniDatum && nizDatuma[i]<=krajnjiDatum)
             	sveNovosti[i].style.display="inline-block";
             else sveNovosti[i].style.display="none";
	                                       }


	   }

       
}

