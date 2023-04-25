# MangAttack

## DROP TABLE

DROP TABLE IF EXISTS tome;
DROP TABLE IF EXISTS manga;
DROP TABLE IF EXISTS categorie;
DROP TABLE IF EXISTS manga_categorie;
DROP TABLE IF EXISTS genre;
DROP TABLE IF EXISTS manga_genre;

## CREATE TABLE

CREATE TABLE tome (
    id INT PRIMARY KEY,
    numero INT,
    id_manga INT,
    nom VARCHAR(256),
    prix Float,
    imgTome VARCHAR(512),
    CONSTRAINT fk_manga_tome FOREIGN KEY (id_manga) REFERENCES manga(id)
    );

CREATE TABLE manga (
    id INT PRIMARY KEY,
    nom VARCHAR(256),
    auteur VARCHAR(128),
    description VARCHAR(2048)
    );
    
CREATE TABLE categorie (
    id INT PRIMARY KEY,
    nom VARCHAR(256)
	);
    
CREATE TABLE manga_categorie (
    id_categorie INT,
    id_manga INT,
    CONSTRAINT fk_cat FOREIGN KEY (id_categorie) REFERENCES categorie(id),
    CONSTRAINT fk_manga FOREIGN KEY (id_manga) REFERENCES manga(id)
	);

CREATE TABLE genre (
    id INT PRIMARY KEY,
    nom VARCHAR(256)
	);
    
CREATE TABLE manga_genre (
    id_genre INT,
    id_manga INT,
    CONSTRAINT fk_genre FOREIGN KEY (id_genre) REFERENCES genre(id),
    CONSTRAINT fk_manga FOREIGN KEY (id_manga) REFERENCES manga(id)
	);

## INSERT VALUES