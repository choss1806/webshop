-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2023 at 09:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--
CREATE DATABASE
IF NOT EXISTS `webshop` DEFAULT CHARACTER
SET utf8mb4
COLLATE utf8mb4_general_ci;
USE `webshop`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `spGetAllProducts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetAllProducts`
(IN `p_price_list_id` INT, IN `p_user_id` INT)
BEGIN
  DECLARE q1 LONGTEXT;
DECLARE q2 LONGTEXT;
DECLARE q3 LONGTEXT;

CREATE TEMPORARY TABLE temporary_Data
(
    id INT,
    name VARCHAR
(255),
    description LONGTEXT,
    price DECIMAL
(8, 2),
    sku VARCHAR
(255),
    published TINYINT
(1)
);

SET q1
= "INSERT INTO temporary_Data ";

IF p_user_id > 0 && p_price_list_id > 0 THEN
SET q2
= CONCAT
("SELECT product.id, product.name, product.description, contract_list.price, product.sku, product.published FROM product INNER JOIN contract_list ON product.id = contract_list.product_id WHERE contract_list.user_id = ", p_user_id," UNION SELECT product.id, product.name, product.description, price_list_items.price, product.sku, product.published FROM product INNER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON price_list_items.product_id = contract_list.product_id WHERE(price_list_items.price_list_id = ", p_price_list_id, ") AND (contract_list.user_id IS NULL OR contract_list.user_id <> ", p_user_id, ") UNION SELECT product.id, product.name, product.description, product.price, product.sku, product.published
FROM product LEFT OUTER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON product.id = contract_list.product_id WHERE (contract_list.price IS NULL) AND (price_list_items.price_list_id IS NULL) ORDER BY id ASC;");
ELSEIF p_user_id > 0 && p_price_list_id = 0 THEN
SET q2
= CONCAT
("SELECT product.id, product.name, product.description, contract_list.price, product.sku, product.published FROM product INNER JOIN contract_list ON product.id = contract_list.product_id WHERE contract_list.user_id = ", p_user_id, " UNION SELECT product.id, product.name, product.description, product.price, product.sku, product.published FROM product LEFT OUTER JOIN contract_list ON product.id = contract_list.product_id WHERE (contract_list.user_id <> ", p_user_id, ") OR (contract_list.price IS NULL) ORDER BY id ASC;");
ELSEIF p_user_id = 0 && p_price_list_id > 0 THEN
SET q2
= CONCAT
("SELECT product.id, product.name, product.description, contract_list.price, product.sku, product.published FROM product INNER JOIN contract_list ON product.id = contract_list.product_id WHERE contract_list.user_id = ", p_user_id," UNION SELECT product.id, product.name, product.description, price_list_items.price, product.sku, product.published FROM product INNER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON price_list_items.product_id = contract_list.product_id WHERE(price_list_items.price_list_id = ", 1, ") AND (contract_list.user_id IS NULL OR contract_list.user_id <> ", p_user_id, ") UNION SELECT product.id, product.name, product.description, product.price, product.sku, product.published
FROM product LEFT OUTER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON product.id = contract_list.product_id WHERE (contract_list.price IS NULL) AND (price_list_items.price_list_id IS NULL) ORDER BY id ASC;");
ELSE
SET q2
= CONCAT
("SELECT * from product ORDER BY id ASC; ");
END
IF;

SET q3
= CONCAT
(q1, q2);

PREPARE stmt FROM q3;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
SELECT
  *
FROM
  temporary_Data;
END$$

DROP PROCEDURE IF EXISTS `spGetProductById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetProductById`
(IN `p_price_list_id` INT, IN `p_user_id` INT, IN `p_product_id` INT)
BEGIN
  DECLARE q1 LONGTEXT;
DECLARE q2 LONGTEXT;
DECLARE q3 LONGTEXT;

CREATE TEMPORARY TABLE temporary_Data
(
    id INT,
    name VARCHAR
(255),
    description LONGTEXT,
    price DECIMAL
(8, 2),
    sku VARCHAR
(255),
    published TINYINT
(1)
);

SET q1
= "INSERT INTO temporary_Data ";

IF p_user_id > 0 && p_price_list_id > 0 THEN
SET q2
= CONCAT
("SELECT product.id, product.name, product.description, contract_list.price, product.sku, product.published FROM product INNER JOIN contract_list ON product.id = contract_list.product_id WHERE contract_list.user_id = ", p_user_id," UNION SELECT product.id, product.name, product.description, price_list_items.price, product.sku, product.published FROM product INNER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON price_list_items.product_id = contract_list.product_id WHERE(price_list_items.price_list_id = ", p_price_list_id, ") AND (contract_list.user_id IS NULL OR contract_list.user_id <> ", p_user_id, ") UNION SELECT product.id, product.name, product.description, product.price, product.sku, product.published
FROM product LEFT OUTER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON product.id = contract_list.product_id WHERE (contract_list.price IS NULL) AND (price_list_items.price_list_id IS NULL) ORDER BY id ASC;");
ELSEIF p_user_id > 0 && p_price_list_id = 0 THEN
SET q2
= CONCAT
("SELECT product.id, product.name, product.description, contract_list.price, product.sku, product.published FROM product INNER JOIN contract_list ON product.id = contract_list.product_id WHERE contract_list.user_id = ", p_user_id, " UNION SELECT product.id, product.name, product.description, product.price, product.sku, product.published FROM product LEFT OUTER JOIN contract_list ON product.id = contract_list.product_id WHERE (contract_list.user_id <> ", p_user_id, ") OR (contract_list.price IS NULL) ORDER BY id ASC;");
ELSEIF p_user_id = 0 && p_price_list_id > 0 THEN
SET q2
= CONCAT
("SELECT product.id, product.name, product.description, contract_list.price, product.sku, product.published FROM product INNER JOIN contract_list ON product.id = contract_list.product_id WHERE contract_list.user_id = ", p_user_id," UNION SELECT product.id, product.name, product.description, price_list_items.price, product.sku, product.published FROM product INNER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON price_list_items.product_id = contract_list.product_id WHERE(price_list_items.price_list_id = 1) AND (contract_list.user_id IS NULL OR contract_list.user_id <> ", p_user_id, ") UNION SELECT product.id, product.name, product.description, product.price, product.sku, product.published
FROM product LEFT OUTER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON product.id = contract_list.product_id WHERE (contract_list.price IS NULL) AND (price_list_items.price_list_id IS NULL) ORDER BY id ASC;");
ELSE
SET q2
= CONCAT
("SELECT * from product ORDER BY id ASC; ");
END
IF;

SET q3
= CONCAT
(q1, q2);

PREPARE stmt FROM q3;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
SELECT *
FROM temporary_Data
WHERE id = p_product_id;
END$$

DROP PROCEDURE IF EXISTS `spGetProductsByCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetProductsByCategory`
(IN `p_price_list_id` INT, IN `p_user_id` INT, IN `p_category_ids` VARCHAR
(255))
BEGIN
  DECLARE q1 LONGTEXT;
DECLARE q2 LONGTEXT;
DECLARE q3 LONGTEXT;

CREATE TEMPORARY TABLE temporary_Data
(
    id INT,
    name VARCHAR
(255),
    description LONGTEXT,
    price DECIMAL
(8, 2),
    sku VARCHAR
(255),
    published TINYINT
(1)
);

SET q1
= "INSERT INTO temporary_Data ";

IF p_user_id > 0 && p_price_list_id > 0 THEN
SET q2
= CONCAT
("SELECT product.id, product.name, product.description, contract_list.price, product.sku, product.published FROM product INNER JOIN contract_list ON product.id = contract_list.product_id WHERE contract_list.user_id = ", p_user_id," UNION SELECT product.id, product.name, product.description, price_list_items.price, product.sku, product.published FROM product INNER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON price_list_items.product_id = contract_list.product_id WHERE(price_list_items.price_list_id = ", p_price_list_id, ") AND (contract_list.user_id IS NULL OR contract_list.user_id <> ", p_user_id, ") UNION SELECT product.id, product.name, product.description, product.price, product.sku, product.published
FROM product LEFT OUTER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON product.id = contract_list.product_id WHERE (contract_list.price IS NULL) AND (price_list_items.price_list_id IS NULL) ORDER BY id ASC;");
ELSEIF p_user_id > 0 && p_price_list_id = 0 THEN
SET q2
= CONCAT
("SELECT product.id, product.name, product.description, contract_list.price, product.sku, product.published FROM product INNER JOIN contract_list ON product.id = contract_list.product_id WHERE contract_list.user_id = ", p_user_id, " UNION SELECT product.id, product.name, product.description, product.price, product.sku, product.published FROM product LEFT OUTER JOIN contract_list ON product.id = contract_list.product_id WHERE (contract_list.user_id <> ", p_user_id, ") OR (contract_list.price IS NULL) ORDER BY id ASC;");
ELSEIF p_user_id = 0 && p_price_list_id > 0 THEN
SET q2
= CONCAT
("SELECT product.id, product.name, product.description, contract_list.price, product.sku, product.published FROM product INNER JOIN contract_list ON product.id = contract_list.product_id WHERE contract_list.user_id = ", p_user_id," UNION SELECT product.id, product.name, product.description, price_list_items.price, product.sku, product.published FROM product INNER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON price_list_items.product_id = contract_list.product_id WHERE(price_list_items.price_list_id = ", 1, ") AND (contract_list.user_id IS NULL OR contract_list.user_id <> ", p_user_id, ") UNION SELECT product.id, product.name, product.description, product.price, product.sku, product.published
FROM product LEFT OUTER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON product.id = contract_list.product_id WHERE (contract_list.price IS NULL) AND (price_list_items.price_list_id IS NULL) ORDER BY id ASC;");
ELSE
SET q2
= CONCAT
("SELECT * from product ORDER BY id ASC; ");
END
IF;

SET q3
= CONCAT
(q1, q2);

PREPARE stmt FROM q3;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
SELECT
  *
FROM
  temporary_Data
  INNER JOIN product_category ON temporary_Data.id = product_category.product_id
WHERE product_category.category_id IN (p_category_ids);
END$$

DROP PROCEDURE IF EXISTS `spGetProdutcsBySearch`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetProdutcsBySearch`
(IN `p_price_list_id` INT, IN `p_user_id` INT, IN `p_search_name` VARCHAR
(255), IN `p_search_category` INT, IN `p_sort_by` VARCHAR
(255), IN `p_sort_order` VARCHAR
(255), IN `p_price_min` INT, IN `p_price_max` INT)
BEGIN
  DECLARE q LONGTEXT;
DECLARE category LONGTEXT;
DECLARE price LONGTEXT;
DECLARE q1 LONGTEXT;
DECLARE q2 LONGTEXT;
DECLARE q3 LONGTEXT;

CREATE TEMPORARY TABLE temporary_Data
(
    id INT,
    name VARCHAR
(255),
    description LONGTEXT,
    price DECIMAL
(8, 2),
    sku VARCHAR
(255),
    published TINYINT
(1)
);

SET q1
= "INSERT INTO temporary_Data ";

IF p_user_id > 0 && p_price_list_id > 0 THEN
SET q2
= CONCAT
("SELECT product.id, product.name, product.description, contract_list.price, product.sku, product.published FROM product INNER JOIN contract_list ON product.id = contract_list.product_id WHERE contract_list.user_id = ", p_user_id," UNION SELECT product.id, product.name, product.description, price_list_items.price, product.sku, product.published FROM product INNER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON price_list_items.product_id = contract_list.product_id WHERE(price_list_items.price_list_id = ", p_price_list_id, ") AND (contract_list.user_id IS NULL OR contract_list.user_id <> ", p_user_id, ") UNION SELECT product.id, product.name, product.description, product.price, product.sku, product.published
FROM product LEFT OUTER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON product.id = contract_list.product_id WHERE (contract_list.price IS NULL) AND (price_list_items.price_list_id IS NULL) ORDER BY id ASC;");
ELSEIF p_user_id > 0 && p_price_list_id = 0 THEN
SET q2
= CONCAT
("SELECT product.id, product.name, product.description, contract_list.price, product.sku, product.published FROM product INNER JOIN contract_list ON product.id = contract_list.product_id WHERE contract_list.user_id = ", p_user_id, " UNION SELECT product.id, product.name, product.description, product.price, product.sku, product.published FROM product LEFT OUTER JOIN contract_list ON product.id = contract_list.product_id WHERE (contract_list.user_id <> ", p_user_id, ") OR (contract_list.price IS NULL) ORDER BY id ASC;");
ELSEIF p_user_id = 0 && p_price_list_id > 0 THEN
SET q2
= CONCAT
("SELECT product.id, product.name, product.description, contract_list.price, product.sku, product.published FROM product INNER JOIN contract_list ON product.id = contract_list.product_id WHERE contract_list.user_id = ", p_user_id," UNION SELECT product.id, product.name, product.description, price_list_items.price, product.sku, product.published FROM product INNER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON price_list_items.product_id = contract_list.product_id WHERE(price_list_items.price_list_id = ", 1, ") AND (contract_list.user_id IS NULL OR contract_list.user_id <> ", p_user_id, ") UNION SELECT product.id, product.name, product.description, product.price, product.sku, product.published
FROM product LEFT OUTER JOIN price_list_items ON product.id = price_list_items.product_id LEFT OUTER JOIN contract_list ON product.id = contract_list.product_id WHERE (contract_list.price IS NULL) AND (price_list_items.price_list_id IS NULL) ORDER BY id ASC;");
ELSE
SET q2
= CONCAT
("SELECT * from product ORDER BY id ASC; ");
END
IF;

SET q3
= CONCAT
(q1, q2);

PREPARE stmt FROM q3;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

IF p_search_category > 0 THEN
SET category
= CONCAT
(" AND product_category.category_id=", p_search_category, " ");
ELSE
SET category
= "";
END
IF;

IF p_price_min > 0 && p_price_max > 0 THEN
SET price
= CONCAT
(" AND temporary_data.price BETWEEN ", p_price_min, " AND ", p_price_max, " ");
ELSEIF p_price_min > 0 && p_price_max = 0 THEN
SET price
= CONCAT
(" AND temporary_data.price >= ", p_price_min, " ");
ELSEIF p_price_min = 0 && p_price_max > 0 THEN
SET price
= CONCAT
(" AND temporary_data.price <= ", p_price_max, " ");
ELSE
SET price
= "";
END
IF;

SET q
= CONCAT
("SELECT DISTINCT temporary_data.id, temporary_data.name, temporary_data.description, temporary_data.price, temporary_data.sku, temporary_data.published
FROM temporary_data
INNER JOIN product_category ON temporary_data.id = product_category.product_id 
WHERE temporary_data.name LIKE '%", p_search_name, "%'", category, price, " ORDER BY temporary_data.", p_sort_by, " ", p_sort_order, ";"); 

PREPARE stmt FROM q;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`
(
  `id` int
(11) NOT NULL,
  `parent_id` int
(11) DEFAULT NULL,
  `name` varchar
(255) NOT NULL,
  `description` varchar
(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contract_list`
--

DROP TABLE IF EXISTS `contract_list`;
CREATE TABLE `contract_list`
(
  `id` int
(11) NOT NULL,
  `user_id` int
(11) DEFAULT NULL,
  `product_id` int
(11) DEFAULT NULL,
  `price` decimal
(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE `discount`
(
  `id` int
(11) NOT NULL,
  `name` varchar
(255) NOT NULL,
  `discount_percent` decimal
(8,2) NOT NULL,
  `active` tinyint
(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`
(
  `id` int
(11) NOT NULL,
  `user_id` int
(11) DEFAULT NULL,
  `price` decimal
(8,2) NOT NULL,
  `price_discount` decimal
(8,2) NOT NULL,
  `price_total` decimal
(8,2) NOT NULL,
  `address_holder` varchar
(255) NOT NULL,
  `address_line1` varchar
(255) NOT NULL,
  `address_line2` varchar
(255) NOT NULL,
  `city` varchar
(255) NOT NULL,
  `postal_code` int
(11) NOT NULL,
  `country` varchar
(255) NOT NULL,
  `phone` varchar
(255) NOT NULL,
  `e_mail` varchar
(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items`
(
  `id` int
(11) NOT NULL,
  `order_details_id` int
(11) DEFAULT NULL,
  `product_id` int
(11) DEFAULT NULL,
  `price` decimal
(8,2) NOT NULL,
  `price_taxed` decimal
(8,2) NOT NULL,
  `quantity` int
(11) NOT NULL,
  `price_total` decimal
(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_list`
--

DROP TABLE IF EXISTS `price_list`;
CREATE TABLE `price_list`
(
  `id` int
(11) NOT NULL,
  `name` varchar
(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_list_items`
--

DROP TABLE IF EXISTS `price_list_items`;
CREATE TABLE `price_list_items`
(
  `id` int
(11) NOT NULL,
  `price_list_id` int
(11) DEFAULT NULL,
  `product_id` int
(11) DEFAULT NULL,
  `price` decimal
(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`
(
  `id` int
(11) NOT NULL,
  `name` varchar
(255) NOT NULL,
  `description` longtext NOT NULL,
  `price` decimal
(8,2) NOT NULL,
  `sku` varchar
(255) NOT NULL,
  `published` tinyint
(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category`
(
  `product_id` int
(11) NOT NULL,
  `category_id` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

DROP TABLE IF EXISTS `tax`;
CREATE TABLE `tax`
(
  `id` int
(11) NOT NULL,
  `name` varchar
(255) NOT NULL,
  `tax_percent` decimal
(8,2) NOT NULL,
  `active` tinyint
(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`
(
  `id` int
(11) NOT NULL,
  `first_name` varchar
(255) NOT NULL,
  `last_name` varchar
(255) NOT NULL,
  `e_mail` varchar
(255) NOT NULL,
  `phone` varchar
(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address`
(
  `id` int
(11) NOT NULL,
  `user_id` int
(11) DEFAULT NULL,
  `address_holder` varchar
(255) NOT NULL,
  `address_line1` varchar
(255) NOT NULL,
  `address_line2` varchar
(255) NOT NULL,
  `city` varchar
(255) NOT NULL,
  `postal_code` int
(11) NOT NULL,
  `country` varchar
(255) NOT NULL,
  `phone` varchar
(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
ADD PRIMARY KEY
(`id`),
ADD KEY `IDX_64C19C1727ACA70`
(`parent_id`);

--
-- Indexes for table `contract_list`
--
ALTER TABLE `contract_list`
ADD PRIMARY KEY
(`id`),
ADD UNIQUE KEY `UNIQ_2CBDB6704584665A`
(`product_id`),
ADD KEY `IDX_2CBDB670A76ED395`
(`user_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
ADD PRIMARY KEY
(`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
ADD PRIMARY KEY
(`id`),
ADD KEY `IDX_845CA2C1A76ED395`
(`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
ADD PRIMARY KEY
(`id`),
ADD KEY `IDX_62809DB08C0FA77`
(`order_details_id`),
ADD KEY `IDX_62809DB04584665A`
(`product_id`);

--
-- Indexes for table `price_list`
--
ALTER TABLE `price_list`
ADD PRIMARY KEY
(`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
ADD PRIMARY KEY
(`id`),
ADD UNIQUE KEY `UNIQ_D34A04ADF9038C4`
(`sku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
ADD PRIMARY KEY
(`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_list`
--
ALTER TABLE `price_list`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
ADD CONSTRAINT `FK_64C19C1727ACA70` FOREIGN KEY
(`parent_id`) REFERENCES `category`
(`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
ADD CONSTRAINT `FK_845CA2C1A76ED395` FOREIGN KEY
(`user_id`) REFERENCES `user`
(`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
