function logout() {
    var xhr;

    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else {
        xhr = ActiveXObject(Microsoft.XMLHTTP)
    }

    let text = "Are you sure want to Logout?";
    if (confirm(text) == true) {
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.body.innerHTML = this.responseText;
            }
        }
    }
    xhr.open('GET', "logout.php", true);
    xhr.send();
}

function login_msg() {
    let login = confirm("Please Login to Continue....");
    if (login === true) {
        window.location.href = "http://localhost/college_php/Project/login.php";
    }
}