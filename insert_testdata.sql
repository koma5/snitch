USE fifthch_snitch;

INSERT INTO user (username, password, email)
VALUES
	('marco', MD5('1234'), 'marco@5th.ch'),
	('sepp', MD5('seppspassword'), 'marcocuoco@bluewin.ch'),
	('arvet', MD5('foxa'), 'marcocuoco@bluewin.ch');

INSERT INTO host (hostname)
VALUES
	('themac.local'),
	('buechli.local'),
	('thin4.local'),
	('iphoenix.local'),
	('probo.local'),
	('gandalf.local'),
	('blackbox');

INSERT INTO ip (address)
VALUES
	('85.5.131.246'),
	('193.46.247.176'),
	('193.12.145.227'),
	('66.249.68.225'),
	('127.0.0.1'),
	('172.16.0.41');

INSERT INTO mtm_host_ip (fk_host, fk_ip, updated)
VALUES
	(1,1, '2011-01-05 12:00:00'),
	(2,6, '2011-01-01 12:00:00'),
	(3,2, '2010-12-24 12:00:00'),
	(4,3, '1992-06-11 08:00:00'),
	(5,4, '2011-01-08 23:59:59'),
	(6,1, now()),
	(7,5, '2010-12-01 12:00:00');
