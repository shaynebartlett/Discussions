CREATE TABLE IF NOT EXISTS `#__discussions_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(100),
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discussions_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `alias` varchar(255),
  `description` varchar(1000) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `show_image` tinyint(1) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  `counter_posts` int(11) NOT NULL,
  `counter_threads` int(11) NOT NULL,
  `last_entry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_entry_user_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `moderated` tinyint(1) NOT NULL DEFAULT '0',
  `meta_title` varchar(255),
  `meta_description` varchar(255),
  `meta_keywords` varchar(255),
  `banner_top` text DEFAULT '',
  `banner_bottom` text DEFAULT '',  
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discussions_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `thread` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `account` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `ip` varchar(100) NOT NULL DEFAULT '',
  `type` int(11) NOT NULL DEFAULT 1,
  `subject` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) DEFAULT '',
  `message` text NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hits` int(11) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `counter_replies` int(11) NOT NULL DEFAULT '0',
  `last_entry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_entry_user_id` int(11) NOT NULL,
  `last_entry_msg_id` int(11) NOT NULL,
  `sticky` tinyint(1) NOT NULL DEFAULT '0',
  `wfm` tinyint(1) DEFAULT '0',
  `image1` varchar(255) DEFAULT '',
  `image1_description` varchar(255) DEFAULT '',
  `image2` varchar(255) DEFAULT '',
  `image2_description` varchar(255) DEFAULT '',
  `image3` varchar(255) DEFAULT '',
  `image3_description` varchar(255) DEFAULT '',
  `image4` varchar(255) DEFAULT '',
  `image4_description` varchar(255) DEFAULT '',
  `image5` varchar(255) DEFAULT '',
  `image5_description` varchar(255) DEFAULT '',  
  PRIMARY KEY (`id`),
  KEY `idx_thread` (`thread`),
  KEY `idx_sticky` (`sticky`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_parent_id` (`parent_id`),
  KEY `idx_cat_id` (`cat_id`),
  KEY `idx_last_entry_user_id` (`last_entry_user_id`),
  KEY `idx_last_entry_msg_id` (`last_entry_msg_id`),
  KEY `idx_published`  (`published`),
  KEY `idx_wfm`  (`wfm`),
  KEY `idx_date`  (`date`)   
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discussions_users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) DEFAULT '',  
  `view` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` tinyint(1) NOT NULL DEFAULT '0',
  `posts` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(100) DEFAULT '',
  `signature` text,
  `title` varchar(100) DEFAULT '',
  `zipcode` varchar(10) DEFAULT '',
  `city` varchar(100) DEFAULT '',
  `country` varchar(100) DEFAULT '',  
  `moderator` tinyint(1) NOT NULL DEFAULT '0',
  `moderated` tinyint(1) NOT NULL DEFAULT '0',
  `rookie` tinyint(1) NOT NULL DEFAULT '0',
  `trusted` tinyint(1) NOT NULL DEFAULT '0',
  `images` tinyint(1) NOT NULL DEFAULT '0',
  `files` tinyint(1) NOT NULL DEFAULT '0',
  `website` varchar(100) DEFAULT '',
  `twitter` varchar(100) DEFAULT '',
  `facebook` varchar(100) DEFAULT '',
  `flickr` varchar(100) DEFAULT '',
  `youtube` varchar(100) DEFAULT '',  
  `googleplus` varchar(100) DEFAULT '',
  `email_notification` tinyint(1) DEFAULT '0',
  `approval_notification` tinyint(1) DEFAULT '0',
  `show_online_status` tinyint(1) DEFAULT '1',
  `messages_email_notifications` tinyint(1) NOT NULL DEFAULT '0',
  `messages_use_signature` tinyint(1) NOT NULL DEFAULT '0',
  `messages_use_signature_for_replies` tinyint(1) NOT NULL DEFAULT '0',
  `messages_signature` text,
  PRIMARY KEY (`id`),
  KEY `idx_moderator` (`moderator`)    
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discussions_configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `social_media_button_1` text DEFAULT '',
  `social_media_button_2` text DEFAULT '',
  `social_media_button_3` text DEFAULT '',
  `share_code` text DEFAULT '',
  `html_box_index_top` text DEFAULT '',
  `html_box_index_bottom` text DEFAULT '',
  `html_box_category_top` text DEFAULT '',
  `html_box_category_bottom` text DEFAULT '',
  `html_box_thread_top` text DEFAULT '',
  `html_box_thread_bottom` text DEFAULT '',
  `html_box_profile_top` text DEFAULT '',
  `html_box_profile_bottom` text DEFAULT '',
  `html_box_posting_top` text DEFAULT '',
  `html_box_posting_bottom` text DEFAULT '',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discussions_messages_inbox` (
  	`id` 			int(11) NOT NULL AUTO_INCREMENT,
	`user_id`		INTEGER UNSIGNED DEFAULT 0,
	`user_from_id`	INTEGER UNSIGNED DEFAULT 0,
	`msg_date`      DATE DEFAULT NULL,
	`msg_time`      TIME DEFAULT NULL,
	`subject`       VARCHAR(80) DEFAULT NULL,
	`message`       TEXT,
	`flag_read`     TINYINT(1) DEFAULT 0,
	`flag_answered` TINYINT(1) DEFAULT 0,
	`flag_deleted`  TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_discussions_messages_inbox_user_id` (`user_id`),
  KEY `idx_discussions_messages_inbox_user_from_id` (`user_from_id`),
  KEY `idx_discussions_messages_inbox_msg_date` (`msg_date`),
  KEY `idx_discussions_messages_inbox_msg_time` (`msg_time`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__discussions_messages_outbox` (
  	`id` 			int(11) NOT NULL AUTO_INCREMENT,
	`user_id`		INTEGER UNSIGNED DEFAULT 0,
	`user_to_id`	INTEGER UNSIGNED DEFAULT 0,
	`msg_date`      DATE DEFAULT NULL,
	`msg_time`      TIME DEFAULT NULL,
	`subject`       VARCHAR(80) DEFAULT NULL,
	`message`       TEXT,
	`flag_read`     TINYINT(1) DEFAULT 0,
	`flag_answered` TINYINT(1) DEFAULT 0,
	`flag_deleted`  TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_discussions_messages_outbox_user_id` (`user_id`),
  KEY `idx_discussions_messages_outbox_user_to_id` (`user_to_id`),
  KEY `idx_discussions_messages_outbox_msg_date` (`msg_date`),
  KEY `idx_discussions_messages_outbox_msg_time` (`msg_time`)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


