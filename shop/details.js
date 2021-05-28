//aggiorna il DB al click del bottone
function aggiornaDB() {
    aggiornaButton();
}

//cambia il contenuto del bottone da 'Add to favourites' a 'Added'
function aggiornaButton() {
    var e= document.getElementById("button");
    e.innerHTML="Added! <i class='fa fa-heart'></i>";
}

