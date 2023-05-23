-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 23 mai 2023 à 19:38
-- Version du serveur : 5.7.24
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbomnesbox`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

CREATE TABLE `account` (
  `email` varchar(40) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `account_password` varchar(30) NOT NULL,
  `account_type` enum('admin','partner','user') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `account`
--

INSERT INTO `account` (`email`, `last_name`, `first_name`, `account_password`, `account_type`) VALUES
('admin1@example.com', 'Admin', 'User', 'password123', 'admin'),
('partner1@example.com', 'Partner', 'User', 'password123', 'partner'),
('partner2@example.com', 'Partner', 'User', 'password123', 'partner'),
('user1@example.com', 'Regular', 'User', 'password123', 'user'),
('user2@example.com', 'Regular', 'User', 'password123', 'user'),
('user3@example.com', 'Regular', 'User', 'password123', 'user'),
('user4@example.com', 'Regular', 'User', 'password123', 'user');

-- --------------------------------------------------------

--
-- Structure de la table `activity`
--

CREATE TABLE `activity` (
  `activity_id` int(11) NOT NULL,
  `activity_title` varchar(40) NOT NULL,
  `activity_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `activity`
--

INSERT INTO `activity` (`activity_id`, `activity_title`, `activity_content`) VALUES
(1, 'cours', 'Apprenez de nouvelles compétences avec nos cours en ligne.'),
(2, 'conference', 'Élargissez vos connaissances lors de nos conférences inspirantes.'),
(3, 'concours', 'Participez à nos concours pour gagner des prix incroyables.'),
(4, 'vacances', 'Offrez-vous des vacances de rêve dans des destinations paradisiaques.'),
(5, 'restaurant', 'Découvrez des saveurs exquises dans nos restaurants partenaires.'),
(6, 'randonnee', 'Explorez les sentiers magnifiques de nos régions naturelles.'),
(7, 'theatre', 'Plongez dans l\'univers captivant du théâtre avec nos représentations.'),
(8, 'cinema', 'Profitez des derniers blockbusters dans nos salles de cinéma.'),
(9, 'concert', 'Vibrez au son de la musique lors de nos concerts live.'),
(10, 'exposition', 'Découvrez l\'art contemporain dans nos expositions renommées.');

-- --------------------------------------------------------

--
-- Structure de la table `activity_offer`
--

CREATE TABLE `activity_offer` (
  `partner_email` varchar(40) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `activity_offer`
--

INSERT INTO `activity_offer` (`partner_email`, `activity_id`) VALUES
('partner1@example.com', 1),
('partner1@example.com', 3),
('partner2@example.com', 4),
('partner1@example.com', 5),
('partner1@example.com', 6),
('partner2@example.com', 6),
('partner2@example.com', 7),
('partner2@example.com', 9),
('partner1@example.com', 10);

-- --------------------------------------------------------

--
-- Structure de la table `box_offer`
--

CREATE TABLE `box_offer` (
  `partner_email` varchar(40) NOT NULL,
  `box_id` int(11) NOT NULL,
  `box_content` text NOT NULL,
  `box_price` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `box_offer`
--

INSERT INTO `box_offer` (`partner_email`, `box_id`, `box_content`, `box_price`) VALUES
('partner1@example.com', 1, 'Découvrez notre boîte cadeau \'Cours de Cuisine - Débutant\' qui vous permettra d\'apprendre les bases de la cuisine française. Cette boîte comprend un cours de cuisine interactif animé par un chef renommé, un livre de recettes exclusives et des ustensiles de cuisine de haute qualité. Offrez-vous une expérience culinaire inoubliable !', 49.99),
('partner1@example.com', 7, 'Plongez dans le monde de la photographie avec notre boîte cadeau \'Concours de Photographie - Thème : Nature\'. Capturez les beautés de la nature et participez à notre concours pour avoir la chance de remporter de superbes prix. Cette boîte comprend un appareil photo professionnel, des accessoires de photographie et un guide pratique pour améliorer vos compétences. Exprimez votre créativité et immortalisez des moments uniques !', 59.99),
('partner1@example.com', 13, 'Savourez un délicieux dîner gastronomique avec notre boîte cadeau \'Dîner Gastronomique - Menu dégustation\'. Dégustez des plats exquis préparés par un chef étoilé dans un cadre élégant. Cette boîte comprend un menu dégustation avec des accords mets-vins, un service attentionné et une expérience culinaire raffinée. Laissez-vous séduire par les saveurs et les textures exceptionnelles !', 149.99),
('partner1@example.com', 16, 'Partez à l\'aventure avec notre boîte cadeau \'Randonnée en Montagne - Parc national des Alpes\'. Explorez des sentiers pittoresques, admirez des panoramas époustouflants et connectez-vous avec la nature. Cette boîte comprend un guide expérimenté, un équipement de randonnée de qualité et des moments de tranquillité au cœur des montagnes. Évadez-vous et découvrez la beauté des Alpes !', 89.99),
('partner1@example.com', 17, 'Plongez dans la nature avec notre boîte cadeau \'Randonnée en Forêt - Sentiers enchantés\'. Explorez des forêts luxuriantes, découvrez des cascades cachées et observez une faune et une flore fascinantes. Cette boîte comprend un guide naturaliste, un pique-nique gourmet et des moments de sérénité au milieu des arbres. Laissez-vous émerveiller par la magie de la nature !', 79.99),
('partner1@example.com', 28, 'Découvrez l\'art contemporain avec notre boîte cadeau \'Exposition d\'Art Moderne - Nouvelles tendances\'. Visitez les galeries d\'art les plus prestigieuses de la ville et admirez des œuvres d\'artistes renommés. Cette boîte comprend des billets d\'entrée VIP, une visite guidée privée et un catalogue d\'exposition exclusif. Plongez dans l\'univers fascinant de l\'art moderne !', 39.99),
('partner2@example.com', 11, 'Échappez-vous de la routine quotidienne avec notre boîte cadeau \'Vacances à la Montagne - Chalet de luxe\'. Profitez d\'un séjour de détente dans un chalet de montagne confortable et élégant. Cette boîte comprend l\'hébergement pour deux personnes, des activités de plein air, des repas gastronomiques et l\'accès à un spa de luxe. Offrez-vous des moments de tranquillité et de ressourcement au cœur de la nature !', 299.99),
('partner2@example.com', 12, 'Explorez une métropole vibrante avec notre boîte cadeau \'Vacances en Ville - Séjour dans une métropole\'. Découvrez les sites emblématiques, la culture dynamique et la cuisine délicieuse de la ville. Cette boîte comprend l\'hébergement dans un hôtel de luxe, des visites guidées passionnantes et des repas gastronomiques. Plongez dans l\'effervescence urbaine et créez des souvenirs inoubliables !', 399.99),
('partner2@example.com', 18, 'Admirez des paysages côtiers spectaculaires avec notre boîte cadeau \'Randonnée Côtière - Vue panoramique sur l\'océan\'. Parcourez des sentiers côtiers pittoresques, découvrez des plages isolées et profitez d\'une brise marine revigorante. Cette boîte comprend un guide expérimenté, un panier-repas gourmand et des moments de détente face à l\'océan. Échappez au quotidien et reconnectez-vous à la nature !', 94.99),
('partner2@example.com', 19, 'Profitez d\'une soirée inoubliable au théâtre avec notre boîte cadeau \'Pièce de Théâtre Comique - Comédie enlevée\'. Riez aux éclats en regardant une comédie hilarante interprétée par des acteurs talentueux. Cette boîte comprend des places de première catégorie, des rafraîchissements pendant l\'entracte et une rencontre avec les membres de la troupe. Laissez-vous emporter par le rire et la bonne humeur !', 49.99),
('partner2@example.com', 25, 'Vivez une expérience musicale unique avec notre boîte cadeau \'Concert de Musique Live - Artiste surprise\'. Assistez à un concert époustouflant d\'un artiste de renommée mondiale dans une salle de concert prestigieuse. Cette boîte comprend des places VIP, un accès aux coulisses et un album dédicacé en souvenir. Laissez-vous envoûter par la magie de la musique en direct !', 69.99);

-- --------------------------------------------------------

--
-- Structure de la table `in_cart`
--

CREATE TABLE `in_cart` (
  `user_email` varchar(40) NOT NULL,
  `box_id` int(11) NOT NULL,
  `chosen_partner_email` varchar(40) NOT NULL,
  `articles_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `omnesbox`
--

CREATE TABLE `omnesbox` (
  `box_id` int(11) NOT NULL,
  `box_title` text NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `omnesbox`
--

INSERT INTO `omnesbox` (`box_id`, `box_title`, `activity_id`) VALUES
(1, 'Cours de Cuisine - Débutant', 1),
(2, 'Cours de Cuisine - Avancé', 1),
(3, 'Cours de Cuisine - Spécialités régionales', 1),
(4, 'Conférence sur l\'Entrepreneuriat - Stratégies gagnantes', 2),
(5, 'Conférence sur l\'Intelligence Artificielle - Nouvelles perspectives', 2),
(6, 'Conférence sur la Psychologie Positive - Bien-être et épanouissement', 2),
(7, 'Concours de Photographie - Thème : Nature', 3),
(8, 'Concours de Dessin - Style libre', 3),
(9, 'Concours de Poésie - Poèmes engagés', 3),
(10, 'Vacances à la Plage - Destination : Bali', 4),
(11, 'Vacances à la Montagne - Chalet de luxe', 4),
(12, 'Vacances en Ville - Séjour dans une métropole', 4),
(13, 'Dîner Gastronomique - Menu dégustation', 5),
(14, 'Brunch Chic - Spécialités du terroir', 5),
(15, 'Dîner Romantique - Ambiance feutrée', 5),
(16, 'Randonnée en Montagne - Parc national des Alpes', 6),
(17, 'Randonnée en Forêt - Sentiers enchantés', 6),
(18, 'Randonnée Côtière - Vue panoramique sur l\'océan', 6),
(19, 'Pièce de Théâtre Comique - Comédie enlevée', 7),
(20, 'Pièce de Théâtre Dramatique - Emotions intenses', 7),
(21, 'Pièce de Théâtre Musicale - Chants et danses', 7),
(22, 'Projection de Films Cultes - Sélection exclusive', 8),
(23, 'Avant-Première d\'un Blockbuster - Soirée VIP', 8),
(24, 'Marathon Cinéphile - Films à la suite', 8),
(25, 'Concert de Musique Live - Artiste surprise', 9),
(26, 'Concert de Jazz - Ambiance chaleureuse', 9),
(27, 'Concert de Rock - Énergie débordante', 9),
(28, 'Exposition d\'Art Moderne - Nouvelles tendances', 10),
(29, 'Exposition de Photographie - Regards captivants', 10),
(30, 'Exposition de Sculptures - Formes surprenantes', 10);

-- --------------------------------------------------------

--
-- Structure de la table `possession`
--

CREATE TABLE `possession` (
  `possession_id` int(11) NOT NULL,
  `possession_date` date DEFAULT NULL,
  `user_email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `purchase_date` date DEFAULT NULL,
  `user_email` varchar(40) NOT NULL,
  `box_id` int(11) NOT NULL,
  `chosen_partner_email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `to_offer`
--

CREATE TABLE `to_offer` (
  `to_offer_id` int(11) NOT NULL,
  `to_offer_password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `used`
--

CREATE TABLE `used` (
  `used_id` int(11) NOT NULL,
  `used_date` date DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `comment` text,
  `user_email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Index pour la table `activity_offer`
--
ALTER TABLE `activity_offer`
  ADD PRIMARY KEY (`partner_email`,`activity_id`),
  ADD KEY `FK3` (`activity_id`);

--
-- Index pour la table `box_offer`
--
ALTER TABLE `box_offer`
  ADD PRIMARY KEY (`partner_email`,`box_id`),
  ADD KEY `FK5` (`box_id`);

--
-- Index pour la table `in_cart`
--
ALTER TABLE `in_cart`
  ADD PRIMARY KEY (`user_email`,`box_id`),
  ADD KEY `FK7` (`box_id`),
  ADD KEY `FK16` (`chosen_partner_email`);

--
-- Index pour la table `omnesbox`
--
ALTER TABLE `omnesbox`
  ADD PRIMARY KEY (`box_id`),
  ADD KEY `FK1` (`activity_id`);

--
-- Index pour la table `possession`
--
ALTER TABLE `possession`
  ADD PRIMARY KEY (`possession_id`),
  ADD KEY `FK13` (`user_email`);

--
-- Index pour la table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `FK8` (`user_email`),
  ADD KEY `FK9` (`box_id`),
  ADD KEY `FK10` (`chosen_partner_email`);

--
-- Index pour la table `to_offer`
--
ALTER TABLE `to_offer`
  ADD PRIMARY KEY (`to_offer_id`);

--
-- Index pour la table `used`
--
ALTER TABLE `used`
  ADD PRIMARY KEY (`used_id`),
  ADD KEY `FK15` (`user_email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `omnesbox`
--
ALTER TABLE `omnesbox`
  MODIFY `box_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activity_offer`
--
ALTER TABLE `activity_offer`
  ADD CONSTRAINT `FK2` FOREIGN KEY (`partner_email`) REFERENCES `account` (`email`),
  ADD CONSTRAINT `FK3` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`activity_id`);

--
-- Contraintes pour la table `box_offer`
--
ALTER TABLE `box_offer`
  ADD CONSTRAINT `FK4` FOREIGN KEY (`partner_email`) REFERENCES `account` (`email`),
  ADD CONSTRAINT `FK5` FOREIGN KEY (`box_id`) REFERENCES `omnesbox` (`box_id`);

--
-- Contraintes pour la table `in_cart`
--
ALTER TABLE `in_cart`
  ADD CONSTRAINT `FK16` FOREIGN KEY (`chosen_partner_email`) REFERENCES `account` (`email`),
  ADD CONSTRAINT `FK6` FOREIGN KEY (`user_email`) REFERENCES `account` (`email`),
  ADD CONSTRAINT `FK7` FOREIGN KEY (`box_id`) REFERENCES `omnesbox` (`box_id`);

--
-- Contraintes pour la table `omnesbox`
--
ALTER TABLE `omnesbox`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`activity_id`);

--
-- Contraintes pour la table `possession`
--
ALTER TABLE `possession`
  ADD CONSTRAINT `FK12` FOREIGN KEY (`possession_id`) REFERENCES `purchase` (`purchase_id`),
  ADD CONSTRAINT `FK13` FOREIGN KEY (`user_email`) REFERENCES `account` (`email`);

--
-- Contraintes pour la table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `FK10` FOREIGN KEY (`chosen_partner_email`) REFERENCES `account` (`email`),
  ADD CONSTRAINT `FK8` FOREIGN KEY (`user_email`) REFERENCES `account` (`email`),
  ADD CONSTRAINT `FK9` FOREIGN KEY (`box_id`) REFERENCES `omnesbox` (`box_id`);

--
-- Contraintes pour la table `to_offer`
--
ALTER TABLE `to_offer`
  ADD CONSTRAINT `FK11` FOREIGN KEY (`to_offer_id`) REFERENCES `purchase` (`purchase_id`);

--
-- Contraintes pour la table `used`
--
ALTER TABLE `used`
  ADD CONSTRAINT `FK14` FOREIGN KEY (`used_id`) REFERENCES `purchase` (`purchase_id`),
  ADD CONSTRAINT `FK15` FOREIGN KEY (`user_email`) REFERENCES `account` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
