USE nhathuocsuckhoeDB;
DROP DATABASE IF EXISTS nhathuocsuckhoeDB;
CREATE DATABASE nhathuocsuckhoeDB;

USE nhathuocsuckhoeDB;
-- DROP TABLE IF EXISTS users;
CREATE TABLE users (
    u_id INT NOT NULL AUTO_INCREMENT,
    u_name TEXT NOT NULL,
    u_phone INT NOT NULL,
    u_address TEXT,
    u_email TEXT,
    u_password TEXT NOT NULL,
    u_point INT,
    remember_token TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    primary key (u_id)
);
