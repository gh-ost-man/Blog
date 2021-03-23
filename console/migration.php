<?php
    require_once 'pdo_ini.php';

    $sql = <<<'SQL'
        CREATE TABLE IF NOT EXISTS `users`(
            `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `email` VARCHAR(255) NOT NULL,
            `nick` VARCHAR(255),
            `password` VARCHAR(255) NOT NULL,
            `url_avatar` VARCHAR(255),
            `role` VARCHAR(255),
            `confirm` TINYINT;
        );
    SQL;
    
    try {
        $pdo->exec($sql);
        echo "success created table users";
        echo PHP_EOL;
    } catch(PDOException $e) {
        die("Error " . $e->getMessage());
    }

    $sql = <<<'SQL'
        CREATE TABLE IF NOT EXISTS `records`(
            `id` INT(25) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `id_autor` INT(25) UNSIGNED NOT NULL,
            `date` DATETIME,
            `status` TINYINT,
            `text` VARCHAR(255),
            `like` INT,
            `dis_like` INT,
            FOREIGN KEY (`id_autor`) REFERENCES `users`(`id`)  ON DELETE CASCADE 
        );
    SQL;

    try {
        $pdo->exec($sql);
        echo "success created table records";
        echo PHP_EOL;
    } catch(PDOException $e) {
        die("Error " . $e->getMessage());
    }

    $sql = <<<'SQL'
        CREATE TABLE IF NOT EXISTS `comments`(
            `id_autor` INT(25) UNSIGNED NOT NULL,
            `id_record` INT(25) UNSIGNED NOT NULL,
            `date` DATETIME,
            `status` TINYINT,
            `text` VARCHAR(255),
            `like` INT,
            `dis_like` INT,
            FOREIGN KEY (`id_autor`) REFERENCES `users`(`id`)  ON DELETE CASCADE,
            FOREIGN KEY (`id_record`) REFERENCES `records`(`id`)  ON DELETE CASCADE 
        );
    SQL;

    try {
        $pdo->exec($sql);
        echo "success created table comments";
        echo PHP_EOL;
    } catch(PDOException $e) {
        die("Error " . $e->getMessage());
    }