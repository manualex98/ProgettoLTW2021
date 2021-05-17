// --------------------------- BOOKS --------------------------- //


var books_string = "";
var books_array = [];


function insertBooksInStorage(_array) {
    books_string = JSON.stringify(_array);
    books_array = _array;
}
function getTitle(i) {
    return books_array[i].title;
}
function getAuthor(i) {
    return books_array[i].author;
}
function getGenreArray(i) {
    return books_array[i].genre;
}
function getGenreString(i) {
    let a = books_array[i].genre;
    let s = "";
    for (let i=0; i < a.length; i++) {
        s += a[i];
    }
    s=s.replace("{","");
    s=s.replace("}","");
    s=s.replace(/,/g,", ");
    return s;
}
function getPages(i) {
    return books_array[i].pages;
}
function getPdf(i) {
    return "pdfs/" + books_array[i].pdf + "#toolbar=0";
}
function getImg(i) {
    return "c-images/" + books_array[i].img;
}

function drawBooks() {
    let str = '<div class="row-books">';

    if (books_array.length == 0) {                                          // se l'array è vuoto metto un div vuoto alto 205px
        str += '<div style="height:205px;"></div>';                         // perché i modal-trigger sono alti 175px + 15px di padding
    }                                                                       // non serve l'else perché se length==0 il for non viene eseguito

    for (let i = 0; i < books_array.length; i++) {
        
        str +=  '<div class="book"><span class="modal-trigger" name=' + i + '>';
        str +=      '<img name=' + i + ' src=' + getImg(i) + ' width="105px" height="150px"></img><br>' + getTitle(i);
        str +=  '<span></div>';

        if ((i+1) % 5 == 0 && i != books_array.length - 1) {                                 // ogni cinque libri, ma non se è l'ultimo libro
            str +=  '</div>';                                                                           // chiudi la riga
            str +=  '<span class="shelf"><img src="c-images/shelf.png"></img></span><br>';              // metti lo scaffale
            str +=  '<div class="row-books">';                                                          // apri la riga nuova
        }
    }
    str += '</div><span class="shelf"><img src= "c-images/shelf.png"></img></span>';       //chiudi l'ultima riga e metti lo scaffale
    document.getElementById("catalog").innerHTML = str;
}



function read_button(n) {
    let url_read = "checkRead.php?pdf=" + books_array[n].pdf;
    window.open(url_read); 
}
function save_button(n) {
    let url_save = "checkSave.php?pdf=" + books_array[n].pdf;
    window.location.assign(url_save);
}


function start() {

    // --------------------------- MODAL BOX --------------------------- //

    var modal = document.querySelector(".modal");
    var closeButton = document.querySelector(".close-button");
    var modal_div = document.getElementById("modal-div");


    function openModal(e) {
        let n =  parseInt(e.target.getAttribute("name"), 10);

        let str = "";
        str +=  "<div class='container-modal'>";
        str +=      "<img src=" + getImg(n) + " width='105px' height='150px'></img>";
        str +=  "</div>";
        str +=  "<div class='container-modal'>";
        str +=      "<div class='title-modal'>" + getTitle(n) + "</div>";
        str +=      "<div class='author-modal'>by " + getAuthor(n) + "</div>";
        str +=      "<div class='other-info-modal'>" +  getGenreString(n) + "<br>" + getPages(n) + " pages</div>";
        str +=  "</div>";
        str +=  "<span class='buttons-modal'>";
        str +=      "<button class='button-modal' onclick='return save_button(" + n + ");'>Save</button>";
        str +=      "<button class='button-modal' onclick='return read_button(" + n + ");'>Read</button>";
        str +=  "</span>";
        
        modal_div.innerHTML = str;
        modal.classList.toggle("show-modal");
    }
    
    function closeModal() {
        modal.classList.toggle("show-modal");
    }

    function windowOnClick(event) {
        if (event.target === modal) {
            closeModal();
        }
    }

    function modalTriggersAddListener() {
        var triggers = document.getElementsByClassName('modal-trigger');
        for (let i = 0; i < triggers.length; i++)
            triggers[i].onclick = openModal;
    }

    modalTriggersAddListener();

    closeButton.addEventListener("click", closeModal);
    window.addEventListener("click", windowOnClick);



    // --------------------------- FILTERS --------------------------- //

    document.getElementById("searchButton").addEventListener("click", searchBooks);
    document.getElementById("searchField").addEventListener("keypress", searchOnKeyEnter);      // così faccio la ricerca anche premendo enter
    document.getElementById("applyFiltersButton").addEventListener("click", applyFilters);
    document.getElementById("resetFiltersButton").addEventListener("click", resetFilters);


    function searchOnKeyEnter(e){
        if(e.keyCode === 13){                  // se il tasto premuto è enter
            searchBooks();
        }
    }

    function searchBooks() {
        let text = document.getElementById("searchField").value;
        text = text.trim();                                         // rimuovo eventuali spazi bianchi all'inizio e alla fine
        text = text.replace(/  /g, " ");                            // sostituisci eventuali doppi spazi con spazi singoli
        text = text.toLowerCase();                                  // lo metto in lower case per fare una ricerca case insensitive
        
        if (text != "") {
            books_array = JSON.parse(books_string);                 // reset dell'array
            
            let books_array_temp = [];
            let j = 0;
            
            for (let i=0; i < books_array.length; i++) {
                let title = books_array[i].title.toLowerCase();
                let author = books_array[i].author.toLowerCase();
                if (title.includes(text) || author.includes(text)) {
                    books_array_temp[j] = books_array[i];
                    j++;
                }
            }
            books_array = books_array_temp;
            drawBooks();
            modalTriggersAddListener();
        }
        else
            resetFilters();
    }


    function checkGenre(genre, i) {
        if (genre == "none")
            return true;
        else
            return books_array[i].genre.includes(genre);
    }

    function checkAuthor(author, i) {
        if (author == "none")
            return true;
        else
            return books_array[i].author == author;
    }

    function checkPages(pages, i) {
        if (pages == "none")
            return true;
        else {
            pages = pages.split("-");                                           // faccio la split per ottenere un array di due valori
            let lowerBound = parseInt(pages[0]);
            let upperBound = parseInt(pages[1]);
            let book_pages = books_array[i].pages;
            return book_pages >= lowerBound && book_pages <= upperBound;
        }
    }

    function applyFilters() {                                                   
        document.getElementById("searchField").value = "";                      // reimposto la barra di ricerca
        books_array = JSON.parse(books_string);                                 // reset in caso fossero già stati applicati altri filtri
        let books_array_temp = [];
        
        let genre = document.filtersForm.genre.value;
        let author = document.filtersForm.author.value;
        let pages = document.filtersForm.pages.value;

        let j = 0;
        for (let i=0; i < books_array.length; i++) {
            if (checkGenre(genre, i) && checkAuthor(author, i) && checkPages(pages, i)) {           // se rispetta tutti i filtri
                books_array_temp[j] = books_array[i];                                               // aggiungi il libro all'array temporaneo
                j++;
            }
        }
        books_array = books_array_temp;
        drawBooks();
        modalTriggersAddListener();
    }

    function resetFilters() {
        document.getElementById("searchField").value = "";                                  // reimposto la barra di ricerca
        books_array = JSON.parse(books_string);
        drawBooks();
        modalTriggersAddListener();
    }

}
