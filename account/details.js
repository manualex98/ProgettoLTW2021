function changePassword(event) {
    
    if (!(checkPassword() && checkPasswordConf())) {
        return false;
    }

    var old_password = document.getElementById('oldPsw').value;
    var new_password = document.getElementById('newPsw').value;
	
	/* Eseguo la chiamata ajax alla pagina signup.php */
	$.ajax({
		method: 'POST',
        url: 'changePassword.php',  //url a cui fare la chiamata/richiesta ajax
        data: {ajax: 'check_password', old_psw: old_password, new_psw: new_password},
        dataType: 'json',           //tipo di dati che mi aspetto di ritorno dal Server
        
	}).done(                        //funzione che viene eseguita una volta la comunicazione con il Server è finita

		/* Funzione di callback */
		function(data) {
			if ( data['correct'] == false )
			{
				document.getElementById('oldPsw').setCustomValidity("Password is wrong");
                document.getElementById('oldPsw').style.borderColor = "rgb(255, 102, 102)";
                alert("Old password is wrong");
				return false;
            }
                        
            alert("Password changed correctly");

            window.location.reload();
			return true;
		}
	);
}

function checkPassword() {
    checkPasswordConf();

    let input = document.getElementById('newPsw');
    let password = input.value;

    let spazio = false;
		
	for (var i = 0; i <= password.length; i++) {
        if (password.charAt(i) == " ") {			//se a un certo punto trova lo spazio (charAt restituisce il carattere in pos i)
            spazio = true;
            break;
        }
    }
    if (spazio) {																				
        input.setCustomValidity('Password can not contain space');
        input.style.borderColor = "rgb(255, 102, 102)";
        return false;
    }
    else if (password.length < 8) {
        input.setCustomValidity('Password needs to be at least 8 characters long');
        input.style.borderColor = "rgb(255, 102, 102)";
        return false;
    }
    return true;
}

function checkPasswordConf() {

    if (document.getElementById('newPsw').value != document.getElementById('newPswConfirm').value) {
        document.getElementById('newPswConfirm').setCustomValidity("Invalid field");
        document.getElementById('newPswConfirm').style.borderColor = "rgb(255, 102, 102)";
        return false;
    }
    return true;
}