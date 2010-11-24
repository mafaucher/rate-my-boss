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
PRIMARY KEY (superId)
);

# DOCUMENT

drop table document;
create table document
(
docId INT NOT NULL AUTO_INCREMENT,
orgId INT NOT NULL,
title VARCHAR(40) NOT NULL,
reported INT NOT NULL,
PRIMARY KEY (docId)
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
PRIMARY KEY (ratingId)
);

# ORGANIZATION EVALUATION

drop table orgEvaluation;
create table orgEvaluation
(
orgEvalId INT NOT NULL AUTO_INCREMENT,
orgId INT NOT NULL,
text VARCHAR(600) NOT NULL,
reported INT NOT NULL,
uString CHAR(32) NOT NULL,
PRIMARY KEY (orgEvalId)
);

# SUPERVISOR EVALUATION

drop table superEvaluation;
create table superEvaluation
(
superEvalId INT NOT NULL AUTO_INCREMENT,
superId INT NOT NULL,
text VARCHAR(600) NOT NULL,
reported INT NOT NULL,
uString CHAR(32) NOT NULL,
PRIMARY KEY (superEvalId)
);

# ORGANIZATION COMMENT

drop table orgComment;
create table orgComment
(
orgCommentId INT NOT NULL AUTO_INCREMENT,
orgEvaluationId INT NOT NULL,
text VARCHAR(600) NOT NULL,
reported INT NOT NULL,
uString CHAR(32) NOT NULL,
PRIMARY KEY (orgCommentId)
);

# SUPERVISOR COMMENT

drop table superComment;
create table superComment
(
superCommentId INT NOT NULL AUTO_INCREMENT,
superEvaluationId INT NOT NULL,
text VARCHAR(600) NOT NULL,
reported INT NOT NULL,
uString CHAR(32) NOT NULL,
PRIMARY KEY (superCommentId)
);

# SUPERVISOR COMMENT

drop table superComment;
create table superComment
(
superCommentId INT NOT NULL AUTO_INCREMENT,
superEvaluationId INT NOT NULL,
text VARCHAR(600) NOT NULL,
reported INT NOT NULL,
uString CHAR(32) NOT NULL,
PRIMARY KEY (superCommentId)
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

drop table user;
create table user
(
userId INT NOT NULL AUTO_INCREMENT,
password VARCHAR(40) NOT NULL,
type VARCHAR(40) NOT NULL,
answer1 VARCHAR(40) NOT NULL,
answer2 VARCHAR(40) NOT NULL,
answer3 VARCHAR(40) NOT NULL,
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
timestamp DATE,
reported INT NOT NULL,
PRIMARY KEY (adId)
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
PRIMARY KEY (businessId)
);

# INSERT VALUES

insert into organization (name, industryType, city, province, website, numberofEmployees, isPending) values ('Bell','telecommunications', 'Montreal', 'Quebec', 'www.bell.ca', 843, 1),
('Google','web', 'Irvine', 'California', 'www.google.ca', 307, 1);