USE fifthch_snitch;

INSERT INTO user (username, password, email)
VALUES
	('marco', MD5('1234'), 'marco@5th.ch'),
	('sepp', MD5('seppspassword'), 'marcocuoco@bluewin.ch'),
	('arvet', MD5('foxa'), 'marcocuoco@bluewin.ch');
