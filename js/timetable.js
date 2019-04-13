var currentDay;
function checkNull() {
    var event = document.getElementById("eventInput").value;
    var time = document.getElementById("timeList").value;
    var eventInput = event.replace(/(^\s*)|(\s*$)/g, '');
    var timeInput = time.replace(/(^\s*)|(\s*$)/g, '');
    if((eventInput === '' || eventInput === undefined || eventInput == null) && (timeInput === '' || timeInput === undefined || timeInput == null)){
        alert("Event and Time cannot be empty");

    }else if (eventInput === '' || eventInput === undefined || eventInput == null ){
        alert("Event cannot be empty");
    }else if(timeInput === '' || timeInput === undefined || timeInput == null){
        alert("Time cannot be empty");
    }
}function confirmDelete() {
    var window = confirm("Do you want to delete this event?");
    if (window == true){
        return true;
    } else{
        return false;
    }
}



function changeToMyEvents() {
    var c1 = document.getElementById("c1");
    var c2 = document.getElementById("c2");
    var theTitle = document.getElementById("selectedDay");
    var btn = document.getElementById("btn");
    btn.value = "All Events";
    currentDay = theTitle.innerText;
    theTitle.innerText = "My Events";
    c1.className = "";
    c2.className = "show";
    btn.setAttribute("onClick","changeToAllEvents()");
}

function changeToAllEvents() {
    var c1 = document.getElementById("c1");
    var c2 = document.getElementById("c2");
    var theTitle = document.getElementById("selectedDay");
    var btn = document.getElementById("btn");
    btn.value = "My Events"
    theTitle.innerText = currentDay;
    c1.className = "show";
    c2.className = "";
    btn.setAttribute("onClick","changeToMyEvents()");
}