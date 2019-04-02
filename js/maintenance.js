function checkNull() {
    var content = document.getElementById('facility').value;
    if (content.trim() === '' || content === undefined || content == null){
          alert("Facility can not be blank!");
    }
    else{
      updateTable();
    }
}

function updateTable(){
    var facility = document.getElementById('facility').value;
    var note = document.getElementById('note').value;
    row = document.getElementById('maintTable').insertRow();
      cell=row.insertCell();
      cell.innerHTML=facility;
      cell = row.insertCell();
      cell.innerHTML=note;
      cell = row.insertCell();
      cell.innerHTML="<button class='btn finishBtn' name='Finish Maintenance' onclick='setDisable(this)'>Finish</button>";
}

function setDisable(obj){
    obj.disabled = true;
}
