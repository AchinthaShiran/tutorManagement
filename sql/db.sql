CREATE DATABASE tutorManagement;

USE tutorManagement;

CREATE TABLE Users (
    id INT NOT NULL AUTO_INCREMENT,
    lastName VARCHAR(50) NOT NULL,
    firstName VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(100),
    role ENUM('ADMIN','USER'),

    PRIMARY KEY (ID)
);



DESC Users;
SELECT * FROM Users;

CREATE TABLE Roles(
    role_id INT NOT NULL AUTO_INCREMENT,
    role ENUM('ADMIN','USER'),

    PRIMARY KEY (role_id)
)

CREATE TABLE Permissions(
    perm_mod VARCHAR(3) NOT NULL,
    perm_id INT NOT NULL,
    perm_desc VARCHAR(255) NOT NULL,

    PRIMARY KEY(perm_mod,perm_id)
);

CREATE TABLE Role_Permissions(
    role_id INT NOT NULL,
    perm_mod VARCHAR(3) NOT NULL,
    perm_id INT NOT NULL,

    PRIMARY KEY(role_id,perm_mod,perm_id)
)