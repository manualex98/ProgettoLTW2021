Database "Bookmark" su pgAdmin:
    -tabella "users" (name | email| password)
    -tabella "libraries" (name | email | city | address) 
    -tabella "books" (name | author | genre | img)
    -tabella "hasBook" (library | book | quantity)

CREATE TABLE users (
    name text PRIMARY KEY,
    email text,
    password text,
);

CREATE TABLE libraries (
    name text PRIMARY KEY,
    email text,
    city text,
    address text
);

CREATE TABLE books (
    name text PRIMARY KEY,
    author text,
    genre text,
    img text
);

CREATE TABLE hasBook (
    library text,
    book text,
    quantity int,
    price float,

    PRIMARY KEY(library,book),
    FOREIGN KEY (library) REFERENCES libraries(name),
    FOREIGN KEY (book) REFERENCES books(name)
);

INSERT INTO libraries(name,email,city,address) VALUES 
('laFeltrinelli','feltrinelli@gmail.com','Roma','Galleria Alberto Sordi');
('Mondadori','mondadori@gmail.com','Roma','Piazza Cola di Rienzo, 81');
('Zanichelli','zanichelli@gmail.com','Milano','Viale Romagna, 5');
('Libreria da Paolo', 'paolorossi@gmail.com','Venezia', 'Piazza San Marco');
('Anna Libri', 'anna@gmail.com','Bologna','Via del tortellino,5');

INSERT INTO books(name, author, genre, img) VALUES
('Dal big bang ai buchi neri', 'Stephen W. Hawking', 'Scientific', 'dalBigBangAiBuchiNeri.jpg');
('La solitudine dei numeri primi', 'Paolo Giordano', 'Novel', 'laSolitudineDeiNumeriPrimi.jpg');
('Le cronache di Narnia', 'C.S. Lewis', 'Fantasy', 'leCronacheDiNarnia.jpg');
('Ventimila leghe sotto i mari', 'Jules Verne', 'Adventure', 'ventimilaLegheSottoIMari.jpg');
('Guida galattica per gli autostoppisti', 'Douglas Adams', 'Fantasy', 'guidaGalatticaPerGliAutostoppisti.jpg');
('Il metodo Warren Buffett. I segreti del più grande investitore del mondo', 'Robert G. Hamstrong', 'Scientific', 'ilMetodoWarrenBuffet.jpg');


//ALTER TABLE libraries ADD FOREIGN KEY (name) REFERENCES hasBook(library);

//ALTER TABLE books ADD FOREIGN KEY (name) REFERENCES hasBook(book);
