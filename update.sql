2014-06-02 :
- ALTER TABLE `post` ADD `open_hour` VARCHAR( 150 ) NOT NULL AFTER `total_room` , ADD `phone` VARCHAR( 150 ) NOT NULL AFTER `open_hour` ;
- ALTER TABLE `post` ADD `price` INT NOT NULL AFTER `phone` ;
- CREATE TABLE IF NOT EXISTS `city_tag` ( `id` int(11) NOT NULL AUTO_INCREMENT, `city_id` int(11) NOT NULL, `tag_id` int(11) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
- CREATE TABLE IF NOT EXISTS `category_sub_tag` ( `id` int(11) NOT NULL AUTO_INCREMENT, `category_sub_id` int(11) NOT NULL, `tag_id` int(11) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

2014-09-26 :
- ALTER TABLE `page_static` ADD `redirect` LONGTEXT NOT NULL AFTER `post_time` ;

2014-09-27 :
- CREATE TABLE IF NOT EXISTS `my_travelling` ( `id` int(11) NOT NULL AUTO_INCREMENT, `traveler_id` int(11) NOT NULL, `title` varchar(255) NOT NULL, `alias` int(11) NOT NULL, `desc` longtext NOT NULL, `tag` varchar(255) NOT NULL, `thumbnail` varchar(100) NOT NULL, `create_date` date NOT NULL, PRIMARY KEY (`id`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;