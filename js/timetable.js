

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

 function IEVersion() {
 var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
 var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1; //判断是否IE<11浏览器
 var isEdge = userAgent.indexOf("Edge") > -1 && !isIE; //判断是否IE的Edge浏览器
 var isIE11 = userAgent.indexOf('Trident') > -1 && userAgent.indexOf("rv:11.0") > -1;
 if(isIE) {
     var reIE = new RegExp("MSIE (\\d+\\.\\d+);");
     reIE.test(userAgent);
     var fIEVersion = parseFloat(RegExp["$1"]);
     if(fIEVersion == 7) {
         return 7;
     } else if(fIEVersion == 8) {
         return 8;
     } else if(fIEVersion == 9) {
         return 9;
     } else if(fIEVersion == 10) {
         return 10;
     } else {
         return 6;//IE版本<=7
     }
 } else if(isEdge) {
     return 'edge';//edge
 } else if(isIE11) {
     return 11; //IE11
 }else{
     return -1;//不是ie浏览器
 }
 }

 function checkBrowser(){
 var browserName = IEVersion();
 if(browserName == 7|| browserName == 8||browserName == 9||browserName == 10||browserName == 6||browserName == 11||browserName == 'edge'){
   var logo = document.getElementById("logoSmall");
   logo.style.height = "1rem";
   var logout = document.getElementById("logout");
   logout.style.fontSize = "0.1rem";
  }
 }
 // window.onload=function() {
 //     function fixRem() {
 //         var windowWidth = document.documentElement.clientWidth || window.innerWidth || document.body.clientWidth;
 //         var windowHeight = document.documentElement.clientHeight || window.innerHeight || document.body.clientHeight;
 //         // windowWidth = windowWidth > 750 ? 750 : windowWidth;
 //         var rootSize = 28 * (windowWidth / 375);
 //         var htmlNode = document.getElementsByTagName("html")[0];
 //         htmlNode.style.fontSize = rootSize + 'px';
 //     }
 //     fixRem();
 //     window.addEventListener('resize', fixRem, false);
 //     checkBrowser();
 //
 // }

 function fixRem() {
     var windowWidth = document.documentElement.clientWidth || window.innerWidth || document.body.clientWidth;
     var windowHeight = document.documentElement.clientHeight || window.innerHeight || document.body.clientHeight;
     // windowWidth = windowWidth > 750 ? 750 : windowWidth;
     var rootSize = 28 * (windowWidth / 375);
     var htmlNode = document.getElementsByTagName("html")[0];
     htmlNode.style.fontSize = rootSize + 'px';
 }
