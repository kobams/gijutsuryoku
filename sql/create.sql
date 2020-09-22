drop database if exists example;
create database example default character set utf8 collate utf8_general_ci;
grant all on example.* to 'staff'@'localhost' identified by 'Qwerty098!';
use example;

create table contact (
    id int auto_increment primary key,
    kenmei varchar(15) not null,
    name varchar(60) not null,
    email varchar(256) not null,
    tel varchar(20) not null,
    message varchar(1000) not null
);