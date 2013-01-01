
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- fos_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fos_user`;

CREATE TABLE `fos_user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255),
    `username_canonical` VARCHAR(255),
    `email` VARCHAR(255),
    `email_canonical` VARCHAR(255),
    `enabled` TINYINT(1) DEFAULT 0,
    `salt` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `last_login` DATETIME,
    `locked` TINYINT(1) DEFAULT 0,
    `expired` TINYINT(1) DEFAULT 0,
    `expires_at` DATETIME,
    `confirmation_token` VARCHAR(255),
    `password_requested_at` DATETIME,
    `credentials_expired` TINYINT(1) DEFAULT 0,
    `credentials_expire_at` DATETIME,
    `roles` TEXT,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `fos_user_U_1` (`username_canonical`),
    UNIQUE INDEX `fos_user_U_2` (`email_canonical`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- fos_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fos_group`;

CREATE TABLE `fos_group`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `roles` TEXT,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- fos_user_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fos_user_group`;

CREATE TABLE `fos_user_group`
(
    `fos_user_id` INTEGER NOT NULL,
    `fos_group_id` INTEGER NOT NULL,
    PRIMARY KEY (`fos_user_id`,`fos_group_id`),
    INDEX `fos_user_group_FI_2` (`fos_group_id`),
    CONSTRAINT `fos_user_group_FK_1`
        FOREIGN KEY (`fos_user_id`)
        REFERENCES `fos_user` (`id`),
    CONSTRAINT `fos_user_group_FK_2`
        FOREIGN KEY (`fos_group_id`)
        REFERENCES `fos_group` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- festival
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `festival`;

CREATE TABLE `festival`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `festival_type_id` INTEGER,
    `festival_content_title` VARCHAR(45) NOT NULL,
    `start_date` DATETIME NOT NULL,
    `end_date` DATETIME NOT NULL,
    `festival_location_id` INTEGER,
    `festival_content_id` INTEGER,
    `festival_url_id` INTEGER,
    `slug` VARCHAR(45),
    `lang` VARCHAR(2),
    PRIMARY KEY (`id`),
    INDEX `festival_FI_1` (`festival_type_id`),
    INDEX `festival_FI_2` (`festival_location_id`),
    INDEX `festival_FI_3` (`festival_content_id`),
    INDEX `festival_FI_4` (`festival_url_id`),
    CONSTRAINT `festival_FK_1`
        FOREIGN KEY (`festival_type_id`)
        REFERENCES `festival_type` (`id`),
    CONSTRAINT `festival_FK_2`
        FOREIGN KEY (`festival_location_id`)
        REFERENCES `festival_location` (`id`),
    CONSTRAINT `festival_FK_3`
        FOREIGN KEY (`festival_content_id`)
        REFERENCES `festival_content` (`id`),
    CONSTRAINT `festival_FK_4`
        FOREIGN KEY (`festival_url_id`)
        REFERENCES `festival_url` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- festival_location
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `festival_location`;

CREATE TABLE `festival_location`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `country` VARCHAR(45) NOT NULL,
    `state` VARCHAR(45),
    `city` VARCHAR(45) NOT NULL,
    `latitude` VARCHAR(45) NOT NULL,
    `longtitude` VARCHAR(45) NOT NULL,
    `festival_location_content_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `festival_location_FI_1` (`festival_location_content_id`),
    CONSTRAINT `festival_location_FK_1`
        FOREIGN KEY (`festival_location_content_id`)
        REFERENCES `festival_location_content` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- festival_content
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `festival_content`;

CREATE TABLE `festival_content`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `festival_id` INTEGER NOT NULL,
    `title` VARCHAR(90) NOT NULL,
    `subtitle` VARCHAR(90),
    `content` TEXT,
    `meta_keywords` TEXT,
    `meta_description` TEXT,
    `visitor` VARCHAR(45),
    `user_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- festival_location_content
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `festival_location_content`;

CREATE TABLE `festival_location_content`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(45) NOT NULL,
    `subtitle` VARCHAR(90),
    `content` TEXT,
    `user_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- festival_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `festival_type`;

CREATE TABLE `festival_type`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- festival_url
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `festival_url`;

CREATE TABLE `festival_url`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `url` VARCHAR(90) NOT NULL,
    `festival_url_type_id` INTEGER NOT NULL,
    `festival_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `festival_url_FI_1` (`festival_url_type_id`),
    CONSTRAINT `festival_url_FK_1`
        FOREIGN KEY (`festival_url_type_id`)
        REFERENCES `festival_url_type` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- festival_url_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `festival_url_type`;

CREATE TABLE `festival_url_type`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100),
    `surname` VARCHAR(100),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- pages
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `master_id` INTEGER NOT NULL,
    `title` VARCHAR(100),
    `slug` VARCHAR(100),
    `content` TEXT,
    `lang` VARCHAR(2),
    `images` TEXT,
    `meta_keywords` TEXT,
    `meta_description` TEXT,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
