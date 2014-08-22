-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 22 Août 2014 à 19:21
-- Version du serveur: 5.1.73
-- Version de PHP: 5.3.3-7+squeeze19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `camilleflorquin_collection`
--

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `favoris` int(11) DEFAULT '0',
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Contenu de la table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `title`, `date`, `img`, `favoris`, `description`) VALUES
(1, 1, 'Batman Forever', '2014-07-21 14:12:08', 'ef01183211a4dfe2955affbfff76975749ea02e4.jpg', 0, 'Batman Forever sur Gameboy est l''adaptation du film sorti en 1995. Vos ennemis sont l''Homme Mystère et Double-Face que vous rencontrerez à plusieurs reprises dans le jeu. '),
(14, 1, 'Rayman', '2014-08-07 08:56:43', 'rayman.jpg', 0, 'La nature et les habitants vivent en paix  jusqu''au jour où l''horrible Mister Dark le dérobe, plongeant le monde dans le chaos et les ténèbres. Rayman devra trouver et délivrer tous les toons puis anéantir Mister Dark.'),
(13, 1, 'Pokemon Crystal', '2014-08-02 19:54:57', 'pokemoncrystal.jpg', 0, 'Pokémon Version Argent est un jeu de rôle sorti sur Gameboy. Dirigez un dresseur de Pokémons qui doit devenir le meilleur d''entre tous. Retrouvez ici 351 Pokémons.'),
(11, 1, 'Pokemon Argent', '2014-08-02 16:52:39', 'pokemonargent.jpg', 0, 'Pokémon Version Argent est un jeu de rôle sorti sur Gameboy. Dirigez un dresseur de Pokémons qui doit devenir le meilleur d''entre tous. Retrouvez ici 251 Pokémons.'),
(10, 1, 'Pokemon Or', '2014-08-03 22:04:38', 'pokemonor.jpg', 0, 'Pokémon Version Argent est un jeu de rôle sorti sur Gameboy. Dirigez un dresseur de Pokémons qui doit devenir le meilleur d''entre tous. Retrouvez ici 251 Pokémons.'),
(9, 1, 'Pokemon Jaune', '2014-08-01 09:39:10', 'pokemonjaune.jpg', 0, 'Retrouvez la version Rouge et la version Bleu réunis avec 150 Pokemon. '),
(8, 1, 'Pokemon Bleu', '2014-08-01 09:28:12', 'pokemonbleu.jpg', 0, 'Pokémon est un jeu de rôle sorti sur Gameboy. Dirigez un dresseur de Pokémons qui doit devenir le meilleur d''entre tous. Pour cela, capturez des créatures et faites-les évoluer.'),
(7, 1, 'Pokemon Rouge', '2014-08-01 09:32:08', 'pokemonrouge.jpg', 0, 'Pokémon Rouge est un jeu de rôle sorti sur Gameboy. Dirigez un dresseur de Pokémons qui doit devenir le meilleur d''entre tous. Pour cela, capturez des créatures et faites-les évoluer.'),
(6, 1, 'Warioland', '2014-07-26 19:33:01', 'warioland.jpg', 0, 'Des pirates ont volé une statue de la princesse Peach. Wario veut la reprendre afin de la revendre à la famille royale pour une coquette somme. Wario voyage à travers un certain nombre de niveaux remplis d''action. '),
(5, 1, 'The Legend of Zelda: Link''s Awakening', '2014-07-22 11:34:26', 'zelda.jpg', 0, 'The Legend of Zelda: Link''s Awakening est un jeu vidéo d''action-aventure sorti en 1993 sur Game Boy, développé et édité par Nintendo2. Il est le premier opus de la série Zelda sur une console portable.'),
(4, 1, 'Yoshi''s Cookie', '2014-08-05 19:37:28', 'yoshiscookie.jpg', 0, 'Yoshi''s Cookie est un jeu peuplée de cookies de cinq types, disposés dans une grille rectangulaire. Le principal objectif de chaque niveau est de dégager le terrain de jeu de tous les cookies.'),
(3, 1, 'Donkey Kong', '2014-07-28 09:56:03', 'donkeykong.jpg', 0, 'Donkey Kong a capturé Pauline et le plombier se met en devoir de sauver la belle. Ce jeu est le successeur spirituel du Donkey Kong sorti en arcade en 1982.'),
(17, 1, 'Asterix', '2014-07-30 00:29:36', 'asterix.jpg', 0, 'Obélix a été capturé par les Romains! César compte bien le faire jeter aux lions, et c''est évidemment Astérix qui doit sauver son ami. Traversez de nombreux pays d''Europe et battez les Romains!\r\n'),
(18, 1, 'Ducktales', '2014-08-10 23:17:29', 'ducktales.jpg', 0, 'Vous contrôlez Picsou dans un jeu de plates-formes, et retrouvez les personnages secondaires de la série, comme Flagada le pilote, Mamie Baba, Zaza, Riri, Fifi et Loulou, qui vous offriront des conseils ou de l''aide.'),
(19, NULL, 'Fifa 96', '2014-08-07 11:19:42', 'fifa.jpg', 0, 'FIFA Soccer 96 est un jeu de football sur Gameboy. Le jeu propose onze ligues officielles ainsi que cinquante-neuf équipes internationales. '),
(21, NULL, 'Mighty Morphin Power Rangers', '2014-07-29 19:28:33', 'power.jpg', 0, 'Mighty Morphin Power Rangers sur Gameboy est un jeu de combat tiré de la série. Le joueur incarne l''un des combattants lors de combats contre les monstres de Rita. Au terme de l''affrontement, le monstre grandit...'),
(22, NULL, 'Scooby-Doo classic creep capers', '2014-08-17 03:04:49', 'scooby.jpg', 0, 'Retrouvez vos personnages tirés de la série. Suivez Shaggy et Scooby pour résoudre les mystères à travers différentes pièces...'),
(25, NULL, 'Harry Potter et la chamber des secrets', '2014-08-13 02:45:49', 'harry.jpg', 0, 'Harry Potter et la Chambre des Secrets est un jeu d''aventures. Retrouvez Harry et ses amis dans ce titre inspiré des secondes aventures du petit sorcier. En bonus, jouez au Quidditch.'),
(28, NULL, 'Dragon Ball Z : Les guerriers légendaires', '2014-08-14 02:50:32', 'dragon.jpg', 0, 'Est un jeu de combat/réflexion situé dans l''univers du manga. Les combats se déroulent en deux temps : une phase d''attaque et une de défense durant lesquelles il faut placer vos cartes efficacement pour remporter le duel.'),
(27, NULL, 'Titeuf', '2014-08-15 02:54:45', 'titeuf.jpg', 0, 'La photo de Nadia est en mille morceaux. Vous partez donc à la chasse au trésor : à chaque épreuve réussie, vous remportez un morceau du cliché. 21 épreuves n''attendent plus que vous.'),
(23, NULL, 'Looney Tunes Racing', '2014-08-16 02:58:52', 'looney.jpg', 0, 'Looney Tunes Racing est un jeu vidéo de course sorti en 2000 sur Game Boy Color.Le gameplay est assez semblable à celui de Mario Kart. D''ailleurs, les bonus ressemblent à ceux de Mario Kart.'),
(26, NULL, 'Le Roi Lion : la formidable aventure de Simba', '2014-08-16 03:01:59', 'lion.jpg', 0, 'Est un jeu de plates-formes sur Gameboy. Dans la peau de Simba, le gentil fils du roi Mufasa, vous effectuez un long périple à travers la jungle et les plaines africaines. Êtes-vous prêts à devenir roi de la Terre des Lions ?'),
(24, NULL, 'Toy Story Racer', '2014-08-18 03:09:55', 'toy.jpg', 0, 'Tiré du film, les fans vont adorer ce jeux. Jouez avec les différents caractères du film pour rouler le plus vite et attraper le drapeau.'),
(29, NULL, 'The Legend of Zelda oracle of ages', '2014-08-19 03:14:09', 'zelda-age.jpg', 0, ' Veran, la Sorcière des Ombres, a capturé l''Ordre des Ages afin semer la destruction dans l''univers. Vous incarnez Link et venez d''être invoqué en Labrynna par la Triforce. Réparez la trame temporelle et sauvez l''Oracle.'),
(20, NULL, 'Megaman IV', '2014-08-19 03:16:51', 'megaman.jpg', 0, 'Le professeur Wily s''empare des robots exposés et les reprogramme pour exécuter ses noirs desseins. Megaman, présent sur place, doit donc combattre les subordonnées de Wily. Mais c''est sans compter l''apparition surprise de Ballade.'),
(41, NULL, 'bla', '2014-08-08 00:00:00', 'a71768c13a3f97e251c6b1df78c96f997f25989a.jpg', 0, 'degggg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `name`, `email`, `password`, `img`) VALUES
(38, 'Beno', 'Benoit', 'benolondero@gmail.com', '*56AF049F421F876FC51F8C610E3EBEB1284DC2C2', 'img/user.jpg'),
(39, 'jean', 'jean', 'jean@jean.com', '*DA76C51812F702F9025B80CE2925EC29FBB63BDA', 'img/user.jpg'),
(37, 'bla', 'camille', 'bla@gmail.com', '*C3169F309AF706040A4C882A85A5BADB40FBC744', 'img/user.jpg');
