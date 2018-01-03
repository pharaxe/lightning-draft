CREATE TABLE IF NOT EXISTS `users` (
   `userid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(255) NOT NULL,
   PRIMARY KEY (`userid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `drafts` (
   `draftid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(255),
   PRIMARY KEY (`draftid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `picks` (
   `pickid` INTEGER NOT NULL AUTO_INCREMENT,
   `listid` INTEGER NOT NULL,
   `cardid` INTEGER NOT NULL,
   `order` INTEGER,
   INDEX `list_index` (`listid`),
   FOREIGN KEY (`cardid`) REFERENCES `cards`(`cardid`),
   PRIMARY KEY (`pickid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `players` (
   `playerid` INTEGER NOT NULL AUTO_INCREMENT,
   `userid` INTEGER NOT NULL,
   `draftid` INTEGER NOT NULL,
   `poolid` INTEGER NOT NULL,
   FOREIGN KEY (`userid`) REFERENCES `users`(`userid`),
   FOREIGN KEY (`draftid`) REFERENCES `drafts`(`draftid`),
   FOREIGN KEY (`poolid`) REFERENCES `picks`(`listid`),
   PRIMARY KEY (`playerid`)
)engine=innodb default character set=utf8;
