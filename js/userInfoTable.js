function confirmDelete() {
    var r = confirm("Are you sure to delete or activate this user?");
    if (r == true){
        return true;
    } else{
        return false;
    }
}

function setDisable(obj){
    obj.disabled = true;
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
  var logout = document.getElementById("logout");
  logout.style.fontSize = "0.1rem";
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
    checkBrowser()
}
