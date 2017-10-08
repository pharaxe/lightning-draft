CREATE TABLE IF NOT EXISTS `cards` (
   `cardid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(255) NOT NULL,
   `mana_cost` VARCHAR(40),
   `cmc` INTEGER,
   `rarity` ENUM('common', 'uncommon', 'rare' 'mythic') NOT NULL,
   `release_date` DATE,
   `power` INTEGER,
   `toughness` INTEGER,
   `legendary` BOOLEAN DEFAULT FALSE,
   `ability` VARCHAR(255),
   PRIMARY KEY (`cardid`)
);

CREATE TABLE IF NOT EXISTS `card_arts` (
   `card_artid` INTEGER NOT NULL AUTO_INCREMENT,
   `card_id` INTEGER NOT NULL
   `multiverseid` INTEGER, 
   `setid` INTEGER,
   `artist` VARCHAR(40),

   PRIMARY KEY (`card_artid`)
   FOREIGN KEY (`cardid`) REFERENCES `cards`(`cardid`)
   FOREIGN KEY (`setid`) REFERENCES `sets`(`setid`)
);

CREATE TABLE IF NOT EXISTS `card_types` (
   `card_typeid` INTEGER NOT NULL AUTO_INCREMENT,
   `cardid` INTEGER NOT NULL,
   `type_name` ENUM ('creature', 'artifact', 'sorcery', 'enchantment', 'instant', 'land', 'conspiracy', 'planeswalker'),
   PRIMARY KEY `card_typeid`,
   FOREIGN KEY(`cardid`) REFERENCES `cards`(`cardid`)
);

CREATE TABLE IF NOT EXISTS `card_subtypes` (
   `card_subtypeid` INTEGER NOT NULL AUTO_INCREMENT,
   `cardid` INTEGER NOT NULL,
   `subtype` VARCHAR(20),
   PRIMARY KEY `card_subtypeid`,
   FOREIGN KEY(`cardid`) REFERENCES `cards`(`cardid`)
);

CREATE TABLE IF NOT EXISTS `card_colors` (
   `card_colorid` INTEGER NOT NULL AUTO_INCREMENT,
   `cardid` INTEGER NOT NULL,
   `color` INTEGER ENUM ('white', 'blue', 'black', 'red', 'green'),
   PRIMARY KEY `card_colorid`,
   FOREIGN KEY(`cardid`) REFERENCES `cards`(`cardid`)
);

CREATE TABLE IF NOT EXISTS `card_identities` (
   `card_identityid` INTEGER NOT NULL AUTO_INCREMENT,
   `cardid` INTEGER NOT NULL,
   `identity` INTEGER ENUM ('white', 'blue', 'black', 'red', 'green'),
   PRIMARY KEY `card_identityid`,
   FOREIGN KEY(`cardid`) REFERENCES `cards`(`cardid`)
);

CREATE TABLE IF NOT EXISTS `sets` (
   `setid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(40) NOT NULL,
   `code` VARCHAR(10),
   `release_date` DATE 
   PRIMARY KEY (`setid`)
);

CREATE TABLE IF NOT EXISTS `formats` (
   `formatid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(40),
);

CREATE TABLE IF NOT EXISTS `set_formats` (
   `set_formatid` INTEGER NOT NULL AUTO_INCREMENT,
   `setid` INTEGER NOT NULL,
   `formatid` INTEGER NOT NULL,
   FOREIGN KEY(`setid`) REFERENCES `sets`(`setid`),
   FOREIGN KEY(`formatid`) REFERENCES `formats`(`formatid`)
);

