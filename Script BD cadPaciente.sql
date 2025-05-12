-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema cadPaciente
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cadPaciente
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cadPaciente` DEFAULT CHARACTER SET utf8 ;
USE `cadPaciente` ;

-- -----------------------------------------------------
-- Table `cadPaciente`.`cpaPaciente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cadPaciente`.`cpaPaciente` (
  `IdPaciente` INT NOT NULL,
  `nmPaciente` VARCHAR(150) NOT NULL,
  `dtnascPaciente` VARCHAR(8) NOT NULL,
  `sxPaciente` VARCHAR(1) NOT NULL,
  `jdPaciente` VARCHAR(1) NOT NULL,
  `udPaciente` VARCHAR(8) NOT NULL,
  `tsPaciente` VARCHAR(3) NOT NULL,
  PRIMARY KEY (`IdPaciente`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
