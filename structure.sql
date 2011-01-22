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
	`hipCreated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`hipUpdated` TIMESTAMP NOT NULL,
	`hipActive` BOOLEAN NOT NULL DEFAULT TRUE,
	PRIMARY KEY (`hipID`),
	INDEX (`fk_hostID`, `fk_ipID`),
	CONSTRAINT FOREIGN KEY (`fk_hostID`) REFERENCES `tHost` (`hostID`) ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY (`fk_ipID`) REFERENCES `tIP` (`ipID`) ON DELETE CASCADE
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
		# insert host and ip
		INSERT IGNORE INTO tHost (hostName) VALUES (in_hostname);
		# get id of host
		SET @id_of_host = (SELECT hostID FROM tHost WHERE hostName = in_hostname); #SET @id_of_host = LAST_INSERT_ID(); <-- didn't work with existing record
	
		INSERT IGNORE INTO tIP (ipAddress) VALUES (in_ip);
		# get id of ip
		SET @id_of_ip = (SELECT ipID FROM tIP WHERE ipAddress = in_ip); #SET @id_of_host = LAST_INSERT_ID(); <-- didn't work with existing record
	
		
          SET @justUpdate = (
                       SELECT COUNT(*) FROM lHost_IP AS mhi
              		WHERE mhi.fk_hostID = @id_of_host
              		AND mhi.fk_ipID = @id_of_ip
              		AND mhi.hipActive = TRUE
        	);
		

          IF @justUpdate = 1 THEN
        
      		# update timestamp, if the latest record is the same
        		UPDATE lHost_IP AS mhi
        		SET mhi.hipUpdated = now()
      		WHERE mhi.fk_hostID = @id_of_host
          		AND mhi.fk_ipID = @id_of_ip
          		AND mhi.hipActive = TRUE;
          		
          ELSE
              
              # make old records inactive
      		UPDATE lHost_IP AS mhi
      		SET mhi.hipActive = FALSE
      		WHERE fk_hostID = @id_of_host;
          
      		# insert values in lHost_IP
      		INSERT INTO lHost_IP (fk_hostID, fk_ipID, hipActive, hipUpdated)
      		VALUES (@id_of_host, @id_of_ip, TRUE, now());
          
          END IF;				

				
	END //
DELIMITER ;




SET FOREIGN_KEY_CHECKS=1;