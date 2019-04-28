

//由于 selectedday现在改成只显示myevents 和allevents，所以这里涉及到selectedday的代码需要修改
 //现在的bug是若当天没有任何信息，则点击myevents后无法切换回allevents
 var currentDay;
 function checkNull() {
     var event = document.getElementById("eventInput").value;
     var time = document.getElementById("timeList").value;
     var eventInput = event.replace(/(^\s*)|(\s*$)/g, '');
     var timeInput = time.replace(/(^\s*)|(\s*$)/g, '');
     if((eventInput === '' || eventInput === undefined || eventInput == null) && (timeInput === '' || timeInput === undefined || timeInput == null)){
         alert("Event and Time cannot be empty");

     }else if (eventInput === '' || eventInput === undefined || eventInput == null ){
         alert("Event cannot be empty");
     }else if(timeInput === '' || timeInput === undefined || timeInput == null){
         alert("Time cannot be empty");
     }
 }function confirmDelete() {
     var window = confirm("Do you want to delete this event?");
     if (window == true){
         return true;
     } else{
         return false;
     }
 }



 function changeToMyEvents() {
     var c1 = document.getElementById("c1");
     var c2 = document.getElementById("c2");
     var theTitle = document.getElementById("selectedDay");
     var btn = document.getElementById("btn");
     btn.value = "All Events";
     currentDay = theTitle.innerText;
     theTitle.innerText = "My Events";
     c1.className = "";
     c2.className = "show";
     btn.setAttribute("onClick","changeToAllEvents()");
 }

 function changeToAllEvents() {
     var c1 = document.getElementById("c1");
     var c2 = document.getElementById("c2");
     var theTitle = document.getElementById("selectedDay");
     var btn = document.getElementById("btn");
     btn.value = "My Events"
     theTitle.innerText = currentDay;
     c1.className = "show";
     c2.className = "";
     btn.setAttribute("onClick","changeToMyEvents()");
 }

 function confirmLogout() {
     var r = confirm("Do you log out LivEasy?")
     if(r==true){
         return true;
     }else{
         return false;
     }
 }

 window.onload=function() {
     function fixRem() {
         var windowWidth = document.documentElement.clientWidth || window.innerWidth || document.body.clientWidth;
         var windowHeight = document.documentElement.clientHeight || window.innerHeight || document.body.clientHeight;
         // windowWidth = windowWidth > 750 ? 750 : windowWidth;
         var rootSize = 28 * (windowWidth / 375);
         var htmlNode = document.getElementsByTagName("html")[0];
         htmlNode.style.fontSize = rootSize + 'px';
     }
     fixRem();
     window.addEventListener('resize', fixRem, false);

 }

 function fixRem() {
     var windowWidth = document.documentElement.clientWidth || window.innerWidth || document.body.clientWidth;
     var windowHeight = document.documentElement.clientHeight || window.innerHeight || document.body.clientHeight;
     // windowWidth = windowWidth > 750 ? 750 : windowWidth;
     var rootSize = 28 * (windowWidth / 375);
     var htmlNode = document.getElementsByTagName("html")[0];
     htmlNode.style.fontSize = rootSize + 'px';
 }
