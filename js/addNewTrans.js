var checkFile = false;
var checkMoney = false;
var checkBox = false;

function load() {
    var background = document.getElementById("background");
    background.style.display = 'block';
}

function checkNull(target) {
	var content = document.getElementById(target).value;
	var hint = target+"Hint";
	if (content.trim() === '' || content === undefined || content == null){
		  document.getElementById("moneyHint").innerHTML = "<font color='red' >Can not be blank</font>";
	}
	else {
		  document.getElementById("moneyHint").innerHTML = "";
	}
}

function checkNum(target) {
	var content = document.getElementById(target).value;
	var hint = target+"Hint";
	if (typeof content != "number") {
		document.getElementById("moneyHint").innerHTML = "<font color='red' >Value must be a number</font>";
	}
	else {
		  document.getElementById("moneyHint").innerHTML = "";
	}
}

function fileChange(target){
var imgName =  document.all.uploadRcpt.value;
     var ext,idx;
    if (imgName == ''){
       // document.all.submitBtn.disabled=true;
       checkFile=false;
        alert("Please choose your receipt file!");
        return;
    } else {
        idx = imgName.lastIndexOf(".");
        if (idx != -1){
            ext = imgName.substr(idx+1).toUpperCase();
            ext = ext.toLowerCase( );
           // alert("ext="+ext);
            if (ext != 'jpg' && ext != 'png' && ext != 'jpeg' && ext != 'gif'){
                // document.all.submitBtn.disabled=true;
                checkFile=false;
                alert("You can only upload .jpg  .png  .jpeg  .gif file!");
                return;
            }
        } else {
          // document.all.submitBtn.disabled=true;
          checkFile=false;
           alert("You can only upload .jpg  .png  .jpeg  .gif file!");
            return;
        }
    }
    checkFile = true;
}

function checkNum(input) {
    var numInput = input.value;
    var numberInput = numInput.replace(/(^\s*)|(\s*$)/g, '');
    var regPos = /^\d+(\.\d+)?$/;
    if(numberInput === '' || numberInput === undefined || numberInput == null){
        document.getElementById("moneyHint").innerHTML = "<font color='red' >Value can not be null</font>";
        // document.getElementById("submitBtn").disabled = true;
        checkMoney = false;
    }
    else if(regPos.test(numberInput) === false){
        document.getElementById("moneyHint").innerHTML = "<font color='red' >Value must be a positive number</font>";
        // document.getElementById("submitBtn").disabled = true;
        checkMoney = false;
    }else{
        document.getElementById("moneyHint").innerHTML = "";
        // document.getElementById("submitBtn").disabled = false;
        checkMoney = true;
    }
}

function checkCheckbox(){
  // var table = document.getElementById("memberTable").value;
  // var rows = table.rows;
  // var cellInfo ="";
  // var cnt = 0;
  // for (var i = 0; i < 6; i++) {    //遍历Table的所有Row
  //           alert("!!!!!");
  //           cellInfo = rows[i].cells[0].innerHTML;   //获取Table中单元格的内容
  //           // if(cellInfo.checkbox.checked==true){
  //           //   cnt++;
  //           // }
  //           // cellInfo="";
  // }
  // if(cnt>0){
  //   // document.getElementById("submitBtn").disabled = false;
  //   alert("great!!!!!!!!!");
  // else{
  //   alert("Please choose at least one member!");
  // }
  var check1 = document.getElementById("userCheckbox1");
  var check2 = document.getElementById("userCheckbox2");
  var check3 = document.getElementById("userCheckbox3");
  var check4 = document.getElementById("userCheckbox4");
  var check5 = document.getElementById("userCheckbox5");
  var check6 = document.getElementById("userCheckbox6");
  if(check1.checked == false &&check2.checked == false &&check3.checked == false
    &&check4.checked == false &&check5.checked == false &&check6.checked == false){
          checkBox= false;
          return;
  }else{
    checkBox = true;
    return;
  }

}

function canSubmit(){
  if(checkBox&&checkFile&&checkMoney){
    alert("Transaction has been added successfully!");
    return true;
  }
  else{
    if(!checkBox){
      alert("Please choose at least one member!");
    }
    if(!checkFile){
      alert("Please upload your receipt!");
    }
    if(!checkMoney){
      alert("Please enter money in correct format!");
    }
    return false;
  }

}

function confirmLogout() {
    var r = confirm("Do you really want to log out LivEasy?")
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
  logout.style.fontSize = "0.1rem";}
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
