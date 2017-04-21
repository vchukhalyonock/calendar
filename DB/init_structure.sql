SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `sessions`;
DROP TABLE IF EXISTS `events`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
);


CREATE TABLE `users` (
  `id` INT(5) NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `surname` VARCHAR(255) NULL DEFAULT NULL ,
  `type` ENUM('admin', 'user') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'user' ,
  `registrationCode` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`),
  UNIQUE (`email`),
  UNIQUE (`registrationCode`))
  ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;


CREATE TABLE `events` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `dateFrom` DATE NOT NULL ,
  `timeFrom` TIME NOT NULL ,
  `dateTo` DATE NOT NULL ,
  `timeTo` TIME NOT NULL ,
  `description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `userId` INT(5) NOT NULL ,
  `status` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `color` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;


ALTER TABLE `events` ADD INDEX(`userId`);
ALTER TABLE `events`
  ADD CONSTRAINT `events_userId` FOREIGN KEY (`userId`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

SET FOREIGN_KEY_CHECKS = 1;