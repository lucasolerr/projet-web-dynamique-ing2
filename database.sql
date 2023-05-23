DROP DATABASE IF EXISTS DBOMNESBOX;
CREATE DATABASE DBOMNESBOX;
USE DBOMNESBOX;

DROP TABLE IF EXISTS account;
DROP TABLE IF EXISTS activity;
DROP TABLE IF EXISTS omnesbox;
DROP TABLE IF EXISTS activity_offer;
DROP TABLE IF EXISTS box_offer;
DROP TABLE IF EXISTS in_cart;
DROP TABLE IF EXISTS purchase;
DROP TABLE IF EXISTS to_offer;
DROP TABLE IF EXISTS possession;
DROP TABLE IF EXISTS used;

CREATE TABLE account(
    email VARCHAR(40) NOT NULL PRIMARY KEY,
    last_name VARCHAR(30) NOT NULL,
    first_name VARCHAR(30),
    account_password VARCHAR(30) NOT NULL,
    account_type ENUM("admin","partner","user")
);

CREATE TABLE activity(
    activity_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    activity_title VARCHAR(40) NOT NULL,
    activity_content TEXT NOT NULL
);

CREATE TABLE omnesbox(
    box_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    box_title TEXT NOT NULL,
    activity_id INT NOT NULL,
    CONSTRAINT FK1 FOREIGN KEY (activity_id) REFERENCES activity(activity_id)
);

CREATE TABLE activity_offer(
    partner_email VARCHAR(40) NOT NULL,
    activity_id INT NOT NULL,
    CONSTRAINT FK2 FOREIGN KEY (partner_email) REFERENCES account(email),
    CONSTRAINT FK3 FOREIGN KEY (activity_id) REFERENCES activity(activity_id),
    PRIMARY KEY(partner_email,activity_id)
);

CREATE TABLE box_offer(
    partner_email VARCHAR(40) NOT NULL,
    box_id INT NOT NULL,
    box_content TEXT NOT NULL,
    box_price FLOAT(8,2) NOT NULL,
    CONSTRAINT FK4 FOREIGN KEY (partner_email) REFERENCES account(email),
    CONSTRAINT FK5 FOREIGN KEY (box_id) REFERENCES omnesbox(box_id),
    PRIMARY KEY(partner_email,box_id)
);

CREATE TABLE in_cart(
    user_email VARCHAR(40) NOT NULL,
    box_id INT NOT NULL,
    chosen_partner_email VARCHAR(40) NOT NULL,
    CONSTRAINT FK6 FOREIGN KEY (user_email) REFERENCES account(email),
    CONSTRAINT FK7 FOREIGN KEY (box_id) REFERENCES omnesbox(box_id),
    CONSTRAINT FK16 FOREIGN KEY (chosen_partner_email) REFERENCES account(email),
    articles_number INT,
    PRIMARY KEY(user_email,box_id)
);

CREATE TABLE purchase(
    purchase_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    purchase_date DATE,
    user_email VARCHAR(40) NOT NULL,
    box_id INT NOT NULL,
    chosen_partner_email VARCHAR(40) NOT NULL,
    CONSTRAINT FK8 FOREIGN KEY (user_email) REFERENCES account(email),
    CONSTRAINT FK9 FOREIGN KEY (box_id) REFERENCES omnesbox(box_id),
    CONSTRAINT FK10 FOREIGN KEY (chosen_partner_email) REFERENCES account(email)

);

CREATE TABLE to_offer(
    to_offer_id INT NOT NULL PRIMARY KEY,
    to_offer_password VARCHAR(20),
    CONSTRAINT FK11 FOREIGN KEY (to_offer_id) REFERENCES purchase(purchase_id)
);

CREATE TABLE possession(
    possession_id INT NOT NULL PRIMARY KEY,
    possession_date DATE,
    user_email VARCHAR(40) NOT NULL,
    CONSTRAINT FK12 FOREIGN KEY (possession_id) REFERENCES purchase(purchase_id),
    CONSTRAINT FK13 FOREIGN KEY (user_email) REFERENCES account(email)
);

CREATE TABLE used(
    used_id INT NOT NULL PRIMARY KEY,
    used_date DATE,
    grade INT,
    comment TEXT,
    user_email VARCHAR(40) NOT NULL,
    CONSTRAINT FK14 FOREIGN KEY (used_id) REFERENCES purchase(purchase_id),
    CONSTRAINT FK15 FOREIGN KEY (user_email) REFERENCES account(email)
);

INSERT INTO account (email, last_name, first_name, account_password, account_type) VALUES
("admin1@example.com", "Admin", "User", "password123", "admin"),
("partner1@example.com", "Partner", "User", "password123", "partner"),
("partner2@example.com", "Partner", "User", "password123", "partner"),
("user1@example.com", "Regular", "User", "password123", "user"),
("user2@example.com", "Regular", "User", "password123", "user"),
("user3@example.com", "Regular", "User", "password123", "user"),
("user4@example.com", "Regular", "User", "password123", "user");

INSERT INTO activity (activity_title, activity_content) VALUES
("cours", "Apprenez de nouvelles compétences avec nos cours en ligne."),
("conference", "Élargissez vos connaissances lors de nos conférences inspirantes."),
("concours", "Participez à nos concours pour gagner des prix incroyables."),
("vacances", "Offrez-vous des vacances de rêve dans des destinations paradisiaques."),
("restaurant", "Découvrez des saveurs exquises dans nos restaurants partenaires."),
("randonnee", "Explorez les sentiers magnifiques de nos régions naturelles."),
("theatre", "Plongez dans l'univers captivant du théâtre avec nos représentations."),
("cinema", "Profitez des derniers blockbusters dans nos salles de cinéma."),
("concert", "Vibrez au son de la musique lors de nos concerts live."),
("exposition", "Découvrez l'art contemporain dans nos expositions renommées.");

INSERT INTO omnesbox (box_title, activity_id) VALUES

("Cours de Cuisine - Débutant", 1),
("Cours de Cuisine - Avancé", 1),
("Cours de Cuisine - Spécialités régionales", 1),
("Conférence sur l'Entrepreneuriat - Stratégies gagnantes", 2),
("Conférence sur l'Intelligence Artificielle - Nouvelles perspectives", 2),
("Conférence sur la Psychologie Positive - Bien-être et épanouissement", 2),
("Concours de Photographie - Thème : Nature", 3),
("Concours de Dessin - Style libre", 3),
("Concours de Poésie - Poèmes engagés", 3),
("Vacances à la Plage - Destination : Bali", 4),
("Vacances à la Montagne - Chalet de luxe", 4),
("Vacances en Ville - Séjour dans une métropole", 4),
("Dîner Gastronomique - Menu dégustation", 5),
("Brunch Chic - Spécialités du terroir", 5),
("Dîner Romantique - Ambiance feutrée", 5),
("Randonnée en Montagne - Parc national des Alpes", 6),
("Randonnée en Forêt - Sentiers enchantés", 6),
("Randonnée Côtière - Vue panoramique sur l'océan", 6),
("Pièce de Théâtre Comique - Comédie enlevée", 7),
("Pièce de Théâtre Dramatique - Emotions intenses", 7),
("Pièce de Théâtre Musicale - Chants et danses", 7),
("Projection de Films Cultes - Sélection exclusive", 8),
("Avant-Première d'un Blockbuster - Soirée VIP", 8),
("Marathon Cinéphile - Films à la suite", 8),
("Concert de Musique Live - Artiste surprise", 9),
("Concert de Jazz - Ambiance chaleureuse", 9),
("Concert de Rock - Énergie débordante", 9),
("Exposition d'Art Moderne - Nouvelles tendances", 10),
("Exposition de Photographie - Regards captivants", 10),
("Exposition de Sculptures - Formes surprenantes", 10);

INSERT INTO activity_offer (partner_email, activity_id) VALUES
("partner1@example.com", 1),
("partner1@example.com", 2),
("partner1@example.com", 3),
("partner2@example.com", 4),
("partner2@example.com", 5),
("partner2@example.com", 6);

INSERT INTO box_offer (partner_email, box_id, box_content, box_price) VALUES
("partner1@example.com", 1, "Découvrez notre boîte cadeau 'Cours de Cuisine - Débutant' qui vous permettra d'apprendre les bases de la cuisine française. Cette boîte comprend un cours de cuisine interactif animé par un chef renommé, un livre de recettes exclusives et des ustensiles de cuisine de haute qualité. Offrez-vous une expérience culinaire inoubliable !", 49.99),
("partner1@example.com", 7, "Plongez dans le monde de la photographie avec notre boîte cadeau 'Concours de Photographie - Thème : Nature'. Capturez les beautés de la nature et participez à notre concours pour avoir la chance de remporter de superbes prix. Cette boîte comprend un appareil photo professionnel, des accessoires de photographie et un guide pratique pour améliorer vos compétences. Exprimez votre créativité et immortalisez des moments uniques !", 59.99),
("partner1@example.com", 28, "Découvrez l'art contemporain avec notre boîte cadeau 'Exposition d'Art Moderne - Nouvelles tendances'. Visitez les galeries d'art les plus prestigieuses de la ville et admirez des œuvres d'artistes renommés. Cette boîte comprend des billets d'entrée VIP, une visite guidée privée et un catalogue d'exposition exclusif. Plongez dans l'univers fascinant de l'art moderne !", 39.99),
("partner2@example.com", 19, "Profitez d'une soirée inoubliable au théâtre avec notre boîte cadeau 'Pièce de Théâtre Comique - Comédie enlevée'. Riez aux éclats en regardant une comédie hilarante interprétée par des acteurs talentueux. Cette boîte comprend des places de première catégorie, des rafraîchissements pendant l'entracte et une rencontre avec les membres de la troupe. Laissez-vous emporter par le rire et la bonne humeur !", 49.99),
("partner2@example.com", 25, "Vivez une expérience musicale unique avec notre boîte cadeau 'Concert de Musique Live - Artiste surprise'. Assistez à un concert époustouflant d'un artiste de renommée mondiale dans une salle de concert prestigieuse. Cette boîte comprend des places VIP, un accès aux coulisses et un album dédicacé en souvenir. Laissez-vous envoûter par la magie de la musique en direct !", 69.99),
("partner2@example.com", 11, "Échappez-vous de la routine quotidienne avec notre boîte cadeau 'Vacances à la Montagne - Chalet de luxe'. Profitez d'un séjour de détente dans un chalet de montagne confortable et élégant. Cette boîte comprend l'hébergement pour deux personnes, des activités de plein air, des repas gastronomiques et l'accès à un spa de luxe. Offrez-vous des moments de tranquillité et de ressourcement au cœur de la nature !", 299.99),
("partner2@example.com", 12, "Explorez une métropole vibrante avec notre boîte cadeau 'Vacances en Ville - Séjour dans une métropole'. Découvrez les sites emblématiques, la culture dynamique et la cuisine délicieuse de la ville. Cette boîte comprend l'hébergement dans un hôtel de luxe, des visites guidées passionnantes et des repas gastronomiques. Plongez dans l'effervescence urbaine et créez des souvenirs inoubliables !", 399.99),
("partner1@example.com", 13, "Savourez un délicieux dîner gastronomique avec notre boîte cadeau 'Dîner Gastronomique - Menu dégustation'. Dégustez des plats exquis préparés par un chef étoilé dans un cadre élégant. Cette boîte comprend un menu dégustation avec des accords mets-vins, un service attentionné et une expérience culinaire raffinée. Laissez-vous séduire par les saveurs et les textures exceptionnelles !", 149.99),
("partner1@example.com", 16, "Partez à l'aventure avec notre boîte cadeau 'Randonnée en Montagne - Parc national des Alpes'. Explorez des sentiers pittoresques, admirez des panoramas époustouflants et connectez-vous avec la nature. Cette boîte comprend un guide expérimenté, un équipement de randonnée de qualité et des moments de tranquillité au cœur des montagnes. Évadez-vous et découvrez la beauté des Alpes !", 89.99),
("partner1@example.com", 17, "Plongez dans la nature avec notre boîte cadeau 'Randonnée en Forêt - Sentiers enchantés'. Explorez des forêts luxuriantes, découvrez des cascades cachées et observez une faune et une flore fascinantes. Cette boîte comprend un guide naturaliste, un pique-nique gourmet et des moments de sérénité au milieu des arbres. Laissez-vous émerveiller par la magie de la nature !", 79.99),
("partner2@example.com", 18, "Admirez des paysages côtiers spectaculaires avec notre boîte cadeau 'Randonnée Côtière - Vue panoramique sur l'océan'. Parcourez des sentiers côtiers pittoresques, découvrez des plages isolées et profitez d'une brise marine revigorante. Cette boîte comprend un guide expérimenté, un panier-repas gourmand et des moments de détente face à l'océan. Échappez au quotidien et reconnectez-vous à la nature !", 94.99);
