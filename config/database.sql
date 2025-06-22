CREATE DATABASE `num_fruit_store`;

USE `num_fruit_store`;

CREATE TABLE
    `admins` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `username` varchar(50) NOT NULL,
        `password` varchar(255) NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        UNIQUE KEY `username` (`username`)
    );

INSERT INTO
    `admins` (`username`, `password`)
VALUES
    ('admin', 'password');

CREATE TABLE
    `categories` (
        `catId` int (11) NOT NULL AUTO_INCREMENT,
        `category` varchar(50) NOT NULL,
        PRIMARY KEY (`catId`)
    );

INSERT INTO
    `categories` (`category`)
VALUES
    ('Citrus'),
    ('Berry'),
    ('Tropical'),
    ('Stone Fruit'),
    ('Melon');

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
    );

IINSERT INTO `fruits` (
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
        'orange.jpg'
    ),
    (
        2,
        'Strawberry',
        'Sweet, red, and juicy. Perfect for desserts.',
        150,
        3.00,
        'strawberry.jpg'
    ),
    (
        3,
        'Banana',
        'A great source of potassium, sweet and soft.',
        200,
        0.30,
        'banana.jpg'
    ),
    (
        5,
        'Watermelon',
        'Refreshing and hydrating, a summer favorite.',
        50,
        5.00,
        'watermelon.jpg'
    ),
    (
        4,
        'Peach',
        'Fuzzy, sweet, and juicy. A classic stone fruit.',
        80,
        0.90,
        'peach.jpg'
    );

CREATE TABLE
    `customers` (
        `cusId` int (11) NOT NULL AUTO_INCREMENT,
        `firstName` varchar(50) NOT NULL,
        `lastName` varchar(50) NOT NULL,
        `email` varchar(100) NOT NULL,
        `password` varchar(255) NOT NULL,
        `phoneNumber` varchar(20) NOT NULL,
        `address` varchar(200) DEFAULT NULL,
        `cityName` varchar(50) NOT NULL,
        `postCode` int (11) DEFAULT NULL,
        `countryName` varchar(100) NOT NULL,
        `regionState` varchar(100) DEFAULT NULL,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`cusId`),
        UNIQUE KEY `email` (`email`)
    );

CREATE TABLE
    `cart_items` (
        `cartItemId` INT (11) NOT NULL AUTO_INCREMENT,
        `cusId` INT (11) NOT NULL,
        `frId` INT (11) NOT NULL,
        `quantity` INT (11) NOT NULL DEFAULT 1,
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`cartItemId`),
        UNIQUE KEY `cusId_frId` (`cusId`, `frId`),
        KEY `cusId` (`cusId`),
        KEY `frId` (`frId`),
        CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cusId`) REFERENCES `customers` (`cusId`) ON DELETE CASCADE,
        CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`frId`) REFERENCES `fruits` (`frId`) ON DELETE CASCADE
    );