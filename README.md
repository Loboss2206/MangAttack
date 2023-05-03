# MangAttack

## DROP TABLE

DROP TABLE IF EXISTS tome;
DROP TABLE IF EXISTS manga;
DROP TABLE IF EXISTS categorie;
DROP TABLE IF EXISTS manga_categorie;
DROP TABLE IF EXISTS genre;
DROP TABLE IF EXISTS manga_genre;
DROP TABLE IF EXISTS client;
DROP TABLE IF EXISTS panier;
DROP TABLE IF EXISTS panier_tome;

## CREATE TABLE

CREATE TABLE tome (
    id INT PRIMARY KEY AUTO_INCREMENT,
    numero INT,
    id_manga INT,
    nom VARCHAR(256),
    prix Float,
    quantite INT,
    imgTome VARCHAR(512),
    CONSTRAINT fk_manga_tome FOREIGN KEY (id_manga) REFERENCES manga(id)
    );

CREATE TABLE manga (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(256),
    auteur VARCHAR(128),
    description VARCHAR(2048)
    );
    
CREATE TABLE categorie (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(256)
	);
    
CREATE TABLE manga_categorie (
    id_categorie INT,
    id_manga INT,
    CONSTRAINT fk_cat FOREIGN KEY (id_categorie) REFERENCES categorie(id),
    CONSTRAINT fk_manga FOREIGN KEY (id_manga) REFERENCES manga(id)
	);

CREATE TABLE genre (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(256)
	);
    
CREATE TABLE manga_genre (
    id_genre INT,
    id_manga INT,
    CONSTRAINT fk_genre FOREIGN KEY (id_genre) REFERENCES genre(id),
    CONSTRAINT fk_manga FOREIGN KEY (id_manga) REFERENCES manga(id)
	);

CREATE TABLE client (
    mail VARCHAR(128) PRIMARY KEY, 
    motDePasse VARCHAR(256), 
    nom TINYTEXT, 
    prenom TINYTEXT, 
    adresse VARCHAR(256),
    codePostal INT(5)
    );

CREATE TABLE panier (
    id INT PRIMARY KEY AUTO_INCREMENT,
    mail_client VARCHAR(128),
    CONSTRAINT fk_client FOREIGN KEY (mail_client) REFERENCES client(mail)
    );

CREATE TABLE panier_tome (
    id_panier INT,
    id_tome INT,
    quantite INT,
    CONSTRAINT fk_panier FOREIGN KEY (id_panier) REFERENCES panier(id),
    CONSTRAINT fk_tome FOREIGN KEY (id_tome) REFERENCES tome(id)
);

## INSERT VALUES

INSERT INTO manga (nom, auteur, description)
VALUES ("Naruto", "Masashi Kishimoto", "Un jeune ninja cherchant à devenir le plus grand ninja de son village."),
("One Piece", "Eiichiro Oda", "L'histoire d'un équipage de pirates cherchant le légendaire trésor appelé le \"One Piece\"."),
("Attack on Titan", "Hajime Isayama", "L'humanité doit faire face à des géants mangeurs d'hommes appelés Titans."),
("Death Note", "Tsugumi Ohba", "Un lycéen trouve un cahier qui permet de tuer les gens en écrivant leur nom dedans."),
("Fullmetal Alchemist", "Hiromu Arakawa", "Deux frères alchimistes cherchent une pierre légendaire pour récupérer leur corps."),
("Bleach", "Tite Kubo", "Un adolescent capable de voir les esprits devient un shinigami pour protéger les âmes."),
("Dragon Ball", "Akira Toriyama", "Un garçon avec une queue de singe cherche les Dragon Balls pour réaliser son vœu."),
("Hunter x Hunter", "Yoshihiro Togashi", "Un jeune garçon veut devenir un Hunter pour trouver son père."),
("My Hero Academia", "Kohei Horikoshi", "Un garçon sans pouvoirs dans un monde où tout le monde en a, rêve de devenir un héros."),
("Jojo's Bizarre Adventure", "Hirohiko Araki", "L'histoire d'une famille possédant des pouvoirs surnaturels dans différentes époques.");

-- ajout de 3 tomes pour le manga "One Piece"
INSERT INTO tome (numero, id_manga, nom, prix, quantite, imgTome)
VALUES 
(1, 2, "East Blue", 6.99, 12, "https://th.bing.com/th/id/OIP.tI3YUrEk0Rf_hCQP-8Vj2gHaLf?w=200&h=311&c=7&r=0&o=5&dpr=1.3&pid=1.7"),
(2, 2, "Baroque Works", 6.99, 10, "https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0"),
(3, 2, "Skypiea", 6.99, 19, "https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0"),
(1, 4, "Livre 1", 7.99, 4, "https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0"),
(2, 4, "Livre 2", 7.99, 7,"https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0"),
(1, 1, "L'histoire du ninja le plus fort de Konoha", 7.99, 1, "https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0"),
(2, 1, "Le pont vers la paix", 7.99, 12, "https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0");

INSERT INTO client (mail, motDePasse, nom, prenom, adresse, codePostal)
VALUES ("philou225@gmail.com","Yoloswag225","Philippe","Bouillon","90 rue de la Paix", 95600);

INSERT INTO panier (mail_client) VALUES ("philou225@gmail.com");