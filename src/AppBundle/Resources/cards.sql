CREATE TABLE IF NOT EXISTS `cards` (
   `cardid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(255) NOT NULL,
   `mana_cost` VARCHAR(100),
   `cmc` INTEGER NOT NULL,
   `power` INTEGER,
   `toughness` INTEGER,
   `legendary` BOOLEAN DEFAULT FALSE NOT NULL,
   `ability` TEXT,
   PRIMARY KEY (`cardid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `sets` (
   `setid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(40) NOT NULL,
   `code` VARCHAR(10) NOT NULL,
   `release_date` DATE,
   PRIMARY KEY (`setid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `arts` (
   `artid` INTEGER NOT NULL AUTO_INCREMENT,
   `rarity` ENUM('common', 'uncommon', 'rare', 'mythic'),
   `multiverseid` INTEGER UNIQUE, 
   `artist` VARCHAR(255),
   `url` VARCHAR(255),
   `cardid` INTEGER NOT NULL,
   `setid` INTEGER NOT NULL,

   PRIMARY KEY (`artid`),
   FOREIGN KEY (`cardid`) REFERENCES `cards`(`cardid`),
   FOREIGN KEY (`setid`) REFERENCES `sets`(`setid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `types` (
   `typeid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` ENUM ('creature', 'artifact', 'sorcery', 'enchantment', 'instant', 'land', 'conspiracy', 'planeswalker'),

   PRIMARY KEY (`typeid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `cards_types` (
   `id` INTEGER NOT NULL AUTO_INCREMENT,
   `cardid` INTEGER NOT NULL,
   `typeid` INTEGER NOT NULL,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`cardid`) REFERENCES `cards`(`cardid`),
   FOREIGN KEY (`typeid`) REFERENCES `types`(`typeid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `colors` (
   `colorid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` ENUM ('white', 'blue', 'black', 'red', 'green'),
   `symbol` ENUM ('W', 'U', 'B', 'R', 'G'),
   PRIMARY KEY (`colorid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `cards_colors` (
   `id` INTEGER NOT NULL AUTO_INCREMENT,
   `cardid` INTEGER NOT NULL,
   `colorid` INTEGER NOT NULL,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`cardid`) REFERENCES `cards`(`cardid`),
   FOREIGN KEY (`colorid`) REFERENCES `colors`(`colorid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `cards_identities` (
   `id` INTEGER NOT NULL AUTO_INCREMENT,
   `cardid` INTEGER NOT NULL,
   `colorid` INTEGER NOT NULL,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`cardid`) REFERENCES `cards`(`cardid`),
   FOREIGN KEY (`colorid`) REFERENCES `colors`(`colorid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `formats` (
   `formatid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(40),
   `description` TEXT,
   PRIMARY KEY (`formatid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `sets_formats` (
   `id` INTEGER NOT NULL AUTO_INCREMENT,
   `setid` INTEGER NOT NULL,
   `formatid` INTEGER NOT NULL,

   PRIMARY KEY (`id`),
   FOREIGN KEY (`setid`) REFERENCES `sets`(`setid`),
   FOREIGN KEY (`formatid`) REFERENCES `formats`(`formatid`)
)engine=innodb default character set=utf8;

