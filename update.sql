2014-06-02 :
- ALTER TABLE `post` ADD `open_hour` VARCHAR( 150 ) NOT NULL AFTER `total_room` , ADD `phone` VARCHAR( 150 ) NOT NULL AFTER `open_hour` ;
- ALTER TABLE `post` ADD `price` INT NOT NULL AFTER `phone` ;
- CREATE TABLE IF NOT EXISTS `city_tag` ( `id` int(11) NOT NULL AUTO_INCREMENT, `city_id` int(11) NOT NULL, `tag_id` int(11) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
- CREATE TABLE IF NOT EXISTS `category_sub_tag` ( `id` int(11) NOT NULL AUTO_INCREMENT, `category_sub_id` int(11) NOT NULL, `tag_id` int(11) NOT NULL, PRIMARY KEY (`id`) ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;