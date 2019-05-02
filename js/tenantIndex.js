// function load() {
//     var background = document.getElementById("background");
//     background.style.display = 'block';
// }
function changeTab1() {
    var tab1 = document.getElementById("allMsg");
    var tab2 = document.getElementById("addMsg");
    var tab3 = document.getElementById("myMsg");
    var c1 = document.getElementById("c1");
    var c2 = document.getElementById("c2");
    var c3 = document.getElementById("c3");
    tab1.className = "verticalBtn selected";
    tab2.className = "verticalBtn";
    tab3.className = "verticalBtn";
    c1.className = "show";
    c2.className = "";
    c3.className = "";
}
function changeTab2() {
    var tab1 = document.getElementById("allMsg");
    var tab2 = document.getElementById("addMsg");
    var tab3 = document.getElementById("myMsg");
    var c1 = document.getElementById("c1");
    var c2 = document.getElementById( "c2");
    var c3 = document.getElementById("c3");
    tab1.className = "verticalBtn";
    tab2.className = "verticalBtn selected";
    tab3.className = "verticalBtn";
    c1.className = "";
    c2.className = "show";
    c3.className = "";
}
function changeTab3() {
    var tab1 = document.getElementById("allMsg");
    var tab2 = document.getElementById("addMsg");
    var tab3 = document.getElementById("myMsg");
    var c1 = document.getElementById("c1");
    var c2 = document.getElementById("c2");
    var c3 = document.getElementById("c3");
    tab1.className = "verticalBtn";
    tab2.className = "verticalBtn";
    tab3.className = "verticalBtn selected";
    c1.className = "";
    c2.className = "";
    c3.className = "show";
}

function checkNull() {
    var msg = document.getElementById("msgInput").value;
    var Message = msg.replace(/(^\s*)|(\s*$)/g, '');
    if (Message === '' || Message === undefined || Message == null) {
        alert("Message can not be empty");
    }
}

function confirmDelete() {
    var window = confirm("Do you want to delete this message?");
    if (window == true){
        return true;
    } else{
        return false;
    }
}

function updateTable() {
    var msg= document.getElementById("msgInput").value;
    allTable = document.getElementById("msgTable");
    newRow = allTable.insertRow();
    cell1 = newRow.insertCell();
    cell1.innerHTML = msg;
    cell1 = newRow.insertCell();
    var selectStatus=document.getElementById('anonymous');
    if(!selectStatus.checked){
          cell1.innerHTML = "Anonymous";
    }else{
          cell1.innerHTML = "Username";
    }


    myTableRow = document.getElementById("myTable");
    newRow2 = myTableRow.insertRow();
    cell2 = newRow2.insertCell();
    cell2.innerHTML = msg;
    cell2 = newRow2.insertCell();
    cell2.innerHTML = "<button class=\"deleteBtn\" onclick=\"confirmDelete()\">Delete</button>";
    this.changeTab1();
    document.getElementById("msgInput").value = "";

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
var tag1 = document.getElementById("allMsg");
var tag2 = document.getElementById("addMsg");
var tag3 = document.getElementById("myMsg");
tag1.style.fontSize = "0.1rem";
tag2.style.fontSize = "0.1rem";
tag3.style.fontSize = "0.1rem";
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
    checkBrowser();
}
