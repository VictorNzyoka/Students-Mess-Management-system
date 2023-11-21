
var schedule=$("#mess-schedule");



function currentTime() {
  let date = new Date(); 
  let hh = date.getHours();
  let mm = date.getMinutes();
  let ss = date.getSeconds();
  let session = "AM";

  if(hh === 0){
   //    hh = 12;
   //    if(hh > 12){
   //   //hh = hh - 12;
   //    session = "PM";
   // }
  } 
  if(hh>12){
    session="PM";
  }
   hh = (hh < 10) ? "0" + hh : hh;
   mm = (mm < 10) ? "0" + mm : mm;
   ss = (ss < 10) ? "0" + ss : ss;
    
   let time = hh + ":" + mm + ":" + ss + " " + session;

   if(hh>5&&hh<11){
    $("#menu-schedule").text("Breakfast menu available.. ");  
    //document.getElementById("#menu-schedule").innerHTML="lunch menu available "; 
   }else if(hh>=11&&hh<=12 ){
   $("#menu-schedule").text("Lunch menu available "); 
  }
  else if(hh>=12&&hh<=14){
   $("#menu-schedule").text("Lunch menu available "); 
  }
    else if(hh>=17&&hh<20){
   $("#menu-schedule").text("supper menu available ");  
    console.log("supper menu available");
   }else{
    $("#menu-schedule").text("menu Unavailable at the moment ");
   }
  document.getElementById("Time").innerHTML=time;  
  schedule.text(time);

  console.log(time);
}

setInterval(currentTime,1000);



   
   
  $("#emoji").text("👇");                
