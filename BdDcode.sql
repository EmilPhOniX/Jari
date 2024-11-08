-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 sep. 2024 à 14:58
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agiletools`
--

-- --------------------------------------------------------
DROP TABLE IF EXISTS idees_bac_a_sable;
DROP TABLE IF EXISTS rolesutilisateurprojet;
DROP TABLE IF EXISTS sprintbacklog;
DROP TABLE IF EXISTS taches;
DROP TABLE IF EXISTS utilisateurs;
DROP TABLE IF EXISTS etatstaches;
DROP TABLE IF EXISTS prioritestaches;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS sprints;
DROP TABLE IF EXISTS equipesprj;
-- --------------------------------------------------------


--
-- Structure de la table `equipesprj`
--

CREATE TABLE `equipesprj` (
  `IdEq` smallint(11) NOT NULL,
  `NomEq` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etatstaches`
--

CREATE TABLE `etatstaches` (
  `IdEtat` smallint(4) NOT NULL,
  `DescEtat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etatstaches`
--

INSERT INTO `etatstaches` (`IdEtat`, `DescEtat`) VALUES
(1, 'A faire'),
(2, 'En cours'),
(3, 'Terminé et TestUnitaire réalisé'),
(4, 'Test Fonctionnel Réalisé / Module intégré dans ver'),
(5, 'intégré dans version de production');

-- --------------------------------------------------------

--
-- Structure de la table `idees_bac_a_sable`
--

CREATE TABLE `idees_bac_a_sable` (
  `Id_Idee_bas` int(11) NOT NULL,
  `desc_Idee_bas` varchar(300) NOT NULL,
  `IdU` smallint(6) NOT NULL,
  `IdEq` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prioritestaches`
--

CREATE TABLE `prioritestaches` (
  `idPriorite` tinyint(1) NOT NULL,
  `DescPriorite` varchar(15) NOT NULL,
  `valPriorite` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prioritestaches`
--

INSERT INTO `prioritestaches` (`idPriorite`, `DescPriorite`, `valPriorite`) VALUES
(1, '1', 1),
(2, '2', 2),
(3, '3', 3),
(4, '4', 4),
(5, '5', 5),
(6, 'MUST (MoSCoW)', 5),
(7, 'SHOULD (MoSCoW)', 4),
(8, 'Could ', 2),
(9, 'WONT (MoSCoW)', 0);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `IdR` varchar(6) NOT NULL,
  `DescR` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`IdR`, `DescR`) VALUES
('PO', 'Product Owner'),
('RefDev', 'Référent Dev'),
('RefUi', 'Référent UI'),
('R_Anim', 'Référent Animation'),
('R_Mode', 'Référent Modélisation'),
('SM', 'Scrum Master'),
('MA', 'Membre Actif');

-- --------------------------------------------------------

--
-- Structure de la table `rolesutilisateurprojet`
--

CREATE TABLE `rolesutilisateurprojet` (
  `IdU` smallint(6) NOT NULL,
  `IdR` varchar(6) NOT NULL,
  `IdEq` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sprintbacklog`
--

CREATE TABLE `sprintbacklog` (
  `IdT` int(11) NOT NULL,
  `IdS` smallint(6) NOT NULL,
  `IdU` smallint(6) NOT NULL,
  `IdEtat` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sprints`
--

CREATE TABLE `sprints` (
  `IdS` smallint(6) NOT NULL,
  `DateDebS` date NOT NULL,
  `DateFinS` date NOT NULL,
  `RetrospectiveS` varchar(300) DEFAULT NULL,
  `RevueS` varchar(300) DEFAULT NULL,
  `IdEq` smallint(6) NOT NULL,
  `VelociteEq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

CREATE TABLE `taches` (
  `IdT` int(11) NOT NULL,
  `TitreT` varchar(50) NOT NULL,
  `UserStoryT` varchar(300) NOT NULL,
  `IdEq` smallint(6) NOT NULL,
  `CoutT` enum('?','1','3','5','10','15','25','999') NOT NULL DEFAULT '?',
  `IdPriorite` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `IdU` smallint(6) NOT NULL,
  `NomU` varchar(50) NOT NULL,
  `PrenomU` varchar(50) NOT NULL,
  `MotDePasseU` varchar(255) NOT NULL,
  `SpecialiteU` enum('Développeur','Modeleur','Animateur','UI','IA','WebComm','Polyvalent') NOT NULL DEFAULT 'Polyvalent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `equipesprj`
--
ALTER TABLE `equipesprj`
  ADD PRIMARY KEY (`IdEq`);

--
-- Index pour la table `etatstaches`
--
ALTER TABLE `etatstaches`
  ADD PRIMARY KEY (`IdEtat`);

--
-- Index pour la table `idees_bac_a_sable`
--
ALTER TABLE `idees_bac_a_sable`
  ADD PRIMARY KEY (`Id_Idee_bas`),
  ADD KEY `IdU` (`IdU`),
  ADD KEY `IdEq` (`IdEq`);

--
-- Index pour la table `prioritestaches`
--
ALTER TABLE `prioritestaches`
  ADD PRIMARY KEY (`idPriorite`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`IdR`);

--
-- Index pour la table `rolesutilisateurprojet`
--
ALTER TABLE `rolesutilisateurprojet`
  ADD PRIMARY KEY (`IdU`,`IdEq`),
  ADD KEY `FK_RoleUtil_Roles` (`IdR`),
  ADD KEY `IdEq` (`IdEq`),
  ADD KEY `IdU` (`IdU`);

--
-- Index pour la table `sprintbacklog`
--
ALTER TABLE `sprintbacklog`
  ADD PRIMARY KEY (`IdT`),
  ADD KEY `IdS` (`IdS`),
  ADD KEY `IdU` (`IdU`),
  ADD KEY `IdEtat` (`IdEtat`);

--
-- Index pour la table `sprints`
--
ALTER TABLE `sprints`
  ADD PRIMARY KEY (`IdS`),
  ADD KEY `IdEq` (`IdEq`);

--
-- Index pour la table `taches`
--
ALTER TABLE `taches`
  ADD PRIMARY KEY (`IdT`),
  ADD KEY `IdPriorite` (`IdPriorite`),
  ADD KEY `IndexIdEq` (`IdEq`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`IdU`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `idees_bac_a_sable`
--
ALTER TABLE `idees_bac_a_sable`
  ADD CONSTRAINT `FK_IdeeBAS_Equipes` FOREIGN KEY (`IdEq`) REFERENCES `equipesprj` (`IdEq`),
  ADD CONSTRAINT `FK_IdeesBAS_Utilisateurs` FOREIGN KEY (`IdU`) REFERENCES `utilisateurs` (`IdU`);

--
-- Contraintes pour la table `rolesutilisateurprojet`
--
ALTER TABLE `rolesutilisateurprojet`
  ADD CONSTRAINT `FK_RoleUtil_Equipes` FOREIGN KEY (`IdEq`) REFERENCES `equipesprj` (`IdEq`),
  ADD CONSTRAINT `FK_RoleUtil_Roles` FOREIGN KEY (`IdR`) REFERENCES `roles` (`IdR`),
  ADD CONSTRAINT `FK_RoleUtil_Utilisateurs` FOREIGN KEY (`IdU`) REFERENCES `utilisateurs` (`IdU`);

--
-- Contraintes pour la table `sprintbacklog`
--
ALTER TABLE `sprintbacklog`
  ADD CONSTRAINT `FK_SB_EtatTaches` FOREIGN KEY (`IdEtat`) REFERENCES `etatstaches` (`IdEtat`),
  ADD CONSTRAINT `FK_SB_Sprints` FOREIGN KEY (`IdS`) REFERENCES `sprints` (`IdS`),
  ADD CONSTRAINT `FK_SB_Taches` FOREIGN KEY (`IdT`) REFERENCES `taches` (`IdT`),
  ADD CONSTRAINT `FK_SB_Utilisateurs` FOREIGN KEY (`IdU`) REFERENCES `utilisateurs` (`IdU`);

--
-- Contraintes pour la table `sprints`
--
ALTER TABLE `sprints`
  ADD CONSTRAINT `FK_Sprints_Equipes` FOREIGN KEY (`IdEq`) REFERENCES `equipesprj` (`IdEq`);

--
-- Contraintes pour la table `taches`
--
ALTER TABLE `taches`
  ADD CONSTRAINT `FK_TachesEquipes` FOREIGN KEY (`IdEq`) REFERENCES `equipesprj` (`IdEq`),
  ADD CONSTRAINT `FK_Taches_Priorite` FOREIGN KEY (`IdPriorite`) REFERENCES `prioritestaches` (`idPriorite`);
COMMIT;

--
-- Creation de la table `VoterPP` (Voter planning Poker)
--
CREATE TABLE VoterPP (
    IdU	smallint(6) NOT NULL,
    IdT int(11) NOT NULL,
    estimationCout enum('?','1','3','5','10','15','25','999') NOT NULL DEFAULT '?',
    	CONSTRAINT pk_VoterPP PRIMARY KEY (idU, idT),
    CONSTRAINT fk_VoterPP FOREIGN KEY (idU) REFERENCES utilisateurs(idU),
    CONSTRAINT fk_VoterPP1 FOREIGN KEY (idT)REFERENCES taches(idT)
);

--
-- Creation de la table `CoutsDeReference` (Pour planning Poker)
--
CREATE TABLE CoutsDeReference (
	idC int(11) NOT NULL,
	LibelleC VARCHAR(100) NOT NULL,
	ValeurC int NOT NULL,
	IdT int(11) NOT NULL,
	IdU smallint(6) NOT NULL,
		CONSTRAINT pk_CoutsdeReference PRIMARY KEY (idC),
   	CONSTRAINT fk_CoutsdeReference FOREIGN KEY (IdT) REFERENCES taches(IdT),
	CONSTRAINT fk_CoutsdeReference1 FOREIGN KEY (IdU) REFERENCES VoterPP(IdU)
	
);

--
-- Indique que le planning poker est en cours
--
ALTER TABLE `equipesprj`
ADD `PP` BOOLEAN NOT NULL DEFAULT FALSE;

--
-- Mets VRAI à la tâche qui est en cours de vote
--
ALTER TABLE `taches`
ADD `VotePP` BOOLEAN NOT NULL DEFAULT FALSE;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- TRIGGER Utilisateurs & SprintBackLog

DELIMITER $$
CREATE TRIGGER before_insert_sprintbacklog
BEFORE INSERT ON sprintbacklog
FOR EACH ROW
BEGIN
	-- Déclare une variable pour stocker l'équipe de la tâche
	DECLARE id_equipe_tache INT;
    
    -- Stock l'id de l'équipe (via IdEq dans taches)
    SELECT IdEq INTO id_equipe_tache
    FROM taches
    WHERE IdT = NEW.IdT;

	-- Vérifie si l'utilisateur est bien lié à l'équipe de la tâche dans roleutilisateurprojet
    IF NOT EXISTS (
        SELECT 1
        FROM rolesutilisateurprojet
        WHERE IdU = NEW.IdU
        AND IdEq = id_equipe_tache
    ) THEN
        -- Si l'utilisateur n'est pas dans l'équipe
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = "Erreur : L\'utilisateur n\'est pas lié à l\'équipe associée à cette tâche.";
    END IF;
END $$
DELIMITER ;

-- TRIGGER Utilisateur & Bac à sable

DELIMITER $$

CREATE TRIGGER before_insert_bac_a_sable
BEFORE INSERT ON idees_bac_a_sable
FOR EACH ROW
BEGIN
	-- Vérifie si l'utilisateur est bien lié à l'équipe du bac à sable
    IF NOT EXISTS (
        SELECT 1
        FROM rolesutilisateurprojet
        WHERE IdU = NEW.IdU
        AND IdEq = NEW.IdEq
    ) THEN
        -- Si l'utilisateur n'est pas dans l'équipe
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = "Erreur : L\'utilisateur n\'est pas lié à l\'équipe pour pouvoir donner une idée dans ce bac à sable.";
    END IF;
END $$

DELIMITER ;

-- TRIGGER Rôle Equipe

DELIMITER $$

CREATE TRIGGER before_insert_rolesutilisateurprojet
BEFORE INSERT ON rolesutilisateurprojet
FOR EACH ROW
BEGIN
    -- Vérifie si le rôle que l'on veut donner est soit PO, soit SM
    IF NEW.IdR IN ('PO', 'SM') THEN
        IF EXISTS (
            SELECT 1
            FROM rolesutilisateurprojet
            WHERE IdEq = NEW.IdEq
            AND IdR = NEW.IdR
        ) THEN
            -- Si le rôle (PO ou SM) est déjà attribué dans l'équipe
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = "Erreur : Ce rôle (PO ou SM) a déjà été attribué dans cette équipe.";
        END IF;
    END IF;
END $$

DELIMITER ;


-- Insertion des utilisateurs (1 patron et 6 employés, avec les mots de passe modifiés)
INSERT INTO `utilisateurs` (`IdU`, `NomU`, `PrenomU`, `MotDePasseU`, `SpecialiteU`) VALUES
(1, 'admin', 'admin', '$2y$10$pHYan9fy0dXRj4a3PKqDb.CIAZMCuIiZbU8DsMLlqSt.j4YI6TZvq', 'Polyvalent'),
(2, 'Dupont', 'Jean', '$2y$10$93AV54KQSGQRdXXAlO.pMeFq7zu5Un3/rZCWSfziOEOFKp.y7YIi6', 'Développeur'),
(3, 'Durand', 'Marie', '$2y$10$93AV54KQSGQRdXXAlO.pMeFq7zu5Un3/rZCWSfziOEOFKp.y7YIi6', 'UI'),
(4, 'Moreau', 'Paul', '$2y$10$93AV54KQSGQRdXXAlO.pMeFq7zu5Un3/rZCWSfziOEOFKp.y7YIi6', 'Développeur'),
(5, 'Leroy', 'Sophie', '$2y$10$93AV54KQSGQRdXXAlO.pMeFq7zu5Un3/rZCWSfziOEOFKp.y7YIi6', 'Animateur'),
(6, 'Martin', 'Jacques', '$2y$10$93AV54KQSGQRdXXAlO.pMeFq7zu5Un3/rZCWSfziOEOFKp.y7YIi6', 'Modeleur'),
(7, 'Bernard', 'Louise', '$2y$10$93AV54KQSGQRdXXAlO.pMeFq7zu5Un3/rZCWSfziOEOFKp.y7YIi6', 'WebComm');

-- Insertion des équipes (2 équipes de 4 employés)
INSERT INTO `equipesprj` (`IdEq`, `NomEq`) VALUES
(1, 'Equipe Alpha'),
(2, 'Equipe Beta');

-- Assignation des rôles aux utilisateurs dans les équipes
INSERT INTO `rolesutilisateurprojet` (`IdU`, `IdR`, `IdEq`) VALUES
(2, 'PO', 1), -- Jean Dupont, Product Owner équipe Alpha
(3, 'SM', 1), -- Marie Durand, Scrum Master équipe Alpha
(4, 'MA', 1), -- Paul Moreau, Membre Actif équipe Alpha
(5, 'MA', 1), -- Sophie Leroy, Membre Actif équipe Alpha
(6, 'PO', 2), -- Jacques Martin, Product Owner équipe Beta
(7, 'SM', 2), -- Louise Bernard, Scrum Master équipe Beta
(2, 'MA', 2), -- Jean Dupont, Membre Actif équipe Beta (travaille sur 2 projets)
(3, 'MA', 2); -- Marie Durand, Membre Actif équipe Beta (travaille sur 2 projets)

-- Insertion des projets (4 projets : 2 terminés, 2 en cours)
INSERT INTO `sprints` (`IdS`, `DateDebS`, `DateFinS`, `RetrospectiveS`, `RevueS`, `IdEq`, `VelociteEq`) VALUES
(1, '2024-01-01', '2024-03-01', 'Projet terminé avec succès', 'Projet livré', 1, 30), -- Projet terminé (équipe Alpha)
(2, '2024-04-01', '2024-06-01', 'Projet terminé avec succès', 'Projet livré', 2, 28), -- Projet terminé (équipe Beta)
(3, '2024-07-01', '2024-09-01', NULL, NULL, 1, 24), -- Projet en cours (80%)
(4, '2024-07-01', '2024-09-01', NULL, NULL, 2, 6); -- Projet en cours (20%)

-- Insertion des sprints pour les projets en cours (1 sprint terminé, 1 sprint non terminé)
-- Sprints pour le projet en cours 80%
INSERT INTO `sprints` (`IdS`, `DateDebS`, `DateFinS`, `RetrospectiveS`, `RevueS`, `IdEq`, `VelociteEq`) VALUES
(5, '2024-09-01', '2024-09-30', 'Sprint terminé', 'Sprint review', 1, 20), -- Sprint terminé pour projet à 80%
(6, '2024-10-01', '2024-11-01', NULL, NULL, 1, 0); -- Sprint non terminé pour projet à 80%

-- Sprints pour le projet en cours 20%
INSERT INTO `sprints` (`IdS`, `DateDebS`, `DateFinS`, `RetrospectiveS`, `RevueS`, `IdEq`, `VelociteEq`) VALUES
(7, '2024-09-01', '2024-09-30', 'Sprint terminé', 'Sprint review', 2, 6), -- Sprint terminé pour projet à 20%
(8, '2024-10-01', '2024-11-01', NULL, NULL, 2, 0); -- Sprint non terminé pour projet à 20%

-- Insertion des tâches (par sprint, incluant leur état et priorité)
-- Tâches du projet en cours 80% (Sprint terminé et en cours)
INSERT INTO `taches` (`IdT`, `TitreT`, `UserStoryT`, `IdEq`, `CoutT`, `IdPriorite`) VALUES
(1, 'Tâche 1 - Sprint 5', 'User Story 1', 1, '5', 2), -- Tâche en cours (Sprint terminé)
(2, 'Tâche 2 - Sprint 6', 'User Story 2', 1, '10', 3); -- Tâche en cours (Sprint non terminé)

-- Tâches du projet en cours 20% (Sprint terminé et en cours)
INSERT INTO `taches` (`IdT`, `TitreT`, `UserStoryT`, `IdEq`, `CoutT`, `IdPriorite`) VALUES
(3, 'Tâche 1 - Sprint 7', 'User Story 3', 2, '3', 4), -- Tâche en cours (Sprint terminé)
(4, 'Tâche 2 - Sprint 8', 'User Story 4', 2, '15', 1); -- Tâche en cours (Sprint non terminé)

-- Insertion dans le sprint backlog (assignation des tâches aux utilisateurs avec état)
-- Assignation des tâches pour le projet à 80%
INSERT INTO `sprintbacklog` (`IdT`, `IdS`, `IdU`, `IdEtat`) VALUES
(1, 5, 2, 3), -- Tâche 1 (Sprint 5 terminé)
(2, 6, 4, 2); -- Tâche 2 (Sprint 6 en cours)

-- Assignation des tâches pour le projet à 20%
INSERT INTO `sprintbacklog` (`IdT`, `IdS`, `IdU`, `IdEtat`) VALUES
(3, 7, 6, 3), -- Tâche 1 (Sprint 7 terminé)
(4, 8, 7, 2); -- Tâche 2 (Sprint 8 en cours)