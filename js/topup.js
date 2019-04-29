function checkNumber(input) {
    var numInput = input.value;
    var numberInput = numInput.replace(/(^\s*)|(\s*$)/g, '');
    var regPos = /^\d+(\.\d+)?$/;
    if(numberInput === '' || numberInput === undefined || numberInput == null){
        document.getElementById("hint").innerText = "";
        document.getElementById("submitBtn").disabled = false;
    }
    else if(regPos.test(numberInput) === false){
        document.getElementById("hint").innerText = "Positive number only";
        document.getElementById("submitBtn").disabled = true;
    }else{
        document.getElementById("hint").innerText = "";
        document.getElementById("submitBtn").disabled = false;
    }
}

function myCheck() {
    var r=confirm("Are you sure to clear all the debts? (This means all the debts have been cleared in reality. All the balance of the users will become 0.)");
    if(r==true){
        return true;
    }else{
        return false;
    }
}

function confirmLogout() {
    var r = confirm("Do you log out LivEasy?")
    if(r==true){
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
