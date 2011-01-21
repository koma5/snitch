SET FOREIGN_KEY_CHECKS=0;

USE fifthch_snitch;

DROP TABLE IF EXISTS tUser;
CREATE TABLE tUser (
	`usrID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`usrName` VARCHAR(30) NOT NULL UNIQUE,
	`usrEmail` VARCHAR(30) NOT NULL,
	`usrPassword` VARCHAR(40) NOT NULL,
	PRIMARY KEY (`usrID`),
	INDEX (`usrID`)
) ENGINE=INNODB;

DROP TABLE IF EXISTS tHost;
CREATE TABLE tHost (
	`hostID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`hostName` VARCHAR(30) NOT NULL UNIQUE,
	PRIMARY KEY (`hostID`),
	INDEX (`hostID`)
) ENGINE=INNODB;

DROP TABLE IF EXISTS tIP;
CREATE TABLE tIP (
	`ipID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`ipAddress` VARCHAR(16) NOT NULL UNIQUE,
	PRIMARY KEY (`ipID`),
	INDEX (`ipID`)
) ENGINE=INNODB;



DROP TABLE IF EXISTS lHost_IP;
CREATE TABLE lHost_IP (
	`hipID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`fk_hostID` INT UNSIGNED NOT NULL, # derselbe Datentyp wie der primary key
	`fk_ipID` INT UNSIGNED NOT NULL, # derselbe Datentyp wie der primary key
	`hipCreated` TIMESTAMP NOT NULL DEFAULT now(),
	`hipUpdated` TIMESTAMP NOT NULL,
	`hipActive` BOOLEAN NOT NULL DEFAULT TRUE,
	PRIMARY KEY (`hipID`),
	INDEX (`fk_hostID`, `fk_ipID`),
	CONSTRAINT FOREIGN KEY (`fk_hostID`) REFERENCES `tHost` (`hostID`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY (`fk_ipID`) REFERENCES `tIP` (`ipID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;


DROP VIEW IF EXISTS vIPperHost;
CREATE VIEW vIPperHost
AS
	SELECT *
	FROM tHost AS h
	INNER JOIN lHost_IP AS mhi ON mhi.fk_hostID = h.hostID
	INNER JOIN tIP AS i ON mhi.fk_ipID = i.ipID
	WHERE mhi.hipActive = TRUE
	ORDER BY h.hostID;
	


DELIMITER //
DROP PROCEDURE IF EXISTS pPost//
CREATE PROCEDURE pPost(IN in_hostname VARCHAR(30), IN in_ip VARCHAR(16))
	BEGIN
		# make old records inactive
		UPDATE lHost_IP AS mhi
		INNER JOIN tHost AS h ON mhi.fk_hostID = h.hostID
		SET mhi.hipActive = FALSE
		WHERE h.hostName = in_hostname;
	
		# insert host and ip
		#INSERT IGNORE INTO tHost (hostName) values (in_hostname);
		#	SELECT @@IDENTITY AS 'aIDHost';
			
		#INSERT IGNORE INTO tIP (ipAddress) values (in_ip);
		#	SELECT @@IDENTITY AS 'aIDIP';
		
		# update timestamp, if the latest record is the same
		#UPDATE
		
		# insert values in lHost_IP
		INSERT INTO lHost_IP (fk_hostID, fk_ipID)
		#VALUES (aIDHost, aIDIP, TRUE);
			SELECT
				(SELECT tHost.hostID  FROM tHost WHERE tHost.hostName = in_hostname) AS host_id,
				(SELECT tIP.ipID FROM tIP WHERE tIP.ipAddress = in_ip) AS ip_id;
				
	END //
DELIMITER ;




SET FOREIGN_KEY_CHECKS=1;
