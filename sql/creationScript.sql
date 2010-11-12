# Rate my Boss SQL creation script

# ORGANIZATION

drop table organization;

create table organization
(
orgId INT NOT NULL AUTO_INCREMENT,
name VARCHAR(40) NOT NULL,
industryType VARCHAR(40) NOT NULL,
city VARCHAR(40) NOT NULL,
province VARCHAR(40) NOT NULL,
website VARCHAR(40),
numberofEmployees INT,
isPending INT NOT NULL,
PRIMARY KEY (orgId)
);

insert into organization (name, industryType, city, province, website, numberofEmployees, isPending) values ('Bell','telecommunications', 'Montreal', 'Quebec', 'www.bell.ca', 843, 1),
('Google','web', 'Irvine', 'California', 'www.google.ca', 307, 1);


