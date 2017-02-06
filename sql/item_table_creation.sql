CREATE TABLE `bisonswap`.`items` (
  `ItemID` INT NOT NULL AUTO_INCREMENT,
  `idusers` INT NOT NULL,
  `itemName` VARCHAR(255) NOT NULL,
  `itemCategory` VARCHAR(45) NOT NULL,
  `itemDescription` VARCHAR(4000) NOT NULL,
  `date_posted` DATETIME NOT NULL,
  `picture1` VARCHAR(255) NOT NULL,
  `picture2` VARCHAR(255) NULL,
  `picture3` VARCHAR(255) NULL,
  `picture4` VARCHAR(255) NULL,
  `picture5` VARCHAR(255) NULL,
  `itemRating` INT NOT NULL,
  PRIMARY KEY (`ItemID`));

