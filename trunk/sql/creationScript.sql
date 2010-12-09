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
adId INT NOT NULL,
keyword VARCHAR(40) NOT NULL,
PRIMARY KEY (tagId),
FOREIGN KEY (adId) REFERENCES ad
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
question1 VARCHAR(100) NOT NULL,
question2 VARCHAR(100) NOT NULL,
question3 VARCHAR(100) NOT NULL,
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
lastView TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
hits INT NOT NULL DEFAULT 0,
cost DECIMAL(10,2) NOT NULL,
isPending INT NOT NULL,
PRIMARY KEY (adId),
FOREIGN KEY (userId) REFERENCES user
);

# BUSINESS

drop table business;
create table business
(
userId INT NOT NULL,
name VARCHAR(40),
address VARCHAR(40),
city VARCHAR(40),
state VARCHAR(40),
country VARCHAR(40),
website VARCHAR(40) NOT NULL,
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

# LOGIN ACTIVITY

drop table loginActivity;
create table loginActivity
(
time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
userId INT NOT NULL,
type VARCHAR(40) NOT NULL,
PRIMARY KEY (time, userId, type),
FOREIGN KEY (userId) REFERENCES user
);

# FINANCIAL ACTIVITY

drop table financialActivity;
create table financialActivity
(
time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
userId INT NOT NULL,
type VARCHAR(40) NOT NULL,
amount DECIMAL(10,2) NOT NULL,
PRIMARY KEY (time, userId, type),
FOREIGN KEY (userId) REFERENCES user
);

# ORGANIZATION

# INSERT VALUES
# NOT PENDING: 1 = Bell, 2 = Google, 3 = Hydro-Québec, 4 = Microsoft, 5 = Telus,
# IS PENDING:  6 = Disney, 7 = BASF, 8 = Rogers, 9 = FedEx, 10 = Molson

insert into organization (name, industryType, city, province, website, numberofEmployees, isPending) values
('Bell','Telecommunications', 'Montreal', 'Quebec', 'www.bell.ca', 843, 0),
('Google','web', 'Irvine', 'California', 'www.google.ca', 307, 0),
('Hydro-Québec','Generation/Distribution of Electricity', 'Montreal', 'Quebec', 'www.hydroquebec.com', 23616, 0),
('Microsoft','Manufacturing Computing Devices and IT', 'Redmond',  'Washington', 'www.microsoft.com', 89000, 0),
('Telus', 'Telecommunications', 'Burnaby', 'British Columbia',' www.telus.com',36600, 0),
('Disney','Media and Entertainment', 'Los Angeles', 'California','www.disney.com', 150000, 1),
('BASF', 'Chemicals and Energy', 'Ludwigshafen','Germany','www.basf.com', 104780, 1),
('Rogers', 'Communications Services', 'Toronto', 'Ontario','www.rogers.com', 29000,1),
('FedEx','Courier','Memphis','Tennessee', 'FedEx.com',280000, 1),
('Molson','Beverages','Montreal','Canada', 'http://www.molson.com', 3000, 1);

insert into supervisor (orgId, title, isPending) values
(1, 'CEO', 0),
(1, 'Janitor', 1),
(2, 'BossofallBosses', 1),
(2, 'President',0),
(2, 'VP External', 0 ),
(3, 'VP Internal',0),
(4, 'VP Social', 0),
(4, 'VP Affairs', 0),
(5, 'VP Finance',0),
(6, 'VP Marketing', 0);

#Ratings
#uString = md5(rating#)

insert into rating (orgId, socialValues, professionalism, openness, encouraging, acceptance, recognition, qualityWorkplace, fairness, cooperation, rewardSystem, fairWages, qualityBenefits, supportEmployees, levelStress, levelCollegiality, levelBureaucracy, advancement, supportFamily, uString) values
(1, 5, 8, 8, 6, 4, 9, 8, 6, 7, 7, 9, 6, 5, 4, 7, 6, 8, 9, '05406e0d07c96b6e2c622a901d4b9f52'),
(1, 7, 8, 1, 3, 5, 9, 8, 2, 8, 3, 6, 5, 8, 4, 5, 6, 1, 3, 'e329b60baaecdcfad0a15662bf1a949c'),
(1, 6, 8, 5, 9, 6, 8, 6, 3, 8, 7, 8, 6, 7, 3, 8, 7, 7, 8, '59cf43803003a8ccad9e5147dd4e93e2'),
(2, 6, 8, 5, 9, 5, 7, 6, 3, 9, 6, 8, 7, 8, 3, 9, 6, 6, 9, 'cad9e521d4ef33a8c162380309cf097e'),
(2, 7, 9, 3, 8, 6, 8, 5, 4, 7, 8, 8, 7, 9, 4, 7, 5, 7, 8, 'a8ccf43803093e2adf39c47d9e5d4e17'),
(2, 5, 8, 4, 9, 6, 9, 7, 3, 8, 7, 8, 6, 8, 2, 9, 5, 6, 9, 'ddf43904003a8eca3fe9e5147c93e392'),
(3, 5, 9, 9, 5, 3, 7, 4, 5, 9, 7, 5, 6, 8, 3, 9, 4, 7, 7, 'aecb60bdacfbf1aa296e32d0a1949c16'),
(3, 6, 7, 8, 4, 4, 8, 5, 5, 8, 7, 7, 6, 9, 5, 9, 5, 5, 9, '7c0d0966eb62a91d4bf252f02c540e09'),
(3, 5, 8, 8, 5, 4, 8, 3, 6, 8, 7, 6, 7, 8, 3, 9, 5, 6, 8, '4ae32cd0a15660bdb4e6fa2bf1a9ac0c');

# User

# admin:		1 = peter - p_rockw; 2 = leila - l_behja; 3 = marc - ma_fauch;
# finance:		4 = accounting - cashman
# agent:		5 = jobboom - getajob; 6 = googleads - dontbeevil; 7 = shoppingC - shoptillyoudrop;
#				8 = sonyrep - s0nyads; 9 = monster - perfectjob; 10 = chevrolet - che5rolet;
# registered:	11 = public - dbs0610
insert into user (name, password, type, question1, question2, question3, answer1, answer2, answer3, isPending) values
("peter", "05c60e65cae54a3364582dccf190e955", "admin", "", "", "", "", "", "", 0),
("leila", "d8e8de91f10ba4adf900a65203918df5", "admin", "", "", "", "", "", "", 0),
("marc",  "8b55849c65a291d77c476dc68cd6a555", "admin", "", "", "", "", "", "", 0),
("accounting", "45143951d8d46d2902dcc9b6d2fd884d", "finance", "", "", "", "", "", "", 0),
("jobboom", "366612fada618dc350f1035ee8ceaea9", "agent", "", "", "", "", "", "", 0),
("googleads", "14deb81a45ba42036204bfb588127a4f", "agent", "", "", "", "", "", "", 0),
("shoppingC", "aaa19b4dd59a02f07cdc6385fdbd4a7f", "agent", "", "", "", "", "", "", 0),
("sonyrep", "73aae60d44506d07110d46ddb2f74c14", "agent", "", "", "", "", "", "", 0),
("monster", "ef78690c3dc4fe9ec4b74ff8d676e672", "agent", "", "", "", "", "", "", 0),
("chevrolet", "5b567433a35acf5d77b0926f1dd6e293", "agent", "", "", "", "", "", "", 0),
("public", "f998eea644728e3a11925c3c8a40c48a", "registered", "", "", "", "", "", "", 0);

# Business
# Users 5, 7, 8, 9, 10 has a business
# User 6 (googleads) does not

insert into business (userId, name, address, city, state, country, website, contactName, contactNumberLand, contactNumberMobile, contactNumberFax, contactPosition, contactEmail) values
(5, "Canoe inc.", "333 King Street East", "Toronto", "Ontario", "Canada", "www.canoe.ca", "Tom Setzer", "(877) 448-4434 X 6150", "(416) 350-6150", "(416) 350-6238", "Representative of Online Services", "info@canoe.ca");

# Ad

insert into ad (userId, content, counter, cost, isPending) values
(5, "Find a job on jobboom today!", 2, 0, 0),
(5, "Recruit employees using jobboom's easy to use recruiting tools", 300, 3.0, 1),
(8, "Shoot unforgeteable shot with a single sweep SONY",3,0, 0),
(8, "Best pictures ever only with SONY ",500, 4.0, 1),
(9, "Thousands of employers search resumes on Monster everyday!", 4, 0, 0),
(9, "Help employers to find you on Monster", 400, 3.0, 1),
(9, "Make your resume searchable to employers only with Monster ", 200, 2.0, 1),
(7, "Finding the best holidays present to your love one only at theshoppingchannel.com ", 5, 0, 0),
(7, "Add warmth & comfort to your bedroom by shopping online at theshoppingchannel.com ", 400, 5.0, 1),
(10, "Leave the competition behind with CHEVROLET", 6, 0, 0),
(10, "CHEVROLET again eith better highway fuel efficiency than a 2010 Accord", 800, 6.5, 1);

# Administrator

insert into administrator value (0, 0.1);
