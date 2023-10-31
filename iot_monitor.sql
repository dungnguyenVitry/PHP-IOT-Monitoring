-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 25 oct. 2023 à 17:01
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `iot_monitor`
--

-- --------------------------------------------------------

--
-- Structure de la table `devices`
--

CREATE TABLE `devices` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` tinyint(4) DEFAULT 0,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `devices`
--

INSERT INTO `devices` (`id`, `name`, `type`, `description`) VALUES
(1, 'DHT11 Temperature Sensor', 1, 'device 1:\r\n my text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specim'),
(2, 'Buzzer', 2, 'Buzzer (Alarm)');

-- --------------------------------------------------------

--
-- Structure de la table `device_readings`
--

CREATE TABLE `device_readings` (
  `id` int(10) UNSIGNED NOT NULL,
  `device_id` int(10) UNSIGNED DEFAULT NULL,
  `reading` float UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `device_readings`
--

INSERT INTO `device_readings` (`id`, `device_id`, `reading`, `created_at`) VALUES
(960, 1, 82, '2023-10-25 14:06:37'),
(961, 1, 51, '2023-10-25 14:07:07'),
(962, 1, 51, '2023-10-25 14:07:37'),
(963, 1, 1, '2023-10-25 14:08:07'),
(964, 1, 78, '2023-10-25 14:08:37'),
(965, 1, 98, '2023-10-25 14:09:12'),
(966, 1, 98, '2023-10-25 14:15:25'),
(967, 1, 93, '2023-10-25 14:15:55'),
(968, 1, 46, '2023-10-25 14:15:56'),
(969, 1, 88, '2023-10-25 14:16:26'),
(970, 1, 66, '2023-10-25 14:16:56'),
(971, 1, 25, '2023-10-25 14:17:26'),
(972, 1, 92, '2023-10-25 14:17:56'),
(973, 1, 3, '2023-10-25 14:18:26'),
(974, 1, 45, '2023-10-25 14:23:29'),
(975, 1, 77, '2023-10-25 14:23:59'),
(976, 1, 80, '2023-10-25 14:24:28'),
(977, 1, 2, '2023-10-25 14:24:58'),
(978, 1, 45, '2023-10-25 14:25:28'),
(979, 1, 4, '2023-10-25 14:25:58'),
(980, 1, 69, '2023-10-25 14:26:28'),
(981, 1, 42, '2023-10-25 14:32:51'),
(982, 1, 29, '2023-10-25 14:33:21'),
(983, 1, 68, '2023-10-25 14:33:52'),
(984, 1, 49, '2023-10-25 14:33:52'),
(985, 1, 26, '2023-10-25 14:34:23'),
(986, 1, 79, '2023-10-25 14:34:53'),
(987, 1, 2, '2023-10-25 14:35:22'),
(988, 1, 75, '2023-10-25 14:35:53'),
(989, 1, 100, '2023-10-25 14:36:23'),
(990, 1, 16, '2023-10-25 14:41:08'),
(991, 1, 16, '2023-10-25 14:43:04'),
(992, 1, 78, '2023-10-25 14:43:35'),
(993, 1, 99, '2023-10-25 14:43:55'),
(994, 1, 78, '2023-10-25 14:44:02'),
(995, 1, 17, '2023-10-25 14:44:10'),
(996, 1, 85, '2023-10-25 14:44:40'),
(997, 1, 33, '2023-10-25 14:45:10'),
(998, 1, 92, '2023-10-25 14:45:40'),
(999, 1, 90, '2023-10-25 14:46:10'),
(1000, 1, 89, '2023-10-25 14:46:40'),
(1001, 1, 70, '2023-10-25 14:47:10'),
(1002, 1, 58, '2023-10-25 14:47:40'),
(1003, 1, 47, '2023-10-25 14:48:10'),
(1004, 1, 80, '2023-10-25 14:48:40'),
(1005, 1, 48, '2023-10-25 14:49:10'),
(1006, 1, 32, '2023-10-25 14:49:40'),
(1007, 1, 84, '2023-10-25 14:50:10'),
(1008, 1, 80, '2023-10-25 14:50:36'),
(1009, 1, 93, '2023-10-25 14:52:35'),
(1010, 2, 70, '2023-10-25 14:53:13'),
(1011, 2, 5, '2023-10-25 14:53:43'),
(1012, 2, 18, '2023-10-25 14:55:05'),
(1013, 2, 41, '2023-10-25 14:55:10');

-- --------------------------------------------------------

--
-- Structure de la table `device_status`
--

CREATE TABLE `device_status` (
  `id` int(11) NOT NULL,
  `status` enum('broken','working_well') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `device_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `device_status`
--

INSERT INTO `device_status` (`id`, `status`, `created_at`, `device_id`) VALUES
(361, 'working_well', '2023-10-25 14:06:37', 1),
(362, 'working_well', '2023-10-25 14:07:07', 1),
(363, 'working_well', '2023-10-25 14:07:37', 1),
(364, 'working_well', '2023-10-25 14:08:07', 1),
(365, 'working_well', '2023-10-25 14:08:37', 1),
(366, 'broken', '2023-10-25 14:09:07', 1),
(367, 'working_well', '2023-10-25 14:09:12', 1),
(368, 'working_well', '2023-10-25 14:15:24', 1),
(369, 'working_well', '2023-10-25 14:15:55', 1),
(370, 'working_well', '2023-10-25 14:15:56', 1),
(371, 'working_well', '2023-10-25 14:16:26', 1),
(372, 'working_well', '2023-10-25 14:16:56', 1),
(373, 'working_well', '2023-10-25 14:17:26', 1),
(374, 'working_well', '2023-10-25 14:17:56', 1),
(375, 'working_well', '2023-10-25 14:18:26', 1),
(376, 'broken', '2023-10-25 14:18:56', 1),
(377, 'working_well', '2023-10-25 14:23:29', 1),
(378, 'working_well', '2023-10-25 14:23:59', 1),
(379, 'working_well', '2023-10-25 14:24:28', 1),
(380, 'working_well', '2023-10-25 14:24:58', 1),
(381, 'working_well', '2023-10-25 14:25:28', 1),
(382, 'working_well', '2023-10-25 14:25:58', 1),
(383, 'working_well', '2023-10-25 14:26:28', 1),
(384, 'broken', '2023-10-25 14:26:58', 1),
(385, 'working_well', '2023-10-25 14:32:51', 1),
(386, 'working_well', '2023-10-25 14:33:21', 1),
(387, 'working_well', '2023-10-25 14:33:51', 1),
(388, 'working_well', '2023-10-25 14:33:52', 1),
(389, 'working_well', '2023-10-25 14:34:22', 1),
(390, 'working_well', '2023-10-25 14:34:53', 1),
(391, 'working_well', '2023-10-25 14:35:22', 1),
(392, 'working_well', '2023-10-25 14:35:52', 1),
(393, 'working_well', '2023-10-25 14:36:22', 1),
(394, 'broken', '2023-10-25 14:36:52', 1),
(395, 'working_well', '2023-10-25 14:41:07', 1),
(396, 'broken', '2023-10-25 14:41:37', 1),
(397, 'working_well', '2023-10-25 14:43:04', 1),
(398, 'working_well', '2023-10-25 14:43:34', 1),
(399, 'working_well', '2023-10-25 14:43:55', 1),
(400, 'working_well', '2023-10-25 14:44:02', 1),
(401, 'working_well', '2023-10-25 14:44:10', 1),
(402, 'working_well', '2023-10-25 14:44:40', 1),
(403, 'working_well', '2023-10-25 14:45:10', 1),
(404, 'working_well', '2023-10-25 14:45:40', 1),
(405, 'working_well', '2023-10-25 14:46:10', 1),
(406, 'working_well', '2023-10-25 14:46:40', 1),
(407, 'working_well', '2023-10-25 14:47:10', 1),
(408, 'working_well', '2023-10-25 14:47:40', 1),
(409, 'working_well', '2023-10-25 14:48:10', 1),
(410, 'working_well', '2023-10-25 14:48:40', 1),
(411, 'working_well', '2023-10-25 14:49:10', 1),
(412, 'working_well', '2023-10-25 14:49:40', 1),
(413, 'working_well', '2023-10-25 14:50:10', 1),
(414, 'working_well', '2023-10-25 14:50:36', 1),
(415, 'broken', '2023-10-25 14:51:06', 1),
(416, 'working_well', '2023-10-25 14:52:35', 1),
(417, 'working_well', '2023-10-25 14:53:13', 2),
(418, 'working_well', '2023-10-25 14:53:43', 2),
(419, 'broken', '2023-10-25 14:54:13', 2),
(420, 'broken', '2023-10-25 14:54:50', 2),
(421, 'working_well', '2023-10-25 14:55:05', 2),
(422, 'working_well', '2023-10-25 14:55:10', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `device_readings`
--
ALTER TABLE `device_readings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `device_id` (`device_id`);

--
-- Index pour la table `device_status`
--
ALTER TABLE `device_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `device_readings`
--
ALTER TABLE `device_readings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1014;

--
-- AUTO_INCREMENT pour la table `device_status`
--
ALTER TABLE `device_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=423;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `device_readings`
--
ALTER TABLE `device_readings`
  ADD CONSTRAINT `device_readings_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
