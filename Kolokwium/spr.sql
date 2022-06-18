DROP TABLE IF EXISTS `rezerwacja`;
DROP TABLE IF EXISTS `czytelnik`;
DROP TABLE IF EXISTS `egzemplarz`;
DROP TABLE IF EXISTS `dzielo`;

CREATE TABLE `dzielo` (
  `idd`          int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tytul`        varchar(100) NOT NULL,
  `autor`        varchar(100),
  `kategoria`    varchar(30),
  `rokpowstania` int(4),
  PRIMARY KEY (`idd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `dzielo` VALUES
  ( 1, 'Feynmana wykłady z fizyki - Mechanika kwantowa', 'Feynman, Richard',                'fizyka kwantowa',            1964),
  ( 2, 'Pan raczy żartować, panie Feynman!',             'Feynman, Richard',                'non-fiction',                1985),
  ( 3, 'Jadąc do Babadag',                               'Stasiuk, Andrzej',                'non-fiction',                2004),
  ( 4, 'Ojciec Goriot',                                  'Balzac, Honore de',               'powieść',                    1835),
  ( 5, 'Wszelki wypadek',                                'Szymborska, Wisława',             'poezja',                     1972),
  ( 6, 'Mechanika kwantowa',                             'Shankar, Ramamurti',              'fizyka kwantowa',            1980),
  ( 7, 'Wstęp do fizyki ciała stałego',                  'Kittel, Charles',                 'fizyka fazy skondensowanej', 1953),
  ( 8, 'Mechanika kwantowa. Teoria nierelatywistyczna',  'Landau, Lew; Lifszyc, Jewgienij', 'fizyka kwantowa',            1948),
  ( 9, 'Eseje',                                          'Camus, Albert',                   'publicystyka',               1971),
  (10, 'Lód',                                            'Dukaj, Jacek',                    'powieść',                    2007);

CREATE TABLE `egzemplarz` (
  `ide`         int(10) unsigned NOT NULL AUTO_INCREMENT,
  `d_id`        int(10) unsigned,
  `wydawnictwo` varchar(50),
  `rokwydania`  int(4),
  PRIMARY KEY (`ide`),
  KEY `d_ind` (`d_id`),
  CONSTRAINT `fk_egzemplarz_dzielo` FOREIGN KEY (`d_id`) REFERENCES `dzielo` (`idd`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `egzemplarz` VALUES
  ( 1,  5, 'Czytelnik',         1975),
  ( 2,  6, 'PWN',               2007),
  ( 3,  3, 'Czarne',            2016),
  ( 4,  2, 'Znak',              2009),
  ( 5,  3, 'Czarne',            2016),
  ( 6,  1, 'PWN',               1972),
  ( 7,  4, 'Czytelnik',         1987),
  ( 8, 10, 'Literackie',        2007),
  ( 9,  8, 'PWN',               1979),
  (10,  1, 'PWN',               2012),
  (11,  7, 'PWN',               1970),
  (12,  8, 'PWN',               2011),
  (13,  5, 'Czytelnik',         1972),
  (14,  1, 'PWN',               2014),
  (15,  4, 'Czytelnik',         1976),
  (16,  7, 'PWN',               1976),
  (17,  4, 'Prószyński i S-ka', 1980),
  (18,  1, 'PWN',               2012),
  (19,  7, 'PWN',               2011),
  (20,  8, 'PWN',               2011);

CREATE TABLE `czytelnik` (
  `idc`      int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imie`     varchar(30) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `adres`    varchar(200) NOT NULL,
  `telefon`  varchar(20),
  `email`    varchar(30),
  PRIMARY KEY (`idc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `czytelnik` VALUES
  ( 1, 'Anna',       'Babacka', 'ul. Dworcowa 19, Wrocław',       '974771592', 'ababacka@gmail.com'),
  ( 2, 'Robert',     'Cabacki', 'ul. Parkowa 3/9, Wrocław',       '470686949', 'rcabacki@interia.pl'),
  ( 3, 'Katarzyna',  'Dabacka', 'ul. Bazarowa 41/5, Wołów',       '229119993', 'kdabacka@protonmail.com'),
  ( 4, 'Jan',        'Fabacki', 'ul. Pożarowa 1, Wrocław',        '533539150', 'jfabacki@op.pl'),
  ( 5, 'Karolina',   'Gabacka', 'ul. Bielikowa 103/8, Wrocław',   '980335797', 'kgabacka@interia.pl'),
  ( 6, 'Mirosław',   'Babacki', 'ul. Brukowa 8/5, Milicz',        '501061565', 'mbabacki@gmail.com'),
  ( 7, 'Agnieszka',  'Cabacka', 'pl. Zamkowy 10/5, Wrocław',      '364300461', 'acabacka@interia.pl'),
  ( 8, 'Mateusz',    'Dabacki', 'ul. Kleszczowa 145/6, Wrocław',  '218317640', 'mdabacki@gmail.com'),
  ( 9, 'Paulina',    'Fabacka', 'ul. Tarasowa 84/4, Wrocław',     '798686843', 'pfabacka@op.pl'),
  (10, 'Andrzej',    'Gabacki', 'ul. Dachowa 143/11, Wrocław',    '538481323', 'agabacki@yahoo.com'),
  (11, 'Magdalena',  'Babacka', 'ul. Lipowa 15, Wrocław',         '113114325', 'mbabacka@yahoo.com'),
  (12, 'Sławomir',   'Cabacki', 'ul. Kokosowa 60, Oleśnica',      '938387141', 'dcabacki@op.pl'),
  (13, 'Agnieszka',  'Dabacka', 'ul. Arbuzowa 106/10, Wrocław',   '166286630', 'adabacka@gmail.com'),
  (14, 'Michał',     'Fabacki', 'os. Kolejowe 120/9, Wrocław',    '142394838', 'mfabacki@gmail.com'),
  (15, 'Aleksandra', 'Gabacka', 'ul. Ananasowa 42/10, Trzebnica', '196346114', 'agabacka@gmail.com'),
  (16, 'Aleksander', 'Babacki', 'pl. Targowy 13/8, Oleśnica',     '347802399', 'ababacki@gmail.com'),
  (17, 'Beata',      'Cabacka', 'ul. Jeżowa 20/2, Środa Śląska',  '652592759', 'bcabacka@gmail.com'),
  (18, 'Andrzej',    'Dabacki', 'ul. Kasztanowa 9, Wrocław',      '581233746', 'adabacki@yahoo.com'),
  (19, 'Katarzyna',  'Fabacka', 'ul. Czerpakowa 121/11, Wrocław', '862761563', 'kfabacka@op.pl'),
  (20, 'Jerzy',      'Gabacki', 'ul. Słodowa 92/9, Oława',        '670106605', 'jgabacki@gmail.com');

CREATE TABLE `rezerwacja` (
  `idr`       int(10) unsigned NOT NULL AUTO_INCREMENT,
  `c_id`      int(10) unsigned,
  `e_id`      int(10) unsigned,
  `datazamow` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datawypoz` timestamp NULL,
  `datazwrot` timestamp NULL,
  PRIMARY KEY (`idr`),
  KEY `c_ind` (`c_id`),
  KEY `e_ind` (`e_id`),
  CONSTRAINT `fk_rezerwacja_czytelnik`  FOREIGN KEY (`c_id`) REFERENCES `czytelnik`  (`idc`) ON UPDATE CASCADE,
  CONSTRAINT `fk_rezerwacja_egzemplarz` FOREIGN KEY (`e_id`) REFERENCES `egzemplarz` (`ide`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `rezerwacja` (`c_id`, `e_id`, `datazamow`, `datawypoz`, `datazwrot`) VALUES
  ( 3,  8, '2018-03-20 12:15:20', '2018-03-20 12:15:20', NULL),
  (10, 14, '2018-03-12 10:24:35', '2018-03-12 10:24:35', NULL),
  (17, 16, '2018-02-28 15:27:42', '2018-02-28 15:27:42', NULL),
  (20,  3, '2018-04-04 14:47:21', '2018-04-04 14:47:21', NULL),
  ( 9,  1, '2018-03-15 09:03:43', '2018-03-15 09:03:43', NULL),
  (18,  5, '2018-03-14 16:03:25', '2018-03-15 15:49:22', NULL),
  ( 5, 11, '2018-03-21 12:52:33', '2018-03-21 12:52:33', NULL),
  ( 3,  6, '2018-03-20 12:15:52', '2018-03-20 12:15:52', NULL),
  (10,  2, '2018-03-12 10:24:35', '2018-03-16 10:24:35', NULL),
  (17, 15, '2018-02-28 15:27:42', '2018-02-28 15:27:42', NULL),
  ( 3, 13, '2018-03-06 13:53:20', '2018-03-09 14:22:51', NULL),
  ( 1,  8, '2018-04-06 16:03:01', NULL, NULL),
  (12, 13, '2018-03-29 10:28:37', NULL, NULL),
  ( 6,  8, '2018-02-01 15:44:12', '2018-02-01 15:44:12', '2018-03-12 09:23:30'),
  ( 7, 11, '2018-03-01 12:43:16', '2018-03-01 12:43:16', '2018-03-02 08:02:11'),
  ( 2, 17, '2018-02-14 15:35:23', '2018-02-14 15:35:23', '2018-03-08 14:02:11'),
  (19, 19, '2018-02-12 14:32:13', '2018-02-12 14:32:13', '2018-03-27 09:22:53'),
  ( 4,  7, '2018-04-05 17:43:42', '2018-04-05 17:43:42', '2018-04-06 12:32:54'),
  (15,  2, '2018-03-05 13:27:29', '2018-03-05 13:27:29', '2018-03-15 08:58:36'),
  (14,  9, '2018-03-19 09:52:57', '2018-03-20 10:05:36', '2018-04-05 15:54:18'),
  (11, 10, '2018-02-28 10:50:29', '2018-02-28 10:50:29', '2018-03-19 16:25:36'),
  (16, 20, '2018-03-01 11:28:15', '2018-03-01 11:28:15', '2018-04-06 16:25:36'),
  (13, 12, '2018-03-16 15:58:30', '2018-03-16 15:58:30', '2018-03-19 09:35:22'),
  ( 3, 18, '2018-03-01 14:33:46', '2018-03-01 14:33:46', '2018-03-08 15:51:08');
