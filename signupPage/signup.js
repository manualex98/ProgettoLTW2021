/* Funzione per il controllo dell'username: se già esistente lo segnala nel campo */
function checkUsername()
{
	/* Ottengo la var */
	var username = $('input[name="inputName"]').val();
	
	/* Eseguo la chiamata ajax alla pagina signup.php */
	$.ajax({
		method: 'POST',
        url: 'signup.php',      //url a cui fare la chiamata/richiesta ajax
        
        /* array associativo di dati da passare al Server tramite POST:
        * uso ajax: 'check_username' come metodo di controllo per richiamare le operazioni di verifica da far svolgere al Server
        * non posso usare come controllo username poiché quello è il parametro da passare, e se viene usato in più funzioni
        * poi non posso identificare da che funzione è arrivato --> non saprei più se i controlli da fare in base alla funzione sono giusti */
		data: {ajax: 'check_username', user: username},
        dataType: 'json',           //tipo di dati che mi aspetto di ritorno dal Server
        
	}).done(                        //funzione che viene eseguita una volta la comunicazione con il Server è finita

		/* Funzione di callback */
		function(data){
			if ( data['is_used'] == true )
			{
				document.signupForm.inputName.setCustomValidity("Username already used");
				document.signupForm.inputName.style.borderColor = "rgb(255, 102, 102)";
				return false;
			}
			document.signupForm.inputName.setCustomValidity("")
			document.signupForm.inputName.style.borderColor = "rgb(167, 250, 167)";
			return true;
		}
	);
}

function checkEmail() {
    checkEmailConf();

    let input = document.signupForm.inputEmail;
    let email = input.value.toLowerCase().trim();

    let regex = new RegExp(/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/, 'i');
    
    if (email.match(regex)) {
        input.setCustomValidity('');
        input.style.borderColor = "rgb(167, 250, 167)";
        return true;
    }
    else {
        input.setCustomValidity('Insert a valid email');
        input.style.borderColor = "rgb(255, 102, 102)";
        return false;
    }

    /* Questo pezzo è inutile ma Federico ci è affezionato */

    /* var chiocciola = false														
	var punto = false														
	var indexChiocciola = false
		
	for (var i = 0; i <= email.length; i++) {									
		if (email.charAt(i) == "@") {				//se a un certo punto trova la @ (charAt restituisce il carattere in pos i)					
			chiocciola = true													
            indexChiocciola = email.indexOf(email.charAt(i)) + 1	
                                                    //memorizza l'indice della @ (indexOf restitusce l'indice della prima occorrenza del carattere)			
			break
		}
	}
	for (var i = 0; i <= email.length; i++) {										
        if (indexChiocciola && email.charAt(i) == "." && (i > (email.length - 4) || i > (email.length - 5)) && (i < (email.length - 2) || i < (email.length - 3))) {	
                                                        //ultime condizioni = se il punto è in terzultima o quartultima posizione
                                                        //--> assumiamo che la mail possa finire solo con o tre lettere dopo il punto	
			var punto = true					
            break 
        }																	
		else {							
			if (!indexChiocciola && email.charAt(i) == "." && i > indexChiocciola && (i < (email.length - 2) || i < (email.length - 3))) {	
			var punto = true						
			break
			}
		}		
	}		
	if (!chiocciola || !punto) {																				
		if (!chiocciola && !punto) {
            document.signupForm.inputEmail.setCustomValidity('Insert "@" and "."')
            input.style.borderColor = "rgb(255, 102, 102)"
            return false
        }
        else if (punto == true && !chiocciola) {
            document.signupForm.inputEmail.setCustomValidity('Insert "@"')
            input.style.borderColor = "rgb(255, 102, 102)"
            return false
        } 
        else if (chiocciola == true && !punto) {
            document.signupForm.inputEmail.setCustomValidity('Insert "." (.it, .com, ...)')
            input.style.borderColor = "rgb(255, 102, 102)"
            return false
        } 								
    }
    document.signupForm.inputEmail.setCustomValidity("")
    input.style.borderColor = "rgb(167, 250, 167)"
    return true
    */
}

function checkEmailConf() {

    if (document.signupForm.inputEmail.value != document.signupForm.inputEmailConfirm.value) {
        document.signupForm.inputEmailConfirm.setCustomValidity("Invalid field");
        document.signupForm.inputEmailConfirm.style.borderColor = "rgb(255, 102, 102)";
        return false;
    }
    document.signupForm.inputEmailConfirm.setCustomValidity("");
    document.signupForm.inputEmailConfirm.style.borderColor = "rgb(167, 250, 167)";
    return true;
}

function checkPassword() {
    checkPasswordConf();

    let input = document.signupForm.inputPassword;
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
    input.setCustomValidity("");
    input.style.borderColor = "rgb(167, 250, 167)";
    return true;
}

function checkPasswordConf() {

    if (document.signupForm.inputPassword.value != document.signupForm.inputPasswordConfirm.value) {
        document.signupForm.inputPasswordConfirm.setCustomValidity("Invalid field");
        document.signupForm.inputPasswordConfirm.style.borderColor = "rgb(255, 102, 102)";
        return false;
    }
    document.signupForm.inputPasswordConfirm.setCustomValidity("");
    document.signupForm.inputPasswordConfirm.style.borderColor = "rgb(167, 250, 167)";
    return true;
}