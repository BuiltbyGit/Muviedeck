CREATE TABLE IF NOT EXISTS GetTopMovieId(
id int(128) PRIMARY KEY AUTO_INCREMENT,
title varchar(128) NOT NULL
)


CREATE TABLE users(
    usersId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    usersName VARCHAR(128) NOT NULL,
    usersUsername VARCHAR(128) NOT NULL,
    usersEmail VARCHAR(128) NOT NULL,
    usersPassword VARCHAR(128) NOT NULL 
    );

CREATE TABLE passwordReset(
	passwordResetId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    passwordResetEmail VARCHAR(128) NOT NULL,
    passwordResetSelector TEXT NOT NULL,
    passwordResetToken TEXT NOT NULL,
    passwordResetExpires TEXT NOT NULL
);