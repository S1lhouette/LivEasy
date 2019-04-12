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
}