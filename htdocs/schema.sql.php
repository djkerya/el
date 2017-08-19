<?php

CREATE TABLE IF NOT EXISTS `part_types` (
    `id` INT(8) NOT NULL AUTO_INCREMENT,
    `part_type` VARCHAR(32),
    PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS  `part_locations` (
    `id` INT(8) NOT NULL AUTO_INCREMENT,
    `location_name` VARCHAR(32),
    PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS  `boards` (
    `id` INT(16) NOT NULL AUTO_INCREMENT,
    `board_name` VARCHAR(32),
    `board_marks` VARCHAR(128),
    `board_pic1` LONGBLOB,
    `board_pic2` LONGBLOB,
    `board_location` VARCHAR(224),
    PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS `parts` (
    `id` INT(128) NOT NULL AUTO_INCREMENT,
    `type_id` INT(8) NOT NULL,
    `part_mark` VARCHAR(32) NOT NULL,
    `part_case` VARCHAR(32) NOT NULL,
    `datasheet_link` VARCHAR(256),
    `part_location` INT(16) NOT NULL,
    `on_board` TINYINT(1) NOT NULL,
    `which_board` int(32),
    PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS `part_cases` (
    `id` INT(128) NOT NULL AUTO_INCREMENT,
    `case_name` VARCHAR(32) NOT NULL,
    `case_desctiption` VARCHAR(128) NOT NULL,
    `case_desc_link` VARCHAR(128) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

?>
