CREATE DATABASE tutorManagement;

USE tutorManagement;


CREATE TABLE Roles(
    role_id INT NOT NULL AUTO_INCREMENT,
    role ENUM('ADMIN', 'USER'),
    PRIMARY KEY (role_id)
);



CREATE TABLE Permissions(
    perm_mod VARCHAR(3) NOT NULL,
    perm_id INT NOT NULL,
    perm_desc VARCHAR(255) NOT NULL,

    PRIMARY KEY(perm_mod, perm_id)
);



CREATE TABLE Role_Permissions(
    role_id INT NOT NULL,
    perm_mod VARCHAR(3) NOT NULL,
    perm_id INT NOT NULL,

    PRIMARY KEY(role_id, perm_mod, perm_id),
    FOREIGN KEY (role_id) REFERENCES Roles(role_id)  ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (perm_mod) REFERENCES Permissions(perm_mod)  ON DELETE CASCADE ON UPDATE CASCADE
);





CREATE TABLE Tutors(
    id INT NOT NULL AUTO_INCREMENT,
    lastName VARCHAR(50) NOT NULL,
    firstName VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(12) UNIQUE,
    subject VARCHAR(25),
    about VARCHAR(500),
    dp VARCHAR(100),

    PRIMARY KEY(id)
);


CREATE TABLE Users (
    id INT NOT NULL AUTO_INCREMENT,
    lastName VARCHAR(50) NOT NULL,
    firstName VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(12) UNIQUE,
    password VARCHAR(100),
    role_id INT,
    status ENUM('Active', 'Pending', 'Disabled'),
    
    PRIMARY KEY (ID),
    FOREIGN KEY (role_id) REFERENCES Roles(role_id)  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Ebooks(
    bookId INT NOT NULL AUTO_INCREMENT,
    fileName VARCHAR(100),
    ebookName VARCHAR(50),
    subject VARCHAR(20),
    grade VARCHAR(15),
    medium VARCHAR(15),
    
    PRIMARY KEY(bookId)
);

CREATE TABLE Grades(
    tutor INT,
    grade VARCHAR(15),
    
    PRIMARY KEY(tutor,grade),
    FOREIGN KEY (tutor) REFERENCES Tutors(id)  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Mediums(
    tutor INT,
    medium VARCHAR(15),
    
    PRIMARY KEY(tutor,medium),
    FOREIGN KEY (tutor) REFERENCES Tutors(id)  ON DELETE CASCADE ON UPDATE CASCADE
);


INSERT INTO Roles (role) VALUES ("ADMIN");
INSERT INTO Roles (role) VALUES ("USER");


INSERT INTO Permissions (perm_mod,perm_id,perm_desc) VALUES ("USR",1,"Create User");
INSERT INTO Permissions (perm_mod,perm_id,perm_desc) VALUES ("USR",2,"Update User");
INSERT INTO Permissions (perm_mod,perm_id,perm_desc) VALUES ("USR",3,"Delete User");
INSERT INTO Permissions (perm_mod,perm_id,perm_desc) VALUES ("USR",4,"View Users");
INSERT INTO Permissions (perm_mod,perm_id,perm_desc) VALUES ("USR",5,"Update Profile");

INSERT INTO Permissions (perm_mod,perm_id,perm_desc) VALUES ("TTR",1,"View Tutors");
INSERT INTO Permissions (perm_mod,perm_id,perm_desc) VALUES ("TTR",2,"Update Tutor");
INSERT INTO Permissions (perm_mod,perm_id,perm_desc) VALUES ("TTR",3,"Add Tutor");
INSERT INTO Permissions (perm_mod,perm_id,perm_desc) VALUES ("TTR",4,"Delete Tutor");

INSERT INTO Permissions (perm_mod,perm_id,perm_desc) VALUES ("EBK",1,"Add Ebook");
INSERT INTO Permissions (perm_mod,perm_id,perm_desc) VALUES ("EBK",2,"View Ebook");
INSERT INTO Permissions (perm_mod,perm_id,perm_desc) VALUES ("EBK",3,"Delete Ebook");

INSERT INTO Permissions (perm_mod,perm_id,perm_desc) VALUES ("ATH",1,"Authenticated");


INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (1,"USR",1);
INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (1,"USR",2);
INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (1,"USR",3);
INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (1,"USR",4);
INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (1,"USR",5);

INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (2,"USR",5);

INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (1,"TTR",1);
INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (1,"TTR",2);
INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (1,"TTR",3);
INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (1,"TTR",4);
INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (2,"TTR",1);

INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (1,"EBK",1);
INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (1,"EBK",2);
INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (1,"EBK",3);
INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (2,"EBK",2);


INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (1,"ATH",1);
INSERT INTO Role_Permissions (role_id,perm_mod,perm_id) VALUES (2,"ATH",1);



INSERT INTO Tutors (lastName,firstName,email,phone,subject) VALUES ("last1","first1","teacher1@gmail.com","11111","Sinhala");
INSERT INTO Tutors (lastName,firstName,email,phone,subject) VALUES ("last2","first2","teacher2@gmail.com","111112","Sinhala");
INSERT INTO Tutors (lastName,firstName,email,phone,subject) VALUES ("last3","first3","teacher3@gmail.com","111113","Maths");
INSERT INTO Tutors (lastName,firstName,email,phone,subject) VALUES ("last4","first4","teacher4@gmail.com","111114","History");
INSERT INTO Tutors (lastName,firstName,email,phone,subject) VALUES ("last5","first5","teacher5@gmail.com","111115","Maths");
INSERT INTO Tutors (lastName,firstName,email,phone,subject) VALUES ("last6","first6","teacher6@gmail.com","111116","History");
INSERT INTO Tutors (lastName,firstName,email,phone,subject) VALUES ("last7","first7","teacher7@gmail.com","111117","IT");
INSERT INTO Tutors (lastName,firstName,email,phone,subject) VALUES ("last8","first8","teacher8@gmail.com","111118","Geography");
INSERT INTO Tutors (lastName,firstName,email,phone,subject) VALUES ("last9","first9","teacher9@gmail.com","111119","Chemistry");
INSERT INTO Tutors (lastName,firstName,email,phone,subject) VALUES ("last10","first10","teacher10@gmail.com","111911","History");
INSERT INTO Tutors (lastName,firstName,email,phone,subject) VALUES ("last11","first11","teacher11@gmail.com","111141","Chemistry");
INSERT INTO Tutors (lastName,firstName,email,phone,subject) VALUES ("last12","first12","teacher12@gmail.com","111131","IT");
INSERT INTO Tutors (lastName,firstName,email,phone,subject) VALUES ("last13","first13","teacher13@gmail.com","1111123","Chemistry");


INSERT INTO Users (firstName,lastName,email,phone,password,role_id,status) VALUES("Soap","Mactavish","admin@gmail.com","119","202cb962ac59075b964b07152d234b70",1,"Active");
INSERT INTO Users (firstName,lastName,email,phone,password,role_id,status) VALUES("Darth","Vader","user1@gmail.com","12456789","202cb962ac59075b964b07152d234b70",2,"Active");
INSERT INTO Users (firstName,lastName,email,phone,password,role_id,status) VALUES("user2","user2","user2@gmail.com","1111","202cb962ac59075b964b07152d234b70",2,"Active");
INSERT INTO Users (firstName,lastName,email,phone,password,role_id,status) VALUES("user3","user3","user3@gmail.com","2222","202cb962ac59075b964b07152d234b70",2,"Active");
INSERT INTO Users (firstName,lastName,email,phone,password,role_id,status) VALUES("user4","user4","user4@gmail.com","3333","202cb962ac59075b964b07152d234b70",2,"Active");
INSERT INTO Users (firstName,lastName,email,phone,password,role_id,status) VALUES("user5","user5","user5@gmail.com","4444","202cb962ac59075b964b07152d234b70",2,"Active");
INSERT INTO Users (firstName,lastName,email,phone,password,role_id,status) VALUES("user6","user6","user6@gmail.com","5555","202cb962ac59075b964b07152d234b70",2,"Active");
