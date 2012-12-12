
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- festival
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `festival`;

CREATE TABLE `festival`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(100),
    `slug` VARCHAR(100),
    `desc` TEXT,
    `lang` VARCHAR(2),
    `start` DATE,
    `end` DATE,
    `lat` DECIMAL,
    `lon` DECIMAL,
    `official_site_url` VARCHAR(100),
    `facebook_url` VARCHAR(100),
    `twitter_url` VARCHAR(100),
    `youtube_url` VARCHAR(100),
    `wikipedia_url` VARCHAR(100),
    `rss_url` VARCHAR(100),
    `country` VARCHAR(100),
    `location` VARCHAR(100),
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
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
