CREATE TABLE `surat_db`.`letter_new` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`letter_type_id` INT NOT NULL ,
`no_surat` VARCHAR( 50 ) NOT NULL ,
`date_surat` DATE NOT NULL ,
`desc` LONGTEXT NOT NULL
) ENGINE = MYISAM ;