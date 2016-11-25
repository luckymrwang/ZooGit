SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `weixin_tank` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

use weixin_tank;

CREATE TABLE IF NOT EXISTS `players` (
  `mobile` BIGINT(11) UNSIGNED NOT NULL,
  `qq` BIGINT(11) UNSIGNED NOT NULL,
  `sex` CHAR(1) DEFAULT '' COMMENT 'F-female, M-male',
  `age` DATE,
  `create_time` INT(11) NOT NULL,
  `userid` int(11) DEFAULT '0',
  `big_app_id` int(10) DEFAULT '0',
  `zid` int(10) DEFAULT '0',
  `ulvl` int(5) DEFAULT '-1',
  `viplvl` int(3) DEFAULT '-1',
  `consume_time` INT(11) NOT NULL,
  

  PRIMARY KEY (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `gifts` (
  `id` BIGINT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `open_id` VARCHAR(64) NOT NULL,
  `random_part` SMALLINT(5) UNSIGNED NOT NULL,
  `type` TINYINT(3) NOT NULL,
  `sub_type` SMALLINT(5) NOT NULL,
  `status` TINYINT(3) DEFAULT 0 COMMENT '0-inited, 1-used',

  PRIMARY KEY (`id`, `open_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `gift_content` (
  `type` TINYINT(3) NOT NULL,
  `sub_type` SMALLINT(5) NOT NULL,
  `content` VARCHAR(256) NOT NULL,

  PRIMARY KEY (`type`, `sub_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
