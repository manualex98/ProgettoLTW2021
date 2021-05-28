function show1() { 
    var password1 = document.getElementById("password1"); 
    if (password1.type === "password") { 
        password1.type = "text"; 
        $("#icon1").removeClass('fa-eye-slash');
        $("#icon1").addClass('fa-eye');
    } 
    else { 
        password1.type = "password"; 
        $("#icon1").removeClass('fa-eye');
        $("#icon1").addClass('fa-eye-slash');
    } 
}

function show2() { 
    var password2 = document.getElementById("password2"); 
    if (password2.type === "password") { 
        password2.type = "text"; 
        $("#icon2").removeClass('fa-eye-slash');
        $("#icon2").addClass('fa-eye');
    } 
    else { 
        password2.type = "password"; 
        $("#icon2").removeClass('fa-eye');
        $("#icon2").addClass('fa-eye-slash');
    } 
}