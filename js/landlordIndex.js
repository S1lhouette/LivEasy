    function confirmDelete() {
      var r = confirm("Are you sure to delete the message?")
        if(r==true){
            return true;
        }else{
            return false;
        }
    }

    function confirmFinish() {
      var r = confirm("Are you sure that the repairment has been finished?")
        if(r==true){
            return true;
        }else{
            return false;
        }
    }

    function deleteMsg(target){
      if (confirm("Do you really want to delete this message?")) {
        deleteRow(target);
      }else{
      }
    }

    function deleteRow(obj){
      var tr=obj.parentNode.parentNode;
      tr.parentNode.removeChild(tr);
      alert("Successfully delete!");
    }

    function addMsg() {
        var c1 = document.getElementById("billboard");
        var c2 = document.getElementById("textField");
        var submitBtn = document.getElementById("submitBtn")
        c1.className = "hide";
        c2.className = "show";
        submitBtn.className = "float";
    }

    function viewBillboard() {
        var c1 = document.getElementById("billboard");
        var c2 = document.getElementById("textField");
        c1.className = "show";
        c2.className = "hide";
    }


    function addRow(){
        var content = document.getElementById('msgInput').value;
        row = document.getElementById('msgTable').insertRow();
          cell=row.insertCell();
          cell.innerHTML=content;
          cell = row.insertCell();
          cell.innerHTML="<img class='delete' src='../images/delete.png' alt='' onclick='deleteMsg(this)'>";
          document.getElementById('msgInput').value="";
          viewBillboard();
    }

    function checkNull(content) {
        if (content.trim() === '' || content === undefined || content == null){
              alert("Message can not be empty");
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
      var logout = document.getElementById("logout");
      logout.style.fontSize = "1rem";
    }
    }
