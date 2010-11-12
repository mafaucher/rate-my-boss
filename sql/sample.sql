#  Let us drop the table dept, if it  exists
drop table dept;
#  now create this table
create table dept
(DEPT CHAR(20) not null,
 CODE CHAR(4) primary key not null);
#  insert data in this table
insert into dept values('Computer Science', 'COMP');
insert into dept values('Decision Science', 'DISC');
drop table deptmajor;
create table deptmajor
(CODE CHAR(4),
 MAJOR CHAR(20),
primary key (CODE, MAJOR));
insert into deptmajor values('COMP', 'COTH');
insert into deptmajor values('COMP', 'SENG');
insert into deptmajor values('COMP', 'CSAP');
insert into deptmajor values('DISC', 'OPRS');
drop table course;
create table course
(CNAME CHAR(20),
 CNUMBER CHAR(8) primary key NOT NULL,
 CREDITS DECIMAL(2),
 ODEPT CHAR(4),
 foreign key (ODEPT) references dept(code)
 on delete cascade);
insert into course values('C++','COMP248',3,'COMP');
insert into course values('DATA STRUCTURES ','COMP352',3,'COMP');
insert into course values('OPERATING SYSTEMS','COMP346',4,'COMP');
insert into course values('DATABASE','COMP353',4,'COMP');
insert into course values('Operation Research','DISC253',4,'DISC');
drop table crs_section;
create table crs_section
(SECID DECIMAL(6) primary key NOT NULL,
 COURSE_NUM CHAR(8),
 SECTION CHAR(2),
 SEMESTER CHAR(4),
 YEAR CHAR(4),
 SCHEDULE CHAR(10),
 ROOM CHAR(7));
insert into crs_section values(85,'COMP352','A','FALL', '1998','TH16001715','H123');
insert into crs_section values(90,'COMP353','B','FALL','1999','MW08451000','H631');
insert into crs_section values(95,'DISC253','B','FALL','1999','MW10151130','H631');
drop table prereq;
create table prereq
(COURSE_Number CHAR(8),
 PREREQ CHAR(8),
 primary key (course_number, prereq));
insert into prereq values('COMP353','COMP352'); 
insert into prereq values('COMP353','COMP346'); 
insert into prereq values('COMP352','COMP248') ;
drop table student;

#--Dates could be specified as a string in the format 'yyyy-mm-dd'

#--yyyy can be 4 digits or two digits
#--4 digit should be in the range  '1901' to '2155'
#--Year Values in the ranges '00' to '69' and '70' to '99' are converted
#--to YEAR values in the ranges 2000 to 2069 and 1970 to 1999.
#--If the values are incorrct, the value '0000-00-00' is entered for the date.


create table student
(SID DECIMAL(7) primary key not null,
 SNAME VARCHAR(20),
 MAJOR CHAR(4),
 YEAR DECIMAL(1),
 BDATE DATE);
insert into student values(8,'Brenda','COMP','2','1977-08-13');
insert into student values(10,'Dupont','ENGL','1','80-05-13');
insert into student values(13,'Kelly','SENG','4','80-08-12');
insert into student values(14,'Jack','CSAP','1','77-02-12'); 
drop table enrollment;

create table enrollment
(STUDENT_NUMBER DECIMAL(3) not null,
 SECTION_ID DECIMAL(6) not null,
 GRADE CHAR(1),
 primary key(student_number, section_id));
insert into enrollment values(8,85,null); 
insert into enrollment values(10,90,null); 
insert into enrollment values(8,90,null); 
insert into enrollment values(14,90,null); 
insert into enrollment values(14,95,null) ;

select *
from student;;

#-- FUNCTION add_months does not exist in MYSQL - exercise  modify- 
#--update student 
#--set bdate=(select add_months(bdate,36)from dual)  
#--where sid=8;

mysql> update stud set BDATE=DATE_ADD(BDATE, INTERVAL  36 MONTH ) where sid=8;


# Oracle FUNCTION to_date does not exist in MYSQL - exercise  modify- 

#--select s.sname 
#--from student s 
#--where to_date(s.bdate) like '%13%';

mysql> select SNAME from STUDENT where date(BDATE) like '%13%';
#--+--------+
#--| sname  |
#--+--------+
#--| Dupont |
#--| Brenda |
#--+--------+


select * from student
where student.sid in (select s.sid from student s, dept d, course c, crs_section r, enrollment e
where  c.ODEPT=d.CODE and 
r.COURSE_NUM=c.CNUMBER and 
r.SECID=e.SECTION_ID and 
e.STUDENT_NUMBER = s.SID);

select s.SID, s.SNAME, s.MAJOR, s.YEAR, s.BDATE
from student s, dept d, course c, crs_section r, enrollment e
where  c.ODEPT=d.CODE and 
r.COURSE_NUM=c.CNUMBER and
r.SECID=e.SECTION_ID and 
e.STUDENT_NUMBER = s.SID and 
d.CODE= 'COMP';

select s.SID, s.SNAME, s.MAJOR, s.YEAR, s.BDATE
from student s, dept d, course c, crs_section r, enrollment e
where  c.ODEPT=d.CODE and 
r.COURSE_NUM=c.CNUMBER and
r.SECID=e.SECTION_ID and 
e.STUDENT_NUMBER = s.SID and 
d.CODE= 'DISC';

select s.SID, s.SNAME, s.MAJOR, s.YEAR, s.BDATE
from student s, dept d, course c, crs_section r, enrollment e
where  c.ODEPT=d.CODE and 
r.COURSE_NUM=c.CNUMBER and
r.SECID=e.SECTION_ID and 
e.STUDENT_NUMBER = s.SID and 
d.CODE= 'COMP';


select * 
from student s, dept d, course c, crs_section r, enrollment e
where  c.ODEPT=d.CODE and r.COURSE_NUM=c.CNUMBER 
and r.SECID=e.SECTION_ID and e.STUDENT_NUMBER = s.SID;
#-- Oracle format in SQLPlus
#-- column major format a5
#-- column sid format 9,9
#-- column sname format a12
#-- column major format a5
#-- column year format 999
#-- column bdate format a12;
#-- ##  HOW DO YOU FORMAT OUTPUT COLUMN SIZES IN MYSQL???

#--# Oracle FUNCTION to_date does not exist in MYSQL - exercise  modify- 
#--select s.sname 
#--from student s 
#--where to_date(s.bdate) like '%AUG%';

mysql> select sname from stud where date(BDATE) like '%-08-%';
#--+--------+
#--| sname  |
#--+--------+
#--| Brenda |
#--| Kelly  |
#--+--------+
#--2 rows in set, 1 war
#--select power(2,10) from dual;;

#--# Oracle FUNCTION to_date does not exist in MYSQL - exercise  modify- 
#--select to_date(sysdate) from dual;
mysql> select current_date;
+--------------+
| current_date |
+--------------+
| 2010-09-25   |
+--------------+
1 row in set (0.00 sec)


#--# Oracle FUNCTION to_date does not exist in MYSQL - exercise  modify- 
#--select s.sname 
#--from student s 
#--where to_date(s.bdate) like '%77%';
mysql> select sname from stud where date(BDATE) like '%77-%-%';
#--+-------+
#--| sname |
#--+-------+
#--| Jack  |
#--+-------+
#--1 row in set, 1 warning (0.00 sec)



