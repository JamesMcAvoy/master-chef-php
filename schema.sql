SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `resto` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `resto`;

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `ingredient_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `preservation` enum('frozen product','fresh product','long lasting product') DEFAULT NULL,
  PRIMARY KEY (`ingredient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

INSERT INTO `ingredients` (`ingredient_id`, `name`, `stock`, `preservation`) VALUES
(1, 'crabe', 80, 'frozen product'),
(2, 'thon', 80, 'frozen product'),
(3, 'oeuf', 500, 'fresh product'),
(4, 'saumon', 100, 'frozen product'),
(5, 'carotte', 200, 'long lasting product'),
(6, 'orange', 500, 'long lasting product'),
(7, 'pomme de terre', 1000, 'long lasting product'),
(8, 'melon', 500, 'long lasting product'),
(9, 'jambon', 1200, 'frozen product'),
(10, 'crêpes', 400, 'fresh product'),
(11, 'poulet', 400, 'frozen product'),
(12, 'steack', 200, 'frozen product'),
(13, 'pain burger', 300, 'fresh product'),
(14, 'frites', 1000, NULL),
(15, 'nuggets', 800, NULL),
(16, 'spaghettis', 800, 'fresh product'),
(17, 'tiramisu', 200, 'frozen product'),
(18, 'madeleine', 300, 'long lasting product'),
(19, 'chocolat', 400, 'fresh product'),
(20, 'framboise', 200, 'fresh product'),
(21, 'citron', 200, 'frozen product'),
(22, 'crème légère', 300, 'frozen product'),
(23, 'pancake', 1000, 'fresh product'),
(24, 'glace', 200, 'frozen product');

DROP TABLE IF EXISTS `list`;
CREATE TABLE IF NOT EXISTS `list` (
  `recipe_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`recipe_id`,`ingredient_id`),
  KEY `list_ingredients0_FK` (`ingredient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `list` (`recipe_id`, `ingredient_id`, `number`) VALUES
(1, 1, 1),
(2, 3, 2),
(3, 2, 2),
(4, 1, 1),
(4, 10, 1),
(5, 3, 1),
(6, 16, 3),
(6, 2, 1),
(7, 5, 2),
(7, 6, 1),
(8, 7, 2),
(9, 4, 2),
(10, 8, 1),
(10, 9, 3),
(11, 11, 1),
(11, 10, 2),
(12, 12, 1),
(12, 13, 2),
(12, 9, 1),
(13, 11, 1),
(14, 12, 1),
(14, 13, 2),
(15, 13, 2),
(15, 4, 1),
(16, 12, 1),
(16, 14, 5),
(17, 15, 5),
(17, 14, 5),
(18, 16, 5),
(19, 4, 2),
(19, 14, 5),
(20, 13, 2),
(20, 4, 1),
(21, 10, 2),
(22, 17, 1),
(22, 3, 1),
(23, 18, 3),
(24, 21, 1),
(24, 19, 1),
(24, 22, 1),
(25, 20, 5),
(25, 21, 1),
(26, 22, 1),
(26, 21, 1),
(27, 19, 5),
(28, 23, 5),
(28, 21, 1),
(29, 20, 5),
(29, 5, 1),
(30, 24, 5),
(30, 19, 3);

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `recipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `preparation_time` int(11) NOT NULL,
  `cooking_time` int(11) NOT NULL,
  `sleeping_time` int(11) NOT NULL,
  `type` enum('entree','dish','dessert') NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`recipe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

INSERT INTO `recipes` (`recipe_id`, `description`, `preparation_time`, `cooking_time`, `sleeping_time`, `type`, `stock`) VALUES
(1, 'Feuilleté au crabe', 10, 0, 0, 'entree', 0),
(2, 'Œufs cocotte', 0, 5, 0, 'entree', 0),
(3, 'Tarte au thon', 5, 5, 0, 'entree', 0),
(4, 'Pics apéritifs de roulés de crêpes au saumon', 5, 0, 0, 'entree', 0),
(5, 'Œufs à la coque', 5, 0, 0, 'entree', 0),
(6, 'Salades de pâtes au thon', 5, 0, 0, 'entree', 0),
(7, 'Carotte à l\'orange', 5, 0, 0, 'entree', 0),
(8, 'Pommes de terre surprise', 5, 0, 0, 'entree', 0),
(9, 'Cornets de saumon fumé', 5, 0, 0, 'entree', 0),
(10, 'Brochettes melon et jambon', 5, 0, 0, 'entree', 0),
(11, 'Crêpes poulet béchamel', 5, 10, 0, 'dish', 0),
(12, 'Burger steack bacon', 0, 10, 0, 'dish', 0),
(13, 'Blancs de poulet à la crème et au miel', 5, 10, 0, 'dish', 0),
(14, 'Burger double steack', 0, 10, 0, 'dish', 0),
(15, 'Burger saumon', 0, 10, 0, 'dish', 0),
(16, 'steak frites', 0, 10, 0, 'dish', 0),
(17, 'Nuggets frites', 0, 10, 0, 'dish', 0),
(18, 'Spaguetti bolognaise', 0, 10, 0, 'dish', 0),
(19, 'Fish ans chips', 0, 10, 0, 'dish', 0),
(20, 'Burger fish', 0, 10, 0, 'dish', 0),
(21, 'Crêpes', 5, 0, 5, 'dessert', 0),
(22, 'Tiramisu', 5, 0, 15, 'dessert', 0),
(23, 'Madeleine au miel', 5, 0, 5, 'dessert', 0),
(24, 'Gateau fondant au chocolat', 5, 1, 9, 'dessert', 0),
(25, 'Framboise et citron', 5, 0, 5, 'dessert', 0),
(26, 'Crème dessert légère', 5, 0, 5, 'dessert', 0),
(27, 'Mousse au chocolat', 5, 0, 5, 'dessert', 0),
(28, 'Pancakes', 5, 5, 5, 'dessert', 0),
(29, 'Salade de fruits d\'été', 5, 0, 0, 'dessert', 0),
(30, 'Glace chocolat', 5, 0, 5, 'dessert', 0);
COMMIT;
