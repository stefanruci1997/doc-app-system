DROP TABLE IF EXISTS `user`;
CREATE TABLE user
(
    email    varchar(255) NOT NULL,
    usertype char(1) DEFAULT NULL,
    PRIMARY KEY (`email`)
);

-- Table for admin
DROP TABLE IF EXISTS `admin`;
CREATE TABLE admin
(
    email    varchar(255) NOT NULL,
    password varchar(255) DEFAULT NULL,
    PRIMARY KEY (email)
);

INSERT into user
values ('admin@doc-alb.com', 'a');
INSERT into admin
values ('admin@doc-alb.com', '$2y$10$hSRy3Zt/9YhM9Y0aRw2yi.t6.CLspTu9NSKauxkD4u1XmyX3EC5cq');



DROP TABLE IF EXISTS `doctor`;
CREATE TABLE doctor
(
    doc_id      INT PRIMARY KEY AUTO_INCREMENT,
    email       varchar(255),
    doclinic    varchar(15),
    password    VARCHAR(255),
    name        VARCHAR(50),
    surname     VARCHAR(50),
    country     varchar(255),
    city        varchar(255),
    address     VARCHAR(100),
    specialties VARCHAR(50),
    telephone   VARCHAR(15),
    department  VARCHAR(50)
);

DROP TABLE IF EXISTS patient;
CREATE TABLE patient
(
    `pid`      int ( 11 ) NOT NULL AUTO_INCREMENT,
    `name`     varchar(255) DEFAULT NULL,
    `surname`  varchar(255) DEFAULT NULL,
    `email`    varchar(255) DEFAULT NULL,
    `address`  varchar(255) DEFAULT NULL,
    `country`  varchar(255) DEFAULT NULL,
    `city`     varchar(255) DEFAULT NULL,
    `reg_date` date         DEFAULT NULL,
    `ptel`     varchar(15)  DEFAULT NULL,
    `password` varchar(255) DEFAULT NULL,
    PRIMARY KEY
        (
         `pid`
            )
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `specialties`;
CREATE TABLE specialties
(
    `id`    int (2) NOT NULL ,
    `sname` varchar(50) DEFAULT NULL,
    PRIMARY KEY
        (`id`)
);
INSERT INTO `specialties` (`id`, `sname`)
VALUES (1, 'Accident and emergency medicine'),
       (2, 'Allergology'),
       (3, 'Anaesthetics'),
       (4, 'Biological hematology'),
       (5, 'Cardiology'),
       (6, 'Child psychiatry'),
       (7, 'Clinical biology'),
       (8, 'Clinical chemistry'),
       (9, 'Clinical neurophysiology'),
       (10, 'Clinical radiology'),
       (11, 'Dental, oral and maxillo-facial surgery'),
       (12, 'Dermato-venerology'),
       (13, 'Dermatology'),
       (14, 'Endocrinology'),
       (15, 'Gastro-enterologic surgery'),
       (16, 'Gastroenterology'),
       (17, 'General hematology'),
       (18, 'General Practice'),
       (19, 'General surgery'),
       (20, 'Geriatrics'),
       (21, 'Immunology'),
       (22, 'Infectious diseases'),
       (23, 'Internal medicine'),
       (24, 'Laboratory medicine'),
       (25, 'Maxillo-facial surgery'),
       (26, 'Microbiology'),
       (27, 'Nephrology'),
       (28, 'Neuro-psychiatry'),
       (29, 'Neurology'),
       (30, 'Neurosurgery'),
       (31, 'Nuclear medicine'),
       (32, 'Obstetrics and gynecology'),
       (33, 'Occupational medicine'),
       (34, 'Ophthalmology'),
       (35, 'Orthopaedics'),
       (36, 'Otorhinolaryngology'),
       (37, 'Paediatric surgery'),
       (38, 'Paediatrics'),
       (39, 'Pathology'),
       (40, 'Pharmacology'),
       (41, 'Physical medicine and rehabilitation'),
       (42, 'Plastic surgery'),
       (43, 'Podiatric Medicine'),
       (44, 'Podiatric Surgery'),
       (45, 'Psychiatry'),
       (46, 'Public health and Preventive Medicine'),
       (47, 'Radiology'),
       (48, 'Radiotherapy'),
       (49, 'Respiratory medicine'),
       (50, 'Rheumatology'),
       (51, 'Stomatology'),
       (52, 'Thoracic surgery'),
       (53, 'Tropical medicine'),
       (54, 'Urology'),
       (55, 'Vascular surgery'),
       (56, 'Venereology');



DROP TABLE IF EXISTS session;
CREATE TABLE session
(
    `s_time` varchar(50) not null,
    PRIMARY KEY
        (`s_time`)
);

INSERT into session
values ('08:00');
INSERT into session
values ('08:30');
INSERT into session
values ('09:00');
INSERT into session
values ('09:30');
INSERT into session
values ('10:00');
INSERT into session
values ('10:30');
INSERT into session
values ('11:00');
INSERT into session
values ('11:30');
INSERT into session
values ('12:00');
INSERT into session
values ('12:30');
INSERT into session
values ('13:00');
INSERT into session
values ('13:30');
INSERT into session
values ('14:00');
INSERT into session
values ('14:30');
INSERT into session
values ('15:00');
INSERT into session
values ('15:30');
INSERT into session
values ('16:00');
INSERT into session
values ('16:30');
INSERT into session
values ('17:00');
INSERT into session
values ('17:30');
INSERT into session
values ('18:00');
INSERT into session
values ('18:30');

DROP TABLE IF EXISTS appointment;
-- Table for appointments
CREATE TABLE appointment
(
    app_id INT PRIMARY KEY AUTO_INCREMENT,
    doc_id INT,
    pid    INT,
    date   DATE,
    s_time varchar(50)
);

CREATE TABLE subscriber
(

    email varchar(50) PRIMARY KEY
);







