SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS `zf2`.`options` (
  `idoption` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `color` VARCHAR(45) NOT NULL,
  `hashtag` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idoption`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `zf2`.`elements` (
  `idelement` INT(11) NOT NULL AUTO_INCREMENT,
  `element` TEXT NOT NULL,
  `options_idoption` INT(11) NOT NULL,
  INDEX `fk_elements_options_idx` (`options_idoption` ASC),
  PRIMARY KEY (`idelement`),
  CONSTRAINT `fk_elements_options`
    FOREIGN KEY (`options_idoption`)
    REFERENCES `zf2`.`options` (`idoption`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `zf2`.`texts` (
  `idtext` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `file` VARCHAR(255) NOT NULL,
  `content` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`idtext`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `zf2`.`elements_has_texts` (
  `elements_idelement` INT(11) NOT NULL,
  `texts_idtext` INT(11) NOT NULL,
  PRIMARY KEY (`elements_idelement`, `texts_idtext`),
  INDEX `fk_elements_has_texts_texts1_idx` (`texts_idtext` ASC),
  INDEX `fk_elements_has_texts_elements1_idx` (`elements_idelement` ASC),
  CONSTRAINT `fk_elements_has_texts_elements1`
    FOREIGN KEY (`elements_idelement`)
    REFERENCES `zf2`.`elements` (`idelement`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_elements_has_texts_texts1`
    FOREIGN KEY (`texts_idtext`)
    REFERENCES `zf2`.`texts` (`idtext`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;




SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
