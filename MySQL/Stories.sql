-- code written in mysql
 -- story member 1
DELIMITER $$
CREATE PROCEDURE `sign_up_normal_user`(
  IN in_email varchar(50),
  IN in_password varchar(50),
  IN in_prefered_game_genre varchar(20),
  IN in_first_name varchar(20),
  IN in_last_name varchar(20),
  IN in_date_of_birth datetime
)
BEGIN
	insert into Members(email, password, preferred_game_genre)
    values(in_email, in_password, in_prefered_game_genre);
    insert into Normal_Users(email, first_name, last_name, date_of_birth)
    values(in_email,in_first_name, in_last_name,in_date_of_birth );
END $$
DELIMITER ;

 -- story member 1
DELIMITER $$
CREATE PROCEDURE `sign_up_verified_reviewer`(
  IN in_email varchar(50),
  IN in_password varchar(50),
  IN in_prefered_game_genre varchar(20),
  IN in_first_name varchar(20),
  IN in_last_name varchar(20),
  IN in_start_date datetime
)
BEGIN
	insert into Members(email, password, preferred_game_genre)
    values(in_email, in_password, in_prefered_game_genre);
    insert into Verified_Reviewers(email, first_name, last_name, start_date)
    values(in_email,in_first_name, in_last_name,in_start_date);
END $$
DELIMITER ;

 -- story member 1
DELIMITER $$
CREATE PROCEDURE `sign_up_development_team`(
  IN in_email varchar(50),
  IN in_password varchar(50),
  IN in_prefered_game_genre varchar(20),
  IN in_formation_date datetime,
  IN in_team_name varchar(20),
  IN in_company varchar(20)
)
BEGIN
	insert into Members(email, password, preferred_game_genre)
    values(in_email, in_password, in_prefered_game_genre);
    insert into Development_Teams(email, formation_date, team_name, company)
    values(in_email,in_formation_date, in_team_name,in_company);
END $$
DELIMITER ;

 -- story member 2
DELIMITER $$
CREATE PROCEDURE `search_games`(
  IN search_keyword varchar(200)
)
BEGIN
	select name, rating, release_date, age_limit
    from Games
    where name = search_keyword;
END $$
DELIMITER ;

 -- story member 2
DELIMITER $$
CREATE PROCEDURE `search_development_teams`(
  IN search_keyword varchar(200)
)
BEGIN
    select email, formation_date, team_name, company
    from Development_Teams
    where team_name = search_keyword;
END $$
DELIMITER ;

 -- story member 2
DELIMITER $$
CREATE PROCEDURE `search_verified_reviewers`(
  IN search_keyword varchar(200)
)
BEGIN
    select email,first_name, last_name, experience_years
    from Verified_Reviewers v
    where v.first_name = search_keyword or v.last_name = search_keyword;
END $$
DELIMITER ;

 -- story member 2
DELIMITER $$
CREATE PROCEDURE `search_communities`(
  IN search_keyword varchar(200)
)
BEGIN
    select name, description, user_request
    from Communities
    where name = search_keyword;
END $$
DELIMITER ;

 -- story member 2
DELIMITER $$
CREATE PROCEDURE `search_conferences`(
  IN search_keyword varchar(200)
)
BEGIN
    select name, start_date, end_date, duration, venue
    from Conferences
    where name = search_keyword;
END $$
DELIMITER ;

 -- story member 3
DELIMITER $$
CREATE PROCEDURE `view_sport_game`(
  IN game_name varchar(50)
)
BEGIN
	select g.name, g.rating, g.release_date, g.age_limit, g.developer_email, g.conference_id, sport.sport_type
    from Games g, Sport_Games sport
    where game_name = g.name and game_name = sport.name;
END $$
DELIMITER ;

 -- story member 3
DELIMITER $$
CREATE PROCEDURE `view_action_game`(
  IN game_name varchar(50)
)
BEGIN
	select g.name, g.rating, g.release_date, g.age_limit, g.developer_email, g.conference_id,ag.sub_genere
    from Games g, Action_Games ag
    where game_name = g.name
    and game_name = ag.name;
END $$
DELIMITER ;

 -- story member 3
DELIMITER $$
CREATE PROCEDURE `view_strategy_game`(
  IN game_name varchar(50)
)
BEGIN
	select g.name, g.rating, g.release_date, g.age_limit, g.developer_email, g.conference_id,sg.real_time
    from Games g, Strategy_Games sg
    where game_name = g.name
    and game_name = sg.name;
END $$
DELIMITER ;

 -- story member 3
DELIMITER $$
CREATE PROCEDURE `view_rpg_game`(
  IN game_name varchar(50)
)
BEGIN
	select g.name, g.rating, g.release_date, g.age_limit, g.developer_email, g.conference_id, rg.pvp, rg.storyline
    from Games g, RPG_Games rg
    where game_name = g.name
    and game_name = rg.name;
END $$
DELIMITER ;

 -- story member 3
DELIMITER $$
CREATE PROCEDURE `view_game_screenshots`(
  IN search_keyword varchar(200)
)
BEGIN
	select *
    from Game_Screenshots
    where name = search_keyword;
END $$
DELIMITER ;

 -- story member 3
DELIMITER $$
CREATE PROCEDURE `view_game_gameplays`(
  IN search_keyword varchar(200)
)
BEGIN
	select *
    from Game_Gameplays
    where name = search_keyword;
END $$
DELIMITER ;

 -- story member 3
DELIMITER $$
CREATE PROCEDURE `view_one_game_reviews`(
  IN in_game_name varchar(50)
)
BEGIN
	select game_name, review, date, writer_email
    from Game_Reviews
    where game_name = in_game_name;
END $$
DELIMITER ;

 -- story member 4
DELIMITER $$
CREATE PROCEDURE `rate_game`(
  IN in_game_name varchar(50),
  IN in_member_email varchar(50),
  IN game_graphics int,
  IN game_interactivity int,
  IN game_uniqueness int,
  IN game_level_design int
)
BEGIN
	insert into Games_RatedBy_Members(member_email, game_name, level_design, interactivity, uniqueness, graphics)
    values(in_member_email, in_game_name, game_level_design, game_interactivity, game_uniqueness, game_graphics);
    update Games
    set rating = (Select (sum(graphics) + sum(interactivity) + sum(uniqueness) + sum(level_design)) / (4*count(*))
				  from Games_RatedBy_Members
                  where game_name = in_game_name)
	where name = in_game_name;
END $$
DELIMITER ;

 -- story member 5
DELIMITER $$
CREATE PROCEDURE `view_game_rate`(
  IN in_game_name varchar(50)
)
BEGIN
	select rating
    from Games
    where name = in_game_name;
END $$
DELIMITER ;

 -- story member 6
DELIMITER $$
CREATE PROCEDURE `view_game_reviews`(
  IN in_member_email varchar(50)
)
BEGIN
	select gr.game_name, v.first_name, v.last_name, gr.review
    from Game_Reviews gr, Games_RatedBy_Members grm, Verified_Reviewers v
    where gr.game_name = grm.game_name and grm.member_email = in_member_email and gr.writer_email = v.email
    Order by v.experience_years;
END $$
DELIMITER ;

 -- story member 7
DELIMITER $$
CREATE PROCEDURE `view_conference`(
  IN in_conference_id int
)
BEGIN
	select c1.name, c1.start_date, c1.end_date, c1.venue
    from Conferences c1
    where c1.id = in_conference_id;
END $$
DELIMITER ;

 -- story member 7
DELIMITER $$
CREATE PROCEDURE `view_developerteams_present`(
  IN in_conference_id int
)
BEGIN
	select p.game_name, p.developer_email
    from Development_Teams_Presents_Games p
    where p.conference_id = in_conference_id;
END $$
DELIMITER ;

 -- story member 7
DELIMITER $$
CREATE PROCEDURE `view_games_debuted`(
  IN in_conference_id int
)
BEGIN
	select name
    from Games
    where conference_id = in_conference_id;
END $$
DELIMITER ;

 -- story member 7
DELIMITER $$
CREATE PROCEDURE `view_conference_review`(
  IN in_conference_id int
)
BEGIN
	select member_email, review
    from Conference_Reviews
    where conference_id = in_conference_id;
END $$
DELIMITER ;

 -- story member 8
DELIMITER $$
CREATE PROCEDURE `attend_conference`(
  IN in_conference_id int,
  IN in_member_email varchar(50)
)
BEGIN
	insert into Conferences_AttendedBy_Members(member_email, conference_id)
    values (in_member_email, in_conference_id);
END $$
DELIMITER ;

 -- story member 9
DELIMITER $$
CREATE PROCEDURE `add_conference_review`(
  IN in_conference_id int,
  IN in_member_email varchar(50),
  IN in_review text
)
BEGIN
	if exists (select conference_id, member_email
				from Conferences_AttendedBy_Members cam
                where member_email = in_member_email and conference_id = in_conference_id)
	then
	insert into Conference_Reviews(review, member_email, conference_id, date)
    values (in_review,in_member_email, in_conference_id, current_timestamp());
    end if;
END $$
DELIMITER ;

 -- story member 10
DELIMITER $$
CREATE PROCEDURE `delete_conference_review`(
  IN in_conference_review_id int,
  IN in_member_email varchar(50)
)
BEGIN
	delete from Conference_Reviews
    where member_email = in_member_email and id = in_conference_review_id;
END $$
DELIMITER ;

 -- story member 11
DELIMITER $$
CREATE PROCEDURE `join_community`(
  IN in_community_id int,
  IN in_member_email varchar(50)
)
BEGIN
	if exists(select *
			  from Communities c
              where not (c.admin_approved is null) and c.id = in_community_id)
	then
	insert into Communities_JoinedBy_Members(community_id, member_email)
    values (in_community_id, in_member_email);
    end if;
END $$
DELIMITER ;

 -- story member 12
DELIMITER $$
CREATE PROCEDURE `view_community`(
  IN in_community_id int,
  IN in_member_email varchar(50)
)
BEGIN
	if exists(select *
			  from Communities_JoinedBy_Members cjm, Communities c
              where cjm.community_id = in_community_id and cjm.member_email = in_member_email and in_community_id = c.id and c.admin_approved is not null)
	then
    select c.name, c.description
    from Communities c
    where in_community_id = c.id;
    end if;
END $$
DELIMITER ;

 -- story member 12
DELIMITER $$
CREATE PROCEDURE `view_community_members`(
  IN in_community_id int,
  IN in_member_email varchar(50)
)
BEGIN
	if exists(select *
			  from Communities_JoinedBy_Members cjm, Communities c
              where cjm.community_id = in_community_id and cjm.member_email = in_member_email and in_community_id = c.id and c.admin_approved is not null)
	then
    select c.member_email
    from Communities_JoinedBy_Members c
    where in_community_id = c.community_id;
    end if;
END $$
DELIMITER ;

 -- story member 12
DELIMITER $$
CREATE PROCEDURE `view_community_topics`(
  IN in_community_id int,
  IN in_member_email varchar(50)
)
BEGIN
	if exists(select *
			  from Communities_JoinedBy_Members cjm, Communities c
              where cjm.community_id = in_community_id and cjm.member_email = in_member_email and in_community_id = c.id and c.admin_approved is not null)
	then
    select title, description_text, member_email
    from Topics
    where in_community_id = community_id;
    end if;
END $$
DELIMITER ;

 -- story member 13
DELIMITER $$
CREATE PROCEDURE `post_topic`(
  IN in_community_id int,
  IN in_member_email varchar(50),
  IN in_title varchar(50),
  IN in_description_text text
)
BEGIN
	if exists(select *
			  from Communities_JoinedBy_Members cjm, Communities c
              where cjm.community_id = in_community_id and cjm.member_email = in_member_email and cjm.community_id = c.id and not(c.admin_approved is null))
	then
		insert into Topics (title, description_text, member_email, community_id)
        values (in_title, in_description_text, in_member_email, in_community_id);
    end if;
END $$
DELIMITER ;

 -- story member 14
DELIMITER $$
CREATE PROCEDURE `delete_topic`(
  IN in_topic_id int,
  IN in_member_email varchar(50)
)
BEGIN
	delete from Topics
	where member_email = in_member_email and id = in_topic_id;
END $$
DELIMITER ;

 -- story member 15
DELIMITER $$
CREATE PROCEDURE `add_conference_review_comment`(
  IN in_conference_review_id int,
  IN in_member_email varchar(50),
  IN in_comments text
)
BEGIN
	insert into Conference_Review_Comments (member_email, conference_review_id, date_time, comments)
    values (in_member_email, in_conference_review_id,current_timestamp() ,in_comments);
END $$
DELIMITER ;

 -- story member 15
DELIMITER $$
CREATE PROCEDURE `add_game_review_comment`(
  IN in_game_review_id int,
  IN in_member_email varchar(50),
  IN in_comments text
)
BEGIN
	insert into Game_Review_Comments (member_email, game_review_id, date_time, comments)
    values (in_member_email, in_game_review_id,current_timestamp() ,in_comments);
END $$
DELIMITER ;

 -- story member 15
DELIMITER $$
CREATE PROCEDURE `add_topic_comment`(
  IN in_topic_id int,
  IN in_member_email varchar(50),
  IN in_comments text
)
BEGIN
	if exists (select *
			  from Topics t, Communities_JoinedBy_Members c
              where id = in_topic_id and t.community_id = c.community_id and c.member_email = in_member_email)
	then
    insert into Topic_Comments (member_email, topic_id, date_time, comments)
    values (in_member_email, in_topic_id,current_timestamp() ,in_comments);
    end if;
END $$
DELIMITER ;

 -- story member 16
DELIMITER $$
CREATE PROCEDURE `view_topic_comment`(
  IN in_topic_id int,
  IN in_member_email varchar(50)
)
BEGIN
	if exists (select *
			  from Topics t, Communities_JoinedBy_Members c
              where id = in_topic_id and t.community_id = c.community_id and c.member_email = in_member_email)
	then
		select member_email, date_time, comments
        from Topic_Comments
        where topic_id = in_topic_id;
    end if;
END $$
DELIMITER ;

-- story member 16
DELIMITER $$
CREATE PROCEDURE `view_game_review_comment`(
  IN in_game_review_id int
)
BEGIN
	select member_email, date_time, comments
	from Game_Review_Comments
	where game_review_id = in_game_review_id;
END $$
DELIMITER ;

-- story member 16
DELIMITER $$
CREATE PROCEDURE `view_conference_review_comment`(
  IN in_conference_review_id int
)
BEGIN
	select member_email, date_time, comments
	from Conference_Review_Comments
	where conference_review_id = in_conference_review_id;
END $$
DELIMITER ;

 -- story member 17
DELIMITER $$
CREATE PROCEDURE `delete_game_review_comment`(
  IN in_game_review_id int,
  IN in_member_email varchar(50),
  IN in_datetime_of_comment datetime
)
BEGIN
	delete from Game_Review_Comments
    where in_game_review_id = game_review_id and in_member_email = member_email and in_datetime_of_comment = date_time; 
END $$
DELIMITER ;

 -- story member 17
DELIMITER $$
CREATE PROCEDURE `delete_conference_review_comment`(
  IN in_conference_review_id int,
  IN in_member_email varchar(50),
  IN in_datetime_of_comment datetime
)
BEGIN
	delete from Conference_Review_Comments
    where in_conference_review_id = conference_review_id and in_member_email = member_email and in_datetime_of_comment = date_time; 
END $$
DELIMITER ;

 -- story member 17
DELIMITER $$
CREATE PROCEDURE `delete_topic_comment`(
  IN in_topic_id int,
  IN in_member_email varchar(50),
  IN in_datetime_of_comment datetime
)
BEGIN
	delete from Topic_Comments
    where in_topic_id = topic_id and in_member_email = member_email and in_datetime_of_comment = date_time; 
END $$
DELIMITER ;

 -- story member 18
DELIMITER $$
CREATE PROCEDURE `top_common_conferences`(
  IN in_member_email varchar(50)
)
BEGIN
	select c1.member_email, count(c1.conference_id) as 'Count_Common'
    from Conferences_AttendedBy_Members c1
    where c1.conference_id in (select c2.conference_id
								from Conferences_AttendedBy_Members c2
                                where c2.member_email = in_member_email)
							and not c1.member_email = in_member_email
	group by c1.member_email
    order by count(c1.conference_id) desc
    limit 5;
END $$
DELIMITER ;

 -- story member 19
DELIMITER $$
CREATE PROCEDURE `top_recommended_games`(
  IN in_member_email varchar(50)
)
BEGIN
	select g1.game_name
    from Games_RecommendedBy_Normal_Users g1
    where g1.game_name not in (select g2.game_name
							   from Games_RecommendedBy_Normal_Users g2
							   where g2.recommender_email = in_member_email or g2.reciever_email = in_member_email)
					and g1.game_name not in
							   (select g3.game_name
							   from Games_RatedBy_Members g3
							   where g3.member_email = in_member_email)
	group by g1.game_name
    order by count(g1.reciever_email) desc
    limit 10;
END $$
DELIMITER ;

 -- story normal user 1
DELIMITER $$
CREATE PROCEDURE `update_normal_user`(
  IN in_email varchar(50),
  IN in_first_name varchar(20),
  IN in_last_name varchar(20),
  IN in_date_of_birth datetime
)
BEGIN
	update Normal_Users
    set email = in_email, first_name = in_first_name, date_of_birth = in_date_of_birth
    where email = in_email;
END $$
DELIMITER ;

 -- story normal user 2
DELIMITER $$
CREATE PROCEDURE `send_friendship_request`(
  IN in_member_email varchar(50),
  IN in_friend_email varchar(50)
)
BEGIN
	insert into Normal_Users_AddFriendship_Normal_Users (user1, user2)
    values (in_member_email, in_friend_email);
END $$
DELIMITER ;

 -- story normal user 3
DELIMITER $$
CREATE PROCEDURE `search_members`(
  IN in_member_email varchar(50)
)
BEGIN
	select email
    from Normal_Users n
    where n.email != in_member_email and not exists (select user2
				from Normal_Users_AddFriendship_Normal_Users
                where (user1 = in_member_email and user2 = n.email)) and not exists (select user1
				from Normal_Users_AddFriendship_Normal_Users
                where (user2 = in_member_email and user1 = n.email));
END $$
DELIMITER ;

 -- story normal user 4
DELIMITER $$
CREATE PROCEDURE `pending_friendship_requests`(
  IN in_member_email varchar(50)
)
BEGIN
	select user2
    from Normal_Users_AddFriendship_Normal_Users
    where user1 = in_member_email and approved is null;
END $$
DELIMITER ;

 -- story normal user 5
DELIMITER $$
CREATE PROCEDURE `accept_reject_friendship_requests`(
  IN in_member_email varchar(50),
  IN in_friend_email varchar(50),
  IN in_accept bit
)
BEGIN
    update Normal_Users_AddFriendship_Normal_Users
    set approved = in_accept
    where user1 = in_friend_email and user2 = in_member_email;
END $$
DELIMITER ;

 -- story normal user 6
DELIMITER $$
CREATE PROCEDURE `view friends`(
  IN in_member_email varchar(50)
)
BEGIN
    select user2
    from Normal_Users_AddFriendship_Normal_Users
    where user1 = in_member_email and approved = 1
    union
    select user1
    from Normal_Users_AddFriendship_Normal_Users
    where user2 = in_member_email and approved = 1;
END $$
DELIMITER ;

 -- story normal user 7
DELIMITER $$
CREATE PROCEDURE `view_friend_profile`(
  IN in_member_email varchar(50),
  IN in_friend_email varchar(50)
)
BEGIN
	if exists (select user2
				from Normal_Users_AddFriendship_Normal_Users
                where (user1 = in_member_email and user2 = in_friend_email and approved = 1) or (user2 = in_member_email and user1 = in_friend_email and approved = 1))
	then
	select first_name, last_name, date_of_birth, age
    from Normal_Users
    where email = in_friend_email;
    end if;
END $$
DELIMITER ;

 -- story normal user 7
DELIMITER $$
CREATE PROCEDURE `view_friend_conferences`(
  IN in_member_email varchar(50),
  IN in_friend_email varchar(50)
)
BEGIN
	if exists (select user2
				from Normal_Users_AddFriendship_Normal_Users
                where (user1 = in_member_email and user2 = in_friend_email and approved = 1) or (user2 = in_member_email and user1 = in_friend_email and approved = 1))
	then
	select c.name, c.start_date, c.end_date, c.venue
    from Conferences c, Conferences_AttendedBy_Members cam
    where c.id = cam.conference_id and cam.member_email = in_friend_email;
    end if;
END $$
DELIMITER ;

 -- story normal user 7
DELIMITER $$
CREATE PROCEDURE `view_friend_games`(
  IN in_member_email varchar(50),
  IN in_friend_email varchar(50)
)
BEGIN
	if exists (select user2
				from Normal_Users_AddFriendship_Normal_Users
                where (user1 = in_member_email and user2 = in_friend_email and approved = 1) or (user2 = in_member_email and user1 = in_friend_email and approved = 1))
	then
	select game_name, level_design, interactivity, uniqueness, graphics
    from Games_RatedBy_Members
    where member_email = in_friend_email;
    end if;
END $$
DELIMITER ;

 -- story normal user 8
DELIMITER $$
CREATE PROCEDURE `send_message`(
  IN in_member_email varchar(50),
  IN in_friend_email varchar(50),
  IN in_message text
)
BEGIN
	if exists (select user2
				from Normal_Users_AddFriendship_Normal_Users
                where (user1 = in_member_email and user2 = in_friend_email and approved = 1) or (user2 = in_member_email and user1 = in_friend_email and approved = 1))
	then
		insert into Messages(user1, user2, date_time, message)
        values(in_member_email, in_friend_email,current_timestamp(), in_message);
    end if;
END $$
DELIMITER ;

 -- story normal user 9
DELIMITER $$
CREATE PROCEDURE `view_message`(
  IN in_member_email varchar(50)
)
BEGIN
	select *
    from Messages
    where user1 = in_member_email or user2 = in_member_email;
END $$
DELIMITER ;

 -- story normal user 10
DELIMITER $$
CREATE PROCEDURE `recommend_game`(
  IN in_member_email varchar(50),
  IN in_friend_email varchar(50),
  IN in_game_name varchar(50)
)
BEGIN
	if exists (select user2
				from Normal_Users_AddFriendship_Normal_Users
                where (user1 = in_member_email and user2 = in_friend_email and approved = 1) or (user2 = in_member_email and user1 = in_friend_email and approved = 1))
	then
		insert into Games_RecommendedBy_Normal_Users(game_name, recommender_email, reciever_email)
        values(in_game_name, in_member_email, in_friend_email);
    end if;
END $$
DELIMITER ;

 -- story normal user 11
DELIMITER $$
CREATE PROCEDURE `view_recommend_game`(
  IN in_member_email varchar(50)
)
BEGIN
	select game_name, recommender_email
    from Games_RecommendedBy_Normal_Users
    where reciever_email = in_member_email;
END $$
DELIMITER ;

 -- story normal user 12
DELIMITER $$
CREATE PROCEDURE `request_community`(
  IN in_member_email varchar(50),
  IN in_name varchar(50),
  IN in_description text
)
BEGIN
	insert into Communities(name, description, user_request)
    values(in_name, in_description, in_member_email);
END $$
DELIMITER ;

 -- story verified reviewer 1
DELIMITER $$
CREATE PROCEDURE `update_verified_reviewer`(
  IN in_email varchar(50),
  IN in_first_name varchar(20),
  IN in_last_name varchar(20),
  IN in_start_date datetime
)
BEGIN
    update Verified_Reviewers
    set first_name = in_first_name, last_name = in_last_name, start_date = in_start_date, experience_years =  (year(current_timestamp()) - year(start_date))
    where email = in_email;
END $$
DELIMITER ;

 -- story verified reviewer 2
DELIMITER $$
CREATE PROCEDURE `add_game_review`(
  IN in_email varchar(50),
  IN in_game_name varchar(50),
  IN in_review text
)
BEGIN
	if exists (select *
			   from Verified_Reviewers
               where verified = 1 and email = in_email)
	then
		insert into Game_Reviews(review, writer_email, game_name, date)
        values (in_review, in_email, in_game_name, current_timestamp());
        end if;
END $$
DELIMITER ;

 -- story verified reviewer 3
DELIMITER $$
CREATE PROCEDURE `delete_game_review`(
  IN in_email varchar(50),
  IN in_game_name varchar(50)
)
BEGIN
	delete from Game_Reviews
    where writer_email = in_email and game_name = in_game_name;
END $$
DELIMITER ;

 -- story verified reviewer 4
DELIMITER $$
CREATE PROCEDURE `view_top_10_reviews`(
  IN in_email varchar(50)
)
BEGIN
	if exists (select *
			   from Verified_Reviewers
               where verified = 1 and email = in_email)
	then
		select gr.id, gr.game_name, gr.review, count(grc.game_review_id) as 'number of comments'
        from Game_Reviews gr
        left outer join Game_Review_Comments grc
        On gr.id = grc.game_review_id
        where gr.writer_email = in_email
        group by gr.id
        order by count(grc.game_review_id) desc
        limit 10;
        end if;
END $$
DELIMITER ;

 -- story development team 1
DELIMITER $$
CREATE PROCEDURE `update_development_team`(
  IN in_email varchar(50),
  IN in_formation_date datetime,
  IN in_team_name varchar(20),
  IN in_company varchar(20)
)
BEGIN
	update Development_Teams
    set formation_date = in_formation_date, team_name = in_team_name, company = in_company
    where email = in_email;
END $$
DELIMITER ;

 -- story development team 2
DELIMITER $$
CREATE PROCEDURE `add_game_to_developed`(
  IN in_email varchar(50),
  IN in_game_name varchar(50)
)
BEGIN
	if exists (select *
			   from Development_Teams
               where verified = 1 and email = in_email)
	then
	update Games
    set developer_email = in_email
    where name = in_game_name;
    end if;
END $$
DELIMITER ;

 -- story development team 3
DELIMITER $$
CREATE PROCEDURE `add_screenshot`(
  IN in_email varchar(50),
  IN in_game_name varchar(50),
  IN in_screenshot varchar(200)
)
BEGIN
	if exists (select *
			   from Development_Teams d, Games g 
               where d.verified = 1 and d.email = in_email and g.developer_email = in_email)
	then
	insert into Game_Screenshots(name, screenshot)
    values(in_game_name, in_screenshot);
    end if;
END $$
DELIMITER ;

-- story development team 3
DELIMITER $$
CREATE PROCEDURE `add_gameplay`(
  IN in_email varchar(50),
  IN in_game_name varchar(50),
  IN in_gameplay varchar(200)
)
BEGIN
	if exists (select *
			   from Development_Teams d, Games g 
               where d.verified = 1 and d.email = in_email and g.developer_email = in_email)
	then
	insert into Game_Gameplays(name, gameplay)
    values(in_game_name, in_gameplay);
    end if;
END $$
DELIMITER ;

 -- story development team 4
DELIMITER $$
CREATE PROCEDURE `add_presented_game`(
  IN in_email varchar(50),
  IN in_game_name varchar(50),
  IN in_Conference_id int
)
BEGIN
	if exists (select *
			   from Development_Teams d, Games g 
               where d.verified = 1 and d.email = in_email and g.developer_email = in_email)
	then
	insert into Development_Teams_Presents_Games(game_name, developer_email, conference_id)
    values(in_game_name, in_email, in_Conference_id);
    end if;
END $$
DELIMITER ;

-- story System administrator 1
DELIMITER $$
CREATE PROCEDURE `view_community_request`(
  IN in_email varchar(50)
)
BEGIN
	if exists (select *
			   from System_Administrators
               where email = in_email)
	then
		select *
        from Communities
        where admin_approved is null;
    end if;
END $$
DELIMITER ;

-- story System administrator 2
DELIMITER $$
CREATE PROCEDURE `accept_community_request`(
  IN in_email varchar(50),
  IN in_community_id int
)
BEGIN
	if exists (select *
			   from System_Administrators
               where email = in_email)
	then
		update Communities
        Set admin_approved = in_email
        where id = in_community_id;
    end if;
END $$
DELIMITER ;

-- story System administrator 2
DELIMITER $$
CREATE PROCEDURE `reject_community_request`(
  IN in_email varchar(50),
  IN in_community_id int
)
BEGIN
	if exists (select *
			   from System_Administrators
               where email = in_email)
	then
		delete from Communities
        where id = in_community_id;
    end if;
END $$
DELIMITER ;

-- story System administrator 3
DELIMITER $$
CREATE PROCEDURE `verify_verified_reviewer`(
  IN in_email varchar(50),
  IN in_verified_email varchar(50)
)
BEGIN
	if exists (select *
			   from System_Administrators
               where email = in_email)
	then
		update Verified_Reviewers
        Set verified = 1, admin_email = in_email
        where email = in_verified_email;
    end if;
END $$
DELIMITER ;

-- story System administrator 3
DELIMITER $$
CREATE PROCEDURE `verify_development_team`(
  IN in_email varchar(50),
  IN in_developer_email varchar(50)
)
BEGIN
	if exists (select *
			   from System_Administrators
               where email = in_email)
	then
		update Development_Teams
        Set verified = 1, admin_email = in_email
        where email = in_developer_email;
    end if;
END $$
DELIMITER ;

-- story System administrator 4
DELIMITER $$
CREATE PROCEDURE `create_conference`(
  IN in_email varchar(50),
  IN in_name varchar(20),
  IN in_start_date datetime,
  IN in_end_date datetime,
  IN in_venue varchar(30)
)
BEGIN
	if exists (select *
			   from System_Administrators
               where email = in_email)
	then
		insert into Conferences(name, start_date, end_date,venue)
        values (in_name, in_start_date, in_end_date, in_venue);
    end if;
END $$
DELIMITER ;

-- story System administrator 5
DELIMITER $$
CREATE PROCEDURE `create_sport_game`(
  IN in_email varchar(50),
  IN in_name VARCHAR(50),
  IN in_release_date DATETIME,
  IN in_age_limit INT,
  IN in_conference_id int,
  IN in_sport_type varchar(20)
)
BEGIN
	if exists (select *
			   from System_Administrators
               where email = in_email)
	then
		insert into Games(name, release_date, age_limit, rating, conference_id)
        values (in_name, in_release_date, in_age_limit, 0, in_conference_id);
        insert into Sport_Games(name, sport_type)
        values (in_name, in_sport_type);
    end if;
END $$
DELIMITER ;

-- story System administrator 5
DELIMITER $$
CREATE PROCEDURE `create_strategy_game`(
  IN in_email varchar(50),
  IN in_name VARCHAR(50),
  IN in_release_date DATETIME,
  IN in_age_limit INT,
  IN in_conference_id int,
  IN in_real_time bit
)
BEGIN
	if exists (select *
			   from System_Administrators
               where email = in_email)
	then
		insert into Games(name, release_date, age_limit, rating, conference_id)
        values (in_name, in_release_date, in_age_limit, 0, in_conference_id);
        insert into Strategy_Games(name, real_time)
        values (in_name, in_real_time);
    end if;
END $$
DELIMITER ;

-- story System administrator 5
DELIMITER $$
CREATE PROCEDURE `create_RPG_game`(
  IN in_email varchar(50),
  IN in_name VARCHAR(50),
  IN in_release_date DATETIME,
  IN in_age_limit INT,
  IN in_conference_id int,
  IN in_storyline text,
  IN in_pvp bit
)
BEGIN
	if exists (select *
			   from System_Administrators
               where email = in_email)
	then
		insert into Games(name, release_date, age_limit, rating, conference_id)
        values (in_name, in_release_date, in_age_limit, 0, in_conference_id);
        insert into RPG_Games(name, storyline, pvp)
        values (in_name, in_storyline, in_pvp);
    end if;
END $$
DELIMITER ;

-- story System administrator 5
DELIMITER $$
CREATE PROCEDURE `create_Action_game`(
  IN in_email varchar(50),
  IN in_name VARCHAR(50),
  IN in_release_date DATETIME,
  IN in_age_limit INT,
  IN in_conference_id int,
  IN in_sub_genere varchar(20)
)
BEGIN
	if exists (select *
			   from System_Administrators
               where email = in_email)
	then
		insert into Games(name, release_date, age_limit, rating, conference_id)
        values (in_name, in_release_date, in_age_limit, 0, in_conference_id);
        insert into Action_Games(name, sub_genere)
        values (in_name, in_sub_genere);
    end if;
END $$
DELIMITER ;

-- story System administrator 6
DELIMITER $$
CREATE PROCEDURE `delete_game`(
  IN in_email varchar(50),
  IN in_game_name VARCHAR(50)
)
BEGIN
	if exists (select *
			   from System_Administrators
               where email = in_email)
	then
		delete from Games
        where name = in_game_name;
        delete from Sport_Games
        where name = in_game_name;
        delete from RPG_Games
        where name = in_game_name;
        delete from Action_Games
        where name = in_game_name;
        delete from Strategy_Games
        where name = in_game_name;
    end if;
END $$
DELIMITER ;

-- story System administrator 6
DELIMITER $$
CREATE PROCEDURE `delete_conference`(
  IN in_email varchar(50),
  IN in_conference_id int
)
BEGIN
	if exists (select *
			   from System_Administrators
               where email = in_email)
	then
		delete from Conferences
        where id = in_conference_id;
    end if;
END $$
DELIMITER ;

-- story System administrator 6
DELIMITER $$
CREATE PROCEDURE `delete_comunity`(
  IN in_email varchar(50),
  IN in_comunity_id int
)
BEGIN
	if exists (select *
			   from System_Administrators
               where email = in_email)
	then
		delete from Communities
        where id = in_comunity_id;
    end if;
END $$
DELIMITER ;