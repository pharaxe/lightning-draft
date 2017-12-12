CREATE TABLE IF NOT EXISTS `users` (
   `userid` INTEGER NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(255) NOT NULL,
   PRIMARY KEY (`userid`)
)engine=innodb default character set=utf8;

