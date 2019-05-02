function checkPsw() {
    var inputPsw = document.getElementById("psw1").value;
    var reg1 = /^(?=.*[A-Za-z])[A-Za-z\d!@#$]{8,16}$/;
    var reg2 = /^(?=.*\d)[A-Za-z\d!@#$]{8,16}$/;
    var flag = reg1.test(inputPsw)||reg2.test(inputPsw);
    if(flag == false){
      // Password must contain numbers, letters, special symbols and the length between 8-16
        document.getElementById("firstPswHint").innerHTML = "<font color='red'>Invalid Password</font>";
        document.getElementById("registerBtn").disabled = true;

    }else{
        document.getElementById("firstPswHint").innerHTML = "";
        document.getElementById("registerBtn").disabled = false;

    }
  }

  function verifyPsw() {
    var x = document.getElementById('psw1').value;
    var y = document.getElementById('psw2').value;
    if(x==y) {
      document.getElementById("pswHint").innerHTML="";
      document.getElementById("registerBtn").disabled = false;
    }
    else {
      document.getElementById("pswHint").innerHTML="<font color='red'>Inconsistent Password</font>";
      document.getElementById("registerBtn").disabled = true;
    }
  }

  	function isEmail(){
      var strEmail = document.getElementById('email').value;
  		var reg=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
  		if(strEmail == null || strEmail.search(reg) == -1)
      {
  			document.getElementById("emailHint").innerHTML = "<font color='red' >Invalid Email Address</font>";
  		}
      else{
        document.getElementById("emailHint").innerHTML = "";
      }
  	}

    function isFlatNum(){
      var strNum = document.getElementById('flatNum').value;
  		var reg=/^[0-9]*$/;
  		if(strNum == null || strNum.search(reg) == -1)
      {
  			document.getElementById("flatHint").innerHTML = "<font color='red' >Invalid Flat Number</font>";
  		}
      else{
        document.getElementById("flatHint").innerHTML = "";
      }
  	}

    function isRoomNum(){
      var strNum = document.getElementById('roomNum').value;
  		var reg=/^[A-Z]{1}$/i;
  		if(strNum == null || strNum.search(reg) == -1)
      {
  			document.getElementById("roomHint").innerHTML = "<font color='red' >Invalid Room Number</font>";
  		}
      else {
        document.getElementById("roomHint").innerHTML = "";
      }
  	}

    function checkNull(target) {
        var content = document.getElementById(target).value;
        var hint = target+"Hint";
        if (content.trim() === '' || content === undefined || content == null){
              document.getElementById("firstNameHint").innerHTML = "<font color='red' >Can not be blank</font>";
        }
        else{
              document.getElementById("firstNameHint").innerHTML = "";
        }
    }

    function deleteConfirm(){
      if (confirm("Do you want to delete your account forever?")) {
        alert("Successfully delete!");
        window.location.href="login.html";
      }else{
      }
    }

    window.onload=function() {
        function fixRem() {
            var windowWidth = document.documentElement.clientWidth || window.innerWidth || document.body.clientWidth;
            // windowWidth = windowWidth > 750 ? 750 : windowWidth;
            var rootSize = 28 * (windowWidth / 375);
            var htmlNode = document.getElementsByTagName("html")[0];
            htmlNode.style.fontSize = rootSize + 'px';
        }
        fixRem();
        window.addEventListener('resize', fixRem, false);
    }

    function myCheck()
    {
        for(var i=0;i<document.editForm.elements.length-1;i++)
        {
            if(document.editForm.elements[i].value=="")
            {
                alert("All input boxes cannot be empty");
                document.editForm.elements[i].focus();
                return false;
            }
        }
        return true;

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
      var title = document.getElementById("subTitile");
  title.style.fontSize = "0.2rem"; }
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
