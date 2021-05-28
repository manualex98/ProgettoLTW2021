//aggiorna il DB al click del bottone
function aggiornaDB() {
    $(document).ready(function() { 
        var name="$name";
        var title="$title";
        
        //chiamata ajax 
        $.ajax({ 
            //imposto il tipo di invio dati  
            type: "POST", 
   
            //Invio i dati alla pagina php 
            url: "../info_user/wishlist.php", 
   
            //Dati da salvare 
            data: {name: name, title: title},
            dataType: "html", 
   
            //visualizzazione errori/ok 
            success: function(msg) 
            { 
                alert("Chiamata Ajax riuscita!");
                aggiornaButton(); 
            }, 
            error: function() 
            { 
                alert("Chiamata fallita, si prega di riprovare...");  
            } 
       }); 
    });
}

//cambia il contenuto del bottone da 'Add to favourites' a 'Added'
function aggiornaButton() {
    var e= document.getElementById("button");
    e.innerHTML="Added! <i class='fa fa-heart'></i>";
}

