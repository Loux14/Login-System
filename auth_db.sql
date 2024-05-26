DROP DATABASE IF EXISTS auth_db;

CREATE DATABASE auth_db CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

USE auth_db;

CREATE TABLE users (
  user_id      INT PRIMARY KEY AUTO_INCREMENT,
  name         VARCHAR(100),
  email        VARCHAR(100) UNIQUE NOT NULL,
  hash         VARCHAR(100) NOT NULL,
  salt         VARCHAR(50) NOT NULL,
  secret       VARCHAR(60) NOT NULL
);

CREATE TABLE logs (
  log_id       INT PRIMARY KEY AUTO_INCREMENT,
  ip_address   VARCHAR(20),
  user_agent   VARCHAR(200),
  log_dt       TIMESTAMP,
  user_id      VARCHAR(50),
  main_log     VARCHAR(4000) NOT NULL,
  supp_log     VARCHAR(4000),
  log_type     VARCHAR(100) NOT NULL
);

DROP USER IF EXISTS auth_db_admin;

CREATE USER auth_db_admin IDENTIFIED BY 'password123';

GRANT ALL PRIVILEGES ON auth_db.* TO auth_db_admin;
