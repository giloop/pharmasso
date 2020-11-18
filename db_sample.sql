-- Exemple de base de données pour tester le code de la Pharmasso
--

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `ph_medocs`
--

DROP TABLE IF EXISTS `ph_medocs`;
CREATE TABLE `ph_medocs` ( 
  `id` INT NOT NULL AUTO_INCREMENT , 
  `nom` VARCHAR(400) NOT NULL , 
  `posologie` VARCHAR(64) NOT NULL , PRIMARY KEY (`id`)
  ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci; 

--
-- Contenu de la table `ph_medocs`
--

INSERT INTO `ph_medocs` (`id`, `nom`, `posologie`) VALUES
(1, 'DOLIPRANE', ''),
(2, 'Dafalgan', ''),
(3, 'METEOSPASMYL', ''),
(4, 'Amoxiciline BGR 1g', ''),
(5, 'Tramadol 50 mg', ''),
(6, 'Lopéramide 2mg', ''),
(7, 'Béquilles enfants', ''),
(8, 'Amoxicilline trihydratée 1g', ''),
(9, 'Tobrex 0,3% collyre en solution', ''),
(10, 'bilaska, bilastine 20mg', ''),
(11, 'Vogalene Lyoc metopimazine 7,5mg', ''),
(12, 'spasfon 80mg', ''),
(13, 'Spasfon lyoc 80mg', ''),
(14, 'Test', ''),
(15, 'erterttert', ''),
(16, 'TOTO', ''),
(17, 'Débridat (Trimébutine)', ''),
(18, 'Volgalène lyoc 7.5mg', ''),
(19, 'Ibuprofène 400mg', ''),
(20, 'Eludril gé 0.5ml/0.5g pour 100ml', ''),
(21, 'Béquilles adultes', ''),
(22, 'Attelle doigt', '');

-- --------------------------------------------------------

--
-- Structure de la table `ph_pharmacie`
--

DROP TABLE IF EXISTS `ph_pharmacie`;
CREATE TABLE IF NOT EXISTS `ph_pharmacie` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) NOT NULL,
  `medocId` int(11) NOT NULL,
  `quantite` varchar(64) NOT NULL,
  `datePeremption` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci; 

--
-- Contenu de la table `ph_pharmacie`
--

INSERT INTO `ph_pharmacie` (`id`, `userId`, `medocId`, `quantite`, `datePeremption`) VALUES
(8, 3, 7, '1 paire à prêter', '01/2029'),
(2, 2, 2, '5 cp', '02/2025'),
(3, 2, 2, '5 cp', '02/2025'),
(4, 3, 3, '20 cp', '07/2019'),
(5, 3, 4, '3 cp', '04/2019'),
(6, 3, 5, '27 cp', '02/2021'),
(7, 3, 6, '20 cp', '09/2019'),
(9, 4, 8, '6 comprimés', '06/2020'),
(10, 4, 9, '1 flacon', '01/2021'),
(11, 4, 10, '26 comprimés', '01/2021'),
(12, 4, 11, '16 comprimés', '06/2019'),
(13, 4, 12, '30 comprimés enrobés', '09/2021'),
(14, 4, 13, '10 lyophilisants oraux', '07/2020'),
(15, 4, 13, '10 lyophilisats oraux', '07/2020'),
(23, 5, 18, '1 boite', '12/2021'),
(22, 5, 17, '1 boite', '03/2021'),
(26, 6, 21, '1 paire à prêter', '01/2029'),
(25, 5, 20, '2 flacons', '07/2020'),
(27, 6, 21, '1 paire à prêter', '01/2029'),
(28, 5, 22, '1', '01/2029');

-- --------------------------------------------------------

--
-- Structure de la table `ph_users`
--

DROP TABLE IF EXISTS `ph_users`;
CREATE TABLE IF NOT EXISTS `ph_users` (
  `id` int(11) NOT NULL auto_increment,
  `nom` varchar(64) NOT NULL,
  `tel` varchar(10) NULL,
  `mail` varchar(64) NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci; 

--
-- Contenu de la table `ph_users`
--

INSERT INTO `ph_users` (`id`, `nom`, `tel`, `mail`) VALUES
(4, 'Delphine', '0299123456', ''),
(3, 'Toto', '0299654321', 'jonnhy.b.good@free.fr'),
(5, 'Bernard', '0606123456', 'bernie@gmail.com'),
(6, 'Simone', '0706654321', 'simone@gmail.com');

