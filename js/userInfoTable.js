function confirmDelete() {
    var window = confirm("Do you want to delete this user?");
    if (window == true){
        return true;
    } else{
        return false;
    }
}

function setDisable(obj){
    obj.disabled = true;
}
<<<<<<< HEAD

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
=======
>>>>>>> master
