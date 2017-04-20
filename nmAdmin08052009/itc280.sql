create table itc280_Admin(
AdminID int unsigned not null auto_increment primary key,
LastName varchar(50) DEFAULT '',
FirstName varchar(50) DEFAULT '',
Email varchar(120) DEFAULT '',
Privilege varchar(50) DEFAULT 'admin',
AdminPW varChar(255),
NumLogins int DEFAULT 0,
DateAdded DATETIME,
LastLogin DATETIME
);
insert into itc280_Admin values (NULL,'Jensen','Mason','developer@example.com','developer','92429d82a41e930486c6de5ebda9602d55c39986',0,now(),now());
