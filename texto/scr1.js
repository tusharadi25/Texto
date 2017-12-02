function validateform() {
    var x = document.forms["signup"]["email"].value;
    var pass1 = document.forms["signup"]["pwd1"].value;
    var pass2 = document.forms["signup"]["pwd2"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
        alert("Not a valid e-mail address");
        return false;
    }
    if (pass1.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }
    if (pass1 != pass2) {
        alert("Enter same password again");
        return false;
    }
}