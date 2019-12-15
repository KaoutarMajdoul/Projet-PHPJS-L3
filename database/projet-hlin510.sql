-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 15 déc. 2019 à 23:26
-- Version du serveur :  10.4.8-MariaDB
-- Version de PHP :  7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet-hlin510`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `emailA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`emailA`) VALUES
('admin@email.com'),
('lacy@email.com');

-- --------------------------------------------------------

--
-- Structure de la table `contributeur`
--

CREATE TABLE `contributeur` (
  `emailC` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contributeur`
--

INSERT INTO `contributeur` (`emailC`) VALUES
('contributeur@email.com'),
('lacy@email.com'),
('none@email.com');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `idEven` int(5) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `nbPlaces` int(6) NOT NULL,
  `dateDeb` date NOT NULL,
  `dateFin` date NOT NULL,
  `theme` int(5) NOT NULL,
  `emailContrib` varchar(50) NOT NULL,
  `event_img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idEven`, `nom`, `description`, `adresse`, `latitude`, `longitude`, `nbPlaces`, `dateDeb`, `dateFin`, `theme`, `emailContrib`, `event_img`) VALUES
(1, 'Cirque du soleil', 'Meilleur cirque d europe, réservez vite !', 'rue de la comédie, Montpellier', '43.6', '3.8833', 1000, '2019-12-27', '2019-12-29', 1, 'contributeur@email.com', 'cirque.png'),
(2, 'Théâtre Mollière', 'Piece de théâtre', 'rue du port, Marseille', '43.3 ', '5.4', 500, '2020-02-10', '2020-02-10', 2, 'contributeur@email.com', 'theatre.jpg'),
(3, 'Concert de rock', 'Concert des Beatles', 'rue du corum, Paris', '48.8534', '2.3488', 5000, '2020-04-10', '2020-04-10', 3, 'contributeur@email.com', 'concert.jpg'),
(4, 'Exposition Musée Fabre', 'Exposition artistique', 'rue de la comédie,Paris', '48.8534', '2.3488', 30, '2020-05-10', '2020-05-17', 4, 'contributeur@email.com', 'exposition.jpg'),
(5, 'Soirée caritative', 'Pour une association', 'rue du port, Marseille', '43.3 ', '5.4', 200, '2020-01-10', '2020-01-10', 5, 'contributeur@email.com', 'caritative.jpg'),
(6, 'Evenement passé', 'passed event', 'marseille', '43.3 ', '5.4', 1, '2019-12-11', '2019-12-12', 5, 'contributeur@email.com', 'fireworks.jpg'),
(12, 'Concert indie', 'Concert adapté aux personnes handicapées', 'rue symfony, Toulouse', '43.6043', '1.4437', 90, '2019-12-30', '2019-12-31', 3, 'contributeur@email.com', 'concert_indie.jpg');

--
-- Déclencheurs `evenement`
--
DELIMITER $$
CREATE TRIGGER `ATTENTION_NBPLACE` BEFORE INSERT ON `evenement` FOR EACH ROW BEGIN 
IF NEW.nbPlaces<=0 THEN
    INSERT INTO LOGERROR(MESSAGE) VALUES (CONCAT("ATTENTION, LE NOMBRE DE PLACES DOIT ETRE SUPERIEUR A 0"));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'LE NOMBRE DE PLACES DOIT ËTRE SUPERIEUR A 0';
END IF; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `LOGERROR`
--

CREATE TABLE `LOGERROR` (
  `ID` int(11) NOT NULL,
  `MESSAGE` varchar(255) DEFAULT NULL,
  `THETIME` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `emailP` varchar(50) NOT NULL,
  `idEv` int(5) NOT NULL,
  `note` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`emailP`, `idEv`, `note`) VALUES
('contributeur@email.com', 6, 5);

--
-- Déclencheurs `note`
--
DELIMITER $$
CREATE TRIGGER `ATTENTION_PARTICIPATION_NOTE` AFTER INSERT ON `note` FOR EACH ROW BEGIN

DECLARE c INT;

SELECT COUNT(*)
INTO c
FROM participe p
WHERE NEW.emailP = p.emailPers
AND NEW.idEv = p.idEven ;

IF c = 0 THEN
      INSERT INTO LOGERROR(MESSAGE) VALUES (CONCAT("ATTENTION, PAS DE PARTICIPATION A L EVEN"));
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'ATTENTION, PAS DE PARTICIPATION A L EVEN';
      END IF ;
      END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `emailPers` varchar(50) NOT NULL,
  `idEven` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `participe`
--

INSERT INTO `participe` (`emailPers`, `idEven`) VALUES
('contributeur@email.com', 1),
('contributeur@email.com', 6),
('contributeur@email.com', 12),
('lacy@email.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `email` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `mdp` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`email`, `nom`, `prenom`, `pseudo`, `mdp`) VALUES
('admin@email.com', 'admin', 'admin', 'admin', '098f6bcd4621d373cade4e832627b4f6'),
('contributeur@email.com', 'contributeur', 'contributeur', 'cont', '098f6bcd4621d373cade4e832627b4f6'),
('lacy1@email.com', 'smith', 'lacy', 'lacy', '098f6bcd4621d373cade4e832627b4f6'),
('lacy2@email.com', 'smith', 'lacy', 'lacy', '098f6bcd4621d373cade4e832627b4f6'),
('lacy3@email.com', 'smith', 'lacy', 'lacy', '098f6bcd4621d373cade4e832627b4f6'),
('lacy@email.com', 'smith', 'lacy', 'lacy', '098f6bcd4621d373cade4e832627b4f6'),
('lays@email.com', 'ch', 'lays', 'lays', '098f6bcd4621d373cade4e832627b4f6'),
('none@email.com', 'none', 'none', 'nono', '098f6bcd4621d373cade4e832627b4f6'),
('popo@pepe.com', 'pepe', 'popo', 'pope', '098f6bcd4621d373cade4e832627b4f6'),
('prenom@nom.com', 'nom', 'prenom', 'pren', '098f6bcd4621d373cade4e832627b4f6');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `idTheme` int(5) NOT NULL,
  `emailA` varchar(50) NOT NULL,
  `nom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`idTheme`, `emailA`, `nom`) VALUES
(1, 'admin@email.com', 'Cirque'),
(2, 'admin@email.com', 'Theatre'),
(3, 'admin@email.com', 'Concert'),
(4, 'admin@email.com', 'Musée'),
(5, 'admin@email.com', 'Soirée');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`emailA`);

--
-- Index pour la table `contributeur`
--
ALTER TABLE `contributeur`
  ADD PRIMARY KEY (`emailC`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`idEven`),
  ADD KEY `FK_EVEN_THEME` (`theme`),
  ADD KEY `FK_EVEN_CONTRIB` (`emailContrib`);

--
-- Index pour la table `LOGERROR`
--
ALTER TABLE `LOGERROR`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`emailP`,`idEv`),
  ADD KEY `FK_NOTE_EVEN` (`idEv`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`emailPers`,`idEven`),
  ADD KEY `FK_EVEN_PARTICIPE` (`idEven`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`idTheme`),
  ADD KEY `FK_THEME_ADMIN` (`emailA`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `idEven` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `LOGERROR`
--
ALTER TABLE `LOGERROR`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `idTheme` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_PERS_ADMIN` FOREIGN KEY (`emailA`) REFERENCES `personne` (`email`);

--
-- Contraintes pour la table `contributeur`
--
ALTER TABLE `contributeur`
  ADD CONSTRAINT `FK_PERS_CONTRIB` FOREIGN KEY (`emailC`) REFERENCES `personne` (`email`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_EVEN_CONTRIB` FOREIGN KEY (`emailContrib`) REFERENCES `contributeur` (`emailC`),
  ADD CONSTRAINT `FK_EVEN_THEME` FOREIGN KEY (`theme`) REFERENCES `theme` (`idTheme`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `FK_NOTE_EVEN` FOREIGN KEY (`idEv`) REFERENCES `evenement` (`idEven`),
  ADD CONSTRAINT `FK_NOTE_PERSONNE` FOREIGN KEY (`emailP`) REFERENCES `personne` (`email`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `FK_EVEN_PARTICIPE` FOREIGN KEY (`idEven`) REFERENCES `evenement` (`idEven`),
  ADD CONSTRAINT `FK_PERS_PARTICIPE` FOREIGN KEY (`emailPers`) REFERENCES `personne` (`email`);

--
-- Contraintes pour la table `theme`
--
ALTER TABLE `theme`
  ADD CONSTRAINT `FK_THEME_ADMIN` FOREIGN KEY (`emailA`) REFERENCES `admin` (`emailA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
