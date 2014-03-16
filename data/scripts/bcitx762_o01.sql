-- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2014 at 01:58 AM
-- Server version: 5.1.72-cll
-- PHP Version: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bcitx762_o01`
--

-- --------------------------------------------------------

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
DROP TABLE IF EXISTS properties;

CREATE TABLE IF NOT EXISTS `properties` (
  `key` varchar(16) NOT NULL,
  `value` varchar(256) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`key`, `value`) VALUES
('code', 'o01'),
('name', 'Thirst Of Man'),
('slug', 'Modern beer drinking beer reviews'),
('link', 'thirstofman.bcitxml.com');

-- --------------------------------------------------------

--
-- Table structure for table `beers`
--

CREATE TABLE IF NOT EXISTS `beers` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `category` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'random'),
(2, 'Fruit Beer'),
(3, 'Imperial Pale Ale'),
(4, 'Amber Ale'),
(5, 'Oak Aged Beer'),
(6, 'Dark Ale'),
(7, 'Imperial Russian Stout'),
(8, 'Lager'),
(9, 'Saison');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('6e4355e9c0c74f8996552e72b2281060', '24.87.154.164', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1394430969, 'a:4:{s:7:"user_id";s:6:"donald";s:9:"user_name";s:6:"donald";s:12:"display_name";s:6:"Donald";s:8:"userRole";s:5:"admin";}'),
('7667fae48f95d5c54d4d2a6fdae6f13f', '192.68.68.10', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko', 1394430890, ''),
('b4ae2ddacea8ad5e626f0665f8251c7f', '24.87.154.164', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko', 1394429771, 'a:4:{s:7:"user_id";s:3:"mat";s:9:"user_name";s:3:"mat";s:12:"display_name";s:5:"Mat S";s:8:"userRole";s:5:"admin";}'),
('b9f3b89fbee47ebd875b89c5269a7047', '70.79.15.234', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1394428549, ''),
('fca675227a75f78c47576dd63d47dc97', '96.55.149.173', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/53', 1394429782, '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `comment` varchar(10) NOT NULL,
  `mdate` varchar(256) NOT NULL,
  `edate` varchar(256) NOT NULL,
  `post_id` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(64) NOT NULL,
  `author` varchar(64) NOT NULL,
  `caption` varchar(256) NOT NULL,
  `licence` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`, `author`, `caption`, `licence`) VALUES
(2, 'profile1.jpg', 'Mat Siwoski', '', 'CCL'),
(3, 'profile2.jpg', 'Jordan Marling', '', 'CCL'),
(4, 'images1.jpg', '', '', ''),
(5, 'fearless.jpg', '', '', ''),
(6, 'prohibited.jpg', '', '', ''),
(7, 'scorpion.jpg', '', '', ''),
(8, 'amber_ale.jpg', '', '', ''),
(9, 'innisgunn.jpg', '', '', ''),
(10, 'Unibroue_Trois_Pistoles.jpg', '', '', ''),
(11, 'torpedo.jpg', '', '', ''),
(12, 'amnesiac.jpg', '', '', ''),
(13, 'stambroise.jpg', '', '', ''),
(14, 'moosehead.jpg', '', '', ''),
(15, 'fourwinds.jpg', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_posted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` varchar(32) NOT NULL,
  `post_title` varchar(128) NOT NULL,
  `slug` varchar(256) NOT NULL,
  `text` text NOT NULL,
  `beer_id` int(8) DEFAULT NULL,
  `rating` int(1) DEFAULT NULL,
  `category_id` int(8) NOT NULL,
  `image_id` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `beer_id` (`beer_id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  KEY `image_id` (`image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `date_created`, `date_modified`, `date_posted`, `user_id`, `post_title`, `slug`, `text`, `beer_id`, `rating`, `category_id`, `image_id`) VALUES
(1, '2014-03-10 05:23:47', '0000-00-00 00:00:00', '2014-03-10 05:23:47', 'mat', 'Welcome to our site', 'Welcome to our Site', '<p><span style="font-size:14px">Just an introduction to the Thirst of Man! This website is a site for the beer drinker in each and every one of us. We would like to rid of the misconceptions of beer and introduce people to the world and wonder of this magical brew! Please enjoy the show!</span></p>\n', 0, 0, 1, 4),
(2, '2014-03-10 05:30:13', '0000-00-00 00:00:00', '2014-03-10 05:30:13', 'mat', 'Fearless Brewing Company Peach Cream Ale', 'A beer best fitted for a relaxing summer evening', '<p>A beer best fitted for a relaxing summer evening, this ale offers a light and fun drink option for those wanting a cider alternative. The scent of peaches was probably better than its peach core taste, but the finish had a lovely creamy finish. Malty and light in colour, Peach Cream Ale is something I don’t think I’d order a second round of. Despite this, if you’re looking for a light fruit tasting beer, you should consider this the next time you see it at the liquor store. This beer is best fitted for summer nights, cider lovers and listening to Peaches – Presidents of the United States of America.</p>\n', 0, 0, 2, 5),
(3, '2014-03-10 05:35:35', '0000-00-00 00:00:00', '2014-03-10 05:35:35', 'mat', 'Prohibited Lawless IPA', 'This beer was not firing on all cylinders for me!', '<p>A relatively strong hoppy entry, this beer was not firing on all cylinders for me. The hoppy floral scent was mild and decent. But I can only really best describe the taste as hoppy with a drab finish. If you were looking for a strong beer with a lot hops, maybe this is your thing. But personally, I don’t really see another purchase on my end. </p>\n', 0, 0, 3, 6),
(4, '2014-03-10 05:38:13', '0000-00-00 00:00:00', '2014-03-10 05:38:13', 'mat', 'Tin Whistle Brewing Scorpion Double IPA', 'The taste itself is moderately malty but surprisingly not too hoppy.', '<p>I’m extremely picky about IPAs. So reading an IPA review from me is probably not the best indicator of a good IPA. The taste itself is moderately malty but surprisingly not too hoppy. What I didn’t enjoy was the bad after taste. You should just discount this review and buy it to make your own judgement on this one, but basically there’s better choices out there.</p>\n', 0, 0, 3, 7),
(5, '2014-03-10 05:40:46', '0000-00-00 00:00:00', '2014-03-10 05:40:46', 'jordan', 'Stanley Park Amber Ale', 'This amber ale has a lovely dark gold colour.', '<p>This amber ale has a lovely dark gold colour (because you know, its’ an amber ale). It’s smooth and crisp with a minor malt finish. I think this beer is better with a non-greasy meal. So note to self: don’t order this with fried chicken wings. This is a beer that’s good, but not great. If you were shopping for craft beer, you should keep walking. However, if you’re looking for an alternate beer to something like Molson Canadian or Kokanee, this may be the beer to choose. This beer sits on the realm of wanting to appeal to the mass market, but doesn’t appeal to anyone particular in the end.</p>\n', 0, 0, 4, 8),
(6, '2014-03-10 05:43:05', '0000-00-00 00:00:00', '2014-03-10 05:43:05', 'jordan', 'Innis and Gunn Original Oak Aged Beer', 'Toffee and vanilla profile gives this beer a sweet taste.', '<p>This is Innis and Gunn’s flagship beer. When you have your first sip of this beer, you’ll understand very quickly why this beer has gone global. The aging process in oak caskets give this golden hued beer a unique profile found rarely in most beers. Toffee and vanilla profile gives this beer a sweet taste. Sometimes beers have a synthetic taste to their beers, but this is not present in this brew. I could see this beer going with some curries or some sort of spicy dish. My only knock on this beer is its price per bottle. But if you’ve never had this beer or oak aged beers in general, this should be the gold standard to experience.</p>\n', 0, 0, 5, 9),
(7, '2014-03-10 05:45:17', '0000-00-00 00:00:00', '2014-03-10 05:45:17', 'jordan', 'Unibroue Trois Pistoles', ' A winter evening by a fire place is where this is best enjoyed.', '<p>A strong beer entry with ripe fruit tastes. It’s bold, and a pretty manly beer. The dark brown colour resembles ebony wood. Although it has a 9% ABU, you don’t notice the alcohol taste as with most other strong beers. A winter evening by a fire place is where this is best enjoyed.</p>\n', 0, 0, 6, 10),
(8, '2014-03-10 05:46:33', '0000-00-00 00:00:00', '2014-03-10 05:46:33', 'jordan', 'Sierra Nevada Torpedo IPA', 'Aromatic and floral, this is a fun little beer to get into.', '<p>Aromatic and floral, this is a fun little beer to get into. It’s got a nice citrus taste which made rounded out the flavour profile. Admittedly, I’ve avoided this beer for a long time (there’s a lot of competition from other beers, after all). But I finally purchased this at the liquor store and I’ve been quite happy with it.  This beer was enjoyed with some friends while planning out world domination. It kept the creative juices flowing and I’d definitely buy this guy again.</p>\n', 0, 0, 3, 11),
(9, '2014-03-10 05:48:15', '0000-00-00 00:00:00', '2014-03-10 05:48:15', 'jordan', 'Phillips Brewing Company Amnesiac Double IPA', 'People with aversion for hops should continue to stay away. ', '<p>A light sweet scent and ends with a hoppy bitter taste. The citrus notes were quite pleasing. Although this was quite easy to drink, I would not say this is for everyone. People with aversion for hops should continue to stay away. But for those who don’t mind it, buy it and try it.</p>\n', 0, 0, 3, 12),
(10, '2014-03-10 05:50:07', '0000-00-00 00:00:00', '2014-03-10 05:50:07', 'jordan', 'St Ambroise Imperial Russian Stout', 'Stout fans, try this. It pours dark heavy and thick. ', '<p>Stout fans, try this. It pours dark heavy and thick. This is a strong dark beer with heavy roasted coffee notes on the back end. It’s pleasant and not overwhelmingly bitter. It comes in a fancy container for marketing reasons, I’m sure. And I think it’s justified. </p>\n', 0, 0, 7, 13),
(11, '2014-03-10 05:51:51', '0000-00-00 00:00:00', '2014-03-10 05:51:51', 'mat', 'Moosehead Lager', 'Welcome yourself to a good hockey beer.', '<p>Welcome yourself to a good hockey beer. I dismissed this beer as a ‘mass appeal’ beer at first. But really, its pretty decent. Malty and easy to drink, this is a beer you should get when watching hockey with some friends. Fact: Moosehead is the oldest independent Canadian beer company.  With that being said, there’s a reason for it’s existence. Purchase this before you grab that Coors Light…</p>\n', 0, 0, 8, 14),
(12, '2014-03-10 05:55:42', '0000-00-00 00:00:00', '2014-03-10 05:55:42', 'mat', '4 Winds Saison ', 'The brewery is located, frankly, in the middle of nowhere. ', '<p>This is 4 Winds Saison. 4 Winds is an up and coming company out from Delta BC. The brewery is located, frankly, in the middle of nowhere. Anyways, the beer itself is great. It’s got a light head and golden colour. The taste is a dry apricot/nectarine taste which I think would pair well with greasy foods. I haven’t seen the beer in many liquor stores at the moment, but I feel that will change in the next 2 years. </p>\n', 0, 0, 9, 15);

-- --------------------------------------------------------

--
-- Table structure for table `postTags`
--

CREATE TABLE IF NOT EXISTS `postTags` (
  `post_id` int(8) NOT NULL,
  `tag_id` int(8) NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE IF NOT EXISTS `quotes` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `person_name` varchar(128) NOT NULL,
  `quote_title` varchar(64) NOT NULL,
  `quote_body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `person_name`, `quote_title`, `quote_body`) VALUES
(1, 'Arnold Schwarzenegger', 'Actor', 'Milk is for babies. When you grow up you have to drink beer.'),
(2, 'Jack Nicholson', 'Actor', 'Beer, it''s the best damn drink in the world.'),
(3, 'Plato', 'Philosopher', 'He was a wise man who invented beer.'),
(4, 'Dan Castellaneta (Homer Simpson)', 'Actor', 'Beer. Now there''s a temporary solution.'),
(5, 'Russell Crowe', 'Actor', 'I have respect for beer.'),
(6, 'Benjamin Franklin', 'US President', 'Beer is proof that God loves us and wants us to be happy.'),
(7, 'David Justice', 'Author', 'I mulled over what he had told me as I savored the Scotch. Not bad, really &#45; like a beer that’s been in a brawl'),
(8, 'Hunter S. Thompson', 'Author', 'Good people drink good beer.'),
(9, 'George Carlin', 'Comedian', 'Give a man a fish and he will eat for a day. Teach him how to fish, and he will sit in a boat and drink beer all day.');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `recipe` text,
  `recipe_type` varchar(64) DEFAULT NULL,
  `recipe_img` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipe_img` (`recipe_img`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `recipe`, `recipe_type`, `recipe_img`) VALUES
(1, '<p>Khao Soi</p> <p>Traditional Northern Thai Soup. </br> 1 tbsp Red Curry Paste</p>', 'Dinner', 'khaosoi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `tag` varchar(64) NOT NULL,
  PRIMARY KEY (`id`,`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_name` varchar(32) NOT NULL,
  `display_name` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `last_visit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(1) NOT NULL,
  `token` varchar(32) NOT NULL,
  `job_title` varchar(128) NOT NULL,
  `about_profile` text,
  `about_image` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`user_name`),
  KEY `about_image` (`about_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `display_name`, `password`, `role`, `email`, `last_visit`, `status`, `token`, `job_title`, `about_profile`, `about_image`) VALUES
('mat', 'Mat S', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', 'mat@thirstofman.com', '2014-03-10 05:51:11', 'A', '', 'Tech Guy - Avid Beer Drinker', '<p>Hi, My name is Mat, I have a Bat. I don''t want to have a cat, and I''m not fat!</p>', 'profile1.jpg'),
('jordan', 'Jordan M', 'd93591bdf7860e1e4ee2fca799911215', 'admin', 'jordan@thirstofman.com', '2014-03-10 05:38:49', 'A', '', 'Tech Guy - Avid Beer Drinker', '<p>Hi, My name is Jordan. I''m not named after a country. The country is named after me! SUCK IT!</p>', 'profile2.jpg'),
('donald', 'Donald', '36846677e3a8f4c0b16d8bdf8ef18608', 'admin', 'donald@thirstofman.com', '2014-03-10 05:56:21', 'A', '', '', '', ''),
('mickey', 'Mickey', '40203abe6e81ed98cbc97cdd6ec4f144', 'user', 'mickey@thirstofman.com', '0000-00-00 00:00:00', 'A', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
