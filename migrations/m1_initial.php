<?php

class m1_initial{

    public function up(){

        $password = password_hash("123456789", PASSWORD_DEFAULT);


       return "
       create table if not exists hospital_parts
(
    id int not null primary key auto_increment,
    partName varchar(255) not null
);

create table if not exists doctors
    (
        id    int not null primary key auto_increment,
        email varchar(500) not null ,
        password varchar(255) not null,
        status   enum ('Not accepted', 'Confirmed') not null,
        name varchar(255) null,
        doctorateId int null,
        partId int null,
        profileImage varchar(500) DEFAULT 'ProfileImages/defaultuser.png' ,
        history text null,
        availableTimes text null,
        patientsList text null ,
        foreign key (partId) references hospital_parts (id)  ON DELETE SET NULL ON UPDATE SET NULL
    );

create table if not exists managers
    (
        id int not null primary key auto_increment,
        email varchar(500) not null,
        password varchar(500) not null,
        status   enum ('Not accepted', 'Confirmed') not null,
        name varchar(255) ,
        profileImage varchar(500) DEFAULT 'ProfileImages/defaultuser.png',
        age int ,
        history text null 
    );

create table if not exists patients
    (
        id int not null primary key auto_increment,
        email varchar(500) not null,
        password varchar(255) not null,
        name varchar(255) ,
        age int ,
        profileImage varchar(500) DEFAULT 'ProfileImages/defaultuser.png',
        doctorsList text null ,
        history text null 
    );

    insert into managers(email, password, status, name) values ('admin@admin.com', '$password', 'Confirmed', 'admin'); 
";
    }

    public function down(){
        return"
        drop table doctors;
    drop table managers;
    drop table patients;
    drop table hospital_parts;
    ";
    }
}