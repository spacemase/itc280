create table tblCustomers( 
CustomerID int unsigned not null auto_increment primary key,
LastName varchar(50),
FirstName varchar(50),
Email varchar(80)
);

insert into tblCustomers values
(NULL,"Smith","Bob","bob@fake.com"),
(NULL,"Jones","Bill","bill@fake.com"),
(NULL,"Doe","John","john@fake.com"),
(NULL,"Rules","Ann","ann@fake.com")
;
update tblCustomers set FirstName='Jonathan' where CustomerID = 3;
Alter table tblCustomers add State char(2) default "WA" after FirstName;
insert into tblCustomers values
(NULL,"Jones","Steve","WA","bill@fake.com"),
(NULL,"Smith","Bob","WA","bob@fake.com"),
(NULL,"Snuffy","Smif","ID","snuffy@smif.com"),
(NULL,"onemore","try","OR","try@fake.com"),
(NULL,"Doe","John","WA","john@fake.com"),
(NULL,"Rules","Ann","NE","ann@fake.com")
;



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





create table Categories(
CategoryID int unsigned not null auto_increment primary key,
Category varchar(120),
Description text
);
create table Books(
BookID int unsigned not null auto_increment primary key,
BookTitle varchar(120),
Authors varchar(120),
CategoryID int DEFAULT 0,
ISBN varchar(30),
Edition varchar(20),
Description text,
Rating float(1,1),
Price float(6,2)
);
insert into Categories values(NULL, 'DotNet', 'Microsoft \'s flagship server technology.' );
insert into Categories values(NULL, 'PHP', 'The world\'s most popular open source technology.');
insert into Categories values(NULL, 'Programming', 'Books of general programming interest.');
insert into Categories values(NULL, 'HTML', 'Web page architecture.');
insert into Categories values(NULL, 'Networking', 'How networks connect us.');
insert into Categories values(NULL, 'ASP', 'Microsoft \'s classic server technology.');
insert into Books values(NULL, 'Professional ADO.NET','Smith',1,'568524456','2nd Edition','A great .NET book',8, 23.50);
insert into Books values(NULL, 'Apache Server Unleashed','Jones',2,'12345678','1st Edition','A great PHP book',7, 29.50);
insert into Books values(NULL, 'ASP.NET Unleashed','Doe',1,'345678976','1st Edition','A great .NET book',9, 39.95);
insert into Books values(NULL, 'Introducing .NET','Wilson',1,'67890567','3rd Edition','A great .NET book',8, 24.45);
insert into Books values(NULL, 'Professional C#','Jones',1,'568524456','1st Edition','A great .NET book',6, 38.45);
insert into Books values(NULL, 'Beginning C++','Jackson',3,'12345678','1st Edition','A great programming book',10, 41.40);
insert into Books values(NULL, 'Beginning J++','Johnson',3,'345678976','1st Edition','A great programming book',8,44.30);
insert into Books values(NULL, 'Beginning PHP','Smith',2,'345678976','2nd Edition','A great PHP book',7, 55.50);
insert into Books values(NULL, 'Beginning MySQL','McDonald',2,'67890567','1st Edition','A great PHP book',6, 98.20);
insert into Books values(NULL, 'Beginning Visual Basic','Cox',3,'12345678','1st Edition','A great .NET book',8, 58.95);
insert into Books values(NULL, 'Beginning XHTML','Jones',4,'12345678','1st Edition','A great HTML book',5, 39.95);
insert into Books values(NULL, 'Hacking Exposed','Evans',5,'12345678','2nd Edition','A great .NET book',9, 22.20);
insert into Books values(NULL, 'Effective Java','Franklin',3,'568524456','1st Edition','A great programming book',8, 91.20);
insert into Books values(NULL, 'JavaScript Bible','Jones',4,'12345678','1st Edition','A great HTML book',6, 33.55);
insert into Books values(NULL, 'Beginning PHP4 and XML','Doe',2,'12345678','2nd Edition','A great PHP book',7, 48.50);
insert into Books values(NULL, 'VBScript Regular Expressions','Smith',3,'12345678','1st Edition','A great programming book',7, 49.50);
insert into Books values(NULL, 'Programming ASP','Johnson',6,'67890567','4th Edition','A great ASP book',8, 49.50);
insert into Books values(NULL, 'Programming PHP','Doe',2,'345678976','1st Edition','A great PHP book',9, 49.50);
insert into Books values(NULL, 'Programming C#','Jones',1,'568524456','1st Edition','A great .NET book',7, 49.50);
insert into Books values(NULL, 'Programming Java','Smith',3,'56780765','5th Edition','A great programming book',6, 49.50);
insert into Books values(NULL, 'Introducing XML','Evans',4,'12345678','1st Edition','A great HTML book',8, 33.95);





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





create table RTE
(RTEID int unsigned not null auto_increment primary key,
RTEText text,
Files varchar(255) DEFAULT ''
);
insert into RTE values
(NULL,'RTE 1 Text Goes Here!',''),
(NULL,'RTE 2 Text Goes Here!',''),
(NULL,'RTE 3 Text Goes Here!',''),
(NULL,'RTE 4 Text Goes Here!',''),
(NULL,'RTE 5 Text Goes Here!',''),
(NULL,'RTE 6 Text Goes Here!',''),
(NULL,'RTE 7 Text Goes Here!',''),
(NULL,'RTE 8 Text Goes Here!',''),
(NULL,'RTE 9 Text Goes Here!',''),
(NULL,'RTE 10 Text Goes Here!',''),
(NULL,'RTE 11 Text Goes Here!',''),
(NULL,'RTE 12 Text Goes Here!',''),
(NULL,'RTE 13 Text Goes Here!',''),
(NULL,'RTE 14 Text Goes Here!',''),
(NULL,'RTE 15 Text Goes Here!',''),
(NULL,'RTE 16 Text Goes Here!',''),
(NULL,'RTE 17 Text Goes Here!',''),
(NULL,'RTE 18 Text Goes Here!',''),
(NULL,'RTE 19 Text Goes Here!',''),
(NULL,'RTE 20 Text Goes Here!','');
