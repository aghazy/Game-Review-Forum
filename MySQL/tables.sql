-- code written in mysql
CREATE TABLE Members (
    email VARCHAR(50) PRIMARY KEY,
    password VARCHAR(50) NOT NULL,
    preferred_game_genre VARCHAR(20)
);

CREATE TABLE Normal_Users (
    email VARCHAR(50) PRIMARY KEY,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    date_of_birth DATETIME NOT NULL,
    age INT,
    FOREIGN KEY (email)
        REFERENCES Members (email)
        ON DELETE CASCADE
);

DELIMITER $$
CREATE TRIGGER age_column_insert BEFORE INSERT ON Normal_Users
FOR EACH ROW BEGIN
SET NEW.age = (year(current_timestamp()) - year(NEW.date_of_birth));
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER age_column_update BEFORE UPDATE ON Normal_Users
FOR EACH ROW BEGIN
SET NEW.age = (year(current_timestamp()) - year(NEW.date_of_birth));
END $$
DELIMITER ;

CREATE TABLE System_Administrators (
    email VARCHAR(50) PRIMARY KEY,
    password VARCHAR(50) NOT NULL
);

CREATE TABLE Verified_Reviewers (
    email VARCHAR(50) PRIMARY KEY,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    start_date DATETIME NOT NULL,
    verified BIT NOT NULL DEFAULT 0,
    experience_years INT,
    admin_email VARCHAR(50) default null,
    FOREIGN KEY (admin_email)
        REFERENCES System_Administrators (email),
    FOREIGN KEY (email)
        REFERENCES Members (email)
        ON DELETE CASCADE
);

DELIMITER $$
CREATE TRIGGER experience_years_column_insert BEFORE INSERT ON Verified_Reviewers
FOR EACH ROW BEGIN
SET NEW.experience_years = (year(current_timestamp()) - year(NEW.start_date));
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER experience_years_update BEFORE UPDATE ON Verified_Reviewers
FOR EACH ROW BEGIN
SET NEW.experience_years = (year(current_timestamp()) - year(NEW.start_date));
END $$
DELIMITER ;

CREATE TABLE Development_Teams (
    email VARCHAR(50) PRIMARY KEY,
    formation_date DATETIME NOT NULL,
    team_name VARCHAR(20) NOT NULL,
    company VARCHAR(20),
    verified BIT NOT NULL DEFAULT 0,
    admin_email VARCHAR(50) default null,
    FOREIGN KEY (admin_email)
        REFERENCES System_Administrators (email)
        ON DELETE SET NULL,
    FOREIGN KEY (email)
        REFERENCES Members (email)
        ON DELETE CASCADE
);

create table Conferences(
id int primary key Auto_increment,
name varchar(20) NOT NULL,
start_date datetime NOT NULL,
end_date datetime NOT NULL,
duration int,
venue varchar(30) NOT NULL
);

DELIMITER $$
CREATE TRIGGER duration_column_insert BEFORE INSERT ON Conferences
FOR EACH ROW BEGIN
SET NEW.duration = (DATEDIFF(NEW.end_date, NEW.start_date) +1);
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER duration_column_update BEFORE UPDATE ON Conferences
FOR EACH ROW BEGIN
SET NEW.duration = (DATEDIFF(NEW.end_date, NEW.start_date) +1);
END $$
DELIMITER ;

CREATE TABLE Games (
    name VARCHAR(50) PRIMARY KEY,
    rating DOUBLE,
    release_date DATETIME NOT NULL,
    age_limit INT,
    developer_email VARCHAR(50),
    conference_id INT,
    FOREIGN KEY (developer_email)
        REFERENCES Development_Teams (email)
        ON DELETE SET NULL,
    FOREIGN KEY (conference_id)
        REFERENCES Conferences (id)
        ON DELETE SET NULL
);

CREATE TABLE Game_Screenshots (
    name VARCHAR(50),
    screenshot VARCHAR(200),
    FOREIGN KEY (name)
        REFERENCES Games (name)
        ON DELETE CASCADE,
    PRIMARY KEY (name , screenshot)
);

CREATE TABLE Game_Gameplays (
    name VARCHAR(50),
    gameplay VARCHAR(200),
    FOREIGN KEY (name)
        REFERENCES Games (name)
        ON DELETE CASCADE,
    PRIMARY KEY (name , gameplay)
);

CREATE TABLE Sport_Games (
    name VARCHAR(50) PRIMARY KEY,
    sport_type VARCHAR(20) NOT NULL,
    FOREIGN KEY (name)
        REFERENCES Games (name)
        ON DELETE CASCADE
);

CREATE TABLE Strategy_Games (
    name VARCHAR(50) PRIMARY KEY,
    real_time BIT NOT NULL,
    FOREIGN KEY (name)
        REFERENCES Games (name)
        ON DELETE CASCADE
);

CREATE TABLE RPG_Games (
    name VARCHAR(50) PRIMARY KEY,
    storyline text NOT NULL,
    pvp BIT NOT NULL,
    FOREIGN KEY (name)
        REFERENCES Games (name)
        ON DELETE CASCADE
);

CREATE TABLE Action_Games (
    name VARCHAR(50) PRIMARY KEY,
    sub_genere VARCHAR(20) NOT NULL,
    FOREIGN KEY (name)
        REFERENCES Games (name)
        ON DELETE CASCADE
);

CREATE TABLE Conference_Reviews (
    id INT PRIMARY KEY AUTO_INCREMENT,
    review TEXT NOT NULL,
    date DATETIME NOT NULL,
    conference_id INT NOT NULL,
    member_email VARCHAR(50) NOT NULL,
    FOREIGN KEY (member_email)
        REFERENCES Members (email)
        ON DELETE CASCADE,
    FOREIGN KEY (conference_id)
        REFERENCES Conferences (id)
        ON DELETE CASCADE
);

CREATE TABLE Game_Reviews (
    id INT PRIMARY KEY AUTO_INCREMENT,
    review TEXT NOT NULL,
    date DATETIME NOT NULL,
    writer_email VARCHAR(50) NOT NULL,
    game_name VARCHAR(50) NOT NULL,
    FOREIGN KEY (writer_email)
        REFERENCES Verified_Reviewers (email)
        ON DELETE CASCADE,
    FOREIGN KEY (game_name)
        REFERENCES Games (name)
        ON DELETE CASCADE
);

CREATE TABLE Communities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    admin_approved VARCHAR(50) default null,
    user_request VARCHAR(50) NOT NULL,
    FOREIGN KEY (admin_approved)
        REFERENCES System_Administrators (email),
    FOREIGN KEY (user_request)
        REFERENCES Normal_Users (email)
        ON DELETE CASCADE
);

CREATE TABLE Topics (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    description_text TEXT NOT NULL,
    member_email VARCHAR(50) NOT NULL,
    community_id INT NOT NULL,
    FOREIGN KEY (member_email)
        REFERENCES Members (email)
        ON DELETE CASCADE,
    FOREIGN KEY (community_id)
        REFERENCES Communities (id)
        ON DELETE CASCADE
);

CREATE TABLE Conferences_AttendedBy_Members (
    member_email VARCHAR(50) NOT NULL,
    conference_id INT NOT NULL,
    FOREIGN KEY (member_email)
        REFERENCES Members (email)
        ON DELETE CASCADE,
    FOREIGN KEY (conference_id)
        REFERENCES Conferences (id)
        ON DELETE CASCADE,
    PRIMARY KEY (member_email , conference_id)
);

CREATE TABLE Games_RatedBy_Members (
    member_email VARCHAR(50) NOT NULL,
    game_name VARCHAR(50) NOT NULL,
    level_design INT NOT NULL,
    CHECK (0 <= level_design <= 5),
    interactivity INT NOT NULL,
    CHECK (0 <= interactivity <= 5),
    uniqueness INT NOT NULL,
    CHECK (0 <= uniqueness <= 5),
    graphics INT NOT NULL,
    CHECK (0 <= graphics <= 5),
    FOREIGN KEY (member_email)
        REFERENCES Members (email)
        ON DELETE CASCADE,
    FOREIGN KEY (game_name)
        REFERENCES Games (name)
        ON DELETE CASCADE,
    PRIMARY KEY (member_email , game_name)
);

CREATE TABLE Communities_JoinedBy_Members (
    community_id INT NOT NULL,
    member_email VARCHAR(50) NOT NULL,
    FOREIGN KEY (member_email)
        REFERENCES Members (email)
        ON DELETE CASCADE,
    FOREIGN KEY (community_id)
        REFERENCES Communities (id)
        ON DELETE CASCADE,
    PRIMARY KEY (member_email , community_id)
);

CREATE TABLE Topic_Comments (
    member_email VARCHAR(50) NOT NULL,
    topic_id INT NOT NULL,
    date_time DATETIME NOT NULL,
    comments TEXT NOT NULL,
    FOREIGN KEY (member_email)
        REFERENCES Members (email)
        ON DELETE CASCADE,
    FOREIGN KEY (topic_id)
        REFERENCES Topics (id)
        ON DELETE CASCADE,
    PRIMARY KEY (member_email , topic_id , date_time)
);

CREATE TABLE Conference_Review_Comments (
    member_email VARCHAR(50) NOT NULL,
    conference_review_id INT NOT NULL,
    date_time DATETIME NOT NULL,
    comments TEXT NOT NULL,
    FOREIGN KEY (member_email)
        REFERENCES Members (email)
        ON DELETE CASCADE,
    FOREIGN KEY (conference_review_id)
        REFERENCES Conference_Reviews (id)
        ON DELETE CASCADE,
    PRIMARY KEY (member_email , conference_review_id , date_time)
);

CREATE TABLE Games_RecommendedBy_Normal_Users (
    game_name VARCHAR(50) NOT NULL,
    recommender_email VARCHAR(50) NOT NULL,
    reciever_email VARCHAR(50) NOT NULL,
    FOREIGN KEY (recommender_email)
        REFERENCES Normal_Users (email)
        ON DELETE CASCADE,
    FOREIGN KEY (reciever_email)
        REFERENCES Normal_Users (email)
        ON DELETE CASCADE,
    FOREIGN KEY (game_name)
        REFERENCES Games (name)
        ON DELETE CASCADE,
    PRIMARY KEY (game_name , recommender_email , reciever_email)
);

CREATE TABLE Development_Teams_Presents_Games (
    game_name VARCHAR(50) NOT NULL,
    developer_email VARCHAR(50) NOT NULL,
    conference_id INT NOT NULL,
    FOREIGN KEY (game_name)
        REFERENCES Games (name)
        ON DELETE CASCADE,
    FOREIGN KEY (conference_id)
        REFERENCES Conferences (id)
        ON DELETE CASCADE,
    FOREIGN KEY (developer_email)
        REFERENCES Development_Teams (email)
        ON DELETE CASCADE,
    PRIMARY KEY (game_name , developer_email , conference_id)
);

CREATE TABLE Game_Review_Comments (
    member_email VARCHAR(50) NOT NULL,
    game_review_id INT NOT NULL,
    date_time DATETIME NOT NULL,
    comments TEXT NOT NULL,
    FOREIGN KEY (member_email)
        REFERENCES Members (email)
        ON DELETE CASCADE,
    FOREIGN KEY (game_review_id)
        REFERENCES game_Reviews (id)
        ON DELETE CASCADE,
    PRIMARY KEY (member_email , game_review_id , date_time)
);

CREATE TABLE Normal_Users_AddFriendship_Normal_Users (
    user1 VARCHAR(50) NOT NULL,
    user2 VARCHAR(50) NOT NULL,
    approved BIT DEFAULT NULL,
    FOREIGN KEY (user1)
        REFERENCES Normal_Users (email)
        ON DELETE CASCADE,
    FOREIGN KEY (user2)
        REFERENCES Normal_Users (email)
        ON DELETE CASCADE,
    PRIMARY KEY (user1 , user2)
);

CREATE TABLE Messages (
    user1 VARCHAR(50) NOT NULL,
    user2 VARCHAR(50) NOT NULL,
    date_time DATETIME NOT NULL,
    message TEXT NOT NULL,
    FOREIGN KEY (user1)
        REFERENCES Normal_Users (email),
    FOREIGN KEY (user2)
        REFERENCES Normal_Users (email),
    PRIMARY KEY (user1 , user2 , date_time)
);