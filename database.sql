CREATE TABLE user (
    id int(6) ZEROFILL NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstname varchar(255) NOT NULL,
    surname varchar(255) NOT NULL,
    username varchar(255) NOT NULL,
    displayname varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    number varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    profile varchar(10) NOT NULL,
    background varchar(10) NOT NULL,
    bio varchar(255) NOT NULL,
    rank varchar(10) NOT NULL,
    regdate timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB DEFAULT CHARSET=utf8;
    
    