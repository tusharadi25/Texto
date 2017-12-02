function validateform() {
    var x = document.forms["Login"]["email"].value;
    var password = document.forms["Login"]["passwd"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
        alert("Not a valid e-mail address");
        return false;
    }
    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }
}