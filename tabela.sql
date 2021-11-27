CREATE TABLE `podstrony`
(
    `id` INT AUTO_INCREMENT,
    `url` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `style` TEXT, 
    `main` TEXT,
    `aside` TEXT,
    PRIMARY KEY (`id`),
    UNIQUE KEY (`url`(128))
)
COLLATE 'utf8_general_ci';