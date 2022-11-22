-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 13 nov. 2022 à 15:12
-- Version du serveur : 10.5.15-MariaDB-0+deb11u1
-- Version de PHP : 8.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cavp`
--

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

CREATE TABLE `agence` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `classe` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annuaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agence`
--

INSERT INTO `agence` (`id`, `name`, `code`, `classe`, `annuaire`) VALUES
(1, 'ANTANANARIVO R.P', 101000, 'REX1', 330650948),
(2, 'ANTANANARIVO ANALAKELY', 101010, 'REX1', 33065),
(3, 'ANTANANARIVO TSARALALANA', 101020, 'REX2', 33065),
(4, 'ANTANANARIVO ANTANIMENA', 101040, 'REX2', 33065),
(5, 'ANTANANARIVO AMBANIDIA', 101200, 'REX2', 33065),
(6, 'ANTANANARIVO FIADANANA', 101500, 'REX2', 33065),
(7, 'VITRINE POSTALE', 101900, 'REX2', 33065),
(8, 'ANTSIRANANA RP', 201000, 'REX2', 33065),
(9, 'NOSY BE', 207000, 'REX2', 33065),
(10, 'FIANARANTSOA RP', 301000, 'REX2', 33065),
(11, 'MAHAJANGA RP', 401000, 'REX2', 33065),
(12, 'TOAMASINA R.P', 501000, 'REX2', 33065),
(13, 'TOLIARA RP', 601000, 'REX2', 33065),
(14, 'TAOLAGNARO', 614000, 'REX2', 33065),
(15, 'ANTANANARIVO ANDRAVOAHANGY', 101400, 'RHC', 33065),
(16, 'ANTSIRABE RP', 110000, 'RHC', 33065),
(17, 'AMBANJA', 203000, 'RHC', 33065),
(18, 'ANTALAHA', 206000, 'RHC', 33065),
(19, 'SAMBAVA', 208000, 'RHC', 33065),
(20, 'FIANARANTSOA TSIANOLONDROA', 301100, 'RHC', 33065),
(21, 'AMBOSITRA', 306000, 'RHC', 33065),
(22, 'ANTSOHIHY', 407000, 'RHC', 33065),
(23, 'AMBATONDRAZAKA', 503000, 'RHC', 33065),
(24, 'MORONDAVA', 619000, 'RHC', 33065),
(25, 'IVATO AEROPORT', 105000, 'R1', 33065),
(26, 'AMBILOBE', 204000, 'R1', 33065),
(27, 'FARAFANGANA', 309000, 'R1', 33065),
(28, 'MANAKARA SUD', 316000, 'R1', 33065),
(29, 'MAEVATANANA', 412000, 'R1', 33065),
(30, 'MAINTIRANO', 413000, 'R1', 33065),
(31, 'MANDRITSARA', 415000, 'R1', 33065),
(32, 'TOAMASINA MARITIME', 501100, 'R1', 33065),
(33, 'TOAMASINA AMBOLOMADINIKA', 501200, 'R1', 33065),
(34, 'MAROANTSETRA', 512000, 'R1', 33065),
(35, 'MORAMANGA', 514000, 'R1', 33065),
(36, 'ANTANANARIVO AMBOHIMANARINA', 101300, 'R2', 33065),
(37, 'ANDRANONAHOATRA', 102400, 'R2', 33065),
(38, 'ANDOHARANOFOTSY', 102600, 'R2', 33065),
(39, 'AMBATOLAMPY', 104000, 'R2', 33065),
(40, 'TALATAMATY', 105390, 'R2', 33065),
(41, 'TSIROANOMANDIDY', 119000, 'R2', 33065),
(42, 'ANDAPA', 205000, 'R2', 33065),
(43, 'IHARANA', 209000, 'R2', 33065),
(44, 'AMBALAVAO', 303000, 'R2', 33065),
(45, 'AMBOHIMAHASOA', 305000, 'R2', 33065),
(46, 'IHOSY', 313000, 'R2', 33065),
(47, 'MANANJARY', 317000, 'R2', 33065),
(48, 'MAHAJANGA MAHABIBO', 401100, 'R2', 33065),
(49, 'MAHAJANGA MARITIME', 401200, 'R2', 33065),
(50, 'BEFANDRIANA AVARATRA', 409000, 'R2', 33065),
(51, 'TOAMASINA ANJOMA', 501300, 'R2', 33065),
(52, 'FENOARIVO ATSINANANA', 509000, 'R2', 33065),
(53, 'MAHANORO', 510000, 'R2', 33065),
(54, 'MANANARA NORD', 511000, 'R2', 33065),
(55, 'VOHIMENA', 515000, 'R2', 33065),
(56, 'VATOMANDRY', 517000, 'R2', 33065),
(57, 'ANKAZOBE CENTRE', 108000, 'R3', 33065),
(58, 'MANJAKANDRIANA', 116000, 'R3', 33065),
(59, 'MIARINARIVO', 117000, 'R3', 33065),
(60, 'FANDRIANA', 308000, 'R3', 33065),
(61, 'VANGAINDRANO', 320000, 'R3', 33065),
(62, 'MAMPIKONY', 414000, 'R3', 33065),
(63, 'MAROVOAY', 416000, 'R3', 33065),
(64, 'BORIZINY', 419000, 'R3', 33065),
(65, 'AMPARAFARAVOLA', 504000, 'R3', 33065),
(66, 'AMBOVOMBE', 604000, 'R3', 33065),
(67, 'BELO SUR TSIRIBIHINA', 608000, 'R3', 33065),
(68, 'BETROKA', 613000, 'R3', 33065),
(69, 'MOROMBE', 618000, 'R3', 33065),
(70, 'SAKARAHA', 620000, 'R3', 33065),
(71, 'ANTANANARIVO ANDFIAVARATRA', 101030, 'R4', 33065),
(72, 'FENOARIVO ATSIMONDRANO', 102500, 'R4', 33065),
(73, 'MAHITSY', 105200, 'R4', 33065),
(74, 'ANTANIFOTSY', 109000, 'R4', 33065),
(75, 'ARIVONIMAMO', 112000, 'R4', 33065),
(76, 'BETAFO', 113000, 'R4', 33065),
(77, 'ANALAVORY', 117100, 'R4', 33065),
(78, 'SOAVINANDRIANA', 118000, 'R4', 33065),
(79, 'DZAMANDZAR', 207100, 'R4', 33065),
(80, 'IFANADIANA', 312000, 'R4', 33065),
(81, 'VOHIPENO', 321000, 'R4', 33065),
(82, 'AMBATO BOENY', 403000, 'R4', 33065),
(83, 'ANALALAVA', 405000, 'R4', 33065),
(84, 'ANTSALOVA', 406000, 'R4', 33065),
(85, 'BEALANANA', 408000, 'R4', 33065),
(86, 'BESALAMPY', 410000, 'R4', 33065),
(87, 'ANDILAMENA', 505000, 'R4', 33065),
(88, 'BRICKAVILLE', 508000, 'R4', 33065),
(89, 'VAVATENINA', 518000, 'R4', 33065),
(90, 'TOLIARA SANFILY', 601100, 'R4', 33065),
(91, 'AMPANIHY', 605000, 'R4', 33065),
(92, 'ANKAZOABO', 606000, 'R4', 33065),
(93, 'BETIOKY', 612000, 'R4', 33065),
(94, 'MAHABO', 615000, 'R4', 33065),
(95, 'MANJA', 616000, 'R4', 33065),
(96, 'MIANDRIVAZO', 617000, 'R4', 33065),
(97, 'AMBOHIDRATRIMO', 105100, 'R5', 33065),
(98, 'ANJOZOROBE', 107000, 'R5', 33065),
(99, 'AMBATOMANOINA', 107200, 'R5', 33065),
(100, 'ANTSIRABE ASABOTSY', 110100, 'R5', 33065),
(101, 'AMBOHIBARY SAMBAINA', 111000, 'R5', 33065),
(102, 'IMERINTSIATOSIKA', 112100, 'R5', 33065),
(103, 'FARATSIHO', 114000, 'R5', 33065),
(104, 'AMPEFY', 118100, 'R5', 33065),
(105, 'AMBODIANGEZOKA', 205100, 'R5', 33065),
(106, 'TSARATANANA', 421000, 'R5', 33065),
(107, 'AMBATOSORATRA', 503100, 'R5', 33065),
(108, 'STATION ALAOTRA', 503200, 'R5', 33065),
(109, 'ANOSIBE AN\' ALA', 506000, 'R5', 33065),
(110, 'ANIVORANO EST', 508100, 'R5', 33065),
(111, 'ANKARATRA SIRAMA', 204190, 'R5', 33065),
(112, 'SOANIERANA IVONGO', 516000, 'R5', 33065),
(113, 'BEKILY', 607000, 'R5', 33065),
(114, 'BEROROHA', 611000, 'R5', 33065),
(115, 'BEZAHA', 612100, 'R5', 33065),
(116, 'ISOANALA', 613100, 'R5', 33065),
(117, 'TSIHOMBE', 621000, 'R5', 33065),
(118, 'TALATA VOLONONDRY', 103000, 'R6', 33065),
(119, 'BEHENJY', 104100, 'R6', 33065),
(120, 'AMBOHIMIADANA', 106000, 'R6', 33065),
(121, 'ANDRAMASINA', 106100, 'R6', 33065),
(122, 'FIHAONANA', 108100, 'R6', 33065),
(123, 'MANDOTO', 113100, 'R6', 33065),
(124, 'FENOARIVOBE', 115000, 'R6', 33065),
(125, 'MANTASOA', 116100, 'R6', 33065),
(126, 'JOFFREVILLE', 202000, 'R6', 33065),
(127, 'ANIVORANO NORD', 202100, 'R6', 33065),
(128, 'AMPANEFENA', 209100, 'R6', 33065),
(129, 'MAHASOABE', 302000, 'R6', 33065),
(130, 'ALAKAMISY ITENINA', 302200, 'R6', 33065),
(131, 'AMBATOFINANDRAHANA', 304000, 'R6', 33065),
(132, 'ALAROBIA VOHIPOSA', 305100, 'R6', 33065),
(133, 'MAHAZOARIVO', 308100, 'R6', 33065),
(134, 'SAHAMADIO FISAKANA', 308200, 'R6', 33065),
(135, 'SANDRANDAHY', 308300, 'R6', 33065),
(136, 'IKONGO', 310000, 'R6', 33065),
(137, 'IAKORA', 311000, 'R6', 33065),
(138, 'RANOMAFANA CENTRE', 312200, 'R6', 33065),
(139, 'RANOHIRA', 313100, 'R6', 33065),
(140, 'IKALAMAVONY', 314000, 'R6', 33065),
(141, 'TANAMBAO MANANJARY', 317100, 'R6', 33065),
(142, 'NOSY VARIKA', 319000, 'R6', 33065),
(143, 'AMBOVOMBE CENTRE', 323000, 'R6', 33065),
(144, 'TSARAMANDROSO', 403100, 'R6', 33065),
(145, 'AMBATOMAINTY	', 404000, 'R6', 33065),
(146, 'ANDRANOFASIKA', 405100, 'R6', 33065),
(147, 'MADIROVALO', 408100, 'R6', 33065),
(148, 'ANDRIBA', 412100, 'R6', 33065),
(149, 'TAMBOHORANO', 413100, 'R6', 33065),
(150, 'MITSINJO', 417100, 'R6', 33065),
(151, 'MORAFENOBE', 418000, 'R6', 33065),
(152, 'SOALALA', 420000, 'R6', 33065),
(153, 'MAHAVELONA', 502000, 'R6', 33065),
(154, 'AMBOHIJANAHARY', 503300, 'R6', 33065),
(155, 'ANDILANATOBY', 503400, 'R6', 33065),
(156, 'IMERIMANDROSO', 503500, 'R6', 33065),
(157, 'MANAKAMBAHINY', 503700, 'R6', 33065),
(158, 'MORARANO', 504100, 'R6', 33065),
(159, 'TANAMBE', 504200, 'R6', 33065),
(160, 'MAROLAMBO', 513000, 'R6', 33065),
(161, 'ANDAINGO', 514100, 'R6', 33065),
(162, 'ANJIRO', 514200, 'R6', 33065),
(163, 'PERINET', 514300, 'R6', 33065),
(164, 'AMBOASARY', 603000, 'R6', 33065),
(165, 'ANTANIMORA', 604100, 'R6', 33065),
(166, 'EJEDA', 605100, 'R6', 33065),
(167, 'BERAKETA', 607300, 'R6', 33065),
(168, 'BELOHA', 609000, 'R6', 33065),
(169, 'ANKILIZATO', 615100, 'R6', 33065),
(170, 'AMBATOLAHY', 617100, 'R6', 33065),
(171, 'MALAIMBANDY', 619100, 'R6', 33065),
(172, 'ANTANETIBE', 107100, 'RD1', 33065),
(173, 'ANKAZOMIRIOTRA', 113200, 'RD1', 33065),
(174, 'AMBATOMANGA', 116200, 'RD1', 33065),
(175, 'ANKARAMENA', 303100, 'RD1', 33065),
(176, 'AMBOROMPOTSY', 304100, 'RD1', 33065),
(177, 'ILAKA CENTRE', 306200, 'RD1', 33065),
(178, 'BEFOTAKA SUD', 307000, 'RD1', 33065),
(179, 'FIADANANA CENTRE', 308500, 'RD1', 33065),
(180, 'MANAMPATRANA', 310100, 'RD1', 33065),
(181, 'AMBOHIMANGA ATSIMO', 312100, 'RD1', 33065),
(182, 'IVOHIBE', 315000, 'RD1', 33065),
(183, 'AMPASIMANJEVA', 316100, 'RD1', 33065),
(184, 'SAHASINAKA', 316200, 'RD1', 33065),
(185, 'ANTSENAVOLO', 317200, 'RD1', 33065),
(186, 'KIANJAVATO', 317300, 'RD1', 33065),
(187, 'VOHILAVA', 317400, 'RD1', 33065),
(188, 'MIDONGY', 318000, 'RD1', 33065),
(189, 'RANOMENA', 320100, 'RD1', 33065),
(190, 'VONDROZO', 322000, 'RD1', 33065),
(191, 'NAMAKIA', 403200, 'RD1', 33065),
(192, 'MAROMANDIA', 405200, 'RD1', 33065),
(193, 'ANAHIDRANO', 407100, 'RD1', 33065),
(194, 'ANTSAKABARY', 409100, 'RD1', 33065),
(195, 'KANDREHO', 411000, 'RD1', 33065),
(196, 'MAHATSINJO', 412200, 'RD1', 33065),
(197, 'MAHAZOMA', 412300, 'RD1', 33065),
(198, 'ANDRIAMENA', 421100, 'RD1', 33065),
(199, 'BRIEVILLE', 421230, 'RD1', 33065),
(200, 'AMBOAVORY', 503600, 'RD1', 33065),
(201, 'ANTANAMBAO MANAMPOTSY', 507000, 'RD1', 33065),
(202, 'RANOMAFANA EST', 508400, 'RD1', 33065),
(203, 'MASOMELOKA', 510200, 'RD1', 33065),
(204, 'AMBOASARY MLA', 514400, 'RD1', 33065),
(205, 'ILAKA EST', 517100, 'RD1', 33065),
(206, 'MANOMBO SUD', 602000, 'RD1', 33065),
(207, 'TSIVORY', 603100, 'RD1', 33065),
(208, 'BEKITRO', 607100, 'RD1', 33065),
(209, 'BENENITRA', 610000, 'RD1', 33065),
(210, 'MANAMBARO', 614100, 'RD1', 33065),
(211, 'BEFANDRIANA SUD', 618100, 'RD1', 33065),
(212, 'TANANDAVA', 618200, 'RD1', 33065),
(213, 'TRANSPOST', 101700, 'RHC', 33065),
(214, 'ALASORA', 103170, 'R6', 33065),
(215, 'ANTSIRABE NORD', 208120, 'R6', 33065),
(216, 'BABETVILLE', 119100, 'R5', 33065),
(217, 'SABOTSY NAMEHANA', 103170, 'R3', 33065),
(218, 'AMBOHIMANDROSO', 0, '', 33065),
(219, 'AMBONDROMAMY', 0, '', 33065),
(220, 'AMBOHIMANGAKELY', 0, '', 33065),
(221, 'Confection Philatelie', 9990099, 'xxx-xxx-xxx-xxx', 0),
(222, 'Bevato', 0, 'REX2', 33065),
(223, 'Diego RP', 0, '', 33065),
(224, 'AMBONDROMISOTRA', 306000, 'RD', 0),
(225, 'ANTSANGASANGA', 503000, '', 0),
(226, 'ANTSAPANANA', 508000, '', 0),
(227, 'REQUISITION DG', 101000, '', 0),
(228, 'VOHILENGO', 509000, 'SMART VILLAGE', 0),
(229, 'VASAKOSSY', 101000, '', 0),
(230, 'CAVP', 119000, 'CAVP', 33067);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `nom_de_categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordre` int(11) NOT NULL,
  `valeur_faciale` int(11) DEFAULT NULL,
  `prix_de_vente` double DEFAULT NULL,
  `annee_emission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cote_emission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_par_pl` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `produit_id`, `nom_de_categorie`, `ordre`, `valeur_faciale`, `prix_de_vente`, `annee_emission`, `cote_emission`, `tp_par_pl`) VALUES
(50, 11, 'Bateau', 1, 300, 300, NULL, NULL, 10),
(51, 11, 'TP12334', 2, 200, 200, NULL, NULL, 12),
(53, 11, 'Pape Francois', 4, 200, 200, NULL, NULL, 12),
(54, 2, 'Exposition n1', 5, 3000, 3000, NULL, NULL, 1),
(55, 2, 'Titanic', 6, 1000, 1000, NULL, NULL, 1),
(58, 11, 'Ankarafatsika', 12, 300, 300, NULL, NULL, 15),
(59, 19, 'Coupon-Reponse', 7, 200, 200, NULL, NULL, 10),
(60, 19, 'Aerogramme', 12, 200, 200, NULL, NULL, 12),
(61, 18, 'Pochette et Complexe', 15, 200, 200, NULL, NULL, 1),
(62, 18, 'Ensemble Timbres', 23, 150, 150, NULL, NULL, 1),
(63, 20, 'Exposition n89', 1, 200, 200, '2006', NULL, 1),
(64, 20, 'Black Contact', 2, 300, 300, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `types` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `descriptions`
--

CREATE TABLE `descriptions` (
  `id` int(11) NOT NULL,
  `information` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `types_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `descriptions`
--

INSERT INTO `descriptions` (`id`, `information`, `types_id`) VALUES
(1, 'Ajouter des nouveaux Catégories', 1),
(2, 'Réintegration', 1),
(3, 'Initialisation des produits', 1),
(4, 'Sorties des categories', 2);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `name`) VALUES
(1, 'Imprimmerie National'),
(2, 'Fournisseur de timbres');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mouvement`
--

CREATE TABLE `mouvement` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `agence_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `types_id` int(11) NOT NULL,
  `descriptions_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `date_entrer` date NOT NULL,
  `number_out` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_planche` int(11) DEFAULT NULL,
  `number_sortie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mouvement`
--

INSERT INTO `mouvement` (`id`, `produit_id`, `reference_id`, `agence_id`, `user_id`, `categorie_id`, `types_id`, `descriptions_id`, `quantite`, `date_entrer`, `number_out`, `number_planche`, `number_sortie`) VALUES
(665, 2, 1, 227, 1, 55, 1, 3, 200, '2022-09-08', '1', NULL, NULL),
(666, 2, 1, 227, 1, 55, 1, 3, 200, '2022-09-08', '1', NULL, NULL),
(667, 2, 1, 227, 1, 55, 1, 1, 600, '2022-09-08', '1', NULL, NULL),
(668, 19, 1, 227, 1, 60, 1, 1, 120, '2022-10-13', '12', 10, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `order_sortie`
--

CREATE TABLE `order_sortie` (
  `id` int(11) NOT NULL,
  `numero_de_sortie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_ordre` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_sortie`
--

INSERT INTO `order_sortie` (`id`, `numero_de_sortie`, `date_ordre`) VALUES
(1, '22/32', '0000-00-00'),
(2, '22/33', '0000-00-00'),
(3, '22/34', '0000-00-00'),
(4, '22/35', '0000-00-00'),
(5, '22/36', '2022-06-20'),
(6, '22/37', '2022-06-20'),
(7, '22/38', '2022-06-20'),
(8, '22/39', '2022-06-20');

-- --------------------------------------------------------

--
-- Structure de la table `order_types`
--

CREATE TABLE `order_types` (
  `id` int(11) NOT NULL,
  `type_order_short` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_order_long` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_types`
--

INSERT INTO `order_types` (`id`, `type_order_short`, `type_order_long`, `other_type`) VALUES
(1, 'PN', 'Produits Nouveaux', 'philatélie'),
(2, 'FP', 'Figurine Postale', 'globale');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `types_id` int(11) NOT NULL,
  `nom_produit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `types_id`, `nom_produit`, `abbreviation`) VALUES
(2, 1, 'Bloc de Luxe', 'B-L'),
(11, 2, 'Timbres Poste Simple', 'TPS'),
(18, 1, 'Pochette', 'PC'),
(19, 2, 'Aerogramme et Coupon-Reponses', 'ACR'),
(20, 1, 'Epreuve de Luxe', 'EL');

-- --------------------------------------------------------

--
-- Structure de la table `situation`
--

CREATE TABLE `situation` (
  `id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  `nombre_planche` int(11) NOT NULL,
  `valeur_faciale` double NOT NULL,
  `prix_de_vente` double NOT NULL,
  `themes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annee_emission` date DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `nature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cote_emission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'entrée'),
(2, 'sortie');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `adresse`) VALUES
(1, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$5UZDE4ez4ec6X.UNLnVxeu3h5KULnguhU.Qx0SogRsVpWLyuYUL9m', 'admin', 'admin', 'Alarobia'),
(2, 'ddp@paositramalagasy.mg', '[\"ROLE_ADMIN\"]', '$2y$13$qaIGeo6FszamGLwQhCNRAeVzZ/N9VcNZM6X0fKad/uD/.CrRxDwyS', 'DSIIN', 'DDP', 'IVANDRY'),
(3, 'dem@paositramalagasy.mg', '[\"ROLE_ADMIN\"]', '$2y$13$pjowT9t9G7H/DqUDOgKZ3eRolaQu6HLkqV2R0hL3E7dVZ0wwlZ3FG', 'DSIIN', 'DEM', 'IVANDRY'),
(4, 'nandry556@gmail.com', '[]', '$2y$13$ZnJk6M56A4GB89iJCfvpuO/h4QmJpwIM4vxNFCkPpAVPufbum.0aC', 'Nandry', 'Randria', 'Ilafy'),
(5, 'dsiin@gmail.com', '[]', '$2y$13$D6/Ezx4JsbvJhE7Gf.neZ.tzZ2jKlb3luyF/AY0Z7zj6DXSmMrUfK', 'dsiin', 'dsiin', 'Ivandry');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agence`
--
ALTER TABLE `agence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_497DD634F347EFB` (`produit_id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `descriptions`
--
ALTER TABLE `descriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C96EAEB68EB23357` (`types_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `mouvement`
--
ALTER TABLE `mouvement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5B51FC3EF347EFB` (`produit_id`),
  ADD KEY `IDX_5B51FC3E1645DEA9` (`reference_id`),
  ADD KEY `IDX_5B51FC3ED725330D` (`agence_id`),
  ADD KEY `IDX_5B51FC3EA76ED395` (`user_id`),
  ADD KEY `IDX_5B51FC3EBCF5E72D` (`categorie_id`),
  ADD KEY `IDX_5B51FC3E8EB23357` (`types_id`),
  ADD KEY `IDX_5B51FC3E3D1C9A63` (`descriptions_id`);

--
-- Index pour la table `order_sortie`
--
ALTER TABLE `order_sortie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_types`
--
ALTER TABLE `order_types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BE2DDF8C8EB23357` (`types_id`);

--
-- Index pour la table `situation`
--
ALTER TABLE `situation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EC2D9ACAF347EFB` (`produit_id`),
  ADD KEY `IDX_EC2D9ACABCF5E72D` (`categorie_id`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agence`
--
ALTER TABLE `agence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `descriptions`
--
ALTER TABLE `descriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mouvement`
--
ALTER TABLE `mouvement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=669;

--
-- AUTO_INCREMENT pour la table `order_sortie`
--
ALTER TABLE `order_sortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `order_types`
--
ALTER TABLE `order_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `situation`
--
ALTER TABLE `situation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `FK_497DD634F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `descriptions`
--
ALTER TABLE `descriptions`
  ADD CONSTRAINT `FK_C96EAEB68EB23357` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`);

--
-- Contraintes pour la table `mouvement`
--
ALTER TABLE `mouvement`
  ADD CONSTRAINT `FK_5B51FC3E1645DEA9` FOREIGN KEY (`reference_id`) REFERENCES `fournisseur` (`id`),
  ADD CONSTRAINT `FK_5B51FC3E3D1C9A63` FOREIGN KEY (`descriptions_id`) REFERENCES `descriptions` (`id`),
  ADD CONSTRAINT `FK_5B51FC3E8EB23357` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`),
  ADD CONSTRAINT `FK_5B51FC3EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_5B51FC3EBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `FK_5B51FC3ED725330D` FOREIGN KEY (`agence_id`) REFERENCES `agence` (`id`),
  ADD CONSTRAINT `FK_5B51FC3EF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `FK_BE2DDF8C8EB23357` FOREIGN KEY (`types_id`) REFERENCES `order_types` (`id`);

--
-- Contraintes pour la table `situation`
--
ALTER TABLE `situation`
  ADD CONSTRAINT `FK_EC2D9ACABCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `FK_EC2D9ACAF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
