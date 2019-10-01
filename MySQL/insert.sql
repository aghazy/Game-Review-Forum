-- code written in mysql
insert into Members (email, password, preferred_game_genre)
values ('m.ismail@gmail.com' , '12345', 'Sports');

insert into Members (email, password, preferred_game_genre)
values ('m.ahmed@gmail.com' , '12345', 'RPG');

insert into Members (email, password, preferred_game_genre)
values ('a.mamdouh@gmail.com' , '12345', 'Action');

insert into Members (email, password, preferred_game_genre)
values ('s.tarek@gmail.com' , '12345', 'Strategy');

insert into Members (email, password, preferred_game_genre)
values ('t.aly@gmail.com' , '12345', 'Sports');

insert into Members (email, password, preferred_game_genre)
values ('a.omar@gmail.com' , '12345', 'RPG');

insert into Normal_users(email,first_name, last_name, date_of_birth)
values('m.ismail@gmail.com', 'Mohamed' ,'Ismail','1995-01-20');

insert into Normal_users(email,first_name, last_name, date_of_birth)
values('m.ahmed@gmail.com', 'Mostafa' ,'Ahmed','1994-05-22');

insert into Normal_users(email,first_name, last_name, date_of_birth)
values('a.mamdouh@gmail.com', 'Ahmed' ,'Mamdouh','1993-09-10');

insert into System_Administrators (email, password)
values ('walidtarekelhefny@gmail.com','admin123');

insert into System_Administrators (email, password)
values ('a.ghazy500@gmail.com','admin123');

insert into System_Administrators (email, password)
values ('badry.atef@gmail.com','admin123');

insert into Verified_Reviewers (email, first_name, last_name, start_date, verified, admin_email)
values('s.tarek@gmail.com','Sobhy','Tarek','2002-08-16',1,'walidtarekelhefny@gmail.com');

insert into Verified_Reviewers (email, first_name, last_name, start_date, verified, admin_email)
values('t.aly@gmail.com','Tamer','Aly','2004-11-02',0,NULL);

insert into Development_Teams (email, formation_date, team_name, company, verified, admin_email)
values('a.omar@gmail.com', '2011-12-14','GGMU','Manchester United',1,'a.ghazy500@gmail.com');

insert into Games (name, rating, release_date, age_limit, developer_email, conference_id)
values ('FIFA 16',0,'2015-11-09',3,NULL,NULL);

insert into Sport_Games (name, sport_type)
values ('FIFA 16','Soccer');

insert into Game_Screenshots ( name, screenshot )
values ('FIFA 16','apache_pb2.png');

insert into Game_Gameplays ( name, gameplay )
values ('FIFA 16', 'www.gameplays.com/fifa16.wav');

insert into Games (name, rating, release_date, age_limit, developer_email, conference_id)
values ('Black Ops 2',0,'2015-09-12',12,'a.omar@gmail.com',NULL);

insert into Action_Games (name, sub_genere)
values('Black Ops 2', 'FPS');

insert into Game_Screenshots ( name, screenshot )
values ('Black Ops 2','wwww.gamephotos.com/bo2.png');

insert into Game_Gameplays ( name, gameplay )
values ('Black Ops 2', 'www.gameplays.com/bo2.m4a');

insert into Games (name, rating, release_date, age_limit, developer_email, conference_id)
values ('Kingdom of Hearts',0,'2009-05-22',12,NULL,NULL);

insert into RPG_Games (name, storyline, pvp)
values ('Kingdom of Hearts','Play with a Disney character',0);

insert into Game_Screenshots ( name, screenshot )
values ('Kingdom of Hearts','wwww.gamephotos.com/koh1.jpeg');

insert into Game_Screenshots ( name, screenshot )
values ('Kingdom of Hearts','wwww.gamephotos.com/koh2.jpeg');

insert into Conferences (name, start_date, end_date, venue)
values ('E3','2015-03-10','2015-03-13','LA');

insert into Conferences (name, start_date, end_date, venue)
values ('WWDC','2015-04-22','2015-04-23','California');

insert into Games (name, rating, release_date, age_limit, developer_email, conference_id)
values ('Age of Empires',0,'1998-02-14',3,NULL,1);

insert into Strategy_Games (name, real_time)
values ('Age of Empires',1);

insert into Conference_Reviews (review, date, member_email , conference_id)
values('Best Conference Ever <3',current_timestamp(), 'm.ismail@gmail.com',2);

insert into Game_Reviews (review, date, writer_email, game_name)
values('Best Sports Game Ever <3',current_timestamp(),'s.tarek@gmail.com','FIFA 16');

insert into Communities (name, description, admin_approved, user_request)
values('RPG Players','A community for RPG players','walidtarekelhefny@gmail.com','m.ahmed@gmail.com');

insert into Communities (name, description, admin_approved, user_request)
values('Barcelonista','A community for Barcelona fans',NULL,'a.mamdouh@gmail.com');

insert into Topics (title, description_text, member_email, community_id)
values('Kingdorm of Hearts Walkthrough','A detailed walkthrough for KoH','m.ahmed@gmail.com',1);

insert into Conferences_AttendedBy_Members ( member_email, conference_id )
values('m.ahmed@gmail.com',1);

insert into Games_RatedBy_Members (member_email, game_name, level_design, interactivity,uniqueness, graphics)
values ('m.ismail@gmail.com','Age of Empires',3,4,5,2);

insert into Communities_JoinedBy_Members ( community_id, member_email )
values(1,'m.ahmed@gmail.com');

insert into Topic_Comments (member_email, topic_id, date_time,comments)
values('m.ahmed@gmail.com',1,current_timestamp(),'Excellent Topic');

insert into Conference_Review_Comments ( member_email, conference_review_id, date_time,comments)
values('s.tarek@gmail.com',1,current_timestamp(),'Excellent Review');

insert into Normal_Users_AddFriendship_Normal_Users (user1, user2, approved)
values('a.mamdouh@gmail.com', 'm.ahmed@gmail.com', 1);

insert into Normal_Users_AddFriendship_Normal_Users (user1, user2, approved)
values('m.ismail@gmail.com', 'm.ahmed@gmail.com', 0);

insert into Normal_Users_AddFriendship_Normal_Users (user1, user2, approved)
values('m.ismail@gmail.com', 'a.mamdouh@gmail.com', NULL);

insert into Games_RecommendedBy_Normal_Users ( game_name, recommender_email,reciever_email)
values('FIFA 16','a.mamdouh@gmail.com','m.ahmed@gmail.com');

insert into Development_Teams_Presents_Games ( game_name, conference_id, developer_email )
values('Black Ops 2',1,'a.omar@gmail.com');

insert into Game_Review_Comments (member_email, game_review_id, date_time,comments)
values('m.ismail@gmail.com', 1, current_timestamp(), 'best game review');

insert into Messages (user1, user2, date_time, message)
values('a.mamdouh@gmail.com', 'm.ahmed@gmail.com', current_timestamp(), 'HI');

insert into Messages (user1, user2, date_time, message)
values('m.ahmed@gmail.com', 'a.mamdouh@gmail.com', current_timestamp(), 'Hey');