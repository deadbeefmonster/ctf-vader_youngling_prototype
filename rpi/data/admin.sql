drop database if exists admin;
create database admin;
use admin;

-- Create permissions
drop user 'admin'@'%';
create user 'admin'@'%' identified by 'yisgicsyauvPifyamGowyeomCaisucef';
grant all on admin.* to 'admin'@'%';
flush privileges;

-- Create tables
create table admin.settings (
       id int unsigned auto_increment primary key,
       k varchar(100),
       v text,
       is_active boolean default true,
       added_ts timestamp,
       updated_ts timestamp
);
create index settings_k_active_idx on admin.setttings (k, is_active);
insert into admin.settings (k, v, added_ts, updated_ts) values ('aes_key', 'alderaan-lol-kaboom-lol', now(), now());
insert into admin.settings (k, v, added_ts, updated_ts) values ('hostname', 'admin.controller.empire', now(), now());
insert into admin.settings (k, v, added_ts, updated_ts) values ('superduperadmin', '2651304937', now(), now());


create table admin.login (
       id int unsigned auto_increment primary key,
       username varchar(100) not null comment 'login username',
       password varchar(32) not null comment 'MD5 password',
       is_admin boolean default false comment 'is admin (can update core firmware)',
       is_active boolean default false comment 'admin approval',
       reset_password_code varchar(32) default null,
       added_ts timestamp,
       updated_ts timestamp
);
create index login_username_idx on admin.login (username, is_active);
insert into admin.login (username, password, is_active, added_ts, updated_ts) values ('2651304937','7c5e7e5c08580bce324bc9213914f6ee', true, now(), now());

create table admin.login_log (
       username varchar(100) comment 'login username',
       password varchar(32) comment 'MD5 password',
       is_successful boolean,
       added_ts timestamp
);

create table admin.core_firmware_access (
       id int unsigned auto_increment primary key,
       login_id int unsigned references login(id),
       system_username varchar(100) not null comment 'core system username',
       public_key text not null comment 'ssh public key, added to system_username/.ssh/authorized_keys',
       firmware_b64 text comment 'base 64 .tar file, core runs tar against it',
       is_active boolean default true,
       added_ts timestamp,
       updated_ts timestamp
);
create index access_system_username_idx on admin.core_firmware_access (system_username);


