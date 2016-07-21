CREATE TABLE weewx (
  `weewx_id` int(10) NOT NULL AUTO_INCREMENT,
  `weewx_icon` varchar(255) NOT NULL,
  `weewx_type` varchar(10) NOT NULL,
  `weewx_name` varchar(50) NOT NULL,
  `weewx_folder` varchar(50) NOT NULL,
  `weewx_version` varchar(5) NOT NULL,
  `weewx_author` varchar(50) NOT NULL,
  `weewx_authorURL` varchar(255) NOT NULL,
  `weewx_date` int(10) NOT NULL,
  `weewx_compatibility` varchar(5) NOT NULL,
  `weewx_url` varchar(255) NOT NULL,

  PRIMARY KEY (`weewx_id`)
) ENGINE=MyISAM;
