-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 7, 2014 at 09:02 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS media;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS tags;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS ratings;
DROP TABLE IF EXISTS beers;
DROP TABLE IF EXISTS postTags;
DROP TABLE IF EXISTS ci_sessions;
DROP TABLE IF EXISTS recipes;
DROP TABLE IF EXISTS quotes;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: 'beer'
--
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS recipes(
    id int(8) NOT NULL AUTO_INCREMENT,
    recipe TEXT,
    recipe_type varchar(64),
    recipe_img varchar(64),
    PRIMARY KEY (id),
    FOREIGN KEY (recipe_img)
        REFERENCES images(filename)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS ci_sessions (
  session_id varchar(40) NOT NULL DEFAULT '0',
  ip_address varchar(45) NOT NULL DEFAULT '0',
  user_agent varchar(120) NOT NULL,
  last_activity int(10) unsigned NOT NULL DEFAULT '0',
  user_data text NOT NULL,
  PRIMARY KEY (session_id),
  KEY last_activity_idx (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS users (
  user_name varchar(32) NOT NULL,
  display_name varchar(32) NOT NULL,
  password varchar(32) NOT NULL,
  role varchar(20) NOT NULL,
  email varchar(128) NOT NULL,
  last_visit TIMESTAMP NOT NULL,
  status varchar(1) NOT NULL,
  token varchar(32) NOT NULL,
  job_title varchar(128) NOT NULL,
  about_profile TEXT,
  about_image varchar(64),
  PRIMARY KEY (user_name),
    FOREIGN KEY (about_image)
        REFERENCES images(filename)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS images (
  id int(11) NOT NULL AUTO_INCREMENT,
  filename varchar(64) NOT NULL,
  author varchar(64) NOT NULL,
  caption varchar(256) NOT NULL,
  licence varchar(64) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS categories(
  id int(8) NOT NULL AUTO_INCREMENT,
  category varchar(256) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;  
  
CREATE TABLE IF NOT EXISTS comments (
  id int(8) NOT NULL AUTO_INCREMENT,
  user_name varchar(64) NOT NULL,
  email varchar(64) NOT NULL,
  comment varchar(10) NOT NULL,
  mdate varchar(256) NOT NULL,
  edate varchar(256) NOT NULL,
  post_id int(8) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY(post_id) 
		REFERENCES posts(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tags (
  id int(8) NOT NULL AUTO_INCREMENT,
  tag varchar(64) NOT NULL,
  PRIMARY KEY (id, tag)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS beers (
  id int(8) NOT NULL AUTO_INCREMENT,
  name varchar(64) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS postTags(
  post_id int(8)  NOT NULL,
  tag_id int(8) NOT NULL,
  PRIMARY KEY (post_id, tag_id),
  FOREIGN KEY (post_id)
    REFERENCES posts(id),
  FOREIGN KEY (tag_id)
    REFERENCES tags(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS posts(
  id int(8) NOT NULL AUTO_INCREMENT,
  date_created TIMESTAMP NOT NULL,
  date_modified TIMESTAMP,
  date_posted TIMESTAMP,
  user_id varchar(32) NOT NULL,
  post_title varchar(128) NOT NULL, 
  slug varchar(256) NOT NULL,
  text TEXT NOT NULL,
  beer_id int(8),
  rating int(1),
  category_id int(8) NOT NULL,
  image_id int(8) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(beer_id) 
		REFERENCES beers(id),
  FOREIGN KEY(category_id)
		REFERENCES categories(id),
  FOREIGN KEY(user_id) 
		REFERENCES users(user_name),
  FOREIGN KEY(image_id) 
		REFERENCES images(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;  

CREATE TABLE IF NOT EXISTS quotes (
  id int(8) NOT NULL AUTO_INCREMENT,
  person_name varchar(128) NOT NULL,
  quote_title varchar(64) NOT NULL,
  quote_body TEXT NOT NULL,
  PRIMARY KEY (id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;  

INSERT INTO quotes (id, person_name, quote_title, quote_body) VALUES
(1, 'Arnold Schwarzenegger', 'Actor', 'Milk is for babies. When you grow up you have to drink beer.'),
(2, 'Jack Nicholson', 'Actor', 'Beer, it''s the best damn drink in the world.'),
(3, 'Plato', 'Philosopher', 'He was a wise man who invented beer.'),
(4, 'Dan Castellaneta (Homer Simpson)', 'Actor', 'Beer. Now there''s a temporary solution.'),
(5, 'Russell Crowe', 'Actor', 'I have respect for beer.'),
(6, 'Benjamin Franklin', 'US President', 'Beer is proof that God loves us and wants us to be happy.'),
(7, 'David Justice', 'Author', 'I mulled over what he had told me as I savored the Scotch. Not bad, really &#45; like a beer that’s been in a brawl'),
(8, 'Hunter S. Thompson','Author','Good people drink good beer.'),
(9, 'George Carlin', 'Comedian', 'Give a man a fish and he will eat for a day. Teach him how to fish, and he will sit in a boat and drink beer all day.'); 
   
INSERT INTO recipes (id, recipe, recipe_type, recipe_img) VALUES
(1, '<p>Khao Soi</p> <p>Traditional Northern Thai Soup. </br> 1 tbsp Red Curry Paste</p>', 'Dinner','khaosoi.jpg');

INSERT INTO images (id, filename, author, caption, licence) VALUES
(2, 'profile1.jpg', 'Mat Siwoski', '', 'CCL'),
(3, 'profile2.jpg', 'Jordan Marling', '', 'CCL');

INSERT INTO users (user_name, display_name, password, role, email, last_visit, status, token, job_title, about_profile, about_image) VALUES
('mat', 'Mat S', md5('1234'), 'admin', 'mat@thirstofman.com', '2013-10-17 12:00:00', 'A', '', 'Tech Guy - Avid Beer Drinker','<p>Hi, My name is Mat, I have a Bat. I don''t want to have a cat, and I''m not fat!</p>', 'profile1.jpg'),
('jordan', 'Jordan M', md5('4321'), 'admin', 'jordan@thirstofman.com', '2013-10-17 12:00:00', 'A', '', 'Tech Guy - Avid Beer Drinker','<p>Hi, My name is Jordan. I''m not named after a country. The country is named after me! SUCK IT!</p>', 'profile2.jpg');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
