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

CREATE TABLE lovesbook (
    username text,
    book text,
    primary key(username,book)
);

CREATE TABLE booking(
    username text,
    book text,
    library text,
    primary key(username,book,library)
);

INSERT INTO libraries(name,email,city,address) VALUES 
('laFeltrinelli','feltrinelli@gmail.com','Roma','Galleria Alberto Sordi'),
('Mondadori','mondadori@gmail.com','Roma','Piazza Cola di Rienzo, 81'),
('Zanichelli','zanichelli@gmail.com','Milano','Viale Romagna, 5'),
('Libreria da Paolo', 'paolorossi@gmail.com','Venezia', 'Piazza San Marco'),
('Anna Libri', 'anna@gmail.com','Bologna','Via del tortellino,5');

INSERT INTO books(name, author, genre, img) VALUES
('Dal big bang ai buchi neri', 'Stephen W. Hawking', 'Scientifico', 'dalBigBangAiBuchiNeri.jpg'),
('La solitudine dei numeri primi', 'Paolo Giordano', 'Romanzo', 'laSolitudineDeiNumeriPrimi.jpg'),
('Le cronache di Narnia', 'C.S. Lewis', 'Fantasy', 'leCronacheDiNarnia.jpg'),
('Ventimila leghe sotto i mari', 'Jules Verne', 'Avventura', 'ventimilaLegheSottoIMari.jpg'),
('Guida galattica per gli autostoppisti', 'Douglas Adams', 'Fantasy', 'guidaGalatticaPerGliAutostoppisti.jpg'),
('Il metodo Warren Buffett. I segreti del più grande investitore del mondo', 'Robert G. Hamstrong', 'Scientifico', 'ilMetodoWarrenBuffet.jpg');


INSERT INTO hasbook(library,book,quantity,price) VALUES
('Mondadori','Dal big bang ai buchi neri','15','15.00'),
('laFeltrinelli','Dal big bang ai buchi neri','1','10.99'),
('Zanichelli','Le cronache di Narnia','6','18.00'),
('Anna Libri','La solitudine dei numeri primi','2','19.99'),
('Anna Libri','Il metodo Warren Buffett. I segreti del più grande investitore del mondo','5','22.15'),
('Anna Libri','Le cronache di Narnia','2','19.99'),
('Libreria da Paolo','Ventimila leghe sotto i mari','10','9.99'),
('Mondadori','Guida galattica per gli autostoppisti','1','20.00');


CREATE OR REPLACE FUNCTION update_user() RETURNS
TRIGGER AS
$$
	DECLARE
	r record;
	BEGIN
		FOR r IN SELECT * FROM lovesbook LOOP
			UPDATE lovesbook SET username=NEW.name WHERE username=OLD.name;
			UPDATE booking SET username=NEW.name WHERE username=OLD.name;
		END LOOP;
		RETURN NULL;
	END;
$$ language plpgsql;
	
CREATE TRIGGER trigger_aggiornamento AFTER UPDATE ON users
FOR EACH ROW EXECUTE PROCEDURE update_user();