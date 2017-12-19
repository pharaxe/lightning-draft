CREATE TABLE IF NOT EXISTS `users` (
   `userid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(255) NOT NULL,
   PRIMARY KEY (`userid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `drafts` (
   `draftid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(255) NOT NULL,
   PRIMARY KEY (`draftid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `players` (
   `playerid` INTEGER NOT NULL AUTO_INCREMENT,
   FOREIGN KEY (`userid`) REFERENCES `users`(`userid`),
   FOREIGN KEY (`draftid`) REFERENCES `drafts`(`draftid`)
   FOREIGN KEY (`picksid`) REFERENCES `cardlist`(`listid`)
   PRIMARY KEY (`playerid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `cardlist` (
   `cardlistid` INTEGER NOT NULL AUTO_INCREMENT,
   `listid` INTEGER NOT NULL,
   FOREIGN KEY (`artid`) REFERENCES `arts`(`artid`),
   FOREIGN KEY (`draftid`) REFERENCES `drafts`(`draftid`)
   PRIMARY KEY (`cardlistid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `picks` (
   `picksid` INTEGER NOT NULL AUTO_INCREMENT,
   FOREIGN KEY (``) REFERENCES `users`(`userid`),
   FOREIGN KEY (`draftid`) REFERENCES `drafts`(`draftid`)
   PRIMARY KEY (`picksid`)
)engine=innodb default character set=utf8;


CREATE TABLE IF NOT EXISTS `picks` (
   `pickid` INTEGER NOT NULL AUTO_INCREMENT,
   FOREIGN KEY (`userid`) REFERENCES `users`(`userid`),
   FOREIGN KEY (`draftid`) REFERENCES `drafts`(`draftid`)
   PRIMARY KEY (`pickid`)
)engine=innodb default character set=utf8;

CREATE TABLE IF NOT EXISTS `players_picks` (
   `playerid` INTEGER NOT NULL AUTO_INCREMENT,
   FOREIGN KEY (`userid`) REFERENCES `users`(`userid`),
   FOREIGN KEY (`draftid`) REFERENCES `drafts`(`draftid`)
   PRIMARY KEY (`playerid`)
)engine=innodb default character set=utf8;


