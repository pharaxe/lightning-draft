CREATE TABLE IF NOT EXISTS `users` (
   `userid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(255) NOT NULL,
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
   PRIMARY KEY (`poolid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `picks` (
   `pickid` INTEGER NOT NULL AUTO_INCREMENT,
   `poolid` INTEGER NOT NULL,
   `artid` INTEGER NOT NULL,
   `order` INTEGER,
   FOREIGN KEY (`poolid`) REFERENCES `pools`(`poolid`),
   FOREIGN KEY (`artid`) REFERENCES `arts`(`artid`),
   PRIMARY KEY (`pickid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `players` (
   `playerid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(255) NOT NULL,
   `userid` INTEGER NOT NULL,
   `draftid` INTEGER NOT NULL,
   `poolid` INTEGER NOT NULL,
   FOREIGN KEY (`userid`) REFERENCES `users`(`userid`),
   FOREIGN KEY (`draftid`) REFERENCES `drafts`(`draftid`),
   FOREIGN KEY (`poolid`) REFERENCES `pools`(`poolid`),
   PRIMARY KEY (`playerid`)
)engine=innodb default character set=utf8;
