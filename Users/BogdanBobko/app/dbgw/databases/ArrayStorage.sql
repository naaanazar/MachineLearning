CREATE DATABASE IF NOT EXISTS `array_storage`
    CHARACTER SET `utf8`
    COLLATE `utf8_general_ci`;

CREATE TABLE IF NOT EXISTS `array` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `type` varchar(255) DEFAULT NULL,
    `title` varchar(255) DEFAULT NULL,
    `data` TEXT,
    PRIMARY KEY (`id`)
);
