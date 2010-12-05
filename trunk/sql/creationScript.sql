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
userId INT NOT NULL,
content VARCHAR(600) NOT NULL,
counter INT NOT NULL,
lastView TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
isPending INT NOT NULL,
PRIMARY KEY (adId),
FOREIGN KEY (userId) REFERENCES user
);

# BUSINESS

drop table business;
create table business
(
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
PRIMARY KEY (userId),
FOREIGN KEY (userId) REFERENCES user
);

# ADMINISTRATOR

drop table administrator;
create table administrator
(
adminId INT NOT NULL PRIMARY KEY,
adPrice DECIMAL(10,2) NOT NULL
);


# INSERT VALUES
# 1 = Bell, 2 = Google, 3 = Hydro-Québec, 4 = Microsoft, 5 = Telus , 6 = Disney, 7 = BASF , 8 = , 

# Organizations

insert into organization (name, industryType, city, province, website, numberofEmployees, isPending) values
('Bell','Telecommunications', 'Montreal', 'Quebec', 'www.bell.ca', 843, 0),
('Google','web', 'Irvine', 'California', 'www.google.ca', 307, 0),
('Hydro-Québec','Generation/Distribution of Electricity', 'Montreal', 'Quebec', 'www.hydroquebec.com', 23616, 0),
('Microsoft','Manufacturing Computing Devices and IT', 'Redmond',  'Washington', 'www.microsoft.com', 89000, 1),
('Telus', 'Telecommunications', 'Burnaby', 'British Columbia','	www.telus.com',36600, 1 ),
('Disney','Media and Entertainment', 'Los Angeles', 'California','http://www.disney.com', 150000, 1),
('BASF', 'Chemicals and Energy', 'Ludwigshafen','Germany','www.basf.com', 104780, 1);

insert into supervisor (orgId, title, isPending) values
(1, 'CEO', 0),
(1, 'Janitor', 0),
(1, 'BossofallBosses', 1);

#Ratings

insert into rating (orgId, socialValues, professionalism, openness, encouraging, acceptance, recognition, qualityWorkplace, fairness, cooperation, rewardSystem, fairWages, qualityBenefits, supportEmployees, levelStress, levelCollegiality, levelBureaucracy, advancement, supportFamily, uString) values
(1,5,8, 8, 6, 4, 9, 8, 6, 7,7, 9, 6, 5, 4, 7, 6,8, 9, 'aaa'),
(1,7,8, 1, 3, 5, 9, 8, 2, 8,3, 6, 5, 8, 4, 5, 6,1, 3, 'aaa'),
(1,6,8, 5, 9, 6, 8, 6, 3, 8,7, 8, 6, 7, 3, 8, 7,7, 8, 'aaa');

# User

# admin:	1 = peter - p_rockw; 2 = leila - l_behja; 3 = marc - ma_fauch;
# finance:	4 = accounting - cashman
# agent:	5 = jobboom - getajob; 6 = googleads - dontbeevil
# registered:	7 = public - dbs0610
insert into user (name, password, type, answer1, answer2, answer3, isPending) values
("peter", "05c60e65cae54a3364582dccf190e955", "admin", "", "", "", 0),
("leila", "d8e8de91f10ba4adf900a65203918df5", "admin", "", "", "", 0),
("marc",  "8b55849c65a291d77c476dc68cd6a555", "admin", "", "", "", 0),
("accounting", "45143951d8d46d2902dcc9b6d2fd884d", "finance", "", "", "", 0),
("jobboom", "366612fada618dc350f1035ee8ceaea9", "agent", "", "", "", 0),
("googleads", "14deb81a45ba42036204bfb588127a4f", "agent", "", "", "", 0),
("public", "f998eea644728e3a11925c3c8a40c48a", "registered", "", "", "", 0);

# Business
# User 5 (jobboom) has a business
# User 6 (googleads) does not

insert into business (userId, name, charter, address, city, state, country, postalCode, email, contactName, contactNumberLand, contactNumberMobile, contactNumberFax, contactPosition, contactEmail) values
(5, "Canoe inc.", NULL, "333 King Street East", "Toronto", "Ontario", "Canada", "M5A 3X5", "info@canoe.ca", "Tom Setzer", "(877) 448-4434 X 6150", "(416) 350-6150", "(416) 350-6238", "Representative of Online Services", "t_setzer@canoe.ca");

insert into ad (userId, content, counter, isPending, reported) values
(5, "Find a job on jobboom today!", 2, 0, 0),
(5, "Recruit employees using jobboom's easy to use recruiting tools", 300, 1, 0);

# Administrator

insert into administrator value (0, 0.10);
