CREATE SCHEMA IF NOT EXISTS `sapp` DEFAULT CHARACTER SET utf8 ;
USE `sapp` ;

CREATE TABLE IF NOT EXISTS `sapp`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `sapp`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `role_id` INT NOT NULL,
  `is_active` TINYINT NULL,
  `email` VARCHAR(45) NULL,
  `name` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `cpf` VARCHAR(45) NULL,
  `cnpj` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_users_role`
    FOREIGN KEY (`role_id`)
    REFERENCES `sapp`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `sapp`.`service_status` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `sapp`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `sapp`.`services` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '	',
  `user_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  `status_id` INT NOT NULL,
  `title` VARCHAR(45) NULL,
  `description` TEXT NULL,
  `min_date` DATETIME NULL,
  `max_date` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_services_status1`
    FOREIGN KEY (`status_id`)
    REFERENCES `sapp`.`service_status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_services_categories1`
    FOREIGN KEY (`category_id`)
    REFERENCES `sapp`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_services_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `sapp`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `sapp`.`states` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `abbreviation` VARCHAR(5) NULL,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `sapp`.`cities` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `state_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_city_state1`
    FOREIGN KEY (`state_id`)
    REFERENCES `sapp`.`states` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `sapp`.`evaluations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `author_id` INT NOT NULL,
  `subject_id` INT NOT NULL,
  `service_id` INT NOT NULL,
  `rating` VARCHAR(45) NULL,
  `comment` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_evaluations_users1`
    FOREIGN KEY (`author_id`)
    REFERENCES `sapp`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_evaluations_users2`
    FOREIGN KEY (`subject_id`)
    REFERENCES `sapp`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_evaluations_services1`
    FOREIGN KEY (`service_id`)
    REFERENCES `sapp`.`services` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `sapp`.`addresses` (
  `id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `city_id` INT NOT NULL,
  `house_number` INT NULL,
  `street` VARCHAR(45) NULL,
  `postal_code` VARCHAR(45) NULL,
  `district` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_addresses_cities1`
    FOREIGN KEY (`city_id`)
    REFERENCES `sapp`.`cities` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_addresses_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `sapp`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `sapp`.`messages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `service_id` INT NOT NULL,
  `text` TEXT NULL,
  `date` DATETIME NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_messages_services1`
    FOREIGN KEY (`service_id`)
    REFERENCES `sapp`.`services` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `sapp`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE IF NOT EXISTS `sapp`.`user_cities` (
  `city_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`city_id`, `user_id`),
  CONSTRAINT `fk_cities_has_users_cities1`
    FOREIGN KEY (`city_id`)
    REFERENCES `sapp`.`cities` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cities_has_users_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `sapp`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
