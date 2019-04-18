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
    var input1 = document.getElementById("input1").value;
    var input2 = document.getElementById("input2").value;
    var input3 = document.getElementById("input3").value;
    var input4 = document.getElementById("input4").value;
    var input5 = document.getElementById("input5").value;
    var input6 = document.getElementById("input6").value;
    var numberInput1 = input1.replace(/(^\s*)|(\s*$)/g, '');
    var numberInput2 = input2.replace(/(^\s*)|(\s*$)/g, '');
    var numberInput3 = input3.replace(/(^\s*)|(\s*$)/g, '');
    var numberInput4 = input4.replace(/(^\s*)|(\s*$)/g, '');
    var numberInput5 = input5.replace(/(^\s*)|(\s*$)/g, '');
    var numberInput6 = input6.replace(/(^\s*)|(\s*$)/g, '');
    if((numberInput1 === '' || numberInput1 === undefined || numberInput1 == null)
    && (numberInput2 === '' || numberInput2 === undefined || numberInput2 == null)
    &&(numberInput3 === '' || numberInput3 === undefined || numberInput3 == null)
        &&(numberInput4 === '' || numberInput4 === undefined || numberInput4 == null)
        &&(numberInput5 === '' || numberInput5 === undefined || numberInput5 == null)
        &&(numberInput6 === '' || numberInput6 === undefined || numberInput6 == null)) {
        alert("Recharge one account at least");
        return false;
    }
    return true;
}

function confirmLogout() {
<<<<<<< HEAD
    var r = confirm("Do you really want to log out LivEasy?")
=======
    var r = confirm("Do you log out LivEasy?")
>>>>>>> master
    if(r==true){
        return true;
    }else{
        return false;
    }
}
<<<<<<< HEAD
=======

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
>>>>>>> master
