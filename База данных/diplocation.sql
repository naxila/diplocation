CREATE TABLE `countries` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `cities` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`country_id` INT(11) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `buildings` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`city_id` INT(11) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `points` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`device_id` varchar(255) NOT NULL UNIQUE,
	`title` varchar(255) NOT NULL,
	`building_id` INT(11) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `points_aliases` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`point_id` INT(11) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `vectors` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`start_point` INT(11) NOT NULL,
	`end_point` INT(11) NOT NULL,
	`distance` INT(11) NOT NULL,
	`direction` INT(11) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `admins` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`login` varchar(255) NOT NULL UNIQUE,
	`password` varchar(255) NOT NULL,
	`name` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`super_user` INT(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
);

CREATE TABLE `admins_buildings` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`admin_id` INT(11) NOT NULL,
	`building_id` INT(11) NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `cities` ADD CONSTRAINT `cities_fk0` FOREIGN KEY (`country_id`) REFERENCES `countries`(`id`);

ALTER TABLE `buildings` ADD CONSTRAINT `buildings_fk0` FOREIGN KEY (`city_id`) REFERENCES `cities`(`id`);

ALTER TABLE `points` ADD CONSTRAINT `points_fk0` FOREIGN KEY (`building_id`) REFERENCES `buildings`(`id`);

ALTER TABLE `points_aliases` ADD CONSTRAINT `points_aliases_fk0` FOREIGN KEY (`point_id`) REFERENCES `points`(`id`);

ALTER TABLE `vectors` ADD CONSTRAINT `vectors_fk0` FOREIGN KEY (`start_point`) REFERENCES `points`(`id`);

ALTER TABLE `vectors` ADD CONSTRAINT `vectors_fk1` FOREIGN KEY (`end_point`) REFERENCES `points`(`id`);

ALTER TABLE `admins_buildings` ADD CONSTRAINT `admins_buildings_fk0` FOREIGN KEY (`admin_id`) REFERENCES `admins`(`id`);

ALTER TABLE `admins_buildings` ADD CONSTRAINT `admins_buildings_fk1` FOREIGN KEY (`building_id`) REFERENCES `buildings`(`id`);

