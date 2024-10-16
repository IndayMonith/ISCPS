CREATE TABLE IF NOT EXISTS `sensors` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `sensor_name` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `slots` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `sensor_id` INT,
    `name` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`sensor_id`) REFERENCES `sensors`(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `logs` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `slot_id` INT,
    `time_in` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `time_out` DATETIME,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`slot_id`) REFERENCES `slots`(`id`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);
