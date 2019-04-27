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
