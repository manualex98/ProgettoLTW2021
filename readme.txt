Database "Bookmark" su pgAdmin:
    -tabella "users" (name | email| password)
    -tabella "libraries" (name | email | city | address) 
    -tabella "books" (name | author | genre | img)
    -tabella "hasBook" (library | book | quantity)

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



//ALTER TABLE libraries ADD FOREIGN KEY (name) REFERENCES hasBook(library);

//ALTER TABLE books ADD FOREIGN KEY (name) REFERENCES hasBook(book);
