CREATE TABLE `naskewrimo_profiles` (
  `id` int(11) NOT NULL auto_increment,
  `email_address` varchar(255) NOT NULL,
  `passcode` char(4) NOT NULL default '',
  `display_name` varchar(255) default NULL,
  `display_link` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email_address` (`email_address`)
);

CREATE TABLE `naskewrimo_sketches` (
  `id` int(11) NOT NULL auto_increment,
  `profile_id` int(11) default NULL,
  `title` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `profile_id` (`profile_id`)
);

-- deprecated
CREATE TABLE `naskewrimo_updates` (
  `id` int(11) NOT NULL auto_increment,
  `profile_id` int(11) default NULL,
  `new_sketch_count` int(11) NOT NULL default '0',
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `new_sketch_count` (`new_sketch_count`),
  KEY `profile_id` (`profile_id`)
);
