create database marketplace;
use marketplace;

create table user(
    'user_id' int primary key auto_increment,
    'user_full_name' varchar(30) not null,
    'user_name' varchar(15) not null,
    'user_gender' varchar(10) not null,
    'user_email' varchar(20) not null,
    'user_password' varchar(10) not null,
    'user_phone_number' varchar(15) not null unique
    'user_status' integer not null,
    'key' varchar(6) not null,
    'time_generate' varchar(8) not null,
    'activation_code' varchar(6) not null,
);
