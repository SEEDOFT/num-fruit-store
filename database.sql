CREATE DATABASE IF NOT EXISTS `num_fruit_store` DEFAULT CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `num_fruit_store`;

-- --------------------------------------------------------
--
-- Table structure for table `admins`
--
DROP TABLE IF EXISTS `admins`;

CREATE TABLE
    `admins` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `username` varchar(50) NOT NULL,
        `password` varchar(255) NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        UNIQUE KEY `username` (`username`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

INSERT INTO
    `admins` (`username`, `password`)
VALUES
    (
        'admin',
        '$2y$10$9.p2wZ5Lz6L5fOaJd7b6f.Y8.o9gU3eU2w/I.d.eF6qE/i9gU3eU2'
    );

-- Default password is 'password'
-- --------------------------------------------------------
--
-- Table structure for table `categories`
--
DROP TABLE IF EXISTS `categories`;

CREATE TABLE
    `categories` (
        `catId` int (11) NOT NULL AUTO_INCREMENT,
        `category` varchar(50) NOT NULL,
        PRIMARY KEY (`catId`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--
INSERT INTO
    `categories` (`category`)
VALUES
    ('Citrus'),
    ('Berry'),
    ('Tropical'),
    ('Stone Fruit'),
    ('Melon');

-- --------------------------------------------------------
--
-- Table structure for table `fruits`
--
DROP TABLE IF EXISTS `fruits`;

CREATE TABLE
    `fruits` (
        `frId` int (11) NOT NULL AUTO_INCREMENT,
        `catId` int (11) NOT NULL,
        `name` varchar(255) NOT NULL,
        `description` text NOT NULL,
        `qty` int (11) NOT NULL DEFAULT 0,
        `price` decimal(10, 2) NOT NULL,
        `image` varchar(255) DEFAULT NULL,
        `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`frId`),
        KEY `catId` (`catId`),
        CONSTRAINT `fruits_ibfk_1` FOREIGN KEY (`catId`) REFERENCES `categories` (`catId`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `fruits`
--
INSERT INTO
    `fruits` (
        `catId`,
        `name`,
        `description`,
        `qty`,
        `price`,
        `image`
    )
VALUES
    (
        1,
        'Orange',
        'Juicy and packed with Vitamin C.',
        100,
        0.70,
        'https://placehold.co/600x400/fb923c/ffffff?text=Orange'
    ),
    (
        2,
        'Strawberry',
        'Sweet, red, and juicy. Perfect for desserts.',
        150,
        3.00,
        'https://placehold.co/600x400/ec4899/ffffff?text=Strawberry'
    ),
    (
        3,
        'Banana',
        'A great source of potassium, sweet and soft.',
        200,
        0.30,
        'https://placehold.co/600x400/facc15/ffffff?text=Banana'
    ),
    (
        5,
        'Watermelon',
        'Refreshing and hydrating, a summer favorite.',
        50,
        5.00,
        'https://placehold.co/600x400/4ade80/ffffff?text=Watermelon'
    ),
    (
        4,
        'Peach',
        'Fuzzy, sweet, and juicy. A classic stone fruit.',
        80,
        0.90,
        'https://placehold.co/600x400/fecaca/ffffff?text=Peach'
    );

-- --------------------------------------------------------
--
-- Table structure for table `customers`
-- (As provided by you, can be expanded upon later)
--
DROP TABLE IF EXISTS `customers`;

CREATE TABLE
    `customers` (
        `cusId` int (11) NOT NULL AUTO_INCREMENT,
        `firstName` varchar(50) NOT NULL,
        `lastName` varchar(50) NOT NULL,
        `email` varchar(100) NOT NULL,
        `phoneNumber` varchar(20) NOT NULL,
        `address` varchar(200) DEFAULT NULL,
        `cityName` varchar(50) NOT NULL,
        `postCode` int (11) DEFAULT NULL,
        `countryName` varchar(100) NOT NULL,
        `regionState` varchar(100) DEFAULT NULL,
        PRIMARY KEY (`cusId`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;