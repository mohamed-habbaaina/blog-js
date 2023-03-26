-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 26 mars 2023 à 13:06
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog_js`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `edit_date` datetime DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `image`, `creation_date`, `edit_date`, `user_id`, `category_id`) VALUES
(1, 'Aubergines farcies', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iure  in  reiciendis corrupti hic nam dolore amet modi beatae blanditiis ab eius sequi soluta, repudiandae vel! Sunt, voluptas!', 'article_thumbnail_1.jpeg', '2023-03-14 13:07:46', NULL, 1, 3),
(3, 'Tzatziki: la sauce grecque traditionnelle', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iure  in  reiciendis corrupti hic nam dolore amet modi beatae blanditiis ab eius sequi soluta, repudiandae vel! Sunt, voluptas!', 'article_thumbnail_3.jpeg', '2023-03-14 13:10:03', NULL, 1, 3),
(7, 'Spaghetti Carbonara', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iure in reiciendis corrupti hic nam dolore amet modi beatae blanditiis ab eius sequi soluta, repudiandae vel! Sunt, voluptas!', 'article_thumbnail_7.jpeg', '2023-03-14 13:22:02', NULL, 9, 2),
(8, 'Ravioli, Tortellini et Agnolotti', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iure in reiciendis corrupti hic nam dolore amet modi beatae blanditiis ab eius sequi soluta, repudiandae vel! Sunt, voluptas!', 'article_thumbnail_8.jpeg', '2023-03-14 13:22:02', NULL, 9, 2),
(12, 'Horiatiki, la salade grecque', 'La salade grecque est l’entrée incontournable de la cuisine du pays que l’on retrouve sur toutes les tables. D’une fraîcheur absolue elle est connue, appréciée et consommée partout dans le monde.', 'article_thumbnail_12.jpeg', '2023-03-14 21:48:18', NULL, 1, 3),
(129, 'Macaronis al ragu', 'Cette recette de pâtes typiquement italienne et très goûteuse, à base de viandes hachées, tomates, céleri, carottes, oignons et parmesan, vous changera des recettes classiques. Découvrez ce plat de pâtes traditionnel qui plaira à toute la famille !', 'article_thumbnail_128.webp', '2023-03-24 12:37:41', NULL, 5, 2),
(130, 'La pinza ou pinsa de Venise', 'Il s’agit d’un gâteau traditionnel que l’on prépare en Vénétie, en Frioul et dans certaines vallées près de Trente pendant les fêtes de Noël et en particulier pour l’Épiphanie. A cette occasion, on allume des feux de joie (qu’on appelle”panevinì” dans la zone de Treviso).\r\n\r\nIl semble que cette tradition dérive de rites purificatoires et propitiatoires de l’époque pré-chrétienne, quand les Celtes allumaient des feux pour gagner les bonnes grâces des divinités et brûlaient un pantin représentant le passé. Pendant que le feu brûlait, les paysans disposés en cercle, criaient et chantaient diverses formules de vœux.\r\n\r\nDe nos jours encore, on garde ce rituel, qui se déroule la veille de l’Épiphanie. La flamme symbolise toujours l’espoir et la volonté de brûler ce qui est vieux (en effet on brûle souvent “la vieille” posée au sommet du bûcher de bois). Quelquefois le bûcher est béni par un prêtre et le crépitement de l’eau bénite dans le feu est attribué au démon furieux qui s’enfuit. La direction de la fumée et des étincelles, soulevées exprès par les paysans au moyen d’une fourche, est interprétée comme un présage pour le futur. Plusieurs dictons populaires se réfèrent à ce rite.', 'article_thumbnail_129.webp', '2023-03-24 12:40:09', NULL, 5, 2),
(131, 'raviolis: ricotta et épinards', 'Les raviolis sont des pâtes fraîches farcies très renommées que vous pouvez goûter partout en Italie. Il en existe une grande variété. Dans chaque région, on les trouvent avec des noms différents, formes diverses et avec de multiples farce et assaisonnement .\r\n\r\nIl est donc assez difficile de remonter à leur lieu et époque d’origine. Selon la plupart des gens, ces pâtes fraîches sont nées en Ligurie et on les cite dans des documents écrits du XIIe siècle, en particulier dans le “Décaméron” de Boccace. En ces temps-là, elles étaient farcies avec des ingrédients très pauvres comme les herbes que la nature offrait spontanément.', 'article_thumbnail_130.webp', '2023-03-24 12:42:55', NULL, 5, 2),
(132, 'Rigatoni pesto rosso', 'Si vous êtes à la recherche d’un plat typique sicilien à base de pâtes, ces rigatoni au pesto rosso aux tomates séchées sont délicieusement parfaits ! Il s’agit d’un plat typique vraiment simple à préparer, avec des ingrédients savoureux, qui rappellent le soleil et la terre.', 'article_thumbnail_131.webp', '2023-03-24 12:45:43', NULL, 5, 2),
(133, 'Linguine à l’encre de seiche', 'Les linguine à l’encre de seiche représentent un classique de la gastronomie sicilienne. En effet, si cette recette était à l’origine celle d’humbles pêcheurs désireux de ne rien jeter de la seiche, elle est désormais reconnue et appréciée pour l’exceptionnel parfum de mer que l’encre donne à ce plat.', 'article_thumbnail_132.webp', '2023-03-24 12:47:29', NULL, 5, 2),
(135, 'Salade d’oranges', 'Cette recette traditionnelle de Sicile a un goût très délicat et particulier. C’est une entrée adaptée aux repas de la période de Noël, en plein milieu de la saison des agrumes, qui donne une touche d’élégance et d’originalité à la table. Toutefois, la salade d’oranges peut être dégustée à n’importe quel moment de l’année, puisque ces fruits sont toujours disponibles sur le marché. La Sicile ayant subi la domination arabe, la recette de la salade d’oranges naît probablement de la tradition culinaire arabe, qui considère l’orange comme l’un des éléments principaux d’un grand nombre de plats.', 'article_thumbnail_133.webp', '2023-03-24 12:51:36', NULL, 5, 2),
(136, 'Daube provençale mijotée', 'Cette recette de daube provençale est ma chouchoute, celle que je fais depuis toujours sans y déroger !\r\nD’ordinaire je faisais mijoter ma daube sur le gaz, mais je devais toujours interrompre la cuisson puis la reprendre afin d’obtenir la texture que je voulais, car mon gaz bien que réglé à la puissance minimum cuisait toujours trop fort. Ma grand-mère elle, la laissait mijoter doucement sur le poêle à mazout, elle n’avait donc pas de soucis à ce niveau là.\r\nEt puis ce week-end j’ai testé pour la première fois la cuisson de ma daube provençale au Délicook, et là : révélation ! Le mijotage de 4h a donné un résultat excellent, une viande fondante et qui se détache toute seule en filaments, une sauce qui enrobe généreusement les morceaux de viande et les rondelles de carottes cuites al-dente, du pur bonheur. Il faut dire que j’ai utilisé un Saint-Joseph comme vin pour faire ma sauce (non ne me jetez pas de pierres) car la bouteille était ouverte depuis le réveillon et qu’elle allait finir dans l’évier un jour ou l’autre vu que nous ne la buvions pas…\r\nSi vous vous étonnez à la lecture de cette recette de daube que je ne mentionne nulle part l’ajout de sel, c’est simplement qu’à mon goût, l’ajout d’olives en fin de cuisson sale suffisamment la daube. Mais ceci à condition d’utiliser des olives de Nyons ou bien encore des olives à la grecque !\r\nA oui dernière chose, cette recette demande que la viande marine au minimum 12h à l’avance, pensez-y avant de commencer la recette, la daube n’en sera que meilleure et la viande que plus fondante.', 'article_thumbnail_135.webp', '2023-03-24 13:00:53', NULL, 5, 1),
(137, 'Blanquette de veau', 'La blanquette de veau, c’est un des fleurons de la cuisine française … et je me rends compte que je n’avais pas publié jusqu’à présent de recette de blanquette ! Enfin ce n’est pas tout à fait exact car j’ai déjà partagé ici-même une blanquette de dinde ou encore une blanquette de saumon, mais jamais de blanquette classique.', 'article_thumbnail_136.webp', '2023-03-24 13:04:43', NULL, 5, 1),
(139, 'Moussaka', 'Ingrédients\r\nPour 10 personnes\r\n800 g de boeuf (ou d&#039;agneau haché)\r\n4 pommes de terre\r\n2 aubergines\r\n2 oignons (coupés en dés)\r\n400 ml d&#039;huile d&#039;olive extra-vierge\r\n2 cuillères à soupe de concentré de tomate\r\n2 gousses d&#039;ail (pressées)\r\n150 ml de vin rouge\r\n½ bouquet de persil (ciselé)\r\nSel\r\nPoivre\r\n1 l de lait\r\n125 g de farine\r\n125 g de beurre\r\n2 jaunes d&#039;oeufs\r\n½ cuillère à café de muscade moulue\r\nsel\r\npoivre', 'article_thumbnail_138.webp', '2023-03-24 13:13:41', NULL, 5, 3),
(140, 'Pizza Napolitaine Margherita', 'La pizza napolitaine est une spécialité culinaire traditionnelle de la ville de Naples. Depuis 2009, elle est protégée par le label de qualité Spécialité Traditionnelle Garantie (STG). On en distingue deux variantes : la Marinara et la Margherita, dont nous vous proposons la recette. Selon les critères du label, la Pizza Napoletana se présente sous forme arrondie au bord surélevé. Son diamètre ne doit pas dépasser 35 cm et sa partie centrale doit être garnie.', 'article_thumbnail_139.webp', '2023-03-24 13:17:32', NULL, 5, 2),
(141, 'Croque monsieur', 'Le croque monsieur est un sandwich chaud faisant parti de la gastronomie française qui peut-être décliné à l’infini.\r\n\r\nToutefois c’est dans sa version la plus authentique que je préfère le croque monsieur : avec sa couche de béchamel moelleuse et son dessus grillé !', 'article_thumbnail_140.webp', '2023-03-24 13:19:35', NULL, 5, 1),
(142, 'crêpes bretonnes', 'Parce que c’est facile à faire, que c’est convivial et en plus délicieux, voici la recette des crêpes bretonnes, légères et savoureuses, qui satisferont tous vos convives, amis et famille ! A accommoder avec de nombreuses garnitures (caramel au beurre salé, chocolat, confiture, crème de marron et j’en passe 🙂 !)', 'article_thumbnail_141.jpg', '2023-03-24 13:27:25', NULL, 5, 1),
(143, 'Spaghettis bolognaise', 'Escapade italienne avec les fameux et traditionnels spaghettis à la bolognaise (aka les &quot;bolo&quot;) que tout le monde aime ! De la viande hachée, revenue avec des tomates concassées, des échalotes (ou des oignons), du basilic, du romarin... Un délice pour les papilles, et pour les yeux ! Voilà une bonne petite recette pour la réussir à coup sûr. Suivez-la (ou regardez la recette simplifiée en vidéo) et savourez votre succès !', 'article_thumbnail_142.webp', '2023-03-24 13:33:21', NULL, 5, 2),
(144, 'La bouillabaisse traditionnelle', 'Les origines de la bouillabaisse remontent à la fondation de Massalia par les grecs. La population mangeait déjà un ragout de poissons concocté avec les restes ou les invendus des pêcheurs. Ce ragoût nommé Kakavia en grec ancien désigne une préparation particulière de la soupe de poissons.\r\n\r\nLa mythologie romaine évoque aussi ce plat. C’est celui que Vénus fait manger à Vulcain pour l’apaiser et l’endormir afin de rejoindre Mars en toute discrétion…\r\n\r\nLe nom de la bouillabaisse vient du provençal, mais plusieurs étymologies sont discutées : « bouiabaisso » ou « bolhabaissa » qui signifie abaisser l’ébullition, « quand ça bout tu baisses », « bouipeis peis » qui veut dire bouillir le poisson, qui bout en bas, en référence à la marmite posée au ras du sol.\r\n\r\nComme tous les grands mets d’aujourd’hui, la bouillabaisse était à l’origine un plat de pauvres. Réconfort des pêcheurs qui écumaient les calanques entre Marseille et Toulon, la bouillabaisse se dégustait au retour du labeur. Au bord de l’eau, ils faisaient chauffer un chaudron rempli d’eau de mer dans lequel ils jetaient tout ce qui se trouvait au fond de leur panier : poissons invendus, écrasés, abîmés … Le bouillon ainsi obtenu était consommé accompagné de croutons frottés à l’ail. Le poisson était mangé séparément avec la rouille ou bien de l’aïoli.\r\n\r\nLe Docteur Raoulx qui est l’auteur d’un ouvrage de référence sur la gastronomie provençale décrit un plat :\r\n\r\n« qui se prépare sur tout le littoral méditerranéen de la France. On peut dire qu’il y a tant de variantes à ce plat que de golfes, criques ou calanques le long de notre rivage et chaque propriétaire de cabanon proclame préparer, lui seul, la bouillabaisse authentique ».\r\n\r\nOn le voit, rien n’a changé… Le bon docteur résout également des questions existentielles : « doit on mettre des pommes de terre ? », « Non pour les marseillais, oui pour les toulonnais ». Un jugement sans appel.', 'article_thumbnail_143.jpg', '2023-03-24 14:07:13', NULL, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Cuisine Française', 'Cuisine Française'),
(2, 'Cuisine Italienne', 'Cuisine Italienne'),
(3, 'Cuisine Grecque', 'Cuisine Grecque'),
(45, 'libanaise', '\'Cuisine libanaise\'');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `edit_date` datetime DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `article_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `creation_date`, `edit_date`, `user_id`, `article_id`) VALUES
(5, 'salat', '2023-03-23 14:14:50', NULL, 5, 12);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `register_date` datetime NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `register_date`, `role`) VALUES
(1, 'mohamed.habbaaina@laplateforme.io', '$2y$12$5sVxP4SU/35PPtAZVrCtM.Q8FW3AsWN7Hor23YItur6AfK.sSs7c6', 'mohamed', '2023-03-10 21:38:37', 'admin'),
(5, 'mohamed.habbaaina@laplateforme.io', '$2y$12$zcae/KIUdaaFpc4I9VPve.aV24vfktwAVz063hNeun30ihl100PTa', 'admin', '2023-03-12 09:22:24', 'admin'),
(9, 'mohamed.habbaaina@laplateforme.io', '1234', 'totoAAA', '2023-03-12 09:52:31', 'moderateur'),
(39, 'aaa', '$2y$12$zcae/KIUdaaFpc4I9VPve.aV24vfktwAVz063hNeun30ihl100PTa', 'aaaa', '2023-03-20 11:38:47', 'user'),
(41, 'aaa', '$2y$12$zcae/KIUdaaFpc4I9VPve.aV24vfktwAVz063hNeun30ihl100PTa', 'aaa2', '2023-03-20 11:38:48', 'user'),
(42, 'aaa', '$2y$12$zcae/KIUdaaFpc4I9VPve.aV24vfktwAVz063hNeun30ihl100PTa', 'aaa3', '2023-03-20 11:38:48', 'user'),
(43, 'aaa', 'aaaaaa', '11111', '2023-03-20 11:38:48', 'user'),
(45, 'aaa', '$2y$12$zchf/obCAfbxzU8o1fw/b.iczZQvPb0nKrTSK.I9SBNPqOmsok.AS', 'aaaaqqq', '2023-03-20 11:38:48', 'user'),
(46, 'aaa', 'aaa', 'aaa7', '2023-03-20 11:38:48', 'user'),
(50, 'aaa', 'aaa', 'aaa10', '2023-03-20 11:38:48', 'moderateur'),
(52, 'mohamed.habbaaina@laplateforme.io', '$2y$12$bWQCMGXLSuJ1NxwnF3s7oO7yOtQ1EZTzuC5nFX2KyRuMwo./WgxkC', 'adminadmin', '2023-03-20 15:07:31', 'user'),
(53, 'mohamed.habbaaina@laplateforme.io', '$2y$12$WQthx6UqeDvkUslfK3qZSuiI6GVnD4bN469APQtp.vWLs03o4jYlm', 'malaye', '2023-03-20 20:45:27', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_articles_users` (`user_id`),
  ADD KEY `fk_articles_categories` (`category_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_users` (`user_id`),
  ADD KEY `fk_comments_articles` (`article_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_articles_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_articles_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
