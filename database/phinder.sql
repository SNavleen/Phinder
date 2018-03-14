CREATE TABLE IF NOT EXISTS `mydb`.`Users` (
  `userId` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `pswd` VARCHAR(255) NOT NULL,
  `dob` DATE NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`userId`),
  UNIQUE INDEX `userId_UNIQUE` (`userId` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`Items` (
  `itemId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `imageCount` INT NOT NULL,
  PRIMARY KEY (`itemId`),
  UNIQUE INDEX `itemId_UNIQUE` (`itemId` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`ItemReview` (
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
    REFERENCES `mydb`.`Users` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `itemId`
    FOREIGN KEY (`itemId`)
    REFERENCES `mydb`.`Items` (`itemId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
