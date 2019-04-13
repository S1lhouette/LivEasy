function confirmDelete() {
    var window = confirm("Do you want to delete this event?");
    if (window == true){
        return true;
    } else{
        return false;
    }
}

function setDisable(obj){
    obj.disabled = true;
}