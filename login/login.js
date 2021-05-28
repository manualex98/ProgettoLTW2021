function checkEmail() {

    let input = document.loginForm.inputEmail;
    let email = input.value.toLowerCase().trim();

    let regex = new RegExp(/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/, 'i');
    if (email.match(regex)) {
        input.setCustomValidity('');
        input.style.borderColor = "transparent";
        return true;
    }
    else {
        input.setCustomValidity('Insert a valid email');
        input.style.borderColor = "rgb(255, 102, 102)";
        return false;
    }
}

function show1() { 
    var password1 = document.getElementById("password1"); 
    if (password1.type === "password") { 
        password1.type = "text";
        $("i").removeClass('fa-eye-slash');
        $("i").addClass('fa-eye');
    } 
    else { 
        password1.type = "password";
        $("i").removeClass('fa-eye');
        $("i").addClass('fa-eye-slash');
    } 
}
