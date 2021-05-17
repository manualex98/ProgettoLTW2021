BOOKSHELL

Bookshell è una biblioteca virtuale che offre un catalogo da cui l'utente, una volta effettuata la registrazione, può  leggere e salvare libri
nella pagina relativa al proprio account.
Per la visualizzazione dei pdf abbiamo utilizzato la libreria open-source pdfjs, per poter salvare il numero di pagina a cui l'utente arriva
durante la lettura. Per alleggerire il progetto sono stati rimossi dei file non necessari, di conseguenza nel viewer sono presenti dei relativi 
warnings che non ostacolano il funzionamento dello stesso.


• Database "Bookshell" su pgAdmin:
    - tabella "users" (name | email | password)
    - tabella "books" (title | author | genre | pages | pdf | img)
    - tabella "usersbooks" (name | pdf | page)

Pagine principali:

• Homepage
    Pagina iniziale che offre collegamenti ai form di registrazione e login tramite appositi pulsanti, nonché un collegamento alla sezione
    contenente un link per andare alla pagina del catalogo.
    Viene messa a disposizione anche una sezione in cui poterci contattare tramite una form che, all'invio dei dati, richiama il metodo php "mail()".

• Sign Up
    Viene chiesto all'utente di inserire uno username, un'email e una password su cui vengono effettuati dei controlli di validità.
    Sia username che email non devono essere stati usati da altri utenti. Se la registrazione va a buon fine, viene creata una nuova riga
    nella tabella users e viene effettuato automaticamente il login, altrimenti viene mostrata una pagina di errore.
    
• Login
    Viene controllato all'invio che la coppia email-password inserita corrisponda ad una coppia nella tabella users, altrimenti mostra una
    pagina di errore. Se il login ha successo, l'username dell'utente viene salvato in una variabile omonima di sessione che viene richiamata
    dalle altre pagine per effettuare controlli.
    Una volta effettuato il login, nell'intero sito i pulsanti di Login e SignUp vengono sostituiti con Account e Logout.

• Catalog
    Seleziona i libri dalla tabella "books" e li mostra sotto forma di riquadri su cui è possibile cliccare e aprire un box contenente le informazioni
    del libro cliccato (titolo, autore, genere, numero di pagine). Sono presenti anche due pulsanti per salvare o leggere il libro, al click dei 
    quali viene controllato che l'utente sia loggato: in caso negativo, si rimanda ad una pagina di errore. Altrimenti, si inserisce nella
    tabella usersbooks una nuova riga con nome dell'utente, nome del pdf del libro, e numero di pagina, il quale viene
    settato a -1 se il click avviene sul pulsante "save", o ad 1 se sul pulsante "read". Quest'ultimo genera l'apertura della pagina viewer.
    - Filtri:
        È possibile filtrare i libri visualizzati per genere, autore e lunghezza. Si dà modo di applicarli anche tutti e tre insieme.
    - Search
        Come alternativa ai filtri è possibile utilizzare una barra di ricerca, che seleziona i libri che contengono, nel titolo o nell'autore,
        la stringa inserita.

• Viewer
    Pagina che visualizza il pdf del libro scelto dall'utente. Abbiamo disabilitato i pulsanti "print" e "download" presenti nella libreria 
    pdfjs per impedire all'utente di leggere il libro al di fuori del nostro sito. Abbiamo implementato una richiesta ajax che, alla chiusura 
    del viewer, aggiorna nella tabella "usersbooks" il numero di pagina nella riga corrispondente all'utente e al libro.

• Account
    Pagina a cui è possibile accedere solamente dopo aver effettuato il login. 
    Presenta due sezioni, una per i libri in lettura e una per i libri salvati che l'utente non ha ancora cominciato a leggere. 
    Riempie le sezioni tramite due query che selezionano dalla tabella "usersbooks" le righe in cui il nome corrisponde al nome dell'utente loggato.
    Una query prende le righe il cui valore di pagina è -1 e le inserisce nella sezione libri salvati. L'altra prende le righe il cui valore di 
    pagina è diverso da -1 e dal numero di pagine totali del libro e le inserisce nella sezione libri in lettura.
    È possibile leggere i libri presenti nell'account o rimuoverli tramite omonimi pulsanti, con un funzionamento uguale a quelli in Catalog.
    
    Inoltre, è possibile accedere ad un menù (in alto a destra) che offre le funzionalità elencate qui di seguito:
        - Details
            Vengono visualizzati i dettagli del proprio account e viene offerta la possibilità di modificare la propria password.
        - Finished books
            Sezione in cui vengono mostrati i libri finiti, dove viene data la possibilità di rimuoverli o riniziare a leggerli 
        - Logout
            Viene effettuato il logout rimuovendo la variabile "username" dalla sessione
        - Delete account
            Viene rimossa la variabile di sessione "username" e vengono cancellate le righe corrispondenti all'utente dalle tabelle "users" e "usersbooks"
 

Di Anna Carini, Mila Allerhand, Federico Montanari
