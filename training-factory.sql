-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 21 jun 2023 om 00:44
-- Serverversie: 10.4.21-MariaDB
-- PHP-versie: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training-factory`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230619130440', '2023-06-19 13:05:00', 90),
('DoctrineMigrations\\Version20230620203842', '2023-06-20 20:38:52', 93),
('DoctrineMigrations\\Version20230620204032', '2023-06-20 20:40:40', 33),
('DoctrineMigrations\\Version20230620204221', '2023-06-20 20:42:29', 167);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lessen`
--

CREATE TABLE `lessen` (
  `id` int(11) NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `training_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `lessen`
--

INSERT INTO `lessen` (`id`, `time`, `date`, `location`, `training_id`) VALUES
(1, '18 uur', '23 Juni 2023', 'Training Factory Den Haag', 1),
(2, '19 uur', '24 Juni 2023', 'Training Factory Den Haag', 2),
(3, '15 uur', '25 Juni 2023', 'Training Factory Den Haag', 1),
(4, '16 uur', '26 Juni 2023', 'Training Factory Den Haag', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `training`
--

INSERT INTO `training` (`id`, `name`, `description`) VALUES
(1, 'fitness', 'Gebruik maken van sportapparaten voor het bouwen van conditie en kracht.'),
(2, 'boksen', 'vechtsport waarbij je alleen je handen gebruikt.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'klaas@rocmondriaan.nl', '[\"ROLE_KLANT\"]', '$2y$13$twfngxMhTre0NtAUSvB4xe.I4h.ghFV2sVL.9YiFrcFA1Z2vGNqw6'),
(2, 'admin@rocmondriaan.nl', '[\"ROLE_ADMIN\"]', '$2y$13$KnFe.xplvQAk84XWFGz47eJ2VQLN2QcX/OhnLDqodvhJgYmJCGd0C'),
(3, 'instructeur@rocmondriaan.nl', '[\"ROLE_INSTRUCTEUR\"]', '$2y$13$ZYDkjd8Ex.Rv1bdjMPtVR.DLh0ooDSqD9gcELIVrYK1iIxP.Ok1qa'),
(4, 'mohammed@rocmondriaan.nl', '[\"ROLE_KLANT\"]', '$argon2id$v=19$m=65536,t=4,p=1$ttc8VHfCyPTETSL7XR/HOA$rVQaREVhLkLtHzW1mYMmZO+Z5KUkZ+qClDU4y85VNfg');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `lessen`
--
ALTER TABLE `lessen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_29B9C79BEFD98D1` (`training_id`);

--
-- Indexen voor tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexen voor tabel `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `lessen`
--
ALTER TABLE `lessen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `lessen`
--
ALTER TABLE `lessen`
  ADD CONSTRAINT `FK_29B9C79BEFD98D1` FOREIGN KEY (`training_id`) REFERENCES `training` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
