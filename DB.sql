-- DROP TABLE

DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS summary_volume;
DROP TABLE IF EXISTS summary;
DROP TABLE IF EXISTS cart_volume;
DROP TABLE IF EXISTS cart;
DROP TABLE IF EXISTS user_;
DROP TABLE IF EXISTS manga_kind;
DROP TABLE IF EXISTS kind;
DROP TABLE IF EXISTS manga_category;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS volume;
DROP TABLE IF EXISTS manga;


-- CREATE TABLE

CREATE TABLE manga (
    id SERIAL PRIMARY KEY,
    name VARCHAR(256),
    author VARCHAR(128),
    description VARCHAR(2048),
    score FLOAT
);

CREATE TABLE volume (
    id SERIAL PRIMARY KEY,
    number INT,
    id_manga INT,
    name VARCHAR(256),
    price NUMERIC,
    quantity INT,
    publisher VARCHAR(64),
    number_pages INT,
    img_volume VARCHAR(64000),
    CONSTRAINT fk_manga_volume FOREIGN KEY (id_manga) REFERENCES manga(id)
);

CREATE TABLE category (
    id SERIAL PRIMARY KEY,
    name VARCHAR(256)
);

CREATE TABLE manga_category (
    id_category INT,
    id_manga INT,
    CONSTRAINT fk_category FOREIGN KEY (id_category) REFERENCES category(id),
    CONSTRAINT fk_manga_category FOREIGN KEY (id_manga) REFERENCES manga(id)
);

CREATE TABLE kind (
    id SERIAL PRIMARY KEY,
    name VARCHAR(256)
);

CREATE TABLE manga_kind (
    id_kind INT,
    id_manga INT,
    CONSTRAINT fk_kind FOREIGN KEY (id_kind) REFERENCES kind(id),
    CONSTRAINT fk_manga_kind FOREIGN KEY (id_manga) REFERENCES manga(id)
);

CREATE TABLE user_ (
    mail VARCHAR(128) PRIMARY KEY,
    password VARCHAR(256),
    last_name TEXT,
    first_name TEXT,
    address VARCHAR(256),
    postal_code VARCHAR(5),
    admin BOOLEAN
);

CREATE TABLE cart (
    id SERIAL PRIMARY KEY,
    mail_user VARCHAR(128),
    CONSTRAINT fk_mail_user_cart FOREIGN KEY (mail_user) REFERENCES user_(mail)
);

CREATE TABLE cart_volume (
    id_cart INT,
    id_volume INT,
    quantity INT,
    CONSTRAINT fk_cart FOREIGN KEY (id_cart) REFERENCES cart(id),
    CONSTRAINT fk_volume FOREIGN KEY (id_volume) REFERENCES volume(id)
);

CREATE TABLE summary (
    id SERIAL PRIMARY KEY,
    mail_user VARCHAR(128),
    date DATE,
    total FLOAT,
    CONSTRAINT fk_mail_user_summary FOREIGN KEY (mail_user) REFERENCES user_(mail)
);

CREATE TABLE summary_volume (
    id_summary INT,
    id_volume INT,
    quantity INT,
    CONSTRAINT fk_summary FOREIGN KEY (id_summary) REFERENCES summary(id),
    CONSTRAINT fk_volume FOREIGN KEY (id_volume) REFERENCES volume(id)
);

CREATE TABLE review (
    id SERIAL PRIMARY KEY,
    mail_user VARCHAR(128),
    id_volume INT,
    title VARCHAR(256),
    score FLOAT,
    comment VARCHAR(2048),
    date DATE,
    CONSTRAINT fk_mail_user_review FOREIGN KEY (mail_user) REFERENCES user_(mail),
    CONSTRAINT fk_volume_review FOREIGN KEY (id_volume) REFERENCES volume(id)
);



-- INSERT VALUES

INSERT INTO manga (name, author, score, description)
VALUES  ('Naruto', 'Masashi Kishimoto', 8.07, '''Naruto'' est un manga écrit et illustré par Masashi Kishimoto. L''histoire suit les aventures d''un jeune ninja nommé Naruto Uzumaki, qui rêve de devenir Hokage, le chef de son village. En cours de route, il rencontre des amis et des ennemis, et doit affronter des défis difficiles pour devenir plus fort. Le manga explore également les thèmes de l''amitié, de la famille et de la lutte contre la discrimination.'),
        ('One Piece', 'Eiichiro Oda', 9.21, '''One Piece'' est un manga écrit et illustré par Eiichiro Oda. L''histoire suit les aventures de Monkey D. Luffy, un jeune pirate avec un corps en caoutchouc, qui cherche le trésor légendaire connu sous le nom de ''One Piece''. Luffy rassemble un équipage de pirates pour l''aider dans sa quête, et doit affronter des ennemis puissants pour atteindre son objectif. Le manga explore les thèmes de l''amitié, de l''aventure et de la persévérance.'),
        ('Attack on Titan', 'Hajime Isayama', 8.56, '''Attack on Titan'' est un manga écrit et illustré par Hajime Isayama. L''histoire se déroule dans un monde où l''humanité doit faire face à des géants mangeurs d''hommes appelés Titans. Les survivants vivent dans une citadelle protégée par trois murs géants, mais lorsqu''un Titan géant détruit la première muraille, l''humanité est forcée de se battre pour sa survie. Le manga explore les thèmes de la survie, de la peur et de la détermination.'),
        ('Death Note', 'Tsugumi Ohba / Takeshi Obata', 8.70, '''Death Note'' est un manga écrit par Tsugumi Ohba et illustré par Takeshi Obata. L''histoire suit un lycéen nommé Light Yagami, qui trouve un cahier qui permet de tuer les gens en écrivant leur nom dedans. Light décide d''utiliser le cahier pour tuer les criminels du monde, mais est poursuivi par un détective connu sous le nom de L. Le manga explore les thèmes de la justice, de la morale et de la psychologie.'),
        ('Fullmetal Alchemist', 'Hiromu Arakawa', 9.04, '''Fullmetal Alchemist'' est un manga écrit et illustré par Hiromu Arakawa. L''histoire suit deux frères alchimistes, Edward et Alphonse Elric, qui cherchent une pierre légendaire pour récupérer leur corps, qui a été perdu lors d''une tentative de ressusciter leur mère. Le manga explore les thèmes de la science, de la famille et de la conséquence de nos actes.'),
        ('Bleach', 'Tite Kubo', 7.83, 'L''histoire suit un adolescent nommé Ichigo Kurosaki, qui a la capacité de voir les esprits. Après avoir rencontré une shinigami (déesse de la mort) blessée, il devient lui-même un shinigami pour protéger les âmes des morts et affronter des ennemis dangereux. Le manga explore les thèmes de la mort, de l''amitié et de la loyauté.'),
        ('Dragon Ball', 'Akira Toriyama', 8.41, 'L''histoire suit les aventures d''un garçon nommé Son Goku, qui possède une queue de singe et qui vit dans un monde fantastique rempli de dragons, de magie et de guerriers puissants. Goku est un combattant exceptionnel et doit trouver les Dragon Balls, sept sphères magiques dispersées à travers le monde, pour réaliser son vœu. Le manga explore les thèmes de la force, de l''amitié et de la persévérance.'),
        ('Hunter x Hunter', 'Yoshihiro Togashi', 8.73, 'L''histoire suit un jeune garçon nommé Gon Freecss, qui découvre que son père, un Hunter professionnel, est toujours en vie. Gon décide alors de devenir un Hunter lui-même pour le retrouver. En cours de route, il rencontre des amis et des ennemis, et doit faire face à des défis dangereux pour atteindre son objectif. Le manga explore les thèmes de la famille, de l''aventure et de la découverte de soi.'),
        ('My Hero Academia', 'Kohei Horikoshi', 8.11, 'L''histoire se déroule dans un monde où la plupart des gens possèdent des super-pouvoirs appelés ''Quirks''. Izuku Midoriya est l''un des rares à ne pas en avoir, mais rêve toujours de devenir un héros. Lorsqu''il rencontre son idole, All Might, il est choisi pour devenir son successeur et entre à l''école de héros pour apprendre à maîtriser ses compétences. Le manga explore les thèmes de l''héroïsme, de la persévérance et de l''amitié.'),
        ('Jojo''s Bizarre Adventure', 'Hirohiko Araki', 9.30, 'Jojo''s Bizarre Adventure est un manga qui suit la famille Joestar, qui possède des pouvoirs surnaturels différents dans différentes époques. Chaque arc raconte l''histoire d''un membre différent de la famille Joestar, et les histoires sont liées par des thèmes communs tels que l''honneur, le courage et le pouvoir de l''amitié. Le manga est connu pour son style unique, ses personnages excentriques et ses combats spectaculaires.'),
        ('Berserk', 'Kentaro Miura', 9.47, 'L''histoire de Berserk se déroule dans un monde sombre et brutal, où le protagoniste, Guts, lutte pour sa survie et se venge des démons qui ont détruit sa vie. Avec un récit profondément complexe et mature, Berserk explore des thèmes tels que la violence, la trahison, la cruauté et la nature de l''humanité. Le style artistique unique de Miura et les scènes d''action intenses ont captivé les lecteurs du monde entier. Berserk est considéré comme l''un des meilleurs mangas jamais créés, offrant une expérience sombre, tragique et épique.'),
        ('Nana', 'Ai Yazawa', 8.78, 'Nana est une série de manga dramatique qui suit la vie de deux jeunes femmes nommées Nana Komatsu et Nana Osaki, qui se rencontrent dans un train pour Tokyo et nouent une amitié improbable. Dans le cadre de l''industrie musicale et des défis de la vie adulte, Nana explore des thèmes tels que l''amour, l''amitié, les rêves et la quête du bonheur. Le style de narration unique et le style artistique distinctif d''Ai Yazawa ont fait de Nana un manga apprécié des fans du monde entier. La série dépeint les hauts et les bas de la vie des personnages, de leurs relations et des complexités de leurs parcours individuels.');

INSERT INTO volume (number, id_manga, name, price, quantity, publisher, number_pages, img_volume)
VALUES  (1, 1, 'Naruto Uzumaki !!', 3.00, 0, 'Kana', 192, 'https://tse3.mm.bing.net/th?id=OIP.8JKy1jY5EBDIgvHwjbDs8gHaKG&pid=Api&P=0'),
        (2, 1, 'Un client désagréable', 7.99, 12, 'Kana', 208, 'https://tse1.mm.bing.net/th?id=OIP.aGlY_NNw7DFeFyG0aMWL2gHaLH&pid=Api&P=0'),
        (1, 2, 'À l''aube d''une grande aventure', 6.90, 53, 'Glénat', 208, 'https://tse3.mm.bing.net/th?id=OIP.Bt2DdPiv8KvwJVCmqDk7LgHaLf&pid=Api&P=0'),
        (2, 2, 'Luffy versus la bande à Baggy !!', 6.90, 10, 'Glénat', 208, 'https://tse4.mm.bing.net/th?id=OIP.V_ZuPcVUaR4SI23oau7OiwAAAA&pid=Api&P=0'),
        (3, 2, 'Une vérité qui blesse', 6.90, 19, 'Glénat', 208,'https://tse4.mm.bing.net/th?id=OIP.ZjRWKTRjeijIVaa5gJgjzQHaLe&pid=Api&P=0'),
        (1, 4, 'Livre 1', 7.99, 4, 'Kana', 200, 'https://cdn1.booknode.com/book_cover/987/death_note_tome_1-986958-264-432.jpg'),
        (2, 4, 'Livre 2', 7.99, 7, 'Kana', 200, 'https://tse2.mm.bing.net/th?id=OIP.6SiH7DMmEP9yTYOFdgm-oAAAAA&pid=Api&P=0'),
        (1, 12, '', 6.20, 9, 'Delcourt/Tonkam', 192, 'https://m.media-amazon.com/images/I/5131GcTh02L._SX326_BO1,204,203,200_.jpg'), 
        (2, 12, '', 6.20, 11, 'Delcourt/Tonkam', 186, 'https://m.media-amazon.com/images/I/51XY8XVHMNL._SX326_BO1,204,203,200_.jpg'),
        (1, 11, '', 12.99, 8, 'Glénat', 240, 'https://media.senscritique.com/media/000005359259/300/berserk.jpg'),
        (2, 11, '', 12.99, 6, 'Glénat', 240, 'https://media.senscritique.com/media/000019897773/300/berserk_tome_2.jpg'),
        (3, 11, '', 12.99, 7, 'Glénat', 240, 'https://media.senscritique.com/media/000019619667/300/berserk_tome_3.jpg'),
        (1, 6, 'The Death And The Strawberry', 6.20, 5, 'Glénat', 200, 'https://media.senscritique.com/media/000009649424/300/The_Death_and_the_Strawberry_Bleach_tome_1.jpg'),
        (2, 6, 'Goodbye Parakeet, Goodnite My Sista', 6.20, 7, 'Glénat', 200, 'https://media.senscritique.com/media/000009649426/300/Goodbye_Parakeet_Goodnite_my_Sista_Bleach_tome_2.jpg'),
        (3, 6, 'Memories In The Rain', 6.20, 8, 'Glénat', 200, 'https://media.senscritique.com/media/000009683676/300/Memories_in_the_Rain_Bleach_tome_3.jpg'),
        (1, 7, 'Sangoku', 2.99, 26, 'Glénat', 192, 'https://cdn1.booknode.com/book_cover/1026/mod11/dragon_ball_tome_1_sangoku-1025617-264-432.jpg'),
        (2, 7, 'Kaméhaméha', 5.99, 14, 'Glénat', 192, 'https://cdn1.booknode.com/book_cover/1037/mod11/dragon_ball_tome_2_kamehameha-1036724-264-432.jpg'),
        (3, 7, 'L''initiaition', 5.99, 13, 'Glénat', 192, 'https://cdn1.booknode.com/book_cover/1037/mod11/dragon_ball_tome_3_linitiation-1036726-264-432.jpg');

INSERT INTO category (name)
VALUES  ('Shonen'), ('Seinen'), ('Shojo'), ('Josei'), ('Kodomo');

INSERT INTO kind (name)
VALUES  ('Nekketsu'), ('Aventure'), ('Comédie'), ('Drame'), 
        ('Fantaisie'), ('Romance'), ('Slice of life'), ('Action'), 
        ('Policier'), ('Mystère'), ('Thriller psychologique'), ('Fantastique'), 
        ('Suiri'), ('Surnaturel');

INSERT INTO manga_category (id_category, id_manga) 
VALUES  (1, 1), (1, 2), (1, 4), (1, 6), (1, 7), (2, 11), (3,12);

INSERT INTO manga_kind (id_kind, id_manga) 
VALUES  (1, 1), (8, 1), (1, 2), (2, 2), (5, 2), (9, 4), 
        (10, 4), (11, 4), (1, 6), (8, 6), (14, 6), (1, 7), (2, 7), (3, 7), 
        (2, 11), (4, 11), (5, 11), (3, 12), (4, 12), (7, 12);

INSERT INTO user_ (mail, password, first_name, last_name, address, postal_code, admin)
VALUES  ('b.logan006@gmail.com', 'Yoloswag06', 'Logan', 'Brunet', '18 rue du Maréchal Feur', '06600', true),
        ('philou225@gmail.com','Yoloswag225','Philippe','Bouillon','90 rue de la Paix', '95600', false),
        ('jeanmi69000@hotmail.com','JM69DP','Jean-Michel','Dupont','1 rue de la République', '69000', false),
        ('antolefifou404@outlook.com','Anto404','Antoine','Lefifou','2 rue de la Liberté', '75000', false);

INSERT INTO cart (mail_user)
VALUES  ('b.logan006@gmail.com'),
        ('philou225@gmail.com');

INSERT INTO review (mail_user, id_volume, title, score, date, comment) 
VALUES  ('jeanmi69000@hotmail.com', 11, 'Excellent tome !!!', 4, '2023-06-22', 'Très bon tome, je recommande ! La fin m''a epoustouflé !'),
        ('antolefifou404@outlook.com', 11, 'Mitigé...', 3, '2023-02-12', 'Tome moyen, je m''attendais à mieux...'),
        ('philou225@gmail.com', 1, 'ACHAT RENTABLE, JE CONSEILLE', 5, '2023-04-01', 'Tome parfait, rien à redire !');