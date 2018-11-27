-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 24 nov. 2018 à 18:01
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `project1`
--

-- --------------------------------------------------------

--
-- Structure de la table `devise`
--

CREATE TABLE `devise` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `symbole` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_tel` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_fix` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adress` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deponse` double DEFAULT NULL,
  `rest_pay` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `client_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `nom`, `prenom`, `num_tel`, `num_fix`, `adress`, `deponse`, `rest_pay`, `credit`, `client_admin`) VALUES
(1, 'adminuser', 'adminuser', 'eddinea49@gmail.com', 'eddinea49@gmail.com', 1, NULL, '$2y$13$owqvgQsdyTuE/yehkz48NeAcSouZjtbnPNWPnKSx.BoTL14.P08/C', '2018-11-22 22:32:21', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 'ala eddine', 'zakhama', '26290285', '234567', 'Moknine', NULL, NULL, NULL, NULL),
(2, 'sayf', 'sayf', 'sayftms@gmail.com', 'sayftms@gmail.com', 1, NULL, '$2y$13$C.bgQwOfX./eY.ycKiOmDu2w5FXTqdqAPYE3UONqFwRFd9aF/98k2', '2018-11-18 21:53:37', NULL, NULL, 'a:0:{}', 'sayf', 'bahri', '97152046', '17852312', 'sayada', 12, 12, 23, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `num_tel` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_fix` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adress` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `deponse` double NOT NULL,
  `credit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `prenom`, `num_tel`, `num_fix`, `email`, `adress`, `deponse`, `credit`, `date`) VALUES
(8, 'Sayf', 'Bahri', '97152064', '53752', 'sayftms@gmail.com', 'moknine', 8, '8', '2018-11-21'),
(9, 'ala', 'eddine', '26290285', '73 222 222', 'eddinea49@gmail.com', 'moknine', 0, '0', '2018-11-24');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom_four` int(11) DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL,
  `nom` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `prix_achat` double NOT NULL,
  `prix_vend` double NOT NULL,
  `vendu` tinyint(1) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom_four`, `id_type`, `nom`, `prix_achat`, `prix_vend`, `vendu`, `date`) VALUES
(24, 8, 8, '345678903211243455', 200, 250, 1, '2018-11-24');

-- --------------------------------------------------------

--
-- Structure de la table `proposition_fournisseurs`
--

CREATE TABLE `proposition_fournisseurs` (
  `id` int(11) NOT NULL,
  `date_ac` datetime NOT NULL,
  `date_ex` datetime NOT NULL,
  `text` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statfour`
--

CREATE TABLE `statfour` (
  `id` int(11) NOT NULL,
  `id_elem` int(11) NOT NULL,
  `nb_produit_N_vend` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `nb_produit_vend` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `list_produit_vend` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `list_vend` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credit` double NOT NULL,
  `deponse` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `statfour`
--

INSERT INTO `statfour` (`id`, `id_elem`, `nb_produit_N_vend`, `nb_produit_vend`, `list_produit_vend`, `list_vend`, `credit`, `deponse`) VALUES
(4, 2, 'a:1:{i:0;a:4:{s:2:\"nb\";s:1:\"0\";s:5:\"achat\";N;s:5:\"vende\";N;s:8:\"qte_prod\";N;}}', 'a:1:{i:0;a:2:{s:2:\"nb\";s:1:\"0\";s:5:\"vende\";N;}}', 'a:0:{}', 'a:0:{}', 0, 0),
(5, 1, 'a:1:{i:0;a:4:{s:2:\"nb\";s:1:\"0\";s:5:\"achat\";N;s:5:\"vende\";N;s:8:\"qte_prod\";N;}}', 'a:1:{i:0;a:2:{s:2:\"nb\";s:1:\"1\";s:5:\"vende\";s:2:\"35\";}}', 'a:2:{i:0;a:4:{s:3:\"nom\";s:5:\"flash\";s:9:\"prixAchat\";d:35;s:5:\"vendu\";b:1;s:4:\"date\";O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2018-11-18 00:00:00.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:13:\"Europe/Berlin\";}}i:1;a:4:{s:3:\"nom\";s:5:\"cable\";s:9:\"prixAchat\";d:35;s:5:\"vendu\";b:1;s:4:\"date\";O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2018-11-18 00:00:00.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:13:\"Europe/Berlin\";}}}', 'a:1:{i:0;a:5:{s:8:\"prixVend\";d:35;i:1;s:1:\"1\";s:3:\"nom\";s:5:\"flash\";s:6:\"dateAc\";O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2013-01-01 00:00:00.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:13:\"Europe/Berlin\";}s:6:\"dateEx\";O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2013-01-01 00:00:00.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:13:\"Europe/Berlin\";}}}', 0, 0),
(6, 6, 'a:1:{i:0;a:4:{s:2:\"nb\";s:1:\"0\";s:5:\"achat\";N;s:5:\"vende\";N;s:8:\"qte_prod\";N;}}', 'a:1:{i:0;a:2:{s:2:\"nb\";s:1:\"0\";s:5:\"vende\";N;}}', 'a:0:{}', 'a:0:{}', 0, 0),
(8, 7, 'a:1:{i:0;a:4:{s:2:\"nb\";s:1:\"2\";s:5:\"achat\";s:3:\"400\";s:5:\"vende\";s:3:\"500\";s:8:\"qte_prod\";s:1:\"0\";}}', 'a:1:{i:0;a:2:{s:2:\"nb\";s:1:\"0\";s:5:\"vende\";N;}}', 'a:0:{}', 'a:0:{}', 400, 0),
(10, 8, 'a:1:{i:0;a:4:{s:2:\"nb\";s:1:\"0\";s:5:\"achat\";N;s:5:\"vende\";N;s:8:\"qte_prod\";N;}}', 'a:1:{i:0;a:2:{s:2:\"nb\";s:1:\"1\";s:5:\"vende\";s:3:\"250\";}}', 'a:1:{i:0;a:4:{s:3:\"nom\";s:15:\"234098543320954\";s:9:\"prixAchat\";d:60;s:5:\"vendu\";b:1;s:4:\"date\";O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2018-11-23 00:00:00.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:13:\"Europe/Berlin\";}}}', 'a:1:{i:0;a:5:{s:8:\"prixVend\";d:250;i:1;s:2:\"20\";s:3:\"nom\";s:15:\"234098543320954\";s:6:\"dateAc\";O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2018-11-23 18:38:04.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:13:\"Europe/Berlin\";}s:6:\"dateEx\";O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2019-11-23 18:38:04.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:13:\"Europe/Berlin\";}}}', 0, 8);

-- --------------------------------------------------------

--
-- Structure de la table `type_produit`
--

CREATE TABLE `type_produit` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `type_produit`
--

INSERT INTO `type_produit` (`id`, `type`) VALUES
(8, 'IPTV');

-- --------------------------------------------------------

--
-- Structure de la table `vende`
--

CREATE TABLE `vende` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `prix_vend` double NOT NULL,
  `date_ac` datetime NOT NULL,
  `date_ex` datetime NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num_tel` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `num_fix` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nom_prod` int(11) DEFAULT NULL,
  `nompre_cli` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `credit` tinyint(1) NOT NULL,
  `rest_pay` double DEFAULT NULL,
  `deponse` double DEFAULT NULL,
  `date` date NOT NULL,
  `abonner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `vende`
--

INSERT INTO `vende` (`id`, `id_user`, `prix_vend`, `date_ac`, `date_ex`, `email`, `num_tel`, `num_fix`, `nom_prod`, `nompre_cli`, `adress`, `credit`, `rest_pay`, `deponse`, `date`, `abonner`) VALUES
(23, 1, 250, '2018-11-24 15:32:17', '2019-11-24 15:32:17', 'eddinea@gmail.com', '26290285', '73 111 456', 24, 'Lotfi Najar', 'Moknine', 1, 100, 150, '2018-11-24', 12);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `devise`
--
ALTER TABLE `devise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_43EDA4DF6C6E55B5` (`nom`),
  ADD UNIQUE KEY `UNIQ_43EDA4DF2B57F8D4` (`symbole`);

--
-- Index pour la table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479497D46CE` (`num_fix`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`),
  ADD UNIQUE KEY `UNIQ_957A6479E0B0AAA1` (`num_tel`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D3EF0041E0B0AAA1` (`num_tel`),
  ADD UNIQUE KEY `UNIQ_D3EF0041497D46CE` (`num_fix`),
  ADD UNIQUE KEY `UNIQ_D3EF0041E7927C74` (`email`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BE2DDF8C6211AC13` (`nom_four`),
  ADD KEY `IDX_BE2DDF8C7FE4B2B` (`id_type`);

--
-- Index pour la table `proposition_fournisseurs`
--
ALTER TABLE `proposition_fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statfour`
--
ALTER TABLE `statfour`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_produit`
--
ALTER TABLE `type_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vende`
--
ALTER TABLE `vende`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C248381D6B3CA4B` (`id_user`),
  ADD KEY `IDX_C248381D4764DBF9` (`nom_prod`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `devise`
--
ALTER TABLE `devise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `proposition_fournisseurs`
--
ALTER TABLE `proposition_fournisseurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statfour`
--
ALTER TABLE `statfour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `type_produit`
--
ALTER TABLE `type_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `vende`
--
ALTER TABLE `vende`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `FK_BE2DDF8C6211AC13` FOREIGN KEY (`nom_four`) REFERENCES `fournisseurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_BE2DDF8C7FE4B2B` FOREIGN KEY (`id_type`) REFERENCES `type_produit` (`id`);

--
-- Contraintes pour la table `vende`
--
ALTER TABLE `vende`
  ADD CONSTRAINT `FK_C248381D4764DBF9` FOREIGN KEY (`nom_prod`) REFERENCES `produits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C248381D6B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `fos_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
