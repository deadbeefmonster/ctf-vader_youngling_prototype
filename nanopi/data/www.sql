drop database if exists www;
create database www;
use www;
drop user 'www'@'%';
create user 'www'@'%' identified by 'DEVS-UPDATE-THIS';
grant all on www.* to 'www'@'%';
flush privileges;
drop user 'www_ro'@'%';
create user 'www_ro'@'%' identified by 'DEVS-UPDATE-THIS';
grant USAGE,SELECT on www.* to 'www_ro'@'%';
flush privileges;


create table www.login (
       id int unsigned auto_increment primary key,
       username varchar(100) not null comment 'login username',
       password varchar(32) not null comment 'MD5 password',
       added_ts timestamp,
       updated_ts timestamp
);

create table www.notes (
       id int unsigned auto_increment primary key,
       login_id int unsigned references login(id),
       subject varchar(256) not null,
       note text not null,
       is_hidden boolean default false,
       added_ts timestamp,
       updated_ts timestamp
);
