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

function confirmLogout() {
    var r = confirm("Do you really want to log out LivEasy?")
    if(r==true){
        return true;
    }else{
        return false;
    }
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

// function updateBalance(balance) {
// 	document.getElementById("bal").innerHTML = "Balance: " + balance;;
// }
