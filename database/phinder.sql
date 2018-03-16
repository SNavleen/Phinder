DROP TABLE `phinder`.`ItemReview`;
DROP TABLE `phinder`.`Users`;
DROP TABLE `phinder`.`Items`;

CREATE TABLE IF NOT EXISTS `phinder`.`Users` (
  `userId` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `salt` VARCHAR(255) NOT NULL,
  `pswd` VARCHAR(255) NOT NULL,
  `dob` DATE NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`userId`),
  UNIQUE INDEX `userId_UNIQUE` (`userId` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `phinder`.`Items` (
  `itemId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `details` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`itemId`),
  UNIQUE INDEX `itemId_UNIQUE` (`itemId` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `phinder`.`ItemReview` (
  `reviewId` INT NOT NULL AUTO_INCREMENT,
  `itemId` INT NOT NULL,
  `userId` INT NULL,
  `rating` DOUBLE NOT NULL,
  `review` TEXT NULL,
  PRIMARY KEY (`reviewId`),
  UNIQUE INDEX `reviewId_UNIQUE` (`reviewId` ASC),
  INDEX `userId_idx` (`userId` ASC),
  INDEX `itemId_idx` (`itemId` ASC),
  CONSTRAINT `userId`
    FOREIGN KEY (`userId`)
    REFERENCES `phinder`.`Users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `itemId`
    FOREIGN KEY (`itemId`)
    REFERENCES `phinder`.`Items` (`itemId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
