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

# SUPERVISOR

drop table supervisor;
create table supervisor
(
superId INT NOT NULL AUTO_INCREMENT,
orgId INT NOT NULL,
title VARCHAR(40) NOT NULL,
levelOfAuthority INT,
isPending INT NOT NULL,
PRIMARY KEY (superId),
FOREIGN KEY (orgId) REFERENCES organization
);

# DOCUMENT

drop table document;
create table document
(
docId INT NOT NULL AUTO_INCREMENT,
orgId INT NOT NULL,
title VARCHAR(40) NOT NULL,
reported INT NOT NULL,
PRIMARY KEY (docId),
FOREIGN KEY (orgId) REFERENCES organization
);

# RATING

drop table rating;
create table rating
(
ratingId INT NOT NULL AUTO_INCREMENT,
orgId INT NOT NULL,
socialValues INT,
professionalism INT,
openness INT,
encouraging INT,
acceptance INT,
recognition INT,
qualityWorkplace INT,
fairness INT,
cooperation INT,
rewardSystem INT,
fairWages INT,
qualityBenefits INT,
supportEmployees INT,
levelStress INT,
levelCollegiality INT,
levelBureaucracy INT,
advancement INT,
supportFamily INT,
uString CHAR(32) NOT NULL,
PRIMARY KEY (ratingId),
FOREIGN KEY (orgId) REFERENCES organization
);

# ORGANIZATION EVALUATION

drop table orgEvaluation;
create table orgEvaluation
(
orgEvalId INT NOT NULL AUTO_INCREMENT,
orgId INT NOT NULL,
title VARCHAR(40) NOT NULL,
text VARCHAR(600) NOT NULL,
reported INT NOT NULL,
uString CHAR(32) NOT NULL,
PRIMARY KEY (orgEvalId),
FOREIGN KEY (orgId) REFERENCES organization
);

# SUPERVISOR EVALUATION

drop table superEvaluation;
create table superEvaluation
(
superEvalId INT NOT NULL AUTO_INCREMENT,
superId INT NOT NULL,
title VARCHAR(40) NOT NULL,
text VARCHAR(600) NOT NULL,
reported INT NOT NULL,
uString CHAR(32) NOT NULL,
PRIMARY KEY (superEvalId),
FOREIGN KEY (superId) REFERENCES supervisor
);

# ORGANIZATION COMMENT

drop table orgComment;
create table orgComment
(
orgCommentId INT NOT NULL AUTO_INCREMENT,
orgEvalId INT NOT NULL,
text VARCHAR(600) NOT NULL,
reported INT NOT NULL,
uString CHAR(32) NOT NULL,
PRIMARY KEY (orgCommentId),
FOREIGN KEY (orgEvalId) REFERENCES orgEvaluation
);

# SUPERVISOR COMMENT

drop table superComment;
create table superComment
(
superCommentId INT NOT NULL AUTO_INCREMENT,
superEvalId INT NOT NULL,
text VARCHAR(600) NOT NULL,
reported INT NOT NULL,
uString CHAR(32) NOT NULL,
PRIMARY KEY (superCommentId),
FOREIGN KEY (superEvalId) REFERENCES superEvaluation
);

# DOCUMENT COMMENT

drop table docComment;
create table docComment
(
docCommentId INT NOT NULL AUTO_INCREMENT,
docId INT NOT NULL,
text VARCHAR(600) NOT NULL,
reported INT NOT NULL,
uString CHAR(32) NOT NULL,
PRIMARY KEY (docCommentId),
FOREIGN KEY (docId) REFERENCES document
);

# TAG

drop table tag;
create table tag
(
tagId INT NOT NULL AUTO_INCREMENT,
parentId INT NOT NULL,
type VARCHAR(40) NOT NULL,
keyword VARCHAR(40) NOT NULL,
PRIMARY KEY (tagId)
);

# USER
# type = "admin", "finance", "registered", or "agent"

drop table user;
create table user
(
userId INT NOT NULL AUTO_INCREMENT,
name VARCHAR(40) NOT NULL,
password VARCHAR(40) NOT NULL,
type VARCHAR(40) NOT NULL,
answer1 VARCHAR(40) NOT NULL,
answer2 VARCHAR(40) NOT NULL,
answer3 VARCHAR(40) NOT NULL,
isPending INT NOT NULL,
PRIMARY KEY (userId)
);

# AD

drop table ad;
create table ad
(
adId INT NOT NULL AUTO_INCREMENT,
businessId INT NOT NULL,
content VARCHAR(600) NOT NULL,
counter INT NOT NULL,
timestamp DATE NOT NULL,
reported INT NOT NULL,
PRIMARY KEY (adId),
FOREIGN KEY (businessId) REFERENCES business
);

# BUSINESS

drop table business;
create table business
(
businessId INT NOT NULL AUTO_INCREMENT,
userId INT NOT NULL,
name VARCHAR(40) NOT NULL,
charter VARCHAR(600),
address VARCHAR(40),
city VARCHAR(40),
state VARCHAR(40),
country VARCHAR(40),
postalCode VARCHAR(40),
email VARCHAR(40),
contactName VARCHAR(40) NOT NULL,
contactNumberLand VARCHAR(40),
contactNumberMobile VARCHAR(40),
contactNumberFax VARCHAR(40),
contactPosition VARCHAR(40),
contactEmail VARCHAR(40),
PRIMARY KEY (businessId),
FOREIGN KEY (userId) REFERENCES user
);

# INSERT VALUES
# 1 = Bell, 2 = Google, 3 = Hydro-Québec, 4 = Microsoft, 5 = Telus , 6 = Disney, 7 = BASF , 8 = , 
insert into organization (name, industryType, city, province, website, numberofEmployees, isPending) values
('Bell','Telecommunications', 'Montreal', 'Quebec', 'www.bell.ca', 843, 1),
('Google','web', 'Irvine', 'California', 'www.google.ca', 307, 1),
('Hydro-Québec','Generation/Distribution of Electricity', 'Montreal', 'Quebec', 'www.hydroquebec.com', 23616, 1),
('Microsoft','Manufacturing Computing Devices and IT', 'Redmond',  'Washington', 'www.microsoft.com', 89000, 1),
('Telus', 'Telecommunications', 'Burnaby', 'British Columbia','	www.telus.com',36600, 1 ),
('Disney','Media and Entertainment', 'Los Angeles', 'California','http://www.disney.com', 150000, 1),
('BASF', 'Chemicals and Energy', 'Ludwigshafen','Germany','www.basf.com', 104780, 1);

# admin: peter - p_rockw; leila - l_behja; marc - ma_fauch;
# finance: accounting - cashman
# agent: jobboom - getajob
# registered: public - dbs0610
insert into user (name, password, type, answer1, answer2, answer3, isPending) values
("peter", "05c60e65cae54a3364582dccf190e955", "admin", "empty", "empty", "empty", 0),
("leila", "d8e8de91f10ba4adf900a65203918df5", "admin", "empty", "empty", "empty", 0),
("marc",  "8b55849c65a291d77c476dc68cd6a555", "admin", "empty", "empty", "empty", 0),
("accounting", "45143951d8d46d2902dcc9b6d2fd884d", "finance", "empty", "empty", "empty", 0),
("jobboom", "366612fada618dc350f1035ee8ceaea9", "agent", "empty", "empty", "empty", 0),
("public", "f998eea644728e3a11925c3c8a40c48a", "registered", "empty", "empty", "empty", 0);
