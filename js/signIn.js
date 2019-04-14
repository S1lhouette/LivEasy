function checkPsw() {
    var inputPsw = document.getElementById("psw1").value;
    var reg = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[~!@#$%^&*()_+`\-={}:";'<>?,.\/]).{8,16}$/;
    var flag = reg.test(inputPsw);
    if(flag == false){
        document.getElementById("firstPswHint").innerHTML = "<font color='red'>Password must contain numbers, letters, special symbols and the length between 8-16</font>";
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
    }
    else {
      document.getElementById("pswHint").innerHTML="<font color='red'>Inconsistent Password</font>";
      cnt++;
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
        cnt++;
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
        cnt++;
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
        cnt++;
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
              cnt++;
        }
    }

    function ableBtn(){
       for(var i=0;i<document.signInForm.elements.length-1;i++)
       {
        if(document.signInForm.elements[i].value=="")
        {
          alert("The current form cannot have empty entries");
          document.signInForm.elements[i].focus();
          return false;
        }
       }
       return true;
     }
    }

    function myCheck()
        {
            for(var i=0;i<document.signInForm.elements.length-1;i++)
            {
                if(document.signInForm.elements[i].value=="")
                {
                    alert("All input boxes cannot be empty");
                    document.signInForm.elements[i].focus();
                    return false;
                }
            }
            return true;

        }
