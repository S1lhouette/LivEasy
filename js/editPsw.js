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

function myCheck()
{
    for(var i=0;i<document.pswForm.elements.length-1;i++)
    {
        if(document.pswForm.elements[i].value=="")
        {
            alert("All input boxes should be filled");
            document.pswForm.elements[i].focus();
            return false;
        }
    }
    return true;

}
function verifyPsw() {
    var x = document.getElementById('psw1').value;
    var y = document.getElementById('psw2').value;
    if(x==y) {
        document.getElementById("hint").innerHTML="";
        document.getElementById("submitBtn").disabled = false;

    }
    else {
        document.getElementById("hint").innerHTML="Inconsistent Password";
        document.getElementById("submitBtn").disabled = true;


    }
}

function checkPsw() {
    var inputPsw = document.getElementById("psw1").value;
    var reg1 = /^(?=.*[A-Za-z])[A-Za-z\d!@#$]{8,16}$/;
    var reg2 = /^(?=.*\d)[A-Za-z\d!@#$]{8,16}$/;
    var flag = reg1.test(inputPsw)||reg2.test(inputPsw);
    if(flag == false){
        // Password must contain numbers, letters, special symbols and the length between 8-16
        document.getElementById("hint1").innerHTML = "Invalid Password";
        document.getElementById("submitBtn").disabled = true;

    }else{
        document.getElementById("hint1").innerHTML = "";
        document.getElementById("submitBtn").disabled = false;

    }
}
