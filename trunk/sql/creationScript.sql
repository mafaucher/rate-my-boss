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
filename VARCHAR(100) NOT NULL,
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
name VARCHAR(40) Not Null,
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

# USER ACTIVITY

drop table userActivity;
create table userActivity
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

# ********************************* Start filling into the tables *********************************
# ORGANIZATION

# INSERT VALUES
# NOT PENDING: 1 = Bell, 2 = Google, 3 = Hydro-Québec, 4 = Microsoft, 5 = Telus, 6 = Disney, 7 = BASF,
# IS PENDING:  8 = Rogers, 9 = FedEx, 10 = Molson

insert into organization (name, industryType, city, province, website, numberofEmployees, isPending) values
('Bell','Telecommunications', 'Montreal', 'Quebec', 'www.bell.ca', 843, 0),
('Google','web', 'Irvine', 'California', 'www.google.ca', 307, 0),
('Hydro-Québec','Generation/Distribution of Electricity', 'Montreal', 'Quebec', 'www.hydroquebec.com', 23616, 0),
('Microsoft','Manufacturing Computing Devices and IT', 'Redmond',  'Washington', 'www.microsoft.com', 89000, 0),
('Telus', 'Telecommunications', 'Burnaby', 'British Columbia',' www.telus.com',36600, 0),
('Disney','Media and Entertainment', 'Los Angeles', 'California','www.disney.com', 150000, 0),
('BASF', 'Chemicals and Energy', 'Ludwigshafen','Germany','www.basf.com', 104780, 0),
('Rogers', 'Communications Services', 'Toronto', 'Ontario','www.rogers.com', 29000,1),
('FedEx','Courier','Memphis','Tennessee', 'FedEx.com',280000, 1),
('Molson','Beverages','Montreal','Canada', 'http://www.molson.com', 3000, 1);


# SUPERVISOR
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


# DOCUMENT - when a document is uploaded it will exist in the documents folder yet may not come up on the site until it is no longer pending

INSERT INTO document (orgId, title,filename, reported) values
(1, "Bell gives you access to Canada`s best network", "Bell.txt", 0),
(1, "Bell PDF details", "Bell.pdf", 0),
(2, "Google : the best search engine","Google.pdf", 0),
(3, "Hydro-Qubec keeping Quebec power rates among the lowest in North America","Hydro-Quebec.txt", 0),
(4, "Microsoft dominate the office suit market with Microsoft Office","Microsoft.txt", 0),
(5, "Telus :  Canada`s second largest telcom with 22% of market share","Telus.txt", 0),
(6, "Disney : largest media and entertainment conglomerate in the world in terms of revenue","Disney.pdf", 0),
(7, " BASF is the world\'b4s leading chemical company","BASF.pdf", 1);

# DOCUMENT COMMENT 

INSERT INTO docComment (docId, text, reported, uString) values
(1, "What an informative document!", 0, ""),
(1, "Excellent info ever", 0, ""),
(1, "Not a comprehensive document!", 0, ""),
(2, "The Best overview", 0, ""),
(2, "This document definitely improved my general knowledge!", 0, ""),
(2, "Wow! This is an interesting document!", 0, ""),
(2, "What an informative document!", 0, ""),
(3, "A good quick look", 0, ""),
(3, "With this doc, I know more about the Hydro-Qubec", 0, ""),
(3, "Hydro-Qubec the lowest rates in North America! That`s amazing!", 0, ""),
(4, "This document surprised me!!!", 0, ""),
(4, "This doc doesn`t tell much about Microsoft", 0, ""),
(4, "What an informative document!", 0, ""),
(5, "Not a good source of info!", 0, ""),
(5, "What an informative document!", 0, ""),
(6, "A good document", 0, ""),
(6, "An excellent document!",0, ""),
(6, "This is an amazing document", 0, ""),
(7, "This should give a knowledge to general public, not specific details...", 0, ""),
(7, "I enjoed reading this", 0, ""),
(7, "What an excellent doc!", 0, ""),
(7, "What an informative document!", 0, "")
;

# ORGANIZATION EVALUATION


INSERT INTO orgEvaluation (orgId, title, text, reported, uString) values
(1, "Great company!", "I love working for this company because I get free internet and calling with them. That`s all I really need in life.", 0, ""),
(2, "Love working for this company", "I love working for this company because it has a friedly environment.", 0, ""),
(3, "Bad company!", "I am not happy with this company since it doesn`t provide any promotion for its employees.", 0, ""),
(4, "The best company in the world!", "Whenver you are in this company, you feel you are at home, this makes everyone to work more efficiently.", 0, ""),
(5, "No doubt about its greatness", "You have every thing that you need in one place...that`s our workplace.", 0, ""),
(6, "Best one in my city", "You are always treated like a guest", 0, ""),
(7, "I love working for this company", "Not only it cares for its employees, it also cares about their family.", 0, "");


# ORGANIZATION COMMENTS

INSERT INTO orgComment (orgCommentId, orgEvalId, text, reported, uString) values
(1, 1, "Satisfied with general performance od the company.", 0, ""),
(2, 1,"Satisfied", 0, ""),
(3, 1,"Dissatisfied since their charge a lot!!!", 0, ""),
(4, 2, "Very Satisfied since it cares about every aspect of the life.", 0, ""),
(5, 2, "Very Satisfied of their services.", 0, ""),
(6, 2, "Satisfied. They have anything that we look for.", 0, ""),
(7, 3, "Dissatisfied! their response is slow", 0, ""),
(8, 3, "Satisfied.", 0, ""),
(9, 4, "Very Disstisfied!!! they do not have a real customer services!", 0, ""),
(9, 4, "Disstisfied!!! they do not have a real customer services!", 0, ""),
(10, 4, "Satisfied, they have the best products.", 0, ""),
(11, 4, "Very Satisfied of their services.", 0, ""),
(12, 5, "Dissatisfied! This companies ratings are too high!", 0, ""),
(13, 5, "Dissatisfied! They charge a lot!", 0, ""),
(14, 5, "Satisfied.", 0, ""),
(15, 6, "Satisfied: It bring the happiness specially to children.", 0, ""),
(16, 6, "Satisfied since it keeps children happy.", 0, ""),
(18, 6, "Satisfied: It bring the happiness specially to children.", 0, ""),
(17, 7, "Very Satisfied because of their fast reply to their customers.", 0, "");



# SUPERVISOR EVALUATION
 

INSERT INTO superEvaluation(superId, title, text, reported, uString) values
(1, "Great CEO!", "I love working for this CEO because of his friendliness. ", 0, ""),
(4, "Best President!", "I love working for this  President because of his friendliness.", 0, ""),
(5, "Great VP External!", "I like him, he is so kind.", 0, ""),
(6, "Not a good VP Internal!", "This VP Internal is lazy.", 0, ""),
(7, "Great VP Social!", "I love working with him, he is so helpful in every aspect.", 0, ""),
(8, "Lazy VP Affairs!", "This VP Affairs doen`t care about those who are in it.", 0, ""),
(9, "Bad VP Finance!", " This VP Finance can do better tham this but he doesn`t try.", 0, ""),
(10, "Great VP Marketing!", "I enjoy working with this VP Marketing because of his brilliant ideas.", 0, "");


#Ratings - All the uStrings are modified
#uString = md5(rating#)

insert into rating (orgId, socialValues, professionalism, openness, encouraging, acceptance, recognition, qualityWorkplace, fairness, cooperation, rewardSystem, fairWages, qualityBenefits, supportEmployees, levelStress, levelCollegiality, levelBureaucracy, advancement, supportFamily, uString) values
(1, 5, 8, 8, 6, 4, 9, 8, 6, 7, 7, 9, 6, 5, 4, 7, 6, 8, 9, '05406e0d07c96b6e2c622a901d4b9f52'),
(1, 7, 8, 1, 3, 5, 9, 8, 2, 8, 3, 6, 5, 8, 4, 5, 6, 1, 3, 'e329b60baaecdcfad0a15662bf1a949c'),
(1, 6, 8, 5, 9, 6, 8, 6, 3, 8, 7, 8, 6, 7, 3, 8, 7, 7, 8, '59cf43803003a8ccad9e5147dd4e93e2'),
(2, 6, 8, 5, 9, 5, 7, 6, 3, 9, 6, 8, 7, 8, 3, 9, 6, 6, 9, '26f4a71ab712f352d003b91a7f91702e'),
(2, 7, 9, 3, 8, 6, 8, 5, 4, 7, 8, 8, 7, 9, 4, 7, 5, 7, 8, 'f7c90596d2b3675b0f1cd96316dc4245'),
(2, 5, 8, 4, 9, 6, 9, 7, 3, 8, 7, 8, 6, 8, 2, 9, 5, 6, 9, '7f510eafe4050dd783b2920e88e583f4'),
(3, 5, 9, 9, 5, 3, 7, 4, 5, 9, 7, 5, 6, 8, 3, 9, 4, 7, 7, '2247eab1fcc1c01d132636d789d463e5'),
(3, 6, 7, 8, 4, 4, 8, 5, 5, 8, 7, 7, 6, 9, 5, 9, 5, 5, 9, '299a1cb2a1bbee8155e8ffd353314203'),
(3, 5, 8, 8, 5, 4, 8, 3, 6, 8, 7, 6, 7, 8, 3, 9, 5, 6, 8, '81e1931f40c48a03fe2084e3f4bb4e77');

# User

# admin:                1 = peter - p_rockw; 2 = leila - l_behja; 3 = marc - ma_fauch;
# finance:              4 = accounting - cashman
# agent:                5 = jobboom - getajob; 6 = googleads - dontbeevil; 7 = shoppingC - shoptillyoudrop;
#                               8 = sonyrep - s0nyads; 9 = monster - perfectjob; 10 = chevrolet - che5rolet;
# registered:   11 = public - dbs0610
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

# Business New Version
# Only Users 5, 7, 8, 9, 10 has a business

insert into business (userId, name, website, contactName) values
(7,"Shopping Channel place that you find everything", "www.theshoppingchannel.com", "Kryzstof Moullan"),
(8,"SONY make & believe", "www.sony.ca", "Allan Smith"),
(9,"Monster job search", "www.jobsearch.monster.ca", "Richard Cygan"),
(10,"Car Company", "www.GM.ca/Chevrolet", "Bill Acemian" );
 

# Ad

insert into ad (userId, content, counter, cost, isPending) values
(5, "Find a job on jobboom today!", 2, 0.0, 0),
(5, "Recruit employees using jobboom`s easy to use recruiting tools", 300, 0.0, 0),
(8, "Shoot unforgeteable shot with a single sweep SONY", 3, 0.0, 0),
(8, "Best pictures ever only with SONY ",500, 0.0, 0),
(9, "Thousands of employers search resumes on Monster everyday!", 4, 0.0, 0),
(9, "Help employers to find you on Monster", 400, 3.0, 1),
(9, "Make your resume searchable to employers only with Monster ", 200, 2.0, 1),
(7, "Finding the best holidays present to your love one only at theshoppingchannel.com ", 5, 0.5, 1),
(7, "Add warmth & comfort to your bedroom by shopping online at theshoppingchannel.com ", 400, 5.0, 1),
(10, "Leave the competition behind with CHEVROLET", 0, 0.0, 0),
(10, "CHEVROLET again eith better highway fuel efficiency than a 2010 Accord", 800, 6.5, 1);



# TAG -(adId is the order in which you added the ads)

insert into tag (adId, keyword) values
(1, "job"), (1, "find"), (1, "today"), (1,"jobboom"),
(2, "recruit"), (2, "employee"), (2, "job"), (2,"easy"),
(3, "shot"), (3, "sony"), (3,"unforgeteable "), (3, "sweep"),
(4, "picture"), (4, "sony"),(4,"ever"), 
(5, "resume"), (5, "monster"),(5, "search"), (5, "job"),(5, "Thousands"),
(10,"CHEVROLET"),(10,"competition"),(10,"Car"),(10,"behind");



# Administrator

insert into administrator value (0, 0.1);







