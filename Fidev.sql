-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 13 nov. 2022 à 15:13
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
-- Base de données : `Fidev`
--

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

CREATE TABLE `agence` (
  `id` int(11) NOT NULL,
  `nom_agence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress_agence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commune` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agence`
--

INSERT INTO `agence` (`id`, `nom_agence`, `adress_agence`, `commune`) VALUES
(1, 'ITAOSY', 'Lot 3 M Itaosy', 'Itaosy');

-- --------------------------------------------------------

--
-- Structure de la table `approbationcredit`
--

CREATE TABLE `approbationcredit` (
  `id` int(11) NOT NULL,
  `dateap` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montantapprouver` double NOT NULL,
  `personneap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_credit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `approuver_client`
--

CREATE TABLE `approuver_client` (
  `id` int(11) NOT NULL,
  `codeclient_id` int(11) DEFAULT NULL,
  `dateapprobation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client_mobile`
--

CREATE TABLE `client_mobile` (
  `id` int(11) NOT NULL,
  `code_client` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_client` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produit_epargne` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `numero_mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_pin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

CREATE TABLE `commune` (
  `id` int(11) NOT NULL,
  `nom_commune` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_commune` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commune`
--

INSERT INTO `commune` (`id`, `nom_commune`, `code_commune`) VALUES
(1, 'Bongatsara', '1117390'),
(2, 'ANTANANARIVO', '10101'),
(3, 'Antananarivo I', '1101001'),
(4, 'Antananarivo II', '1101002'),
(5, 'Antananarivo III', '1101003'),
(6, 'Antananarivo IV', '1101004'),
(7, 'Antananarivo V', '1101005'),
(8, 'Antananarivo VI', '1101006'),
(9, 'Alasora', '1102010'),
(10, 'Ankadikely Ilafy', '1102039'),
(11, 'Ambohimanambola', '1102050'),
(12, 'Sabotsy Namehana', '1102079'),
(13, 'Ambohimangakely', '1102099'),
(14, 'Manandriana', '1102210'),
(15, 'Ambohimalaza Miray', '1102230'),
(16, 'Fieferana', '1102279'),
(17, 'Ambohimanga Rova', '1102319'),
(18, 'Viliahazo', '1102350'),
(19, 'Talata Volonondry', '1102379'),
(20, 'Anjeva Gara', '1102390'),
(21, 'Masindray', '1102410'),
(22, 'Ankadinandriana', '1102430'),
(23, 'Ambohidratrimo', '1103010'),
(24, 'Anosiala', '1103030'),
(25, 'Talatamaty', '1103050'),
(26, 'Antehiroka', '1103070'),
(27, 'Iarinarivo', '1103090'),
(28, 'Ivato Firaisana', '1103111'),
(29, 'Ivato Aeroport', '1103112'),
(30, 'Ambohitrimanjaka', '1103130'),
(31, 'Mahitsy', '1103150'),
(32, 'Merimandroso', '1103171'),
(33, 'Ambatolampy', '1103172'),
(34, 'Ampangabe', '1103190'),
(35, 'Ampanotokana', '1103210'),
(36, 'Mananjara', '1103230'),
(37, 'Manjakavaradrano', '1103251'),
(38, 'Antsahafilo', '1103252'),
(39, 'Ambohimanjaka', '1103270'),
(40, 'Fiadanana', '1103290'),
(41, 'Mahabo', '1103310'),
(42, 'Mahereza', '1103330'),
(43, 'Antanetibe', '1103350'),
(44, 'Ambohipihaonana', '1103370'),
(45, 'Ambato', '1103390'),
(46, 'Anjanadoria', '1103410'),
(47, 'Avaratsena', '1103430'),
(48, 'Ankazobe', '1104010'),
(49, 'Talata Angavo', '1104030'),
(50, 'Ambohitromby', '1104050'),
(51, 'Antotohazo', '1104070'),
(52, 'Fihaonana', '1104090'),
(53, 'Mahavelona', '1104110'),
(54, 'Fiadanana', '1104130'),
(55, 'Tsaramasoandro', '1104150'),
(56, 'Ambolotarakely', '1104170'),
(57, 'Antakavana', '1104190'),
(58, 'Kiangara', '1104210'),
(59, 'Miantso', '1104230'),
(60, 'Marondry', '1104250'),
(61, 'Andranomiady', '1104270'),
(62, 'Manjakandriana', '1106011'),
(63, 'Ambatolaona', '1106012'),
(64, 'Sambaina', '1106030'),
(65, 'Ambohibary', '1106050'),
(66, 'Ambatomanga', '1106070'),
(67, 'Alarobia', '1106090'),
(68, 'Mantasoa', '1106110'),
(69, 'Ranovao', '1106130'),
(70, 'Miadanandriana', '1106150'),
(71, 'Nandihizana', '1106170'),
(72, 'Anjepy', '1106190'),
(73, 'Ambanitsena', '1106210'),
(74, 'Ambohitrandriamanitra', '1106230'),
(75, 'Ambatomena', '1106250'),
(76, 'Ambohitseheno', '1106271'),
(77, 'Antsahalalina', '1106272'),
(78, 'Ambohitrony', '1106290'),
(79, 'Merikanjaka', '1106310'),
(80, 'Betoho', '1106330'),
(81, 'Ankazondandy', '1106351'),
(82, 'Soavinandriana', '1106352'),
(83, 'Ambohitrolomahitsy', '1106370'),
(84, 'Sadabe', '1106390'),
(85, 'Ampaneva', '1106410'),
(86, 'Ambohibao Sud', '1106430'),
(87, 'Ambohibao Nord', '1106450'),
(88, 'Avaratsena', '1106470'),
(89, 'Anjozorobe', '1107019'),
(90, 'Mangamila', '1107070'),
(91, 'Ambongamarina', '1107099'),
(92, 'Tsarasaotra Andona', '1107110'),
(93, 'Ambohimanarina Marovazaha', '1107130'),
(94, 'Betatao', '1107150'),
(95, 'Alakamisy', '1107170'),
(96, 'Analaroa', '1107190'),
(97, 'Antanetibe', '1107211'),
(98, 'Belanitra', '1107212'),
(99, 'Ambatomanoina', '1107230'),
(100, 'Amparatanjona', '1107250'),
(101, 'Amboasary', '1107270'),
(102, 'Androvakely', '1107290'),
(103, 'Ambohibary', '1107310'),
(104, 'Ambohimirary', '1107330'),
(105, 'Marotsipoy', '1107350'),
(106, 'Beronono', '1107370'),
(107, 'Andramasina', '1115010'),
(108, 'Sabotsy Ambohitromby', '1115031'),
(109, 'Andohariana', '1115032'),
(110, 'Mandrosoa', '1115050'),
(111, 'Alatsinainy Bakaro', '1115070'),
(112, 'Ambohimiadana', '1115091'),
(113, 'Tankafatra', '1115092'),
(114, 'Alarobia Vatosola', '1115110'),
(115, 'Fitsinjovana Bakaro', '1115130'),
(116, 'Sabotsy Manjakavahoaka', '1115150'),
(117, 'Anosibe Trimoloharano', '1115170'),
(118, 'Antotohazo', '1115190'),
(119, 'Ampitatafika', '1117011'),
(120, 'Anosizato Andrefana', '1117012'),
(121, 'Andranonahoatra', '1117030'),
(122, 'Ambohidrapeto', '1117050'),
(123, 'Bemasoandro', '1117070'),
(124, 'Fiombonana', '1117090'),
(125, 'Itaosy', '1117110'),
(126, 'Ambavahaditokana', '1117130'),
(127, 'Tanjombato Andafiatsimo', '1117150'),
(128, 'Andoharanofotsy', '1117170'),
(129, 'Ankaraobato', '1117190'),
(130, 'Soalandy', '1117210'),
(131, 'Antanetikely', '1117230'),
(132, 'Alatsinain\' Ambazaha', '1117250'),
(133, 'Ampanefy', '1117270'),
(134, 'Ankadimanga', '1117290'),
(135, 'Fenoarivo', '1117311'),
(136, 'Alakamisy Fenoarivo', '1117312'),
(137, 'Soavina', '1117330'),
(138, 'Ambohijanaka', '1117350'),
(139, 'Ampahitrosy', '1117370'),
(140, 'Androhibe', '1117410'),
(141, 'Tsiafahy', '1117430'),
(142, 'Ambalavao', '1117450'),
(143, 'Ambatofahavalo', '1117470'),
(144, 'Antsenakely Andraikiba', '1208001'),
(145, 'Ampatana Mandriakeniheny', '1208002'),
(146, 'Soamalaza Mahatsinjo', '1208003'),
(147, 'Antsirabe Afovoany A.', '1208004'),
(148, 'Manodidina Ny Gara A.', '1208005'),
(149, 'Mahazoarivo Avarabohitra', '1208006'),
(150, 'Betafo', '1209010'),
(151, 'Andranomafana', '1209030'),
(152, 'Mandritsara Ambohijato', '1209050'),
(153, 'Alakamisy Anativato', '1209070'),
(154, 'Antsoso', '1209090'),
(155, 'Tritriva', '1209110'),
(156, 'Soavina', '1209130'),
(157, 'Manohisoa', '1209150'),
(158, 'Ambatonikolahy', '1209170'),
(159, 'Antohobe', '1209190'),
(160, 'Mahaiza', '1209210'),
(161, 'Alakamisy Marososona', '1209230'),
(162, 'Ambohimanambola', '1209250'),
(163, 'Ambohimasina', '1209270'),
(164, 'Inanantonana', '1209290'),
(165, 'Ankazomiriotra', '1209310'),
(166, 'Vinany', '1209330'),
(167, 'Fidirana', '1209350'),
(168, 'Mandoto', '1209370'),
(169, 'Alarobia Bemaha', '1209390'),
(170, 'Vasiana', '1209410'),
(171, 'Antanambao Ambary', '1209430'),
(172, 'Anjoma Ramartina', '1209450'),
(173, 'Betsohana', '1209470'),
(174, 'Andrembesoa', '1209490'),
(175, 'Anosiarivo Manapa', '1209510'),
(176, 'Ambatolampy', '1210010'),
(177, 'Morarano', '1210030'),
(178, 'Ambohipihaonana', '1210050'),
(179, 'Manjakatompo Firaisana', '1210070'),
(180, 'Ambatondrakalavao', '1210090'),
(181, 'Andriambilany', '1210110'),
(182, 'Belambo Firaisana', '1210130'),
(183, 'Andravola Vohipeno A.', '1210150'),
(184, 'Tsiafajavona Ankaratra', '1210170'),
(185, 'Ambodifarihy Fenomanana', '1210190'),
(186, 'Sabotsy Namatoana', '1210210'),
(187, 'Antanimasaka Tsaramiafara', '1210230'),
(188, 'Behenjy Afovoany', '1210250'),
(189, 'Antsampandrano', '1210270'),
(190, 'Alarobia Antanamalaza', '1210291'),
(191, 'Antakasina', '1210292'),
(192, 'Tsinjoarivo', '1210310'),
(193, 'Andranovelona', '1210330'),
(194, 'Antanifotsy', '1214010'),
(195, 'Ambatolahy', '1214030'),
(196, 'Ampitatafika', '1214050'),
(197, 'Ambatomiady', '1214079'),
(198, 'Andranofito', '1214090'),
(199, 'Ambohimandroso', '1214110'),
(200, 'Ambatotsipihina', '1214150'),
(201, 'Ambohitompoina', '1214179'),
(202, 'Antsahalava', '1214199'),
(203, 'Ambodiriana', '1214230'),
(204, 'Antsampandrano', '1214290'),
(205, 'Belanitra', '1214310'),
(206, 'Faratsiho', '1216010'),
(207, 'Antsampanimahazo', '1216030'),
(208, 'Vinaninony Avaratra', '1216050'),
(209, 'Ramainandro', '1216070'),
(210, 'Andranomiady', '1216090'),
(211, 'Vinaninony Atsimo', '1216110'),
(212, 'Ambohiborona', '1216130'),
(213, 'Miandrarivo', '1216150'),
(214, 'Valabetokana', '1216170'),
(215, 'Ambano', '1218010'),
(216, 'Belazao', '1218030'),
(217, 'Alakamisy', '1218050'),
(218, 'Antanimandry', '1218070'),
(219, 'Vinaninkarena', '1218090'),
(220, 'Andranomanelatra', '1218110'),
(221, 'Ambohidranandriana', '1218130'),
(222, 'Ambohimiarivo', '1218150'),
(223, 'Ambohitsimanova', '1218170'),
(224, 'Mangarano', '1218190'),
(225, 'Manandona', '1218210'),
(226, 'Antsaontany', '1218230'),
(227, 'Alatsinainy Ibity', '1218250'),
(228, 'Sahanivotry Manandona', '1218270'),
(229, 'Soanindrariny', '1218290'),
(230, 'Ambatomena', '1218310'),
(231, 'Ambohibary', '1218331'),
(232, 'Mandrosohasina', '1218332'),
(233, 'Tsarahonenana Sahanivotry', '1218350'),
(234, 'Antanambao', '1218370'),
(235, 'Arivonimamo Urbaine', '1305010'),
(236, 'Arivonimamo Rural', '1305030'),
(237, 'Ambohitrambo', '1305050'),
(238, 'Ampahimanga', '1305070'),
(239, 'Amboanana', '1305090'),
(240, 'Morafeno', '1305110'),
(241, 'Imeritsiatosika', '1305130'),
(242, 'Morarano', '1305150'),
(243, 'Ambatomirahavavy', '1305170'),
(244, 'Ambatomanga Mahatsinjo', '1305190'),
(245, 'Manalalondo', '1305211'),
(246, 'Alakamisy Ambohidehibe', '1305212'),
(247, 'Antenimbe', '1305213'),
(248, 'Mahatsinjo Est', '1305214'),
(249, 'Marofangady', '1305215'),
(250, 'Rambolamasoandro', '1305216'),
(251, 'Ambohimandry', '1305230'),
(252, 'Amboasary Antambolo', '1305250'),
(253, 'Ambohimasina', '1305270'),
(254, 'Ambohipandrano', '1305290'),
(255, 'Miantsoarivo', '1305310'),
(256, 'Miandrandra', '1305330'),
(257, 'Miarinarivo Urbaine', '1312010'),
(258, 'Miarinarivo Suburbaine', '1312030'),
(259, 'Ambatomanjaka', '1312050'),
(260, 'Manazary', '1312070'),
(261, 'Soamahamanina', '1312090'),
(262, 'Analavory', '1312110'),
(263, 'Mandiavato', '1312130'),
(264, 'Anosibe Ifanja', '1312151'),
(265, 'Sarobaratra Ifanja', '1312152'),
(266, 'Zoma Bealoka', '1312170'),
(267, 'Soavimbazaha', '1312190'),
(268, 'Andolofotsy', '1312210'),
(269, 'Antoby Est', '1312230'),
(270, 'Alatsinainikely', '1312250'),
(271, 'Soavinandriana', '1313011'),
(272, 'Dondona', '1313012'),
(273, 'Ampary', '1313030'),
(274, 'Mananasy Tsitakondaza', '1313050'),
(275, 'Mandiavato Masindray', '1313070'),
(276, 'Ampefy', '1313090'),
(277, 'Antanetibe', '1313110'),
(278, 'Amparaky Sarodrivotra', '1313131'),
(279, 'Amberomanga', '1313132'),
(280, 'Ankaranana Tiafandrosoana', '1313150'),
(281, 'Mahavelona', '1313170'),
(282, 'Ambohibahoaka Ankisabe', '1313190'),
(283, 'Ambatoasana Afovoany', '1313210'),
(284, 'Tamponala', '1313230'),
(285, 'Amparibohitra', '1313250'),
(286, 'Tsiroanomandidy Renivohitra', '1411010'),
(287, 'Tsiroanomandidy Fihaonana', '1411030'),
(288, 'Ambatolampy', '1411050'),
(289, 'Bevato', '1411070'),
(290, 'Ankadinondry Sakay', '1411090'),
(291, 'Ankerana Avaratra', '1411110'),
(292, 'Miandrarivo', '1411130'),
(293, 'Tsinjoarivo', '1411150'),
(294, 'Soanierana', '1411170'),
(295, 'Androtra Anosy', '1411190'),
(296, 'Bemahatazana', '1411210'),
(297, 'Belobaka', '1411230'),
(298, 'Ambalanirana', '1411250'),
(299, 'Mahasolo', '1411270'),
(300, 'Ambararatabe (Bemahatazana)', '1411290'),
(301, 'Fierenana', '1411310'),
(302, 'Mahasolo Maroharona', '1411330'),
(303, 'Marotampona', '1411350'),
(304, 'Fenoarivo Afovoany', '1419010'),
(305, 'Firavahana', '1419031'),
(306, 'Morarano Marotampona', '1419032'),
(307, 'Kiranomena', '1419051'),
(308, 'Tsinjoarivo', '1419052'),
(309, 'Ambohitromby', '1419071'),
(310, 'Ambatomainty Sud', '1419072'),
(311, 'Mahajeby', '1419090'),
(312, 'Tanana Ambony', '2101001'),
(313, 'Tanana Ambany', '2101002'),
(314, 'Andrainjato Avaratra', '2101003'),
(315, 'Andrainjato Atsimo', '2101004'),
(316, 'Manolafaka', '2101005'),
(317, 'Lalazana', '2101006'),
(318, 'Vatosola', '2101007'),
(319, 'Ambalavao', '2105010'),
(320, 'Manamisoa', '2105030'),
(321, 'Iarintsena', '2105050'),
(322, 'Ambohimandroso', '2105071'),
(323, 'Andrainjato', '2105072'),
(324, 'Anjoma', '2105090'),
(325, 'Kirano Soamifanaraka', '2105110'),
(326, 'Sendrisoa', '2105130'),
(327, 'Besoa', '2105150'),
(328, 'Mahazony', '2105170'),
(329, 'Ambinanindovoka', '2105190'),
(330, 'Ankaramena', '2105211'),
(331, 'Ambinaniroa', '2105212'),
(332, 'Ambohimahamasina', '2105230'),
(333, 'Miarinarivo', '2105250'),
(334, 'Vohitsaoka', '2105270'),
(335, 'Fenoarivo', '2105290'),
(336, 'Ambohimahasoa', '2108010'),
(337, 'Ampitana', '2108030'),
(338, 'Ankerana', '2108050'),
(339, 'Manandroy', '2108071'),
(340, 'Ambalakindresy', '2108072'),
(341, 'Ankafina', '2108090'),
(342, 'Sahave', '2108110'),
(343, 'Morafeno', '2108130'),
(344, 'Kalalao', '2108150'),
(345, 'Vohiposa', '2108170'),
(346, 'Ambatosoa', '2108190'),
(347, 'Isaka', '2108210'),
(348, 'Ambohinamboarina', '2108230'),
(349, 'Tamboharivo Sahatona', '2108251'),
(350, 'Camp Robin', '2108252'),
(351, 'Befeta', '2108270'),
(352, 'Fiadanana', '2108290'),
(353, 'Vohitrarivo', '2108310'),
(354, 'Ikalamavony', '2119010'),
(355, 'Mangidy', '2119030'),
(356, 'Solila', '2119050'),
(357, 'Ambatomainty', '2119070'),
(358, 'Fitampito', '2119090'),
(359, 'Sakay Tanamarina', '2119110'),
(360, 'Tsitondroina', '2119130'),
(361, 'Tanamarina Bekisopa', '2119150'),
(362, 'Andrainjato Centre', '2120011'),
(363, 'Andrainjato Est', '2120012'),
(364, 'Ambalakely', '2120030'),
(365, 'Soaindrana', '2120050'),
(366, 'Ivoamba', '2120071'),
(367, 'Ialanindro', '2120072'),
(368, 'Taindambo', '2120090'),
(369, 'Mahatsinjony', '2120111'),
(370, 'Sahambavy', '2120112'),
(371, 'Talata Ampano', '2120130'),
(372, 'Ankarinarivo Manirisoa', '2120150'),
(373, 'Iavonomby Vohibola', '2120170'),
(374, 'Nasandratrony', '2120190'),
(375, 'Ambalamahasoa', '2120210'),
(376, 'Maneva', '2120230'),
(377, 'Alakamisy Ambohimaha', '2120250'),
(378, 'Andoharanomaitso', '2120270'),
(379, 'Mahasoabe', '2120291'),
(380, 'Andranomiditra', '2120292'),
(381, 'Ihazoara', '2120293'),
(382, 'Andranovorivato', '2120310'),
(383, 'Androy', '2120330'),
(384, 'Alatsinainy Ialamarina', '2120350'),
(385, 'Isorana', '2120370'),
(386, 'Alakamisy Itenina', '2120391'),
(387, 'Ivohibato Ouest', '2120392'),
(388, 'Ambondrona', '2120410'),
(389, 'Fandrandava', '2120430'),
(390, 'Vohimarina', '2120450'),
(391, 'Anjoma Itsara', '2120470'),
(392, 'Soatanana', '2120490'),
(393, 'Vohitrafeno', '2120510'),
(394, 'Fanjakana', '2120530'),
(395, 'Mahaditra', '2120551'),
(396, 'Ankoromalaza Mifanasoa', '2120552'),
(397, 'Vinanitelo', '2120570'),
(398, 'Ambalamidera II', '2120590'),
(399, 'Mahazoarivo', '2120610'),
(400, 'Andriamizaha', '2120630'),
(401, 'Ambatofinandrahana', '2202010'),
(402, 'Itremo', '2202030'),
(403, 'Fenoarivo', '2202050'),
(404, 'Soavina', '2202070'),
(405, 'Ambondromisotra', '2202090'),
(406, 'Ambatomifanongoa', '2202110'),
(407, 'Amborompotsy', '2202130'),
(408, 'Mandrosonoro', '2202150'),
(409, 'Mangataboahangy', '2202170'),
(410, 'Ambositra', '2203010'),
(411, 'Ambositra II', '2203030'),
(412, 'Ankazoambo', '2203050'),
(413, 'Ivony Miaramiasa', '2203070'),
(414, 'Andina Firaisana', '2203090'),
(415, 'Imerina Imady', '2203110'),
(416, 'Ivato', '2203130'),
(417, 'Tsarasaotra', '2203150'),
(418, 'Marosoa', '2203170'),
(419, 'Fahizay Ambatolahimasina', '2203190'),
(420, 'Alakamisy Ambohijato', '2203210'),
(421, 'Kianjandrakefina', '2203230'),
(422, 'Ambalamanakana', '2203250'),
(423, 'Ilaka Afovoany', '2203290'),
(424, 'Ihadilalana Ambohinamboar', '2203310'),
(425, 'Ambatofitorahana', '2203390'),
(426, 'Antoetra', '2203410'),
(427, 'Mahazina Ambohipierenana', '2203430'),
(428, 'Sahatsiho Ambohimanjaka', '2203450'),
(429, 'Ambohimitombo I', '2203490'),
(430, 'Ambinanindrano', '2203550'),
(431, 'Ambohimitombo II', '2203570'),
(432, 'Vohidahy', '2203590'),
(433, 'Fandriana', '2204010'),
(434, 'Milamaina', '2204030'),
(435, 'Sahamadio Fisakana', '2204050'),
(436, 'Fiadanana', '2204070'),
(437, 'Tsarazaza', '2204090'),
(438, 'Tatamalaza', '2204110'),
(439, 'Ankarinoro', '2204130'),
(440, 'Sandrandahy', '2204150'),
(441, 'Mahazoarivo', '2204170'),
(442, 'Miarinavaratra', '2204191'),
(443, 'Betsimisotra', '2204192'),
(444, 'Alakamisy Ambohimahazo', '2204210'),
(445, 'Imito', '2204230'),
(446, 'Ambovombe Afovoany', '2223010'),
(447, 'Ambohimahazo', '2223030'),
(448, 'Anjoma Nandihizana', '2223050'),
(449, 'Ambohimilanja', '2223070'),
(450, 'Ambohipo', '2223090'),
(451, 'Anjoman\'Ankona', '2223110'),
(452, 'Andakatanikely', '2223131'),
(453, 'Vinany', '2223132'),
(454, 'Talata Vohimena', '2223150'),
(455, 'Ambatomarina', '2223170'),
(456, 'Andakatany', '2223190'),
(457, 'Ifanadiana', '2306011'),
(458, 'Antaretra', '2306012'),
(459, 'Tsaratanana', '2306030'),
(460, 'Ranomafana', '2306051'),
(461, 'Kelilalina', '2306052'),
(462, 'Androrangavola', '2306070'),
(463, 'Ambohimiera', '2306090'),
(464, 'Antsindra', '2306110'),
(465, 'Ambohimanga Atsimo', '2306130'),
(466, 'Analampasina', '2306150'),
(467, 'Fasintsara', '2306170'),
(468, 'Maroharatra', '2306190'),
(469, 'Marotoko', '2306210'),
(470, 'Mahatsinjo', '2306230'),
(471, 'Andiolava', '2306250'),
(472, 'Ambia', '2306270'),
(473, 'Nosy Varika', '2307010'),
(474, 'Ambahy', '2307030'),
(475, 'Fiadanana', '2307050'),
(476, 'Sahavato', '2307070'),
(477, 'Vohilava', '2307090'),
(478, 'Vohitrandriana', '2307111'),
(479, 'Vohidroa', '2307112'),
(480, 'Soavina', '2307130'),
(481, 'Ambodilafa', '2307151'),
(482, 'Androrangavola', '2307152'),
(483, 'Ampasinambo', '2307170'),
(484, 'Befody', '2307190'),
(485, 'Ambakobe', '2307210'),
(486, 'Andara', '2307230'),
(487, 'Ambodirian\'Isahafary', '2307250'),
(488, 'Antanambao', '2307270'),
(489, 'Angodogondona', '2307290'),
(490, 'Ambodiara', '2307310'),
(491, 'Mananjary', '2309010'),
(492, 'Tsaravary', '2309030'),
(493, 'Mahatsara Atsimo', '2309050'),
(494, 'Tsiatosika', '2309070'),
(495, 'Mahatsara Iefaka', '2309090'),
(496, 'Marokarima', '2309110'),
(497, 'Morafeno', '2309130'),
(498, 'Antsenavolo', '2309150'),
(499, 'Marosangy', '2309170'),
(500, 'Ambohimiarina II', '2309190'),
(501, 'Andranambolava', '2309210'),
(502, 'Vohilava', '2309230'),
(503, 'Mahela', '2309250'),
(504, 'Mahavoky Avaratra', '2309270'),
(505, 'Andonabe', '2309290'),
(506, 'Ambohinihaonana', '2309310'),
(507, 'Marofototra', '2309330'),
(508, 'Vatohandrina', '2309350'),
(509, 'Ambalahosy Avaratra', '2309370'),
(510, 'Ambodinonoka', '2309390'),
(511, 'Kianjavato', '2309410'),
(512, 'Sandrohy', '2309430'),
(513, 'Anosimparihy', '2309450'),
(514, 'Manakana Avaratra', '2309470'),
(515, 'Namorona', '2309490'),
(516, 'Ankatafana', '2309510'),
(517, 'Ambohitsara Est', '2309530'),
(518, 'Andranomavo', '2309550'),
(519, 'Antaretra', '2309570'),
(520, 'Manakara Tanambe', '2310010'),
(521, 'Tataho', '2310030'),
(522, 'Marofarihy', '2310051'),
(523, 'Anosiala', '2310052'),
(524, 'Ambila', '2310070'),
(525, 'Sorombo', '2310090'),
(526, 'Mizilo Gara', '2310110'),
(527, 'Ambohitsara M', '2310130'),
(528, 'Sahasinaka', '2310150'),
(529, 'Amboanjo Ifaho', '2310170'),
(530, 'Vohimasy', '2310190'),
(531, 'Lokomby', '2310211'),
(532, 'Vatana', '2310212'),
(533, 'Ambahive', '2310230'),
(534, 'Vohimanitra', '2310250'),
(535, 'Mitanty', '2310270'),
(536, 'Bekatra', '2310291'),
(537, 'Vinanitelo', '2310292'),
(538, 'Ampasimanjeva', '2310311'),
(539, 'Nihaonana', '2310312'),
(540, 'Ambotaka', '2310313'),
(541, 'Mavorano', '2310330'),
(542, 'Vohimasina Sud', '2310351'),
(543, 'Vohimasina Nord', '2310352'),
(544, 'Vohilava Ex-Sahasondry', '2310370'),
(545, 'Fenomby', '2310390'),
(546, 'Ambalavero', '2310410'),
(547, 'Amborondra', '2310430'),
(548, 'Mahabako', '2310451'),
(549, 'Ionilahy', '2310452'),
(550, 'Mahamaibe', '2310470'),
(551, 'Ampasimpotsy', '2310490'),
(552, 'Anteza', '2310510'),
(553, 'Saharefo', '2310531'),
(554, 'Ampasimboraka', '2310532'),
(555, 'Ambandrika', '2310550'),
(556, 'Kianjanomby', '2310570'),
(557, 'Mangatsiotra', '2310590'),
(558, 'Sakoana', '2310610'),
(559, 'Ambahatrazo', '2310630'),
(560, 'Sahanambohitra', '2310650'),
(561, 'Anorombato', '2310670'),
(562, 'Ambalaroka', '2310690'),
(563, 'Analavory', '2310710'),
(564, 'Betampona', '2310730'),
(565, 'Ikongo', '2311011'),
(566, 'Ambolomadinika', '2311012'),
(567, 'Ambatofotsy', '2311031'),
(568, 'Belemoka', '2311032'),
(569, 'Maromandia', '2311033'),
(570, 'Manampatrana', '2311050'),
(571, 'Ifanirea', '2311071'),
(572, 'Sahalanonana', '2311072'),
(573, 'Tanakambana', '2311073'),
(574, 'Tolongoina', '2311091'),
(575, 'Ambohimisafy', '2311092'),
(576, 'Ankarimbelo', '2311111'),
(577, 'Kalafotsy', '2311112'),
(578, 'Ambinanitromby', '2311130'),
(579, 'Antodinga', '2311150'),
(580, 'Vohipeno', '2312010'),
(581, 'Vohitrindry', '2312031'),
(582, 'Vohindava', '2312032'),
(583, 'Ivato', '2312051'),
(584, 'Savana', '2312052'),
(585, 'Mahabo', '2312070'),
(586, 'Ankarimbary', '2312090'),
(587, 'Lanivo', '2312110'),
(588, 'Nato', '2312130'),
(589, 'Mahasoabe', '2312150'),
(590, 'Onjatsy', '2312171'),
(591, 'Vohilany', '2312172'),
(592, 'Andemaka', '2312190'),
(593, 'Ifatsy', '2312210'),
(594, 'Ilakatra', '2312230'),
(595, 'Sahalava', '2312250'),
(596, 'Mahazoarivo', '2312270'),
(597, 'Anolaka', '2312290'),
(598, 'Antanambo', '2312310'),
(599, 'Ihosy', '2416010'),
(600, 'Ankily', '2416031'),
(601, 'Ambia', '2416032'),
(602, 'Irina', '2416050'),
(603, 'Sahambano', '2416070'),
(604, 'Analaliry', '2416090'),
(605, 'Mahasoa', '2416110'),
(606, 'Ambatolahy', '2416131'),
(607, 'Soamatasy', '2416132'),
(608, 'Zazafotsy', '2416150'),
(609, 'Sakalalina', '2416170'),
(610, 'Satrokala', '2416191'),
(611, 'Andiolava', '2416192'),
(612, 'Analavoka', '2416210'),
(613, 'Ranohira', '2416231'),
(614, 'Ilakaka', '2416232'),
(615, 'Menamaty Iloto', '2416250'),
(616, 'Tolohomiady', '2416270'),
(617, 'Antsoha', '2416290'),
(618, 'Ivohibe', '2418010'),
(619, 'Antambohobe', '2418030'),
(620, 'Maropaika', '2418050'),
(621, 'Ivongo', '2418070'),
(622, 'Iakora', '2421010'),
(623, 'Ranotsara Avaratra', '2421030'),
(624, 'Begogo', '2421050'),
(625, 'Farafangana', '2513010'),
(626, 'Vohimasy', '2513030'),
(627, 'Anosivelo', '2513050'),
(628, 'Anosy', '2513070'),
(629, 'Vohitromby', '2513090'),
(630, 'Ivandrika', '2513110'),
(631, 'Manambotra Atsimo', '2513130'),
(632, 'Mahavelo', '2513150'),
(633, 'Mahafasa Afovoany', '2513170'),
(634, 'Amporoforo', '2513190'),
(635, 'Iabohazo', '2513210'),
(636, 'Tangainony', '2513230'),
(637, 'Beretra Bevoay', '2513250'),
(638, 'Ambohigogo', '2513270'),
(639, 'Maheriraty', '2513290'),
(640, 'Mahabo Mananivo', '2513310'),
(641, 'Ambohimandroso', '2513330'),
(642, 'Ankarana Miraihina', '2513350'),
(643, 'Evato', '2513370'),
(644, 'Etrotroka', '2513390'),
(645, 'Ambalavato', '2513410'),
(646, 'Efatsy Anandroza', '2513430'),
(647, 'Tovona', '2513450'),
(648, 'Ambalatany', '2513470'),
(649, 'Sahamadio', '2513490'),
(650, 'Fenoarivo', '2513510'),
(651, 'Antseranambe', '2513530'),
(652, 'Ihorombe', '2513550'),
(653, 'Vohilengo', '2513570'),
(654, 'Marovandrika', '2513590'),
(655, 'Namohora Iaborano', '2513610'),
(656, 'Antevato', '2513630'),
(657, 'Vangaindrano', '2514010'),
(658, 'Ampasimalemy', '2514031'),
(659, 'Bekaraoky', '2514032'),
(660, 'Tsianofana', '2514033'),
(661, 'Tsiately', '2514050'),
(662, 'Soamanova', '2514070'),
(663, 'Lopary', '2514090'),
(664, 'Vohitrambo', '2514111'),
(665, 'Anilobe', '2514112'),
(666, 'Lohafary', '2514131'),
(667, 'Ampataka', '2514132'),
(668, 'Matanga', '2514151'),
(669, 'Masianaka', '2514152'),
(670, 'Vohipaho', '2514170'),
(671, 'Ranomena', '2514190'),
(672, 'Ambongo', '2514211'),
(673, 'Ambatolava', '2514212'),
(674, 'Iara', '2514230'),
(675, 'Bevata', '2514251'),
(676, 'Karimbary', '2514252'),
(677, 'Manambondro', '2514270'),
(678, 'Fenoambany', '2514290'),
(679, 'Isahara', '2514310'),
(680, 'Amparihy Atsinanana', '2514331'),
(681, 'Sandravinany', '2514332'),
(682, 'Marokibo', '2514350'),
(683, 'Vatanato', '2514370'),
(684, 'Vohimalaza', '2514390'),
(685, 'Bema', '2514410'),
(686, 'Midongy Atsimo', '2515011'),
(687, 'Ankazovelo', '2515012'),
(688, 'Andranolalina', '2515031'),
(689, 'Maliorano', '2515032'),
(690, 'Ivondro Ex-Lavaraty', '2515051'),
(691, 'Soakibany Ex-Lavaraty', '2515052'),
(692, 'Vondrozo', '2517011'),
(693, 'Manambidala', '2517012'),
(694, 'Anandravy', '2517013'),
(695, 'Mahatsinjo', '2517030'),
(696, 'Mahazoarivo', '2517051'),
(697, 'Iamontana', '2517052'),
(698, 'Vohimary', '2517071'),
(699, 'Antokonala', '2517072'),
(700, 'Ambohimana', '2517090'),
(701, 'Karianga', '2517111'),
(702, 'Manantona', '2517112'),
(703, 'Ivato', '2517130'),
(704, 'Mahavelo', '2517150'),
(705, 'Andakana', '2517170'),
(706, 'Moroteza', '2517191'),
(707, 'Vohiboreka', '2517192'),
(708, 'Befotaka', '2522011'),
(709, 'Antondabe', '2522012'),
(710, 'Marovotsika', '2522031'),
(711, 'Antaninarenina', '2522032'),
(712, 'Ranotsara Atsimo', '2522051'),
(713, 'Bekofafa Sud', '2522052'),
(714, 'Beharena', '2522070'),
(715, 'Ambodimanga Toamasina I', '3101001'),
(716, 'Anjoma', '3101002'),
(717, 'Morarano', '3101003'),
(718, 'Tanambao V', '3101004'),
(719, 'Ankirihiry', '3101005'),
(720, 'Vohibinany', '3106010'),
(721, 'Vohitranivona', '3106030'),
(722, 'Anivorano Atsinanana', '3106050'),
(723, 'Mahatsara', '3106070'),
(724, 'Andevoranto', '3106090'),
(725, 'Ambinaninony', '3106110'),
(726, 'Fetraomby', '3106130'),
(727, 'Vohipeno (Razanaka)', '3106150'),
(728, 'Ranomafana', '3106171'),
(729, 'Ampasimbe', '3106172'),
(730, 'Fanasana', '3106190'),
(731, 'Ambalarondra', '3106210'),
(732, 'Maroseranana', '3106230'),
(733, 'Lohariandava', '3106251'),
(734, 'Andekaleka', '3106252'),
(735, 'Ambohimanana', '3106270'),
(736, 'Anjahamana', '3106290'),
(737, 'Niarovana', '3106310'),
(738, 'Vatomandry', '3107010'),
(739, 'Ambodivoananto', '3107030'),
(740, 'Maintinandry', '3107051'),
(741, 'Vahatrakaka', '3107052'),
(742, 'Sahamatevina', '3107070'),
(743, 'Antanambao Mahatsara', '3107090'),
(744, 'Ambalavolo', '3107110'),
(745, 'Amboditavolo', '3107131'),
(746, 'Nierenana', '3107132'),
(747, 'Ilaka Atsinanana', '3107151'),
(748, 'Niarovana caroline', '3107152'),
(749, 'Tsivangiana', '3107171'),
(750, 'Ampasimazava', '3107172'),
(751, 'Ampasimadinika', '3107190'),
(752, 'Ifasina I', '3107210'),
(753, 'Ambalabe', '3107230'),
(754, 'Ifasina II', '3107250'),
(755, 'Tsarasambo', '3107270'),
(756, 'Iaborano', '3107290'),
(757, 'Mahanoro', '3108011'),
(758, 'Betsizaraina', '3108012'),
(759, 'Tsaravinany', '3108030'),
(760, 'Ambodiharina', '3108050'),
(761, 'Manjakandriana', '3108070'),
(762, 'Masomeloka', '3108090'),
(763, 'Ambinanidilana', '3108110'),
(764, 'Ambodibonara', '3108130'),
(765, 'Ankazotsifantatra', '3108150'),
(766, 'Ambinanindrano', '3108170'),
(767, 'Befotaka', '3108190'),
(768, 'Marolambo', '3109010'),
(769, 'Betampona', '3109030'),
(770, 'Andonabe Atsimo', '3109050'),
(771, 'Ambalapaiso II', '3109070'),
(772, 'Ambohimilanja', '3109090'),
(773, 'Ambatofisaka II', '3109110'),
(774, 'Androrangavola', '3109131'),
(775, 'Anosiarivo', '3109132'),
(776, 'Amboasary', '3109150'),
(777, 'Lohavanana', '3109170'),
(778, 'Ambodinonoka', '3109191'),
(779, 'Sahakevo', '3109192'),
(780, 'Tanambao Rabemanana', '3109210'),
(781, 'Ambodivoahangy', '3109230'),
(782, 'Toamasina II', '3110010'),
(783, 'Antetezambaro', '3110030'),
(784, 'Fanandrana', '3110050'),
(785, 'Ambodiriana', '3110070'),
(786, 'Ampasimadinika Manambolo', '3110091'),
(787, 'Amboditandroho', '3110092'),
(788, 'Mahavelona (Foulpointe)', '3110110'),
(789, 'Sahambala', '3110130'),
(790, 'Ambodilazana', '3110150'),
(791, 'Ampasimbe', '3110170'),
(792, 'Mangabe', '3110191'),
(793, 'Antenina', '3110192'),
(794, 'Andondabe', '3110210'),
(795, 'Andranobolaha', '3110230'),
(796, 'Fito', '3110250'),
(797, 'Amporoforo', '3110270'),
(798, 'Ampisokina', '3110290'),
(799, 'Antanambao Manampotsy', '3111010'),
(800, 'Mahela', '3111030'),
(801, 'Saivaza', '3111050'),
(802, 'Antanandehibe', '3111070'),
(803, 'Manakana', '3111090'),
(804, 'Ambodifotatra', '3202001'),
(805, 'Loukintsy', '3202002'),
(806, 'Maroantsetra C.U', '3203010'),
(807, 'Ankadimbazaha Anjanazana', '3203031'),
(808, 'Manambolo', '3203032'),
(809, 'Andranofotsy', '3203051'),
(810, 'Antakotaka', '3203052'),
(811, 'Ankofa', '3203070'),
(812, 'Ambinanitelo', '3203090'),
(813, 'Anjahana', '3203110'),
(814, 'Voloina', '3203131'),
(815, 'Antsirabe Sahatany', '3203132'),
(816, 'Rantabe', '3203151'),
(817, 'Androndrona', '3203152'),
(818, 'Mahavelona', '3203170'),
(819, 'Ankofabe', '3203190'),
(820, 'Anandrivola', '3203210'),
(821, 'Ambodimanga Rantabe', '3203230'),
(822, 'Morafeno', '3203250'),
(823, 'Ambatosoa', '3203270'),
(824, 'Mananara Avaratra', '3204011'),
(825, 'Ambodivoanio', '3204012'),
(826, 'Antanambaobe', '3204030'),
(827, 'Manambolosy', '3204050'),
(828, 'Ambodiampana', '3204070'),
(829, 'Sandrakatsy', '3204091'),
(830, 'Ambatoharanana', '3204092'),
(831, 'Tanibe', '3204093'),
(832, 'Antanambe', '3204110'),
(833, 'Saromaona', '3204130'),
(834, 'Vanono', '3204150'),
(835, 'Andasibe', '3204170'),
(836, 'Imorona', '3204190'),
(837, 'Antananivo', '3204210'),
(838, 'Fenoarivo Atsinanana C.U', '3205010'),
(839, 'Ambodimanga II', '3205030'),
(840, 'Mahambo', '3205050'),
(841, 'Ampasina Maningory', '3205070'),
(842, 'Tsaratampona (Ambatoharanana)', '3205090'),
(843, 'Vohilengo', '3205110'),
(844, 'Saranambana', '3205130'),
(845, 'Ampasimbe Manantsatrana', '3205150'),
(846, 'Miorimivalana', '3205170'),
(847, 'Vohipeno', '3205190'),
(848, 'Antsiatsiaka', '3205210'),
(849, 'Mahanoro', '3205238'),
(850, 'Vavatenina', '3215010'),
(851, 'Maromitety', '3215030'),
(852, 'Ambohibe', '3215050'),
(853, 'Ampasimazava', '3215070'),
(854, 'Anjahambe', '3215091'),
(855, 'Ambatoharanana', '3215092'),
(856, 'Andasibe', '3215110'),
(857, 'Miarinarivo', '3215130'),
(858, 'Sahatavy', '3215150'),
(859, 'Ambodimangavalo', '3215170'),
(860, 'Soanierana Ivongo', '3218011'),
(861, 'Fotsialanana', '3218012'),
(862, 'Antanifotsy', '3218030'),
(863, 'Ambodiampana I', '3218050'),
(864, 'Andapafito', '3218070'),
(865, 'Ambahoabe', '3218090'),
(866, 'Manompana', '3218110'),
(867, 'Antenina', '3218130'),
(868, 'Amparafaravola', '3312011'),
(869, 'Bedidy', '3312012'),
(870, 'Ambatomainty', '3312030'),
(871, 'Ambohitrarivo', '3312051'),
(872, 'Anororo', '3312052'),
(873, 'Morarano Chrome', '3312071'),
(874, 'Ranomainty', '3312072'),
(875, 'Ambohijanahary', '3312090'),
(876, 'Tanambe', '3312111'),
(877, 'Vohitsara', '3312112'),
(878, 'Beanana', '3312113'),
(879, 'Amboavory', '3312130'),
(880, 'Vohimena', '3312151'),
(881, 'Andrebakely I', '3312152'),
(882, 'Ambohimandroso I', '3312170'),
(883, 'Sahamamy', '3312190'),
(884, 'Ampasikely', '3312210'),
(885, 'Andrebakely II', '3312230'),
(886, 'Andilana Nord', '3312250'),
(887, 'Ambodimanga', '3312270'),
(888, 'Ambatondrazaka C.U', '3313010'),
(889, 'Feramanga Avaratra', '3313031'),
(890, 'Ambandrika', '3313032'),
(891, 'Ambatondrazaka Suburbaine', '3313033'),
(892, 'Ampitatsimo', '3313050'),
(893, 'Ambohitsilaozana', '3313070'),
(894, 'Ilafy', '3313090'),
(895, 'Manakambahiny Andrefana', '3313111'),
(896, 'Antsangasanga', '3313112'),
(897, 'Ambatosoratra', '3313130'),
(898, 'Andilanatoby', '3313151'),
(899, 'Bejofo', '3313152'),
(900, 'Didy', '3313170'),
(901, 'Imerimandroso', '3313191'),
(902, 'Amparihitsokatra', '3313192'),
(903, 'Andromba', '3313193'),
(904, 'Antanandava', '3313194'),
(905, 'Manakambahiny Atsinanana', '3313210'),
(906, 'Soalazaina', '3313231'),
(907, 'Tanambao Besakay', '3313232'),
(908, 'Moramanga', '3314010'),
(909, 'Ambohibary', '3314030'),
(910, 'Ampasimpotsy Gara', '3314050'),
(911, 'Andasibe', '3314070'),
(912, 'Anosibe Ifody', '3314091'),
(913, 'Vodiriana', '3314092'),
(914, 'Morarano Gara', '3314110'),
(915, 'Belavabary', '3314130'),
(916, 'Sabotsy Anjiro', '3314150'),
(917, 'Ambohidronono', '3314170'),
(918, 'Beforona', '3314190'),
(919, 'Ambatovola', '3314210'),
(920, 'Lakato', '3314230'),
(921, 'Amboasary', '3314250'),
(922, 'Fierenana', '3314270'),
(923, 'Mandialaza', '3314291'),
(924, 'Ampasimpotsy Mandialaza', '3314292'),
(925, 'Antaniditra', '3314293'),
(926, 'Antanandava', '3314310'),
(927, 'Beparasy', '3314330'),
(928, 'Andaingo', '3314350'),
(929, 'Andilamena', '3316011'),
(930, 'Bemaitso', '3316012'),
(931, 'Antanimenabaka', '3316031'),
(932, 'Tanananifololahy', '3316032'),
(933, 'Maroadabo', '3316051'),
(934, 'Marovato', '3316052'),
(935, 'Miarinarivo', '3316071'),
(936, 'Maitsokely', '3316072'),
(937, 'Anosibe An\'Ala', '3317011'),
(938, 'Ampasimaneva', '3317012'),
(939, 'Ampandroantraka', '3317031'),
(940, 'Tratramarina', '3317032'),
(941, 'Antandrokomby', '3317051'),
(942, 'Ambalanomby', '3317052'),
(943, 'Niarovana', '3317053'),
(944, 'Longozabe', '3317071'),
(945, 'Ambatoharanana', '3317072'),
(946, 'Tsaravinany', '3317090'),
(947, 'C.U Mahajanga', '4101009'),
(948, 'Soalala', '4103010'),
(949, 'Ambohipaky', '4103030'),
(950, 'Andranomavo', '4103050'),
(951, 'Ambato Ambarimay', '4105019'),
(952, 'Ankijabe', '4105051'),
(953, 'Andranofasika', '4105052'),
(954, 'Madirovalo', '4105070'),
(955, 'Anjiajia', '4105090'),
(956, 'Tsaramandroso', '4105111'),
(957, 'Ambondromamy', '4105112'),
(958, 'Ankirihitra', '4105130'),
(959, 'Andranomamy', '4105150'),
(960, 'Manerinerina', '4105170'),
(961, 'Sitampiky', '4105190'),
(962, 'Marovoay Ambonivohitra', '4106010'),
(963, 'Marovoay Ambanivohitra', '4106031'),
(964, 'Anosinalain\'olona', '4106032'),
(965, 'Antanambao Andranolava', '4106033'),
(966, 'Ambolomoty', '4106051'),
(967, 'Marosakoa', '4106052'),
(968, 'Tsararano', '4106070'),
(969, 'Ankazomborona', '4106090'),
(970, 'Manaratsandry', '4106111'),
(971, 'Antanimasaka', '4106112'),
(972, 'Bemaharivo', '4106130'),
(973, 'Ankaraobato', '4106150'),
(974, 'Mitsinjo', '4107011'),
(975, 'Antseza', '4107012'),
(976, 'Antongomena Bevary', '4107030'),
(977, 'Matsakabanja', '4107050'),
(978, 'Katsepy', '4107070'),
(979, 'Bekipay', '4107091'),
(980, 'Ambarimanenga', '4107092'),
(981, 'Belobaka', '4115011'),
(982, 'Boanamary', '4115012'),
(983, 'Ambalakida', '4115031'),
(984, 'Betsako', '4115032'),
(985, 'Mariarano', '4115050'),
(986, 'Bekobay', '4115071'),
(987, 'Andranoboka', '4115072'),
(988, 'Mahajamba Usine', '4115091'),
(989, 'Ambalabe Befanjava', '4115092'),
(990, 'Boriziny Vaovao I', '4209010'),
(991, 'Ambanjabe', '4209031'),
(992, 'Boriziny Vaovao II', '4209032'),
(993, 'Tsaratanana I', '4209033'),
(994, 'Tsarahasina', '4209050'),
(995, 'Tsiningia', '4209070'),
(996, 'Andranomeva', '4209091'),
(997, 'Amparihy', '4209092'),
(998, 'Leanja', '4209111'),
(999, 'Ambodisakoana', '4209112'),
(1000, 'Tsinjomitondraka', '4209131'),
(1001, 'Maevaranohely', '4209132'),
(1002, 'Marovato', '4209150'),
(1003, 'Ambodimahabibo', '4209171'),
(1004, 'Ambodivongo', '4209172'),
(1005, 'C.U Mandritsara', '4210010'),
(1006, 'Antanandava', '4210030'),
(1007, 'Antsoha', '4210050'),
(1008, 'Tsaratanana', '4210070'),
(1009, 'Kalandy', '4210090'),
(1010, 'Antsirabe Afovoany', '4210110'),
(1011, 'Amboaboa', '4210130'),
(1012, 'Manampaneva', '4210150'),
(1013, 'Ambarikorano', '4210170'),
(1014, 'Ambaripaika', '4210190'),
(1015, 'Ambalakirajy', '4210210'),
(1016, 'Antsatramidola', '4210230'),
(1017, 'Marotandrano', '4210250'),
(1018, 'Ambilombe', '4210270'),
(1019, 'Andohajango', '4210290'),
(1020, 'Anjiabe', '4210310'),
(1021, 'Ambohisoa', '4210330'),
(1022, 'Ampatakamaroreny', '4210350'),
(1023, 'Ankiabe-Salohy', '4210370'),
(1024, 'Ambodiadabo', '4210391'),
(1025, 'Amborondolo', '4210392'),
(1026, 'Antanambaon\'Amberina', '4210410'),
(1027, 'Ankaramy', '4210430'),
(1028, 'Antsiatsiaka', '4210450'),
(1029, 'Andratamarina', '4210470'),
(1030, 'Ambodiamontana Kianga', '4210490'),
(1031, 'Tsarajomoka', '4210510'),
(1032, 'Ankiakabe-Fonoka', '4210530'),
(1033, 'Pont Sofia', '4210550'),
(1034, 'Analalava', '4211011'),
(1035, 'Ambarijeby Sud', '4211012'),
(1036, 'Ambolobozo', '4211030'),
(1037, 'Befotaka Avaratra', '4211050'),
(1038, 'Ambaliha', '4211070'),
(1039, 'Maromandia', '4211090'),
(1040, 'Marovatolena', '4211110'),
(1041, 'Andriambavontsona', '4211130'),
(1042, 'Marovantaza', '4211150'),
(1043, 'Ankaramibe', '4211170'),
(1044, 'Antonibe', '4211190'),
(1045, 'Mahadrodroka', '4211210'),
(1046, 'Angoaka Sud', '4211230'),
(1047, 'C.U Befandriana Avaratra', '4212010'),
(1048, 'Morafeno', '4212030'),
(1049, 'Ambodimotso Atsimo', '4212050'),
(1050, 'Tsiamalao', '4212070'),
(1051, 'Maroamalona', '4212090'),
(1052, 'Tsarahonenana', '4212110'),
(1053, 'Antsakanalabe', '4212130'),
(1054, 'Ambararata', '4212150'),
(1055, 'Ambolidibe Atsinanana', '4212170'),
(1056, 'Ankarongana', '4212190'),
(1057, 'Antsakabary', '4212210'),
(1058, 'Matsondakana', '4212230'),
(1059, 'C.U Antsohihy', '4213010'),
(1060, 'Ankerika', '4213030'),
(1061, 'Ampandriankilandy', '4213051'),
(1062, 'Anjalazala', '4213052'),
(1063, 'Anahidrano', '4213070'),
(1064, 'Ambodimandresy', '4213090'),
(1065, 'Anjiamangirana', '4213110'),
(1066, 'Ambodimanary', '4213130'),
(1067, 'Antsahabe', '4213150'),
(1068, 'Ambodimadiro', '4213171'),
(1069, 'Andreba', '4213172'),
(1070, 'Maroala', '4213190'),
(1071, 'Bealanana', '4214010'),
(1072, 'Beandrarezona', '4214031'),
(1073, 'Antananivo Haut', '4214032'),
(1074, 'Antsamaka', '4214050'),
(1075, 'Ambatosia', '4214070'),
(1076, 'Ambatoriha Est', '4214090'),
(1077, 'Ambovonomby', '4214110'),
(1078, 'Analila', '4214130'),
(1079, 'Mangindrano', '4214150'),
(1080, 'Ambodisikidy', '4214170'),
(1081, 'Marotolana', '4214190'),
(1082, 'Ambodiadabo', '4214211'),
(1083, 'Ambalaromba', '4214212'),
(1084, 'Ambodiampana', '4214230'),
(1085, 'Anjozoromadosy', '4214250'),
(1086, 'Ambararata Nord', '4214270'),
(1087, 'Ambararata Sofia', '4214290'),
(1088, 'Ankazotokana', '4214310'),
(1089, 'Mampikony', '4223010'),
(1090, 'Mampikony II', '4223030'),
(1091, 'Ambohitoaka', '4223050'),
(1092, 'Bekoratsaka', '4223070'),
(1093, 'Komajia', '4223090'),
(1094, 'Ampasimatera', '4223110'),
(1095, 'Ankiririky', '4223130'),
(1096, 'Malakialina', '4223150'),
(1097, 'Betaramahamay', '4223170'),
(1098, 'Ambodihazoambo', '4223190'),
(1099, 'Maevatanana', '4304010'),
(1100, 'Maevatanana II', '4304031'),
(1101, 'Beratsimanina', '4304032'),
(1102, 'Bemokotra', '4304050'),
(1103, 'Mahazoma', '4304070'),
(1104, 'Antsiafabositra', '4304091'),
(1105, 'Antanimbary', '4304092'),
(1106, 'Tsararano', '4304111'),
(1107, 'Ambalajia', '4304112'),
(1108, 'Ambalanjanakomby', '4304130'),
(1109, 'Maria', '4304150'),
(1110, 'Andriba', '4304171'),
(1111, 'Mahatsinjo', '4304172'),
(1112, 'Morafeno', '4304173'),
(1113, 'Mangabe', '4304191'),
(1114, 'Madiromirafy', '4304192'),
(1115, 'Marokoroko', '4304210'),
(1116, 'Tsaratanana', '4308010'),
(1117, 'Bekapaika', '4308030'),
(1118, 'Tsararova', '4308050'),
(1119, 'Betrandraka', '4308070'),
(1120, 'Keliloha', '4308090'),
(1121, 'Sarobaratra', '4308110'),
(1122, 'Ampandrana', '4308130'),
(1123, 'Andriamena', '4308150'),
(1124, 'Ambakireny', '4308170'),
(1125, 'Brieville', '4308190'),
(1126, 'Sakoamadinika', '4308210'),
(1127, 'Manakana', '4308230'),
(1128, 'Kandreho', '4316010'),
(1129, 'Antanimbaribe', '4316030'),
(1130, 'Betaimboay', '4316051'),
(1131, 'Andasibe', '4316052'),
(1132, 'Ambaliha', '4316070'),
(1133, 'Behazomaty', '4316090'),
(1134, 'Besalampy', '4402010'),
(1135, 'Marovoay Atsimo', '4402030'),
(1136, 'Soanenga', '4402050'),
(1137, 'Bekodoka', '4402071'),
(1138, 'Ambolodia Sud', '4402072'),
(1139, 'Ankasakasa', '4402090'),
(1140, 'Mahabe', '4402110'),
(1141, 'Ampako', '4402130'),
(1142, 'Ambatomainty', '4417011'),
(1143, 'Bemarivo', '4417012'),
(1144, 'Sarodrano', '4417031'),
(1145, 'Marotsialeha', '4417032'),
(1146, 'Antsalova', '4420010'),
(1147, 'Soahany', '4420030'),
(1148, 'Masoarivo', '4420050'),
(1149, 'Trangahy', '4420070'),
(1150, 'Bekopaka', '4420090'),
(1151, 'Maintirano', '4421010'),
(1152, 'Mafaijijo', '4421030'),
(1153, 'Andabotoka Antsakoalamoty', '4421050'),
(1154, 'Betanatanana', '4421070'),
(1155, 'Andrea', '4421090'),
(1156, 'Ankisatra', '4421110'),
(1157, 'Marohazo', '4421130'),
(1158, 'Antsondrodava', '4421150'),
(1159, 'Belitsaka', '4421170'),
(1160, 'Tambohorano', '4421191'),
(1161, 'Andranovao', '4421192'),
(1162, 'Maromavo', '4421193'),
(1163, 'Veromanga', '4421194'),
(1164, 'Antsaidoha Bebao', '4421210'),
(1165, 'Berevo Ranobe', '4421231'),
(1166, 'Bebaboka Sud', '4421232'),
(1167, 'Bemokotra Sud', '4421250'),
(1168, 'Morafenobe', '4422010'),
(1169, 'Andramy', '4422030'),
(1170, 'Beravina', '4422050'),
(1171, 'TSARATAMPONA-I-AMBATOHARANANA', '50909'),
(1172, 'VOHILENGO', '50910'),
(1173, 'VOHIPENO', '50911'),
(1174, 'MAHANORO ( CHEF LIEU )', '50912'),
(1175, 'Tanambao I', '5101001'),
(1176, 'Tanambao II', '5101002'),
(1177, 'Mahavatse I', '5101003'),
(1178, 'Mahavatse II', '5101004'),
(1179, 'Betania', '5101005'),
(1180, 'Besakoa', '5101006'),
(1181, 'Beroroha', '5103010'),
(1182, 'Fanjakana', '5103030'),
(1183, 'Behisatsy', '5103050'),
(1184, 'Marerano', '5103070'),
(1185, 'Mandronarivo', '5103090'),
(1186, 'Bemavo', '5103110'),
(1187, 'Sakena', '5103130'),
(1188, 'Tanamary', '5103150'),
(1189, 'Morombe I', '5104010'),
(1190, 'Morombe II (Befandefa)', '5104030'),
(1191, 'Ambahikily', '5104050'),
(1192, 'Antongo Vaovao', '5104070'),
(1193, 'Nosy Ambositra', '5104090'),
(1194, 'Befandriana Atsimo', '5104110'),
(1195, 'Antanimieva', '5104130'),
(1196, 'Basibasy', '5104150'),
(1197, 'Ankazoabo Atsimo', '5105010'),
(1198, 'Tandrano', '5105030'),
(1199, 'Andranomafana', '5105050'),
(1200, 'Berenty', '5105070'),
(1201, 'Fotivolo', '5105090'),
(1202, 'Ilemby', '5105110'),
(1203, 'Betioky Atsimo', '5106010'),
(1204, 'Beantake', '5106030'),
(1205, 'Masiaboay', '5106050'),
(1206, 'Antohabato', '5106070'),
(1207, 'Tameantsoa', '5106090'),
(1208, 'Tongobory', '5106111'),
(1209, 'Vatolatsaka', '5106112'),
(1210, 'Besely', '5106130'),
(1211, 'Bezaha', '5106150'),
(1212, 'Manalobe', '5106170'),
(1213, 'Andranomangatsiaka', '5106190'),
(1214, 'Soamanonga', '5106210'),
(1215, 'Fenoandala', '5106230'),
(1216, 'Soaserana', '5106250'),
(1217, 'Salobe', '5106270'),
(1218, 'Tanambao Ambony', '5106290'),
(1219, 'Belamoty', '5106311'),
(1220, 'Montifeno', '5106312'),
(1221, 'Lazarivo', '5106330'),
(1222, 'Sakamasay', '5106350'),
(1223, 'Ambahitrimitsinjo', '5106370'),
(1224, 'Ankazomanga Ouest', '5106390'),
(1225, 'Ankazombalala', '5106410'),
(1226, 'Maroarivo Ankazomanga', '5106430'),
(1227, 'Ankilivalo', '5106450'),
(1228, 'Marosavoa', '5106470'),
(1229, 'Antsavoa', '5106490'),
(1230, 'Ampanihy Andrefana', '5107010'),
(1231, 'Anosa (Ankiliabo)', '5107030'),
(1232, 'Amborompotsy', '5107050'),
(1233, 'Ankilizato', '5107070'),
(1234, 'Maniry', '5107090'),
(1235, 'Antaly', '5107110'),
(1236, 'Ankilimivory', '5107130'),
(1237, 'Ejeda', '5107150'),
(1238, 'Belafike Ambony', '5107170'),
(1239, 'Beahitse', '5107190'),
(1240, 'Gogogogo', '5107210'),
(1241, 'Androka', '5107230'),
(1242, 'Vohitany', '5107250'),
(1243, 'Beroy Atsimo', '5107270'),
(1244, 'Fotadrevo', '5107290'),
(1245, 'Itampolo', '5107310'),
(1246, 'AMBATOHARANANA', '51101'),
(1247, 'AMBODIAMPANA', '51102'),
(1248, 'AMBODIVOANIO', '51103'),
(1249, 'ANTANAMBAOBE', '51104'),
(1250, 'ANTANAMBE', '51105'),
(1251, 'MANAMBOLOSY', '51106'),
(1252, 'MANANARA-AVARATRA', '51107'),
(1253, 'SANDRAKATSY', '51108'),
(1254, 'SAROMAONA', '51109'),
(1255, 'TANIBE', '51110'),
(1256, 'VANONA', '51111'),
(1257, 'Sakaraha', '5112011'),
(1258, 'Miary teheza', '5112012'),
(1259, 'Miary Lamatihy', '5112030'),
(1260, 'Mahaboboka', '5112050'),
(1261, 'Amboronabo', '5112070'),
(1262, 'Bereketa', '5112090'),
(1263, 'Andamasiny Vineta', '5112111'),
(1264, 'Mihavatse', '5112112'),
(1265, 'Andranolava', '5112130'),
(1266, 'Ambinany', '5112150'),
(1267, 'Mikoboka', '5112170'),
(1268, 'Mitsinjo', '5112190'),
(1269, 'Mitsinjo Betanimena', '5120010'),
(1270, 'Belalanda', '5120030'),
(1271, 'Betsinjaka', '5120050'),
(1272, 'Miary', '5120071'),
(1273, 'Behompy', '5120072'),
(1274, 'Maromiandra', '5120090'),
(1275, 'AMBINANITELO', '51201'),
(1276, 'Ambohimahavelona', '5120110'),
(1277, 'Ianantsony (Saint Augustin)', '5120131'),
(1278, 'Soalara', '5120132'),
(1279, 'Ambolofoty', '5120150'),
(1280, 'Ankilimalinike', '5120170'),
(1281, 'Antanimena', '5120191'),
(1282, 'Manorofify', '5120192'),
(1283, 'ANDRANOFOTSY', '51202'),
(1284, 'Marofoty', '5120210'),
(1285, 'Tsianisiha', '5120230'),
(1286, 'Manombo Atsimo', '5120250'),
(1287, 'Andranovory', '5120270'),
(1288, 'Ankoraobato Milenaky', '5120290'),
(1289, 'ANJAHANA', '51203'),
(1290, 'Ankililoaka', '5120310'),
(1291, 'Analamisampy', '5120330'),
(1292, 'Beheloke', '5120358'),
(1293, 'Andranohinaly', '5120370'),
(1294, 'Anakao', '5120390'),
(1295, 'ANKADIMBAZAHA-ANJANAZANA', '51204'),
(1296, 'ANKOFA', '51205'),
(1297, 'MAROANTSETRA', '51206'),
(1298, 'RANTABE', '51207'),
(1299, 'VOLOINA', '51208'),
(1300, 'ANTSIRABE SAHATANY', '51209'),
(1301, 'ANTAKOTAKO', '51210'),
(1302, 'Benenitra', '5121010'),
(1303, 'Ianapera', '5121031'),
(1304, 'Ambalavato', '5121032'),
(1305, 'Ehara', '5121050'),
(1306, 'MANAMBOLO', '51211'),
(1307, 'ANDRODRONA', '51212'),
(1308, 'AMBATOSOA', '51213'),
(1309, 'AMBODIMANGA RATABE', '51214'),
(1310, 'MORAFENO', '51215'),
(1311, 'ANANDRIVOLA', '51216'),
(1312, 'ANKOFABE', '51217'),
(1313, 'NOSY BORAHA', '51501'),
(1314, 'AMBAHOABE', '51602'),
(1315, 'AMBODIAMPANA-I', '51603'),
(1316, 'ANDAPAFITO', '51604'),
(1317, 'ANTANIFOTSY', '51605'),
(1318, 'ANTENINA', '51606'),
(1319, 'FOTSIALANANA', '51607'),
(1320, 'MANOMPANA', '51608'),
(1321, 'SOANIERANA-IVONGO', '51609'),
(1322, 'AMBATOHARANANA', '51801'),
(1323, 'AMBODIMANGAVALO', '51802'),
(1324, 'AMBOHIBE', '51803'),
(1325, 'AMPASIMAZAVA', '51804'),
(1326, 'ANDASIBE', '51805'),
(1327, 'ANJAHAMBE', '51806'),
(1328, 'MAROMITETY', '51807'),
(1329, 'MIARINARIVO', '51808'),
(1330, 'SAHATAVY', '51809'),
(1331, 'VAVATENINA', '51810'),
(1332, 'Beloha', '5213010'),
(1333, 'Tranovaho', '5213030'),
(1334, 'Kopoky', '5213050'),
(1335, 'Marolinta', '5213070'),
(1336, 'Tranoroa', '5213090'),
(1337, 'Beabobo', '5213110'),
(1338, 'Tsihombe', '5214010'),
(1339, 'Betanty (Faux cap)', '5214030'),
(1340, 'Marovato', '5214050'),
(1341, 'Antaritarika', '5214071'),
(1342, 'Imongy', '5214072'),
(1343, 'Nikoly', '5214090'),
(1344, 'Anjapaly', '5214110'),
(1345, 'Ambovombe', '5216011'),
(1346, 'Anjeke-Ankilikira', '5216012'),
(1347, 'Erada', '5216013'),
(1348, 'Ambanisarika', '5216031'),
(1349, 'Ambohimalaza', '5216032'),
(1350, 'Ambonaivo', '5216050'),
(1351, 'Maroalopoty', '5216071'),
(1352, 'Maroalimainte', '5216072'),
(1353, 'Ambondro', '5216091'),
(1354, 'Ambazoa', '5216092'),
(1355, 'Sihanamaro', '5216111'),
(1356, 'Marovato-Befeno', '5216112'),
(1357, 'Antanimora Atsimo', '5216130'),
(1358, 'Andalatanosy', '5216151'),
(1359, 'Ampamata', '5216152'),
(1360, 'Jafaro', '5216170'),
(1361, 'Imanombo', '5216190'),
(1362, 'Tsimananada', '5216210'),
(1363, 'Analamary', '5216230'),
(1364, 'Morefeno Bekily', '5218010'),
(1365, 'Ankaranabo Avaratra', '5218030'),
(1366, 'Anja Avaratra', '5218050'),
(1367, 'Antsakoamaro', '5218070'),
(1368, 'Ambatosola', '5218091'),
(1369, 'Tsirandrany', '5218092'),
(1370, 'Tsikolaky', '5218110'),
(1371, 'Manakompy', '5218130'),
(1372, 'Ambahita', '5218151'),
(1373, 'Maroviro', '5218152'),
(1374, 'Belindo Mahasoa', '5218170'),
(1375, 'Beteza', '5218190'),
(1376, 'Tanandava', '5218210'),
(1377, 'Bekitro', '5218230'),
(1378, 'Beraketa', '5218251'),
(1379, 'Vohimanga', '5218252'),
(1380, 'Bevitiky', '5218270'),
(1381, 'Anivorano Mitsinjo', '5218290'),
(1382, 'Besakoa', '5218310'),
(1383, 'Taolagnaro', '5315010'),
(1384, 'Ampasy Nahampoana', '5315031'),
(1385, 'Mandromodromotra', '5315032'),
(1386, 'Soanierana', '5315033'),
(1387, 'Ifarantsa', '5315051'),
(1388, 'Isaka-ivondro', '5315052'),
(1389, 'Mandiso', '5315053'),
(1390, 'Manambaro', '5315071'),
(1391, 'Sarisambo', '5315072'),
(1392, 'Ankaramena', '5315090'),
(1393, 'Ranopiso', '5315111'),
(1394, 'Analampatsy', '5315112'),
(1395, 'Andranobory', '5315113'),
(1396, 'Ambatoabo', '5315114'),
(1397, 'Mahatalaky', '5315131'),
(1398, 'Iaboakoho-Riandava', '5315132'),
(1399, 'Enaniliha', '5315151'),
(1400, 'Fenoevo', '5315152'),
(1401, 'Enakara', '5315170'),
(1402, 'Ranomafana', '5315190'),
(1403, 'Bevoay', '5315210'),
(1404, 'Ampasimena', '5315230'),
(1405, 'Manantenina', '5315251'),
(1406, 'Analamary', '5315252'),
(1407, 'Ankariera', '5315270'),
(1408, 'Emagnombo', '5315290'),
(1409, 'Soavary', '5315310'),
(1410, 'Betroka', '5317010'),
(1411, 'Tsaraitso', '5317030'),
(1412, 'Naninora', '5317050'),
(1413, 'Ambalasoa', '5317070'),
(1414, 'Ivahona', '5317090'),
(1415, 'Analamary', '5317110'),
(1416, 'Ianabinda', '5317130'),
(1417, 'Benato Toby', '5317150'),
(1418, 'Mahabo', '5317170'),
(1419, 'Beapombo I', '5317190'),
(1420, 'Jangany', '5317210'),
(1421, 'Mahasoa Atsinanana', '5317230'),
(1422, 'Bekorobo', '5317250'),
(1423, 'Iaborotra', '5317270'),
(1424, 'Isoanala', '5317291'),
(1425, 'Beampombo II', '5317292'),
(1426, 'Ianakafy', '5317310'),
(1427, 'Andriandampy', '5317330'),
(1428, 'Ambatomivary', '5317350'),
(1429, 'Manarena', '5317370'),
(1430, 'Sakamahily', '5317390'),
(1431, 'Amboasary Atsimo', '5319010'),
(1432, 'Behara', '5319030'),
(1433, 'Tanandava Atsimo', '5319050'),
(1434, 'Sampona', '5319070'),
(1435, 'Ifotaka', '5319090'),
(1436, 'Tranomaro', '5319110'),
(1437, 'Maromby', '5319130'),
(1438, 'Elonty', '5319150'),
(1439, 'Esira', '5319170'),
(1440, 'Mahaly', '5319190'),
(1441, 'Manevy', '5319210'),
(1442, 'Tsivory', '5319230'),
(1443, 'Marotsiraka', '5319250'),
(1444, 'Tomboarivo', '5319270'),
(1445, 'Ebelo', '5319290'),
(1446, 'Ranobe', '5319310'),
(1447, 'Manja', '5402010'),
(1448, 'Beharona', '5402030'),
(1449, 'Anontsibe Sakalava', '5402050'),
(1450, 'Soaserana', '5402070'),
(1451, 'Ankiliabo', '5402090'),
(1452, 'Andranopasy', '5402110'),
(1453, 'Morondava', '5408010'),
(1454, 'Bemanonga', '5408059'),
(1455, 'Analaiva', '5408079'),
(1456, 'Befasy', '5408159'),
(1457, 'Belo Mariny Ranomasina', '5408179'),
(1458, 'Mahabo', '5409010'),
(1459, 'Ankilivalo', '5409030'),
(1460, 'Tanandava II Analamitsivalana', '5409051'),
(1461, 'Befotaka', '5409052'),
(1462, 'Ampanihy', '5409070'),
(1463, 'Ankilizato', '5409091'),
(1464, 'Ambia', '5409092'),
(1465, 'Mandabe', '5409110'),
(1466, 'Malaimbandy', '5409130'),
(1467, 'Beronono', '5409150'),
(1468, 'Tsimazava', '5409170'),
(1469, 'Belon\'i Tsiribihina', '5410011'),
(1470, 'Bemarivo-ankirondro', '5410012'),
(1471, 'Andimaky Manambolo', '5410013'),
(1472, 'Tsimafana', '5410030'),
(1473, 'Tsaraotana', '5410050'),
(1474, 'Serinam = Masoarivo', '5410070'),
(1475, 'Amboalimena', '5410090'),
(1476, 'Ankalalobe', '5410111'),
(1477, 'Ambiky', '5410112'),
(1478, 'Berevo', '5410131'),
(1479, 'Antsoha', '5410132'),
(1480, 'Soaserana = Belinta', '5410151'),
(1481, 'Ankororoky', '5410152'),
(1482, 'Beroboka Nord', '5410170'),
(1483, 'Miandrivazo', '5411011'),
(1484, 'Dabolava', '5411012'),
(1485, 'Bemahatazana', '5411031'),
(1486, 'Ampanihy', '5411032'),
(1487, 'Anosimena', '5411033'),
(1488, 'Manandaza', '5411050'),
(1489, 'Ankotrofotsy', '5411071'),
(1490, 'Isalo', '5411072'),
(1491, 'Ambatolahy', '5411091'),
(1492, 'Manambina', '5411092'),
(1493, 'Itondy', '5411110'),
(1494, 'Ankavandra', '5411130'),
(1495, 'Soaloka', '5411159'),
(1496, 'Betsipolitra', '5411170'),
(1497, 'Ankondromena', '5411210'),
(1498, 'Ramena', '7113010'),
(1499, 'Sakaramy', '7113031'),
(1500, 'Joffre Ville', '7113032'),
(1501, 'Antsahampano', '7113050'),
(1502, 'Mahavanona', '7113070'),
(1503, 'Mangaoka', '7113090'),
(1504, 'Andrafiabe', '7113110'),
(1505, 'Anketrakabe', '7113130'),
(1506, 'Sadjoavato', '7113151'),
(1507, 'Antsalaka', '7113152'),
(1508, 'Andranovondronina', '7113170'),
(1509, 'Andranofanjava', '7113191'),
(1510, 'Mahalina', '7113192'),
(1511, 'Ankarongana', '7113210'),
(1512, 'Anivorano Avaratra', '7113230'),
(1513, 'Bobasakoa', '7113251'),
(1514, 'Mosorolava', '7113252'),
(1515, 'Antanamitarana', '7113270'),
(1516, 'Antsoha', '7113290'),
(1517, 'Ambondrona', '7113310'),
(1518, 'Bobakilandy', '7113330'),
(1519, 'Antsiranana Afovoany', '7115001'),
(1520, 'Antsiranana Andrefana', '7115002'),
(1521, 'Antsiranana Atsinanana', '7115003'),
(1522, 'Ambilobe', '7117010'),
(1523, 'Mantaly', '7117030'),
(1524, 'Ampondralava', '7117050'),
(1525, 'Tanambao Marivorahona', '7117070'),
(1526, 'Ambakirano', '7117090'),
(1527, 'Ambatoben\'Anjavy', '7117110'),
(1528, 'Antsaravibe', '7117130'),
(1529, 'Antsohimbondrona', '7117150'),
(1530, 'Anjiabe Ambony', '7117171'),
(1531, 'Ambodibonara', '7117172'),
(1532, 'Beramanja', '7117190'),
(1533, 'Betsiaka', '7117210'),
(1534, 'Ambarakaraka', '7117231'),
(1535, 'Anaborano Ifasy', '7117232'),
(1536, 'Manambato', '7117233'),
(1537, 'Antsirambazaha Hell-Ville', '7118001'),
(1538, 'Ampangorina', '7118002'),
(1539, 'Ambatozavavy', '7118003'),
(1540, 'Bemanondrobe', '7118004'),
(1541, 'Dzamandzary', '7118005'),
(1542, 'Ambanja CU', '7119010'),
(1543, 'Benavony', '7119030'),
(1544, 'Ambohimena', '7119050'),
(1545, 'Antsatsaka', '7119070'),
(1546, 'Antranokarany', '7119091'),
(1547, 'Djangoa', '7119092'),
(1548, 'Antsakoamanondro', '7119110'),
(1549, 'Ambalahonko', '7119130'),
(1550, 'Ankingameloka', '7119150'),
(1551, 'Bemaneviky Haut Sambirano', '7119171'),
(1552, 'Ambodimanga Ramena', '7119172'),
(1553, 'Antafiambotry', '7119190'),
(1554, 'Maherivaratra', '7119210'),
(1555, 'Marovato', '7119231'),
(1556, 'Ambohimarina', '7119232'),
(1557, 'Ambaliha', '7119250'),
(1558, 'Marotolana', '7119270'),
(1559, 'Bemaneviky Andrefana', '7119290'),
(1560, 'Anorotsangana', '7119310'),
(1561, 'Antsirabe', '7119330'),
(1562, 'Ankatafa', '7119350'),
(1563, 'Maevatanana', '7119370'),
(1564, 'Ambohitrandriana', '7119390'),
(1565, 'Antalaha CU', '7210010'),
(1566, 'Ampahana', '7210030'),
(1567, 'Ampohibe', '7210050'),
(1568, 'Antombana', '7210070'),
(1569, 'Antsahanoro', '7210090'),
(1570, 'Antananambo', '7210110'),
(1571, 'Marofinaritra', '7210130'),
(1572, 'Sarahandrano', '7210150'),
(1573, 'Ambalabe', '7210170'),
(1574, 'Ambinanifaho', '7210190'),
(1575, 'Ambohitralanana', '7210210'),
(1576, 'Lanjarivo', '7210230'),
(1577, 'Antsambalahy', '7210250'),
(1578, 'Vinanivao', '7210270'),
(1579, 'Andampy', '7210290'),
(1580, 'Ampanavoana', '7210310');
INSERT INTO `commune` (`id`, `nom_commune`, `code_commune`) VALUES
(1581, 'Sambava CU', '7211010'),
(1582, 'Ambohimalaza', '7211059'),
(1583, 'Farahalana', '7211079'),
(1584, 'Nosiarina', '7211090'),
(1585, 'Ambodivoara', '7211130'),
(1586, 'Anjinjaomby', '7211150'),
(1587, 'Morafeno', '7211170'),
(1588, 'Analamaho', '7211190'),
(1589, 'Ambohimitsinjo', '7211210'),
(1590, 'Anjangoveratra', '7211230'),
(1591, 'Andratamarina (Fir Antsiradrano)', '7211250'),
(1592, 'Marogaona', '7211270'),
(1593, 'Marojala', '7211290'),
(1594, 'Antsambaharo (Fir Andasibe)', '7211310'),
(1595, 'Andrahanjo', '7211330'),
(1596, 'Bemanevika', '7211350'),
(1597, 'Amboangibe', '7211370'),
(1598, 'Antindra', '7211390'),
(1599, 'Ambodiampana', '7211410'),
(1600, 'Maroambihy', '7211430'),
(1601, 'Ambatoafo (Fir Beanantsindra)', '7211450'),
(1602, 'Anjialava', '7211470'),
(1603, 'Tanambao Daoud', '7211490'),
(1604, 'Antsahavaribe', '7211510'),
(1605, 'Bevonotra', '7211530'),
(1606, 'Andrembona', '7211550'),
(1607, 'Andapa CU', '7212010'),
(1608, 'Tanandava', '7212030'),
(1609, 'Ankiakabe Avaratra', '7212050'),
(1610, 'Belaoka Marovato', '7212070'),
(1611, 'Ambodimanga I', '7212090'),
(1612, 'Marovato', '7212110'),
(1613, 'Andrakata', '7212130'),
(1614, 'Bealampona', '7212150'),
(1615, 'Matsohely', '7212170'),
(1616, 'Andranomena', '7212190'),
(1617, 'Ambalamanasy II', '7212210'),
(1618, 'Ambodiangezoka', '7212230'),
(1619, 'Betsakotsako', '7212250'),
(1620, 'Belaoka Lokoho', '7212270'),
(1621, 'Anoviara', '7212290'),
(1622, 'Doany', '7212310'),
(1623, 'Anjialavabe', '7212330'),
(1624, 'Antsahamena', '7212350'),
(1625, 'Vohimarina CU', '7216010'),
(1626, 'Ampondra', '7216030'),
(1627, 'Fanambana', '7216050'),
(1628, 'Milanoa', '7216070'),
(1629, 'Bobakindro', '7216090'),
(1630, 'Daraina', '7216110'),
(1631, 'Ambalasatrana', '7216130'),
(1632, 'Tsarabaria', '7216150'),
(1633, 'Nosibe', '7216170'),
(1634, 'Andravory', '7216190'),
(1635, 'Andrafainkona', '7216210'),
(1636, 'Ampanefena', '7216231'),
(1637, 'Antsaharavibe', '7216232'),
(1638, 'Ambinanin\'Andravory', '7216250'),
(1639, 'Amboriala', '7216270'),
(1640, 'Maromokotra', '7216290'),
(1641, 'Antsirabe Avaratra', '7216310'),
(1642, 'Ampisikinana', '7216330'),
(1643, 'Belambo', '7216350'),
(1644, 'Autres communes', 'AU'),
(1645, 'Non disponible', 'ND');

-- --------------------------------------------------------

--
-- Structure de la table `compte_epargne`
--

CREATE TABLE `compte_epargne` (
  `id` int(11) NOT NULL,
  `codeclient_id` int(11) DEFAULT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `datedebut` date NOT NULL,
  `type_client` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codeep` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codeepargne` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `compte_epargne`
--

INSERT INTO `compte_epargne` (`id`, `codeclient_id`, `produit_id`, `datedebut`, `type_client`, `codeep`, `codeepargne`) VALUES
(3, NULL, 2, '2022-11-12', 'INDIVIDUEL', 'I010000001', 'I01000000110002'),
(5, NULL, 1, '2022-11-11', 'INDIVIDUEL', 'I010000001', 'I01000000110001'),
(6, NULL, 1, '2022-11-11', 'GROUPE', 'G010000001', 'G01000000110001'),
(7, NULL, 2, '2022-11-12', 'INDIVIDUEL', 'I010000010', 'I01000001010002'),
(8, NULL, 2, '2022-11-13', 'INDIVIDUEL', 'I010000009', 'I01000000910002'),
(9, NULL, 2, '2022-11-13', 'INDIVIDUEL', 'I010000009', 'I01000000910002');

-- --------------------------------------------------------

--
-- Structure de la table `config_ep`
--

CREATE TABLE `config_ep` (
  `id` int(11) NOT NULL,
  `produit_epargne_id` int(11) DEFAULT NULL,
  `deviseutiliser_id` int(11) DEFAULT NULL,
  `is_negatif` tinyint(1) NOT NULL,
  `nbrj_inactif` int(11) NOT NULL,
  `nb_min_ret` int(11) NOT NULL,
  `nbr_jr_max_dep` int(11) NOT NULL,
  `age_min_cpt` int(11) NOT NULL,
  `frais_tenu_cpt` double NOT NULL,
  `commission_ret_cash` double NOT NULL,
  `commission_transf` double NOT NULL,
  `frais_ferm_cpt` double NOT NULL,
  `soldeouvert` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `config_ep`
--

INSERT INTO `config_ep` (`id`, `produit_epargne_id`, `deviseutiliser_id`, `is_negatif`, `nbrj_inactif`, `nb_min_ret`, `nbr_jr_max_dep`, `age_min_cpt`, `frais_tenu_cpt`, `commission_ret_cash`, `commission_transf`, `frais_ferm_cpt`, `soldeouvert`) VALUES
(1, 1, 1, 0, 20, 20, 100000, 20, 1000, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `depot_aterme`
--

CREATE TABLE `depot_aterme` (
  `id` int(11) NOT NULL,
  `compte_id` int(11) NOT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `datedepot` datetime NOT NULL,
  `piececomptable` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tauxinteret` double NOT NULL,
  `periodemois` int(11) NOT NULL,
  `is_interetcapitalise` tinyint(1) NOT NULL,
  `date_echeance` datetime NOT NULL,
  `valeurecheance` double NOT NULL,
  `taxeretenue` double NOT NULL,
  `retenuetaxe` double NOT NULL,
  `tva` double NOT NULL,
  `is_depotcall` tinyint(1) NOT NULL,
  `is_interetecheance` tinyint(1) NOT NULL,
  `is_interetmois` tinyint(1) NOT NULL,
  `is_interettrimestrielle` tinyint(1) NOT NULL,
  `is_interetsemestrielle` tinyint(1) NOT NULL,
  `is_interetpayelorscalcul` tinyint(1) NOT NULL,
  `_is_interettransferercptep` tinyint(1) NOT NULL,
  `is_retirealecheance` tinyint(1) NOT NULL,
  `is_remetreaucptalecheance` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devise`
--

CREATE TABLE `devise` (
  `id` int(11) NOT NULL,
  `devise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devise`
--

INSERT INTO `devise` (`id`, `devise`, `pays`) VALUES
(1, 'Ariary', 'Madagascar'),
(2, 'Euro', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20221111104652', '2022-11-11 13:46:57', 16835),
('DoctrineMigrations\\Version20221112041237', '2022-11-12 07:12:52', 1799);

-- --------------------------------------------------------

--
-- Structure de la table `etatcivile`
--

CREATE TABLE `etatcivile` (
  `id` int(11) NOT NULL,
  `etatcivile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etatcivile`
--

INSERT INTO `etatcivile` (`id`, `etatcivile`) VALUES
(1, 'Célibataire');

-- --------------------------------------------------------

--
-- Structure de la table `etude`
--

CREATE TABLE `etude` (
  `id` int(11) NOT NULL,
  `niveau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etude`
--

INSERT INTO `etude` (`id`, `niveau`) VALUES
(1, 'Universitaire');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `nom_groupe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_inscription` date NOT NULL,
  `numero_mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codegroupe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nom_groupe`, `date_inscription`, `numero_mobile`, `email`, `codegroupe`) VALUES
(1, 'Groupe A', '2022-11-11', '03452653', 'fidev@gmail.com', 'G010000001'),
(2, 'Groupe B', '2022-11-12', '034 12 456 52', 'fidev@gmail.com', 'G010000002'),
(6, 'Groupe R', '2022-11-12', '034 12 456 52', 'fidev2@gmail.com', 'G010000003');

-- --------------------------------------------------------

--
-- Structure de la table `individuelclient`
--

CREATE TABLE `individuelclient` (
  `id` int(11) NOT NULL,
  `etatcivile_id` int(11) DEFAULT NULL,
  `etude_id` int(11) DEFAULT NULL,
  `titre_id` int(11) DEFAULT NULL,
  `membre_groupe_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nom_client` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_client` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_conjoint` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_inscription` date NOT NULL,
  `sexe` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `lieu_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_enfant` int(11) NOT NULL,
  `nb_personne_charge` int(11) NOT NULL,
  `parent_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adressephysique` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre_groupe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieudelivrance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datecin` date NOT NULL,
  `dateexpiration` date NOT NULL,
  `type_identite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateadhesion` date DEFAULT NULL,
  `codeclient` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commune` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agence_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `individuelclient`
--

INSERT INTO `individuelclient` (`id`, `etatcivile_id`, `etude_id`, `titre_id`, `membre_groupe_id`, `user_id`, `nom_client`, `prenom_client`, `cin`, `nom_conjoint`, `date_inscription`, `sexe`, `date_naissance`, `lieu_naissance`, `numero_mobile`, `profession`, `nb_enfant`, `nb_personne_charge`, `parent_nom`, `parent_adresse`, `photo`, `adressephysique`, `titre_groupe`, `lieudelivrance`, `datecin`, `dateexpiration`, `type_identite`, `dateadhesion`, `codeclient`, `commune`, `agence_id`) VALUES
(5, 1, 1, 2, NULL, 1, 'RAZANAJASOA', 'Herimampionina', '105 0222 14 8999', 'Hery', '2022-11-12', 'Masculin', '1998-11-12', 'Antanety', '034 60 559 29', 'Developpeur', 1, 5, 'RAJANARY sy ANDONIARY', 'Ambatomanga', 'images-2-636f6af50dc8a.jpg', 'AT8 Antanety Ankadikely Ilafy', '', 'Ankazobe', '2012-11-12', '2022-02-12', 'CIN', '2022-11-11', 'I010000005', 'Ankadikely Ilafy', 1),
(6, 1, 1, 2, NULL, 1, 'RANDRIAMHAINGO', 'Herinandrianina Eloi', '105 0222 14 8999', 'Nandry', '2022-11-12', 'Masculin', '1993-11-11', 'Antanety', '034 60 559 29', 'Manager', 1, 3, 'RAZAFY et NIRINA', 'Ambatomanga', 'telechargement-636f6cdadb82d.png', 'AT8 Antanety Ankadikely Ilafy', '', 'Ankazobe', '2012-11-11', '2022-11-11', 'CIN', '2022-11-12', 'I010000006', 'Ankadikely Ilafy', 1),
(7, 1, 1, 2, 2, 1, 'RAKOTONANAHARY', 'njaka', '105 0222 14 8999', 'Njaka', '2022-11-12', 'Masculin', '1993-11-06', 'Antanambao', '034 60 559 23', 'Developpeur', 2, 2, 'Rabe sy Soa', 'Ambato', '327623-636f8fa4ca964.jpg', 'Ankazoambo', 'Secretaire', 'Ankaraobato', '2014-11-12', '2022-02-02', 'CIN', '2022-11-12', 'I010000007', 'Ankazoambo', 1),
(8, 1, 1, 2, 1, 1, 'RATSIMISETA', 'Charlotte', '104 1111 888 26', 'Charlotte', '2022-11-12', 'Masculin', '1992-11-11', 'ANtanety Ilafy', '034 60 559 26', 'Stagiaire', 0, 0, 'RAKOTO sy RASOA', 'Ambohimanga', 'images-2-636f98153d615.jpg', 'Analamhitsy', 'Secretaire', 'Analamhitsy', '2014-11-12', '2024-11-12', 'CIN', NULL, 'I010000008', 'Tanandava II Analamitsivalana', 1),
(9, 1, 1, 2, 1, 1, 'RAJANARIMARINA', 'Jacque Berthin', '105 0222 14 8999', 'Berthin', '2022-11-12', 'Masculin', '1992-11-12', 'Ambolotarabe', '034 60 559 28', 'Manager', 2, 2, 'RANJARY & RAKETAKA', 'Marovato', 'images-1-636f999db2642.jpg', 'Ivandry', 'Secretaire', 'Ambalavao', '2012-11-12', '2022-11-10', 'CIN', '2022-11-12', 'I010000009', 'Antananarivo I', 1),
(10, 1, 1, 1, 6, 1, 'TAHINJANAHARY', 'Caroline', '105 0222 14 8999', 'Caroline', '2022-11-12', 'Feminin', '1995-11-11', 'HJRA Anosy', '034 60 559 21', 'Etudiant', 2, 2, 'RAJANARY sy ANDONIARY', 'Ambatomanga', 'pexels-photo-1972115-636f9b5e58d4d.jpg', 'Mahamasina', 'President', 'Analamhitsy', '2014-11-11', '2025-02-02', 'Passeport', '2022-11-12', 'I010000010', 'Anosiala', 1);

-- --------------------------------------------------------

--
-- Structure de la table `individuelclient_compte_epargne`
--

CREATE TABLE `individuelclient_compte_epargne` (
  `individuelclient_id` int(11) NOT NULL,
  `compte_epargne_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `journal_comptabilite`
--

CREATE TABLE `journal_comptabilite` (
  `id` int(11) NOT NULL,
  `compteepargne` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit` int(11) NOT NULL,
  `credit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

CREATE TABLE `langue` (
  `id` int(11) NOT NULL,
  `langue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `langue`
--

INSERT INTO `langue` (`id`, `langue`, `pays`) VALUES
(1, 'Malagasy', 'Madagascar'),
(2, 'Français', 'Frrance');

-- --------------------------------------------------------

--
-- Structure de la table `liste_rouge`
--

CREATE TABLE `liste_rouge` (
  `id` int(11) NOT NULL,
  `codegroupe_id` int(11) DEFAULT NULL,
  `codeclient_id` int(11) DEFAULT NULL,
  `dateliste` date NOT NULL,
  `raison` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_client` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mobile`
--

CREATE TABLE `mobile` (
  `id` int(11) NOT NULL,
  `code_client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produittransfert`
--

CREATE TABLE `produittransfert` (
  `id` int(11) NOT NULL,
  `compte1_id` int(11) DEFAULT NULL,
  `compte2_id` int(11) DEFAULT NULL,
  `datetransfert` date NOT NULL,
  `montant` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit_epargne`
--

CREATE TABLE `produit_epargne` (
  `id` int(11) NOT NULL,
  `type_epargne_id` int(11) DEFAULT NULL,
  `nomproduit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isdesactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit_epargne`
--

INSERT INTO `produit_epargne` (`id`, `type_epargne_id`, `nomproduit`, `isdesactive`) VALUES
(1, 1, 'Produit manaraka', 1),
(2, 1, 'Pack entrer', 1);

-- --------------------------------------------------------

--
-- Structure de la table `suivi_client`
--

CREATE TABLE `suivi_client` (
  `id` int(11) NOT NULL,
  `date_entre` date NOT NULL,
  `date_sortie` date NOT NULL,
  `utilisateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_utiliser` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `titre`
--

CREATE TABLE `titre` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `titre`
--

INSERT INTO `titre` (`id`, `titre`) VALUES
(1, 'Madame'),
(2, 'Monsieur');

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `piece_comptable` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_transaction` date NOT NULL,
  `montant` double NOT NULL,
  `papeterie` double NOT NULL,
  `commission` double NOT NULL,
  `type_client` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `solde` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codetransaction` int(11) DEFAULT NULL,
  `codeepargneclient` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codeepargnegroupe` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transaction`
--

INSERT INTO `transaction` (`id`, `description`, `piece_comptable`, `date_transaction`, `montant`, `papeterie`, `commission`, `type_client`, `solde`, `codetransaction`, `codeepargneclient`, `codeepargnegroupe`) VALUES
(4, 'DEPOT', 'Checque', '2022-11-11', 19600, 200, 200, 'INDIVIDUEL', '19600', 979464886, 'I01000000110002', NULL),
(5, 'DEPOT', '0001', '2022-11-11', 998000, 1000, 1000, 'INDIVIDUEL', '998000', 996818564, 'I01000000110001', NULL),
(6, 'TRANSFERT', '004', '2022-11-11', -8000, 0, 0, 'INDIVIDUEL', '990000', 567542159, 'I01000000110001', NULL),
(7, 'TRANSFERT', '004', '2022-11-11', 8000, 0, 0, 'INDIVIDUEL', '27600', 567542159, 'I01000000110002', NULL),
(8, 'DEPOT', 'Checque', '2022-11-12', 9998000, 1000, 1000, 'INDIVIDUEL', '10988000', 156751343, 'I01000000110001', NULL),
(9, 'DEPOT', '0001', '2022-11-11', 99980000, 10000, 10000, 'GROUPE', '99980000', 643165614, 'G01000000110001', NULL),
(10, 'RETRAIT', '001', '2022-11-11', 0, 100, 100, 'INDIVIDUEL', '988200', 608435, 'I01000000110001', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `transfertep`
--

CREATE TABLE `transfertep` (
  `id` int(11) NOT NULL,
  `description_t` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `piece_comptable_t` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_transaction_t` date NOT NULL,
  `montantdestinataire` int(11) NOT NULL,
  `papeterie` int(11) NOT NULL,
  `commission` int(11) NOT NULL,
  `type_client_t` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soldedestinataire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `soldeenvoyeur` int(11) NOT NULL,
  `codetransaction_t` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codedestinateur` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codeenvoyeur` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transfertep`
--

INSERT INTO `transfertep` (`id`, `description_t`, `piece_comptable_t`, `date_transaction_t`, `montantdestinataire`, `papeterie`, `commission`, `type_client_t`, `soldedestinataire`, `soldeenvoyeur`, `codetransaction_t`, `codedestinateur`, `codeenvoyeur`) VALUES
(3, 'TRANSFERT', '004', '2022-11-12', -8000, 0, 0, 'INDIVIDUEL', '27600', 990000, '953265545', 'I01000000110002', 'I01000000110001'),
(4, 'TRANSFERT', '004', '2022-11-12', -8000, 0, 0, 'INDIVIDUEL', '27600', 990000, '821252711', 'I01000000110002', 'I01000000110001'),
(6, 'TRANSFERT', '004', '2022-11-11', -8000, 0, 0, 'INDIVIDUEL', '27600', 990000, '567542159', 'I01000000110002', 'I01000000110001');

--
-- Déclencheurs `transfertep`
--
DELIMITER $$
CREATE TRIGGER `Tranfert` AFTER INSERT ON `transfertep` FOR EACH ROW INSERT INTO 
transaction(
    description,
    piece_comptable,
    date_transaction,
    montant,
    papeterie,
    commission,
    type_client,
    solde,
    codetransaction,
    codeepargneclient)VALUES(
      new.description_t,
    new.piece_comptable_t,
    new.date_transaction_t,
    -(new.montantdestinataire),
    new.papeterie,
    new.commission,
    new.type_client_t,
    new.soldedestinataire,
    new.codetransaction_t,
    new.codedestinateur)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Tranfert2` AFTER INSERT ON `transfertep` FOR EACH ROW INSERT INTO 
transaction(
    description,
    piece_comptable,
    date_transaction,
    montant,
    papeterie,
    commission,
    type_client,
    solde,
    codetransaction,
    codeepargneclient)VALUES(
      new.description_t,
    new.piece_comptable_t,
    new.date_transaction_t,
    (new.montantdestinataire),
    new.papeterie,
    new.commission,
    new.type_client_t,
    new.soldeenvoyeur,
    new.codetransaction_t,
    new.codeenvoyeur)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `transfert_produit`
--

CREATE TABLE `transfert_produit` (
  `id` int(11) NOT NULL,
  `produitatransferer_id` int(11) DEFAULT NULL,
  `produittransmis_id` int(11) DEFAULT NULL,
  `compte_id` int(11) DEFAULT NULL,
  `datetransfert` date NOT NULL,
  `montant` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_epargne`
--

CREATE TABLE `type_epargne` (
  `id` int(11) NOT NULL,
  `nom_type_ep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abreviation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_epargne`
--

INSERT INTO `type_epargne` (`id`, `nom_type_ep`, `abreviation`, `description`) VALUES
(1, 'Depot a Vue', 'DAV', 'Depot a vue'),
(2, 'Depot Salaire', 'DA', 'Depot a salaire');

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
  `responsabilite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `responsabilite`) VALUES
(1, 'randria@gmail.com', '[]', '$2y$13$6IYaMzvkMSoJKGsuOdpzuOYjqWCQwNDrHMNZMLwVHh1ATTod/bOyy', 'RANDRIAMIHAINGO', 'Herinandrianina', 'Developpeur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agence`
--
ALTER TABLE `agence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `approbationcredit`
--
ALTER TABLE `approbationcredit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `approuver_client`
--
ALTER TABLE `approuver_client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_387761DCCEAA546A` (`codeclient_id`);

--
-- Index pour la table `client_mobile`
--
ALTER TABLE `client_mobile`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commune`
--
ALTER TABLE `commune`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compte_epargne`
--
ALTER TABLE `compte_epargne`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_19FDB51ACEAA546A` (`codeclient_id`),
  ADD KEY `IDX_19FDB51AF347EFB` (`produit_id`);

--
-- Index pour la table `config_ep`
--
ALTER TABLE `config_ep`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_92B49DF24C62D160` (`produit_epargne_id`),
  ADD KEY `IDX_92B49DF2A6D70781` (`deviseutiliser_id`);

--
-- Index pour la table `depot_aterme`
--
ALTER TABLE `depot_aterme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_80EAC779F2C56620` (`compte_id`),
  ADD KEY `IDX_80EAC779F347EFB` (`produit_id`);

--
-- Index pour la table `devise`
--
ALTER TABLE `devise`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `etatcivile`
--
ALTER TABLE `etatcivile`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etude`
--
ALTER TABLE `etude`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `individuelclient`
--
ALTER TABLE `individuelclient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9B96C69F962FC573` (`etatcivile_id`),
  ADD KEY `IDX_9B96C69F47ABD362` (`etude_id`),
  ADD KEY `IDX_9B96C69FD54FAE5E` (`titre_id`),
  ADD KEY `IDX_9B96C69FC5203672` (`membre_groupe_id`),
  ADD KEY `IDX_9B96C69FA76ED395` (`user_id`),
  ADD KEY `IDX_9B96C69FD725330D` (`agence_id`);

--
-- Index pour la table `individuelclient_compte_epargne`
--
ALTER TABLE `individuelclient_compte_epargne`
  ADD PRIMARY KEY (`individuelclient_id`,`compte_epargne_id`),
  ADD KEY `IDX_8246D5B14C27CDF` (`individuelclient_id`),
  ADD KEY `IDX_8246D5B2D4E37D3` (`compte_epargne_id`);

--
-- Index pour la table `journal_comptabilite`
--
ALTER TABLE `journal_comptabilite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `langue`
--
ALTER TABLE `langue`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `liste_rouge`
--
ALTER TABLE `liste_rouge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CD0B545AD0408C7` (`codegroupe_id`),
  ADD KEY `IDX_7CD0B545CEAA546A` (`codeclient_id`);

--
-- Index pour la table `mobile`
--
ALTER TABLE `mobile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3C7323E0B5AE1119` (`code_client_id`);

--
-- Index pour la table `produittransfert`
--
ALTER TABLE `produittransfert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1991DBC8EDF0C83D` (`compte1_id`),
  ADD KEY `IDX_1991DBC8FF4567D3` (`compte2_id`);

--
-- Index pour la table `produit_epargne`
--
ALTER TABLE `produit_epargne`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67610235F8593E48` (`type_epargne_id`);

--
-- Index pour la table `suivi_client`
--
ALTER TABLE `suivi_client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `titre`
--
ALTER TABLE `titre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transfertep`
--
ALTER TABLE `transfertep`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transfert_produit`
--
ALTER TABLE `transfert_produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BCF83C4EE4059086` (`produitatransferer_id`),
  ADD KEY `IDX_BCF83C4E8E88FB7D` (`produittransmis_id`),
  ADD KEY `IDX_BCF83C4EF2C56620` (`compte_id`);

--
-- Index pour la table `type_epargne`
--
ALTER TABLE `type_epargne`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `approbationcredit`
--
ALTER TABLE `approbationcredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `approuver_client`
--
ALTER TABLE `approuver_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client_mobile`
--
ALTER TABLE `client_mobile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commune`
--
ALTER TABLE `commune`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1646;

--
-- AUTO_INCREMENT pour la table `compte_epargne`
--
ALTER TABLE `compte_epargne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `config_ep`
--
ALTER TABLE `config_ep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `depot_aterme`
--
ALTER TABLE `depot_aterme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `devise`
--
ALTER TABLE `devise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `etatcivile`
--
ALTER TABLE `etatcivile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `etude`
--
ALTER TABLE `etude`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `individuelclient`
--
ALTER TABLE `individuelclient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `journal_comptabilite`
--
ALTER TABLE `journal_comptabilite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `langue`
--
ALTER TABLE `langue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `liste_rouge`
--
ALTER TABLE `liste_rouge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mobile`
--
ALTER TABLE `mobile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produittransfert`
--
ALTER TABLE `produittransfert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit_epargne`
--
ALTER TABLE `produit_epargne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `suivi_client`
--
ALTER TABLE `suivi_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `titre`
--
ALTER TABLE `titre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `transfertep`
--
ALTER TABLE `transfertep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `transfert_produit`
--
ALTER TABLE `transfert_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_epargne`
--
ALTER TABLE `type_epargne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `approuver_client`
--
ALTER TABLE `approuver_client`
  ADD CONSTRAINT `FK_387761DCCEAA546A` FOREIGN KEY (`codeclient_id`) REFERENCES `individuelclient` (`id`);

--
-- Contraintes pour la table `compte_epargne`
--
ALTER TABLE `compte_epargne`
  ADD CONSTRAINT `FK_19FDB51ACEAA546A` FOREIGN KEY (`codeclient_id`) REFERENCES `individuelclient` (`id`),
  ADD CONSTRAINT `FK_19FDB51AF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit_epargne` (`id`);

--
-- Contraintes pour la table `config_ep`
--
ALTER TABLE `config_ep`
  ADD CONSTRAINT `FK_92B49DF24C62D160` FOREIGN KEY (`produit_epargne_id`) REFERENCES `produit_epargne` (`id`),
  ADD CONSTRAINT `FK_92B49DF2A6D70781` FOREIGN KEY (`deviseutiliser_id`) REFERENCES `devise` (`id`);

--
-- Contraintes pour la table `depot_aterme`
--
ALTER TABLE `depot_aterme`
  ADD CONSTRAINT `FK_80EAC779F2C56620` FOREIGN KEY (`compte_id`) REFERENCES `individuelclient` (`id`),
  ADD CONSTRAINT `FK_80EAC779F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit_epargne` (`id`);

--
-- Contraintes pour la table `individuelclient`
--
ALTER TABLE `individuelclient`
  ADD CONSTRAINT `FK_9B96C69F47ABD362` FOREIGN KEY (`etude_id`) REFERENCES `etude` (`id`),
  ADD CONSTRAINT `FK_9B96C69F962FC573` FOREIGN KEY (`etatcivile_id`) REFERENCES `etatcivile` (`id`),
  ADD CONSTRAINT `FK_9B96C69FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9B96C69FC5203672` FOREIGN KEY (`membre_groupe_id`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `FK_9B96C69FD54FAE5E` FOREIGN KEY (`titre_id`) REFERENCES `titre` (`id`),
  ADD CONSTRAINT `FK_9B96C69FD725330D` FOREIGN KEY (`agence_id`) REFERENCES `agence` (`id`);

--
-- Contraintes pour la table `individuelclient_compte_epargne`
--
ALTER TABLE `individuelclient_compte_epargne`
  ADD CONSTRAINT `FK_8246D5B14C27CDF` FOREIGN KEY (`individuelclient_id`) REFERENCES `individuelclient` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8246D5B2D4E37D3` FOREIGN KEY (`compte_epargne_id`) REFERENCES `compte_epargne` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `liste_rouge`
--
ALTER TABLE `liste_rouge`
  ADD CONSTRAINT `FK_7CD0B545AD0408C7` FOREIGN KEY (`codegroupe_id`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `FK_7CD0B545CEAA546A` FOREIGN KEY (`codeclient_id`) REFERENCES `individuelclient` (`id`);

--
-- Contraintes pour la table `mobile`
--
ALTER TABLE `mobile`
  ADD CONSTRAINT `FK_3C7323E0B5AE1119` FOREIGN KEY (`code_client_id`) REFERENCES `individuelclient` (`id`);

--
-- Contraintes pour la table `produittransfert`
--
ALTER TABLE `produittransfert`
  ADD CONSTRAINT `FK_1991DBC8EDF0C83D` FOREIGN KEY (`compte1_id`) REFERENCES `compte_epargne` (`id`),
  ADD CONSTRAINT `FK_1991DBC8FF4567D3` FOREIGN KEY (`compte2_id`) REFERENCES `compte_epargne` (`id`);

--
-- Contraintes pour la table `produit_epargne`
--
ALTER TABLE `produit_epargne`
  ADD CONSTRAINT `FK_67610235F8593E48` FOREIGN KEY (`type_epargne_id`) REFERENCES `type_epargne` (`id`);

--
-- Contraintes pour la table `transfert_produit`
--
ALTER TABLE `transfert_produit`
  ADD CONSTRAINT `FK_BCF83C4E8E88FB7D` FOREIGN KEY (`produittransmis_id`) REFERENCES `compte_epargne` (`id`),
  ADD CONSTRAINT `FK_BCF83C4EE4059086` FOREIGN KEY (`produitatransferer_id`) REFERENCES `compte_epargne` (`id`),
  ADD CONSTRAINT `FK_BCF83C4EF2C56620` FOREIGN KEY (`compte_id`) REFERENCES `compte_epargne` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
