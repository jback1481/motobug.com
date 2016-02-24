-- mysql> show tables;
-- +----------------------+
-- | Tables_in_mvv_ingest |
-- +----------------------+
-- | assets               |
-- | ingest               |
-- | status               |
-- | topics               |
-- | topics_namespace     |
-- +----------------------+
-- 5 rows in set (0.00 sec)

CREATE DATABASE `mvv_ingest`;
/*!40100 DEFAULT CHARACTER SET utf8 */;

use `mvv_ingest`;

-- mysql> describe assets;
-- +-----------+---------------------+------+-----+---------------------+-----------------------------+
-- | Field     | Type                | Null | Key | Default             | Extra                       |
-- +-----------+---------------------+------+-----+---------------------+-----------------------------+
-- | id        | bigint(11) unsigned | NO   | PRI | NULL                |                             |
-- | ingest_id | int(11)             | NO   |     | NULL                |                             |
-- | name      | varchar(45)         | NO   |     | NULL                |                             |
-- | type      | varchar(45)         | NO   |     | NULL                |                             |
-- | created   | timestamp           | NO   |     | 0000-00-00 00:00:00 |                             |
-- | modified  | timestamp           | NO   |     | CURRENT_TIMESTAMP   | on update CURRENT_TIMESTAMP |
-- +-----------+---------------------+------+-----+---------------------+-----------------------------+
-- 6 rows in set (0.01 sec)

CREATE TABLE `assets` (
  `id` bigint(11) unsigned NOT NULL,
  `ingest_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT 0, 
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- mysql> describe ingest;
-- +-------------------+---------------------+------+-----+---------------------+-----------------------------+
-- | Field             | Type                | Null | Key | Default             | Extra                       |
-- +-------------------+---------------------+------+-----+---------------------+-----------------------------+
-- | id                | bigint(11) unsigned | NO   | PRI | NULL                | auto_increment              |
-- | title             | varchar(45)         | NO   |     | NULL                |                             |
-- | slug              | varchar(45)         | NO   |     | NULL                |                             |
-- | short_description | longtext            | NO   |     | NULL                |                             |
-- | long_description  | longtext            | NO   |     | NULL                |                             |
-- | tags              | longtext            | NO   |     | NULL                |                             |
-- | content_type      | varchar(45)         | NO   |     | NULL                |                             |
-- | content_channel   | varchar(45)         | NO   |     | NULL                |                             |
-- | auto_published    | varchar(11)         | NO   |     | false               |                             |
-- | available_date    | datetime            | NO   |     | NULL                |                             |
-- | premiere_date     | datetime            | NO   |     | NULL                |                             |
-- | encore_date       | datetime            | NO   |     | NULL                |                             |
-- | expiration_date   | datetime            | NO   |     | NULL                |                             |
-- | created           | timestamp           | NO   |     | 0000-00-00 00:00:00 |                             |
-- | modified          | timestamp           | NO   |     | CURRENT_TIMESTAMP   | on update CURRENT_TIMESTAMP |
-- +-------------------+---------------------+------+-----+---------------------+-----------------------------+
-- 15 rows in set (0.01 sec)

CREATE TABLE `ingest` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `short_description` longtext NOT NULL,
  `long_description` longtext NOT NULL,
  `tags` longtext NOT NULL,
  `content_type` varchar(45) NOT NULL,
  `content_channel` varchar(45) NOT NULL,
  `auto_published` varchar(11) NOT NULL DEFAULT 'false',
  `available_date` DATETIME NOT NULL,
  `premiere_date` DATETIME NOT NULL,
  `encore_date` DATETIME NOT NULL,
  `expiration_date` DATETIME NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT 0, 
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- mysql> describe status;
-- +-----------+---------------------+------+-----+---------------------+-----------------------------+
-- | Field     | Type                | Null | Key | Default             | Extra                       |
-- +-----------+---------------------+------+-----+---------------------+-----------------------------+
-- | id        | bigint(11) unsigned | NO   | PRI | NULL                | auto_increment              |
-- | ingest_id | bigint(11) unsigned | NO   |     | NULL                |                             |
-- | status    | bigint(11) unsigned | NO   |     | 0                   |                             |
-- | created   | timestamp           | NO   |     | 0000-00-00 00:00:00 |                             |
-- | modified  | timestamp           | NO   |     | CURRENT_TIMESTAMP   | on update CURRENT_TIMESTAMP |
-- +-----------+---------------------+------+-----+---------------------+-----------------------------+
-- 5 rows in set (0.00 sec)

CREATE TABLE `status` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `ingest_id` bigint(11) unsigned NOT NULL,
  `status` bigint(11) unsigned NOT NULL DEFAULT 0,
  `created` TIMESTAMP NOT NULL DEFAULT 0, 
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- mysql> describe topics;
-- +---------------------+---------------------+------+-----+---------+----------------+
-- | Field               | Type                | Null | Key | Default | Extra          |
-- +---------------------+---------------------+------+-----+---------+----------------+
-- | id                  | bigint(11) unsigned | NO   | PRI | NULL    | auto_increment |
-- | ingest_id           | bigint(11) unsigned | NO   |     | NULL    |                |
-- | topics_namespace_id | bigint(11) unsigned | NO   |     | NULL    |                |
-- | slug                | varchar(45)         | NO   |     | NULL    |                |
-- +---------------------+---------------------+------+-----+---------+----------------+
-- 4 rows in set (0.00 sec)

CREATE TABLE `topics` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `ingest_id` bigint(11) unsigned NOT NULL,
  `topics_namespace_id` bigint(11) unsigned NOT NULL,
  `slug` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- mysql> describe topics_namespace;
-- +-------+---------------------+------+-----+---------+----------------+
-- | Field | Type                | Null | Key | Default | Extra          |
-- +-------+---------------------+------+-----+---------+----------------+
-- | id    | bigint(11) unsigned | NO   | PRI | NULL    | auto_increment |
-- | title | varchar(45)         | NO   |     | NULL    |                |
-- +-------+---------------------+------+-----+---------+----------------+
-- 2 rows in set (0.01 sec)

CREATE TABLE `topics_namespace` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;