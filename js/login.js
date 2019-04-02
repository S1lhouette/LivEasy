    function checkNull() {
        var uName = document.getElementById("usernameInput").value;
        var psd = document.getElementById("passwordInput").value;
        var userName = uName.replace(/(^\s*)|(\s*$)/g, '');
        var password = psd.replace(/(^\s*)|(\s*$)/g, '');
        if ((userName === '' || userName === undefined || userName == null)&&(password === '' || password === undefined || password == null)){
                alert("User name and Password can't be empty");
                    return
        }
        else if (userName === '' || userName === undefined || userName == null){
                    alert("User name can't be empty");
                    return
            }
        else if (password === '' || password === undefined || password == null){
                    alert("Password can't be empty");
                    return
            }
    }

    window.onload=function() {
        function fixRem() {
            var windowWidth = document.documentElement.clientWidth || window.innerWidth || document.body.clientWidth;
            // windowWidth = windowWidth > 750 ? 750 : windowWidth;
            var rootSize = 28 * (windowWidth / 375);
            var htmlNode = document.getElementsByTagName("html")[0];
            htmlNode.style.fontSize = rootSize + 'px';
        }
        fixRem();
        window.addEventListener('resize', fixRem, false);
    }
