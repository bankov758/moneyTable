-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE =
        'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema money_table
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema money_table
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `money_table` DEFAULT CHARACTER SET utf8;
USE `money_table`;

-- -----------------------------------------------------
-- Table `money_table`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `money_table`.`users`
(
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `email`      VARCHAR(255) NOT NULL,
    `full_name`  VARCHAR(45)  NOT NULL,
    `is_active`  TINYINT      NOT NULL DEFAULT 0,
    `created_at` DATETIME     NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email_UNIQUE` (`email` ASC)
);


-- -----------------------------------------------------
-- Table `money_table`.`invoices`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `money_table`.`invoices`
(
    `id`      INT UNSIGNED   NOT NULL AUTO_INCREMENT,
    `amount`  DECIMAL(10, 4) NULL,
    `user_id` INT UNSIGNED   NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_invoices_users_idx` (`user_id` ASC),
    CONSTRAINT `fk_invoices_users`
        FOREIGN KEY (`user_id`)
            REFERENCES `money_table`.`users` (`id`)
);


SET SQL_MODE = @OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;
