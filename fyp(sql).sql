DROP DATABASE FYP;
CREATE DATABASE FYP;
USE FYP;


CREATE TABLE USERS(
	Userid Int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	username VarChar(128) NOT NULL, 
	userpassword VarChar(128) NOT NULL
);

CREATE TABLE JOURNAL(
	Journalid Int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	Userid Int(4) NOT NULL,
	jtitle VarChar(128) NOT NULL,
	jdate DATE NOT NULL
);

CREATE TABLE Entries(
	entryId Int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	Journalid Int(4) NOT NULL,
	entryTitle VarChar(128) NOT NULL,
	jcontent LONGTEXT NOT NULL
);


CREATE TABLE VIDEOS(
	Videotypeid Int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	genre VarChar(128) NOT NULL

);

CREATE TABLE VIDEOMAPPING(
	Videotypeid Int(4) NOT NULL, 
	Videoid Int(4) NOT NULL
);

CREATE TABLE SPECIFICVIDEOS(
	Videoid Int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	vtitle VarChar(128) NOT NULL,
	vlink LONGTEXT NOT NULL
);

CREATE TABLE QUOTES(
	Quotetypeid Int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	theme VarChar(128) NOT NULL
);

CREATE TABLE QUOTEMAPPING(
	Quotetypeid Int(4) NOT NULL,
	Quoteid Int(4) NOT NULL
);


CREATE TABLE SPECIFICQUOTES(
	Quoteid Int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	qtitle VarChar(128) NOT NULL,
	qlink LONGTEXT NOT NULL	
);


CREATE TABLE VCOMMENTS(
	VCommentid Int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	VComment LONGTEXT NOT NULL,	
	Userid Int(4) NOT NULL, 
	Videoid Int(4) NOT NULL, 
	Vdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE QCOMMENTS(
	QCommentid Int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	QComment LONGTEXT NOT NULL,
	Userid Int(4) NOT NULL, 
	Quoteid Int(4) NOT NULL, 
	Qdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE VCOMMENTS ADD FOREIGN KEY(Userid) REFERENCES USERS(Userid) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE VCOMMENTS ADD FOREIGN KEY(Videoid) REFERENCES SPECIFICVIDEOS(Videoid) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE QCOMMENTS ADD FOREIGN KEY(Userid) REFERENCES USERS(Userid) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE QCOMMENTS ADD FOREIGN KEY(Quoteid) REFERENCES SPECIFICQUOTES(Quoteid) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE VIDEOMAPPING ADD FOREIGN KEY(Videotypeid) REFERENCES VIDEOS(Videotypeid) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE VIDEOMAPPING ADD FOREIGN KEY(Videoid) REFERENCES SPECIFICVIDEOS(Videoid) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE QUOTEMAPPING ADD FOREIGN KEY(Quotetypeid) REFERENCES QUOTES(Quotetypeid) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE QUOTEMAPPING ADD FOREIGN KEY(Quoteid) REFERENCES SPECIFICQUOTES(Quoteid) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE JOURNAL ADD FOREIGN KEY(Userid) REFERENCES USERS(Userid) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Entries ADD FOREIGN KEY(Journalid) REFERENCES JOURNAL(Journalid) ON DELETE CASCADE ON UPDATE CASCADE


INSERT INTO Users(Userid, username, userpassword)
	VALUES(1, 'admin', 'abc'),
		(2, 'bob', '123'),
		(3, 'hoe', '456');

INSERT INTO Journal(Journalid, Userid, jtitle, jdate)
	VALUES(1, 2, 'dayone', '2022-02-02'),
		(2, 2, 'daytwo', '2022-02-03'),
		(3, 2, 'day3', '2022-02-04'),
		(4, 3, 'happy dayz', '2022-09-09');

INSERT INTO Videos(Videotypeid, genre)
	VALUES(1, 'depression'),
		(2, 'anxiety'),
		(3, 'stress');

INSERT INTO SPECIFICVIDEOS(Videoid, vtitle, vlink)
	VALUES(1, 'how to handle depression', 'src="https://www.youtube.com/embed/MOiaSc38ZeI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'),
		(2, 'how to handle anxiety', 'src="https://www.youtube.com/embed/VRxOmosteCc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'),
		(3, 'how to handle stress', 'src="https://www.youtube.com/embed/15GaKTP0gFE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');

INSERT INTO VIDEOMAPPING(Videoid, Videotypeid)
	VALUES (1, 1), (1, 2), (2, 2), (2, 3), (3, 3);

INSERT INTO Quotes(Quotetypeid, theme)
	VALUES(1, 'depression'),
		(2, 'anxiety'),
		(3, 'stress');

INSERT INTO Entries(Journalid, entryTitle, jcontent)
	VALUES(1, 'I cut my cock', "I woke up horny today, didn't understand why. Couldn't beat myself tho cuz My hands were in bandages from yesterday. So I started rubbing against the bed frame. Ended up cutting the shaft."),
		(1, 'Fish are kinda sexy ngl', 'Yesterday I was watching shark tails. And then I saw the fish in the movie that is supposed to look like beyonce. Safe to say I have a kink for fish now'),
		(2, 'I used my cooking oil as lube', 'So after I cut myself because of what happened in the morning. I realised this could all have been avoided had I just used some lube. But Im poor. So Instead of buying some, i just used my moms cooking oil. WORKED!');
		
		
INSERT INTO SPECIFICQUOTES(Quoteid, qtitle, qlink)
	VALUES(1, 'for depression', 'https://parade.com/.image/c_limit%2Ccs_srgb%2Cq_auto:good%2Cw_680/MTkwNTc1OTM1ODcyODM3NTAw/depression-quotes-2.webp'),
		(2, 'for anxiety', 'https://parade.com/.image/c_limit%2Ccs_srgb%2Cq_auto:good%2Cw_680/MTkwNTc1OTMxMDM0NjQyMzAw/anxiety-quotes-3.webp'),
		(3, 'for stress', 'https://home.hellodriven.com/wp-content/uploads/2021/06/william-james.jpg');

INSERT INTO QUOTEMAPPING(Quoteid, Quotetypeid)
	VALUES (1, 1), (1, 2), (2, 2), (2, 3), (3, 3);
