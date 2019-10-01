-- code written in mysql
-- test story member 1
Call `sign_up_normal_user`('a.hany@gamil.com' , '12345', 'Action' , 'Ahmed', 'Hany', '1995-11-12');
call `sign_up_verified_reviewer`('m.yousef@gmail.com', '12345', 'Sports', 'Mansour', 'Yousef', '2011-01-25');
call `sign_up_development_team`('o.medhat@gmail.com', '12345', 'RPG', '2013-07-07', 'RPGMasters', 'Ubisoft');
call `sign_up_development_team`('a.attia@gmail.com', '12345', 'Sports', '2015-11-07', 'Sarcasm', null);

-- test story member 2
call `search_games`('FIFA 16');
call `search_conferences`('E3');
call `search_communities`('RPG Players');
call `search_verified_reviewers`('Tarek');
call `search_development_teams`('GGMU');

-- test story member 3
call `view_one_game_reviews`('FIFA 16');
call `view_game_gameplays`('FIFA 16');
call `view_game_screenshots`('FIFA 16');
call `view_sport_game`('FIFA 16');
call `view_action_game`('Black Ops 2');
call `view_strategy_game`('Age of Empires');
call `view_rpg_game`('Kingdom of Hearts');

-- test story member 4
call `rate_game`('FIFA 16', 'a.hany@gamil.com', 5,5,5,5);

-- test story member 5
call `view_game_rate`('FIFA 16');

-- test story member 6
call `view_game_reviews`('a.hany@gamil.com');

-- test story member 7
call `view_conference`(1);
call `view_developerteams_present`(1);
call `view_games_debuted`(1);
call `view_conference_review`(2);

-- test story member 8
call `attend_conference`(2,'m.ismail@gmail.com');
call `attend_conference`(2,'a.hany@gamil.com');
call `attend_conference`(1,'a.hany@gamil.com');
call `attend_conference`(1,'m.ismail@gmail.com');

-- test story member 9
call `add_conference_review`(2, 'm.ismail@gmail.com', 'The conference was bad :( ');

-- test story member 10
call `delete_conference_review`(1,'m.ismail@gmail.com');

-- test story member 11
call `join_community`(1, 'a.hany@gamil.com');

-- test story member 12
call `view_community`(1, 'a.hany@gamil.com');
call `view_community_members`(1, 'a.hany@gamil.com');
call `view_community_topics`(1, 'a.hany@gamil.com');

-- test story member 13
call `post_topic`(1, 'a.hany@gamil.com', 'Final Fantasy XIV', 'It is finally released');

-- test story member 14
call `delete_topic`(2, 'a.hany@gamil.com');

-- test story member 15
call `add_conference_review_comment`(2, 'a.hany@gamil.com', 'Dont exaggerate :D');
call `add_game_review_comment`(1, 'a.hany@gamil.com', 'Dont exaggerate :D');
call `add_topic_comment`(1, 'a.hany@gamil.com', 'Thanks');

-- test story member 16
call `view_topic_comment`(1, 'a.hany@gamil.com');
call `view_game_review_comment`(1);
call `view_conference_review_comment`(2);

-- test story member 17
call `delete_game_review_comment`(1, 'a.hany@gamil.com', '2015-11-17 12:58:35');
call `delete_conference_review_comment`(2,'a.hany@gamil.com', '2015-11-17 12:55:04');
call `delete_topic_comment`(1, 'a.hany@gamil.com', '2015-11-17 13:00:14');

-- test story member 18
call `top_common_conferences`('a.hany@gamil.com');

-- test story member 19
call `top_recommended_games`('a.hany@gamil.com');

-- test story normal user 1
call `update_normal_user`('a.hany@gamil.com', 'Ahmed', 'Hany', '1994-10-10');

-- test story normal user 2
call `send_friendship_request`('a.hany@gamil.com', 'm.ismail@gmail.com');

-- test story normal user 3
call `search_members`('a.hany@gamil.com');

-- test story normal user 4
call `pending_friendship_requests`('a.hany@gamil.com');

-- test story normal user 5
call `accept_reject_friendship_requests`('m.ismail@gmail.com', 'a.hany@gamil.com', 1);

-- test story normal user 6
call `view friends`('m.ismail@gmail.com');

-- test story normal user 7
call `view_friend_profile`('m.ismail@gmail.com', 'a.hany@gamil.com');
call `view_friend_conferences`('m.ismail@gmail.com', 'a.hany@gamil.com');
call `view_friend_games`('m.ismail@gmail.com', 'a.hany@gamil.com');

-- test story normal user 8
call `send_message`('m.ismail@gmail.com', 'a.hany@gamil.com', 'ezayak a5eran 7ad 3amely friend :D :D');
call `send_message`('a.hany@gamil.com', 'm.ismail@gmail.com', '7abeb 2alby :D');

-- test story normal user 9
call  `view_message`('a.hany@gamil.com');

-- test story normal user 10
call `recommend_game`('a.hany@gamil.com', 'm.ismail@gmail.com', 'FIFA 16');

-- test story normal user 11
call `view_recommend_game`('m.ismail@gmail.com');

-- test story normal user 12
call `request_community`('a.hany@gamil.com', 'FIFA 16 Lovers <3', 'Gathering FIFA 16 supporters PES 16 sucks :D');

-- test story verified reviewer 1
call `update_verified_reviewer`('m.yousef@gmail.com', 'Mansour', 'Yousef', '2013-06-30');

-- test story verified reviewer 2
call `add_game_review`('s.tarek@gmail.com', 'Black Ops 2', 'One of the best Action games in the market');

-- test story verified reviewer 3
call `delete_game_review`('s.tarek@gmail.com', 'Black Ops 2');

-- test story verified reviewer 4
call `view_top_10_reviews`('s.tarek@gmail.com');

-- test story development team 1
call `update_development_team`('a.attia@gmail.com', '2015-11-07', 'Sarcasm', 'GUC');

-- test story development team 2
call `add_game_to_developed`('a.omar@gmail.com','Age of Empires');

-- test story development team 3
call `add_screenshot`('a.omar@gmail.com','Age of Empires', 'www.gamephotos.com/aoe.png');
call `add_gameplay`('a.omar@gmail.com','Age of Empires','www.gameplays.com/aoe.m4a');

-- test story development team 4
call `add_presented_game`('a.omar@gmail.com','Age of Empires',1);

-- test story System administrator 1
call `view_community_request`('a.ghazy500@gmail.com');

-- test story System administrator 2
call `accept_community_request`('a.ghazy500@gmail.com', 3);
call `reject_community_request`('a.ghazy500@gmail.com', 2);

-- test story System administrator 3
call `verify_verified_reviewer`('a.ghazy500@gmail.com', 'm.yousef@gmail.com');
call `verify_development_team`('a.ghazy500@gmail.com', 'o.medhat@gmail.com');

-- test story System administrator 4
call `create_conference`('a.ghazy500@gmail.com', 'i/o','2015-05-19', '2015-05-21', 'Cairo'); 

-- test story System administrator 5
call `create_sport_game`('walidtarekelhefny@gmail.com','WWE 16','2015-09-11',12,'1','Wrestling');
call `create_strategy_game`('walidtarekelhefny@gmail.com','Medal of Honor 2','2000-04-09',3,Null,1);
call `create_RPG_game`('walidtarekelhefny@gmail.com','Assasins Creed Syndicate','2015-06-11',18,3,'Ezio fights his way to victory',0);
call `create_Action_game`('walidtarekelhefny@gmail.com','Batman Arkham Knight','2014-10-30',12,NULL,'Story');

-- test story System administrator 6
call `delete_game`('walidtarekelhefny@gmail.com', 'Medal of Honor 2');
call `delete_conference`('walidtarekelhefny@gmail.com', 3);
call `delete_comunity`('walidtarekelhefny@gmail.com', 3);