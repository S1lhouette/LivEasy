function load() {
    var background = document.getElementById("background");
    background.style.display = 'block';
}

function setDisable(obj) {
    obj.disabled = true;
}

function updateAccTable(date, payer, cost) {
	var table = document.getElementById("accountingTable");
	var row = table.insertRow();
    cell = row.insertCell();
    cell.innerHTML = date;
    cell = row.insertCell();
    cell.innerHTML = payer;
    cell = row.insertCell();
	cell.innerHTML = "&#163;" + cost;
}

// function updateConfirmTable(date, price, rcptLocation) {
// 	var table = document.getElementById("confirmTable");
// 	var row = table.insertRow();
// 	cell = row.insertCell();
// 	cell.innerHTML = date;
// 	cell = row.insertCell();
// 	cell.innerHTML = "&#163;" + price;
// 	cell = row.insertCell();
// 	var newLink = document.createElement("a");
// 	var linkText = document.createTextNode("View receipt");
// 	newLink.href = rcptLocation;
// 	newLink.className = "links";
// 	newLink.appendChild(linkText);
// 	cell.innerHTML = newLink;
// 	cell = row.insertCell();
// 	cell.innerHTML = '<button class="btn confirmBtn" name="Confirm transaction" onclick="setDisable(this)">Confirm</button></td>';
// }

function updateBalance(balance) {
	document.getElementById("bal").innerHTML = "Balance: " + balance;
}
function confirmLogout() {
    var r = confirm("Do you log out LivEasy?")
    if(r==true){
        return true;
    }else{
        return false;
    }
}

function confirmConfirmBtn() {
    var r = confirm("Are you sure to confirm this transaction?");
    if(r == true){
        return true;
    }else{
        return false;
    }
}

function confirmDeleteBtn() {
    var r = confirm("Are you sure to recall this transaction? (All the information of the transaction will be deleted and the consumers' balance will not reduce.)");
    if(r == true){
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
