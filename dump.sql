CREATE TABLE IF NOT EXISTS `prefix_prof` (
  `prof_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `prof_name` varchar(30) NOT NULL,
  PRIMARY KEY (`prof_id`),
  KEY `prof_name` (`prof_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `prefix_prof_user` (
  `prof_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  UNIQUE KEY `user_id` (`user_id`),
  KEY `prof_id` (`prof_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;