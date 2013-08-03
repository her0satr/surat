CREATE TABLE IF NOT EXISTS `disposisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `letter_id` int(11) NOT NULL,
  `no_agenda` varchar(255) NOT NULL,
  `date_letter` date NOT NULL,
  `date_finish` date NOT NULL,
  `no_date_letter` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `continued` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;