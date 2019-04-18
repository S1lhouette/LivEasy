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