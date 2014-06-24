create database toonify;

use toonify;

create table company(company_id varchar(10) primary key, company_name varchar(30) not null, ip_add_start_range varchar(15) not null, ip_add_end_range varchar(15) not null);


create table users(user_id varchar(10) primary key, user_name varchar(30) not null, password varchar(15) not null, role varchar(20) not null, company_id varchar(10), foreign key (company_id) references company(company_id));


create table content(video_id varchar(15) primary key, video_name varchar(30) not null, video_desc blob not null, company_id varchar(10), video_url varchar(30) not null, foreign key (company_id) references company(company_id));



create table content_details(detail_id varchar(15) primary key, video_id varchar(15) not null, asset_info blob not null, foreign key(video_id) references content(video_id));

