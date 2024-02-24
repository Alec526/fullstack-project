-- MySQL Script generated by MySQL Workbench
-- Sat Feb 24 20:33:42 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema casus_cafe
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `casus_cafe` ;

-- -----------------------------------------------------
-- Schema casus_cafe
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `casus_cafe` DEFAULT CHARACTER SET utf8 ;
USE `casus_cafe` ;

-- -----------------------------------------------------
-- Table `casus_cafe`.`band`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `casus_cafe`.`band` ;

CREATE TABLE IF NOT EXISTS `casus_cafe`.`band` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(16) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));


-- -----------------------------------------------------
-- Table `casus_cafe`.`genres`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `casus_cafe`.`genres` ;

CREATE TABLE IF NOT EXISTS `casus_cafe`.`genres` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idgenre_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `casus_cafe`.`band_has_genres`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `casus_cafe`.`band_has_genres` ;

CREATE TABLE IF NOT EXISTS `casus_cafe`.`band_has_genres` (
  `band_id` VARCHAR(32) NOT NULL,
  `genres_id` INT NOT NULL,
  PRIMARY KEY (`band_id`, `genres_id`),
  INDEX `fk_band_has_genres_genres1_idx` (`genres_id` ASC),
  INDEX `fk_band_has_genres_band_idx` (`band_id` ASC),
  CONSTRAINT `fk_band_has_genres_band`
    FOREIGN KEY (`band_id`)
    REFERENCES `casus_cafe`.`band` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_band_has_genres_genres1`
    FOREIGN KEY (`genres_id`)
    REFERENCES `casus_cafe`.`genres` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `casus_cafe`.`evenementen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `casus_cafe`.`evenementen` ;

CREATE TABLE IF NOT EXISTS `casus_cafe`.`evenementen` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NOT NULL,
  `datum` TIMESTAMP NOT NULL,
  `prijs` DECIMAL(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));


-- -----------------------------------------------------
-- Table `casus_cafe`.`evenementen_has_band`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `casus_cafe`.`evenementen_has_band` ;

CREATE TABLE IF NOT EXISTS `casus_cafe`.`evenementen_has_band` (
  `evenementen_id` INT NOT NULL,
  `band_id` INT NOT NULL,
  PRIMARY KEY (`evenementen_id`, `band_id`),
  INDEX `fk_evenementen_has_band_band1_idx` (`band_id` ASC),
  INDEX `fk_evenementen_has_band_evenementen1_idx` (`evenementen_id` ASC),
  CONSTRAINT `fk_evenementen_has_band_evenementen1`
    FOREIGN KEY (`evenementen_id`)
    REFERENCES `casus_cafe`.`evenementen` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_evenementen_has_band_band1`
    FOREIGN KEY (`band_id`)
    REFERENCES `casus_cafe`.`band` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
