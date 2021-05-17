var SAVED = 0;
var READING = 1;
var FINISHED = -2;

// --------------------------- SAVED, READING AND FINISHED BOOKS --------------------------- //
var savedbooks_array;
var readingbooks_array;
var finishedbooks_array;

function insertBooksInStorage(mode,_array) {
    if(mode==SAVED){
        savedbooks_array = _array;  
    }
    else if(mode==READING){
        readingbooks_array = _array;
    }
    else if(mode==FINISHED){
        finishedbooks_array= _array;
    }
}


function unsave(mode, n){
    pdf=getPdf(mode,n);

    $.ajax({
        method: 'POST',
        url: 'removeBook.php',
        data: {ajax: 'unsave', pdf: pdf},
        dataType: null
    })
    .done(                                    
		function(){
            window.location.reload(true);
		}
    );
    return true;
}

function reload(mode, n){ 
    pdf=getPdf(mode,n);

    $.ajax({
        method: 'POST',
        url: 'removeBook.php',
        data: {ajax: 'reload', pdf: pdf},
        dataType: null
    })
    .done(                                    
		function(){
            read_button(mode, n);
		}
    );
    return true;
}

function getTitle(mode,i) {
    if(mode==SAVED){
        return savedbooks_array[i].title;
    }
    else if(mode==READING){
        return readingbooks_array[i].title;
    }
    else if(mode==FINISHED){
        return finishedbooks_array[i].title;
    }
}

function getAuthor(mode,i) {
    if(mode==SAVED){
        return savedbooks_array[i].author;
    }
    else if(mode==READING){
        return readingbooks_array[i].author;
    }
    else if(mode==FINISHED){
        return finishedbooks_array[i].author;
    }
}

function getGenreArray(mode,i) {
    if(mode==SAVED){
        return savedbooks_array[i].genre;
    }
    else if(mode==READING){
        return readingbooks_array[i].genre;
    }
    else if(mode==FINISHED){
        return finishedbooks_array[i].genre;
    }
}

function getGenreString(mode,i) {
    let a;
    if(mode==SAVED){
        a = savedbooks_array[i].genre;
    }
    else if(mode==READING){
        a = readingbooks_array[i].genre;
    }
    else if(mode==FINISHED){
        a = finishedbooks_array[i].genre;
    }
    let s = "";
    for (let i=0; i < a.length; i++) {
            s += a[i];
    }
    s=s.replace("{","");
    s=s.replace("}","");
    s=s.replace(/,/g,", ");
    return s;
}

function getPages(mode,i) {
    if(mode==SAVED){
        return savedbooks_array[i].pages;
    }
    else if(mode==READING){
        return readingbooks_array[i].pages;
    }
    else if(mode==FINISHED){
        return finishedbooks_array[i].pages;
    }

}

function getPdf(mode,i) {
    if(mode==SAVED){
        return savedbooks_array[i].pdf;
    }
    else if(mode==READING){
        return readingbooks_array[i].pdf;
    }
    else if(mode==FINISHED){
        return finishedbooks_array[i].pdf;
    }
}

function getImg(mode,i) {
    if(mode==SAVED){
        return "../catalog/c-images/" + savedbooks_array[i].img;
    }
    else if(mode==READING){
        return "../catalog/c-images/" + readingbooks_array[i].img;
    }
    else if(mode==FINISHED){
        return "../catalog/c-images/" + finishedbooks_array[i].img;
    }
}

function drawBooks(mode,div) {
    var bookslength;
    let str = '<div class="row-books">';
    if(mode==SAVED){
        bookslength=savedbooks_array.length;
    }
    else if(mode==READING){
        bookslength=readingbooks_array.length;
    }
    else if(mode==FINISHED){ 
        bookslength = finishedbooks_array.length;
    }
    
    if (bookslength == 0) {                                         // se l'array è vuoto
        str += '<div style="height:205px;"></div>';                 // metto un div vuoto per posizionare bene lo scaffale
    } 
    for (let i = 0; i < bookslength; i++) {

        str +=  '<div class="book"><span class="' + div + 'modal-trigger" name=' + i + '>';
        str +=      '<img name=' + i + ' src=' + getImg(mode,i) + ' width="105px" height="150px"></img><br>' + getTitle(mode,i);
        str +=  '<span></div>';
        
        if ((i+1)%3==0 && i != bookslength-1) {                                                                 // ogni tre libri
            str +=  '</div>';                                                                                   // chiudi la riga
            str +=  '<span class="shelf"><img src= "../catalog/c-images/halfShelf.png"></img></span><br>';      // metti lo scaffale
            str +=  '<div class="row-books">';                                                                  // apri la riga nuova
        }
    }
    str += '</div><span class="shelf"><img src= "../catalog/c-images/halfShelf.png"></img></span>';       //chiudi l'ultima riga e metti lo scaffale
    document.getElementById(div+"-catalog").innerHTML = str;
}



function read_button(mode, n) {
    let url_read = "/../catalog/checkRead.php?pdf="+ getPdf(mode,n);
    window.open(url_read); 
}

// --------------------------- MODAL BOXES, ALL IN FUNCTION START() --------------------------- //
function start(){
    var modal = document.querySelector(".modal");
    var modal_div = document.getElementById("modal-div");
    var closeButton = document.querySelector(".close-button");

    function openFinishedModal(e) { 
        let n =  parseInt(e.target.getAttribute("name"), 10);
        
        let str = "";
        str +=  "<div class='container-modal'>";
        str +=      "<img src=" + getImg(-2,n) + " width='105px' height='150px'></img>";
        str +=  "</div>";
        str +=  "<div class='container-modal'>";
        str +=      "<div class='title-modal'>" + getTitle(-2,n) + "</div>";
        str +=      "<div class='author-modal'>by " + getAuthor(-2,n) + "</div>";
        str +=      "<div class='other-info-modal'>" +  getGenreString(-2,n) + "<br>" + getPages(-2,n) + " pages</div>";
        str +=  "</div>";
        str +=  "<span class='buttons-modal'>";
        str +=  "<button class='button-modal' onclick='return unsave(-2, " + n + ");'>Remove</button>";
        str +=  "<button class='button-modal' onclick='return reload(-2, " + n + ");'>Read again</button>";
        str +=  "</span>";
        modal_div.innerHTML = str;
        modal.classList.toggle("show-modal");
    }

    function openSavedModal(e) {
        let n =  parseInt(e.target.getAttribute("name"), 10);
        
        let str = "";
        str +=  "<div class='container-modal'>";
        str +=      "<img src=" + getImg(0,n) + " width='105px' height='150px'></img>";
        str +=  "</div>";
        str +=  "<div class='container-modal'>";
        str +=      "<div class='title-modal'>" + getTitle(0,n) + "</div>";
        str +=      "<div class='author-modal'>by " + getAuthor(0,n) + "</div>";
        str +=      "<div class='other-info-modal'>" +  getGenreString(0,n) + "<br>" + getPages(0,n) + " pages</div>";
        str +=  "</div>";
        str +=  "<span class='buttons-modal'>";
        str +=      "<button class='button-modal' onclick='return unsave(0, " + n + ");'>Unsave</button>";    //0 = salvato
        str +=      "<button class='button-modal' onclick='return read_button(0, " + n + ");'>Read</button>";
        str +=  "</span>";
        modal_div.innerHTML = str;
        modal.classList.toggle("show-modal");
    }
    function openReadingModal(e) {
        let n =  parseInt(e.target.getAttribute("name"), 10);
        
        let str = "";
        str +=  "<div class='container-modal'>";
        str +=      "<img src=" + getImg(1,n) + " width='105px' height='150px'></img>";
        str +=  "</div>";
        str +=  "<div class='container-modal'>";
        str +=      "<div class='title-modal'>" + getTitle(1,n) + "</div>";
        str +=      "<div class='author-modal'>by " + getAuthor(1,n) + "</div>";
        str +=      "<div class='other-info-modal'>" +  getGenreString(1,n) + "<br>" + getPages(1,n) + " pages</div>";
        str +=  "</div>";
        str +=  "<span class='buttons-modal'>";
        str +=      "<button class='button-modal' onclick='return unsave(1, " + n + ");'>Remove</button>";    //1 = in lettura
        str +=      "<button class='button-modal' onclick='return read_button(1, " + n + ");'>Continue reading</button>";
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

    function savedmodalTriggersAddListener() {
        var savedtriggers = document.getElementsByClassName('savedmodal-trigger');
        for (let i = 0; i < savedtriggers.length; i++)
            savedtriggers[i].onclick = openSavedModal;
    }
    function readingmodalTriggersAddListener() {
        var readingtriggers = document.getElementsByClassName('readingmodal-trigger');
        for (let i = 0; i < readingtriggers.length; i++)
            readingtriggers[i].onclick = openReadingModal;
    }
    function finishedmodalTriggersAddListener(){ 
        var finishedtriggers = document.getElementsByClassName('finishedmodal-trigger');
        for (let i = 0; i < finishedtriggers.length; i++)
            finishedtriggers[i].onclick = openFinishedModal;
    }

    savedmodalTriggersAddListener();
    readingmodalTriggersAddListener();
    finishedmodalTriggersAddListener(); 

    closeButton.addEventListener("click", closeModal);
    window.addEventListener("click", windowOnClick);
}


function confirmDelete() {
    if (confirm('Are you sure you want to delete your account?')) {
        return true;
    }
    else {
        return false;
    }
}