CREATE TABLE IF NOT EXISTS `users` (
   `userid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(255),
   PRIMARY KEY (`userid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `drafts` (
   `draftid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(255),
   `status` ENUM('setup', 'running', 'completed'),
   PRIMARY KEY (`draftid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `pools` (
   `poolid` INTEGER NOT NULL AUTO_INCREMENT,
   `ordered` BOOLEAN DEFAULT FALSE,
   PRIMARY KEY (`poolid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `picks` (
   `pickid` INTEGER NOT NULL AUTO_INCREMENT,
   `poolid` INTEGER NOT NULL,
   `artid` INTEGER NOT NULL,
   `order` INTEGER DEFAULT NULL,
   FOREIGN KEY (`poolid`) REFERENCES `pools`(`poolid`),
   FOREIGN KEY (`artid`) REFERENCES `arts`(`artid`),
   PRIMARY KEY (`pickid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `players` (
   `playerid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(255),
   `userid` INTEGER NOT NULL,
   `draftid` INTEGER NOT NULL,
   `packid` INTEGER,
   `picksid` INTEGER,
   `passid` INTEGER,
   FOREIGN KEY (`userid`) REFERENCES `users`(`userid`),
   FOREIGN KEY (`draftid`) REFERENCES `drafts`(`draftid`),
   FOREIGN KEY (`packid`) REFERENCES `pools`(`poolid`),
   FOREIGN KEY (`picksid`) REFERENCES `pools`(`poolid`),
   FOREIGN KEY (`passid`) REFERENCES `pools`(`poolid`),
   PRIMARY KEY (`playerid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `players_colors` (
   `id` INTEGER NOT NULL AUTO_INCREMENT,
   `playerid` INTEGER NOT NULL,
   `colorid` INTEGER NOT NULL,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`playerid`) REFERENCES `players`(`playerid`),
   FOREIGN KEY (`colorid`) REFERENCES `colors`(`colorid`)
)engine=innodb default character set=utf8;
