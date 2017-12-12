CREATE TABLE IF NOT EXISTS `cards` (
   `cardid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(255) NOT NULL,
   `mana_cost` VARCHAR(40),
   `cmc` INTEGER NOT NULL,
   `power` INTEGER,
   `toughness` INTEGER,
   `legendary` BOOLEAN DEFAULT FALSE NOT NULL,
   `ability` VARCHAR(255) DEFAULT '' NOT NULL,
   PRIMARY KEY (`cardid`)
)engine=innodb;

CREATE TABLE IF NOT EXISTS `sets` (
   `setid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(40) NOT NULL,
   `code` VARCHAR(10) NOT NULL,
   `release_date` DATE,
   PRIMARY KEY (`setid`)
)engine=innodb;

CREATE TABLE IF NOT EXISTS `card_arts` (
   `card_artid` INTEGER NOT NULL AUTO_INCREMENT,
   `cardid` INTEGER NOT NULL,
   `setid` INTEGER NOT NULL,
   `rarity` ENUM('common', 'uncommon', 'rare', 'mythic') NOT NULL,
   `multiverseid` INTEGER, 
   `artist` VARCHAR(40),

   PRIMARY KEY (`card_artid`),
   FOREIGN KEY (`cardid`) REFERENCES `cards`(`cardid`),
   FOREIGN KEY (`setid`) REFERENCES `sets`(`setid`)
)engine=innodb;

CREATE TABLE IF NOT EXISTS `card_types` (
   `card_typeid` INTEGER NOT NULL AUTO_INCREMENT,
   `cardid` INTEGER NOT NULL,
   `type_name` ENUM ('creature', 'artifact', 'sorcery', 'enchantment', 'instant', 'land', 'conspiracy', 'planeswalker'),

   PRIMARY KEY (`card_typeid`),
   FOREIGN KEY (`cardid`) REFERENCES `cards`(`cardid`)
)engine=innodb;

CREATE TABLE IF NOT EXISTS `card_subtypes` (
   `card_subtypeid` INTEGER NOT NULL AUTO_INCREMENT,
   `cardid` INTEGER NOT NULL,
   `subtype` VARCHAR(255),

   PRIMARY KEY (`card_subtypeid`),
   FOREIGN KEY (`cardid`) REFERENCES `cards`(`cardid`)
)engine=innodb;

CREATE TABLE IF NOT EXISTS `card_colors` (
   `card_colorid` INTEGER NOT NULL AUTO_INCREMENT,
   `cardid` INTEGER NOT NULL,
   `color` ENUM ('white', 'blue', 'black', 'red', 'green'),
   PRIMARY KEY (`card_colorid`),
   FOREIGN KEY (`cardid`) REFERENCES `cards`(`cardid`)
);

CREATE TABLE IF NOT EXISTS `card_identities` (
   `card_identityid` INTEGER NOT NULL AUTO_INCREMENT,
   `cardid` INTEGER NOT NULL,
   `identity` ENUM ('white', 'blue', 'black', 'red', 'green'),
   PRIMARY KEY (`card_identityid`),
   FOREIGN KEY (`cardid`) REFERENCES `cards`(`cardid`)
);

CREATE TABLE IF NOT EXISTS `formats` (
   `formatid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(40),
   `description` VARCHAR(40),
   PRIMARY KEY (`formatid`)
);

CREATE TABLE IF NOT EXISTS `set_formats` (
   `set_formatid` INTEGER NOT NULL AUTO_INCREMENT,
   `setid` INTEGER NOT NULL,
   `formatid` INTEGER NOT NULL,

   PRIMARY KEY (`set_formatid`),
   FOREIGN KEY (`setid`) REFERENCES `sets`(`setid`),
   FOREIGN KEY (`formatid`) REFERENCES `formats`(`formatid`)
);

