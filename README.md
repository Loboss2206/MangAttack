# MangAttack

## DROP TABLE

DROP TABLE IF EXISTS volume;
DROP TABLE IF EXISTS manga;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS manga_category;
DROP TABLE IF EXISTS kind;
DROP TABLE IF EXISTS manga_kind;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS cart;
DROP TABLE IF EXISTS cart_volume;

## CREATE TABLE

CREATE TABLE volume (
    id INT PRIMARY KEY AUTO_INCREMENT,
    number INT,
    id_manga INT,
    name VARCHAR(256),
    price Float,
    quantity INT,
    publisher VARCHAR(64),
    number_pages INT,
    img_volume VARCHAR(512),
    CONSTRAINT fk_manga_volume FOREIGN KEY (id_manga) REFERENCES manga(id)
    );

CREATE TABLE manga (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(256),
    author VARCHAR(128),
    description VARCHAR(2048),
    score FLOAT
    );
    
CREATE TABLE category (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(256)
	);
    
CREATE TABLE manga_category (
    id_category INT,
    id_manga INT,
    CONSTRAINT fk_category FOREIGN KEY (id_category) REFERENCES category(id),
    CONSTRAINT fk_manga FOREIGN KEY (id_manga) REFERENCES manga(id)
	);

CREATE TABLE kind (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(256)
	);
    
CREATE TABLE manga_kind (
    id_kind INT,
    id_manga INT,
    CONSTRAINT fk_kind FOREIGN KEY (id_kind) REFERENCES kind(id),
    CONSTRAINT fk_manga FOREIGN KEY (id_manga) REFERENCES manga(id)
	);

CREATE TABLE user (
    mail VARCHAR(128) PRIMARY KEY, 
    password VARCHAR(256), 
    last_name TINYTEXT, 
    first_name TINYTEXT, 
    address VARCHAR(256),
    postal_code VARCHAR(5),
    admin bool
    );

CREATE TABLE cart (
    id INT PRIMARY KEY AUTO_INCREMENT,
    mail_user VARCHAR(128),
    CONSTRAINT fk_user FOREIGN KEY (mail_user) REFERENCES user(mail)
    );

CREATE TABLE cart_volume (
    id_cart INT,
    id_volume INT,
    quantity INT,
    CONSTRAINT fk_cart FOREIGN KEY (id_cart) REFERENCES cart(id),
    CONSTRAINT fk_volume FOREIGN KEY (id_volume) REFERENCES volume(id)
);

## INSERT VALUES

INSERT INTO category (name)
VALUES ("Shonen"), 
("Seinen"), 
("Shojo"), 
("Josei"), 
("Kodomo");

INSERT INTO manga (name, author, description)
VALUES ("Naruto", "Masashi Kishimoto", "'Naruto' est un manga écrit et illustré par Masashi Kishimoto. L'histoire suit les aventures d'un jeune ninja nommé Naruto Uzumaki, qui rêve de devenir Hokage, le chef de son village. En cours de route, il rencontre des amis et des ennemis, et doit affronter des défis difficiles pour devenir plus fort. Le manga explore également les thèmes de l'amitié, de la famille et de la lutte contre la discrimination."),
("One Piece", "Eiichiro Oda", "'One Piece' est un manga écrit et illustré par Eiichiro Oda. L'histoire suit les aventures de Monkey D. Luffy, un jeune pirate avec un corps en caoutchouc, qui cherche le trésor légendaire connu sous le nom de 'One Piece'. Luffy rassemble un équipage de pirates pour l'aider dans sa quête, et doit affronter des ennemis puissants pour atteindre son objectif. Le manga explore les thèmes de l'amitié, de l'aventure et de la persévérance."),
("Attack on Titan", "Hajime Isayama", "'Attack on Titan' est un manga écrit et illustré par Hajime Isayama. L'histoire se déroule dans un monde où l'humanité doit faire face à des géants mangeurs d'hommes appelés Titans. Les survivants vivent dans une citadelle protégée par trois murs géants, mais lorsqu'un Titan géant détruit la première muraille, l'humanité est forcée de se battre pour sa survie. Le manga explore les thèmes de la survie, de la peur et de la détermination."),
("Death Note", "Tsugumi Ohba / Takeshi Obata", "'Death Note' est un manga écrit par Tsugumi Ohba et illustré par Takeshi Obata. L'histoire suit un lycéen nommé Light Yagami, qui trouve un cahier qui permet de tuer les gens en écrivant leur nom dedans. Light décide d'utiliser le cahier pour tuer les criminels du monde, mais est poursuivi par un détective connu sous le nom de L. Le manga explore les thèmes de la justice, de la morale et de la psychologie."),
("Fullmetal Alchemist", "Hiromu Arakawa", "'Fullmetal Alchemist' est un manga écrit et illustré par Hiromu Arakawa. L'histoire suit deux frères alchimistes, Edward et Alphonse Elric, qui cherchent une pierre légendaire pour récupérer leur corps, qui a été perdu lors d'une tentative de ressusciter leur mère. Le manga explore les thèmes de la science, de la famille et de la conséquence de nos actes."),
("Bleach", "Tite Kubo", "L'histoire suit un adolescent nommé Ichigo Kurosaki, qui a la capacité de voir les esprits. Après avoir rencontré une shinigami (déesse de la mort) blessée, il devient lui-même un shinigami pour protéger les âmes des morts et affronter des ennemis dangereux. Le manga explore les thèmes de la mort, de l'amitié et de la loyauté."),
("Dragon Ball", "Akira Toriyama", "L'histoire suit les aventures d'un garçon nommé Son Goku, qui possède une queue de singe et qui vit dans un monde fantastique rempli de dragons, de magie et de guerriers puissants. Goku est un combattant exceptionnel et doit trouver les Dragon Balls, sept sphères magiques dispersées à travers le monde, pour réaliser son vœu. Le manga explore les thèmes de la force, de l'amitié et de la persévérance."),
("Hunter x Hunter", "Yoshihiro Togashi", "L'histoire suit un jeune garçon nommé Gon Freecss, qui découvre que son père, un Hunter professionnel, est toujours en vie. Gon décide alors de devenir un Hunter lui-même pour le retrouver. En cours de route, il rencontre des amis et des ennemis, et doit faire face à des défis dangereux pour atteindre son objectif. Le manga explore les thèmes de la famille, de l'aventure et de la découverte de soi."),
("My Hero Academia", "Kohei Horikoshi", "L'histoire se déroule dans un monde où la plupart des gens possèdent des super-pouvoirs appelés 'Quirks'. Izuku Midoriya est l'un des rares à ne pas en avoir, mais rêve toujours de devenir un héros. Lorsqu'il rencontre son idole, All Might, il est choisi pour devenir son successeur et entre à l'école de héros pour apprendre à maîtriser ses compétences. Le manga explore les thèmes de l'héroïsme, de la persévérance et de l'amitié."),
("Jojo's Bizarre Adventure", "Hirohiko Araki", "\"Jojo's Bizarre Adventure\" est un manga qui suit la famille Joestar, qui possède des pouvoirs surnaturels différents dans différentes époques. Chaque arc raconte l'histoire d'un membre différent de la famille Joestar, et les histoires sont liées par des thèmes communs tels que l'honneur, le courage et le pouvoir de l'amitié. Le manga est connu pour son style unique, ses personnages excentriques et ses combats spectaculaires.");

-- ajout de 3 tomes pour le manga "One Piece"
INSERT INTO volume (number, id_manga, name, price, quantity, publisher, number_pages, img_volume)
VALUES 
(1, 1, "Naruto Uzumaki !!", 3.00, 24, "Kana", 192, "https://tse3.mm.bing.net/th?id=OIP.8JKy1jY5EBDIgvHwjbDs8gHaKG&pid=Api&P=0"),
(2, 1, "Un client désagréable", 7.99, 12, "Kana", 208, "https://tse1.mm.bing.net/th?id=OIP.aGlY_NNw7DFeFyG0aMWL2gHaLH&pid=Api&P=0"),
(1, 2, "À l'aube d'une grande aventure", 6.90, 53, "Glénat", 208, "https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0"),
(2, 2, "Luffy versus la bande à Baggy !!", 6.90, 10, "Glénat", 208, "https://tse4.mm.bing.net/th?id=OIP.V_ZuPcVUaR4SI23oau7OiwAAAA&pid=Api&P=0"),
(3, 2, "Une vérité qui blesse", 6.90, 19, "Glénat", 208,"https://tse4.mm.bing.net/th?id=OIP.ZjRWKTRjeijIVaa5gJgjzQHaLe&pid=Api&P=0"),
(1, 4, "Livre 1", 7.99, 4, "Kana", 200, "https://tse4.mm.bing.net/th?id=OIP.U84d4noBL-AkhI1qUX2MAwHaLH&pid=Api&P=0"),
(2, 4, "Livre 2", 7.99, 7, "Kana", 200, "https://tse2.mm.bing.net/th?id=OIP.6SiH7DMmEP9yTYOFdgm-oAAAAA&pid=Api&P=0");

INSERT INTO user (mail, password, last_name, first_name, address, postal_code, admin)
VALUES ("b.logan006@gmail.com", "Yoloswag06", "Logan", "Brunet", "18 rue du Maréchal Feur", "06789", true),
("philou225@gmail.com","Yoloswag225","Philippe","Bouillon","90 rue de la Paix", 95600, false);

INSERT INTO cart (mail_user) VALUES 
("b.logan006@gmail.com"),
("philou225@gmail.com");