function load() {
    var background = document.getElementById("background");
    background.style.display = 'block';
}
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
    var c2 = document.getElementById("c2");
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
        alert("Message can't be empty");
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
