USE user_db;
CREATE TABLE user (
     username VARCHAR(50) UNIQUE  NOT NULL,
     password VARCHAR(50) NOT NULL,
     PRIMARY KEY (username)
);