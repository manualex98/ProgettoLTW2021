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

function clean(){
    var password = document.getElementById("password1");
    password.value="";
    var checkbox = document.getElementById("ckbox");
    checkbox.disabled=false;
    
}