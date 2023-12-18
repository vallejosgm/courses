-------------------------- copy and paste to your local mysql server -------------------------------
drop database if exists php_course;
create database php_course;
use php_course;
create table bestdish (id int auto_increment primary key, country varchar(40), votes int);
insert into bestdish (country, votes) values ('France', 0), ('Italy', 0),('USA', 0),('Peru', 0);
select * from bestdish;
----------------------------------------------------------------------------------------------------


---------------------------- copy and paste to your remote server ----------------------------------
create table bestdish (id int auto_increment primary key, country varchar(40), votes int);
insert into bestdish (country, votes) values ('France', 0), ('Italy', 0),('USA', 0),('Peru', 0);
select * from bestdish;
----------------------------------------------------------------------------------------------------
