SET FOREIGN_KEY_CHECKS=0;

USE fifthch_snitch;

DROP TABLES IF EXISTS user;
CREATE TABLE user (
	`uid` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(30) NOT NULL UNIQUE,
	`email` VARCHAR(30) NOT NULL,
	`password` VARCHAR(40) NOT NULL,
	PRIMARY KEY (`uid`),
	INDEX (`uid`)
) ENGINE=INNODB;

DROP TABLES IF EXISTS host;
CREATE TABLE host (
	`hid` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`hostname` VARCHAR(30) NOT NULL UNIQUE,
	PRIMARY KEY (`hid`),
	INDEX (`hid`)
) ENGINE=INNODB;

DROP TABLES IF EXISTS ip;
CREATE TABLE ip (
	`iid` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`address` VARCHAR(16) NOT NULL UNIQUE,
	PRIMARY KEY (`iid`),
	INDEX (`iid`)
) ENGINE=INNODB;



DROP TABLES IF EXISTS mtm_host_ip;
CREATE TABLE mtm_host_ip (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`fk_host` INT UNSIGNED NOT NULL, # derselbe Datentyp wie primary key
	`fk_ip` INT UNSIGNED NOT NULL, # derselbe Datentyp wie primary key
	`updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`active` BOOLEAN NOT NULL DEFAULT TRUE,
	PRIMARY KEY (`id`),
	INDEX (`fk_host`, `fk_ip`),
	CONSTRAINT FOREIGN KEY (`fk_host`) REFERENCES `host` (`hid`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY (`fk_ip`) REFERENCES `ip` (`iid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;


DROP VIEW IF EXISTS ip_per_host;
CREATE VIEW ip_per_host
AS
	SELECT *
	FROM host AS h
	INNER JOIN mtm_host_ip AS mhi ON mhi.fk_host = h.hid
	INNER JOIN ip AS i ON mhi.fk_ip = i.iid
	WHERE mhi.active = TRUE
	ORDER BY h.hid;
	


DELIMITER //
DROP PROCEDURE IF EXISTS post//
CREATE PROCEDURE post(IN in_hostname VARCHAR(30), IN in_ip VARCHAR(16))
	BEGIN
		# insert host and ip
		INSERT IGNORE INTO host (hostname) values (in_hostname);
		INSERT IGNORE INTO ip (address) values (in_ip);
		
		# make old records inactive
		UPDATE mtm_host_ip AS mhi
		INNER JOIN host AS h ON mhi.fk_host = h.hid
		SET mhi.active = FALSE
		WHERE h.hostname = in_hostname ;
		
		INSERT INTO mtm_host_ip (fk_host, fk_ip)
			SELECT
				(SELECT host.hid  FROM host WHERE host.hostname = in_hostname) AS host_id,
				(SELECT ip.iid FROM ip WHERE ip.address = in_ip) AS ip_id
		;
	END //
DELIMITER ;




SET FOREIGN_KEY_CHECKS=1;









## Old stuff ##

# Gruppiert nach hostname und Zeit - die neueste IP steht in der hostname Gruppe zuunterst.
#DROP VIEW IF EXISTS all_ip_per_host;
#CREATE VIEW all_ip_per_host
#AS
#	SELECT * FROM mtm_host_ip AS mhi
#	INNER JOIN host AS h ON h.hid = mhi.fk_host
#	INNER JOIN ip AS i ON i.iid = mhi.fk_ip
#	ORDER BY h.hostname, mhi.updated;
