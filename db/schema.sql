CREATE TABLE `promocodes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `promocode` varchar(32) NOT NULL DEFAULT '',
  `agency_id` int(11) DEFAULT NULL,
  `agent_id` bigint(11) DEFAULT NULL,
  `account_plan_id` int(11) DEFAULT NULL,
  `udf1` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `promocode` (`promocode`),
  KEY `account_plan_id` (`account_plan_id`),
  KEY `agency_id` (`agency_id`),
  CONSTRAINT `promocodes_ibfk_1` FOREIGN KEY (`account_plan_id`) REFERENCES `account_plans` (`id`),
  CONSTRAINT `promocodes_ibfk_2` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`),
  CONSTRAINT `promocodes_ibfk_3` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
