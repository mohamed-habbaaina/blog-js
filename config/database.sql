CREATE DATABASE `blog_js`;

USE `blog_js`;

CREATE TABLE `categories` (
    `id` INT(10) UNSIGNED AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
    `id` INT(10) UNSIGNED AUTO_INCREMENT NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `register_date` DATETIME NOT NULL,
    `role` VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `articles` (
    `id` INT(10) UNSIGNED AUTO_INCREMENT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `content` TEXT NOT NULL,
    `creation_date` DATETIME NOT NULL,
    `edit_date` DATETIME DEFAULT NULL,
    `user_id` INT(10) UNSIGNED,
    `category_id` INT(10) UNSIGNED NOT NULL,
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_articles_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
    CONSTRAINT `fk_articles_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `comments` (
    `id` INT(10) UNSIGNED AUTO_INCREMENT NOT NULL,
    `content` TEXT DEFAULT NULL,
    `creation_date` DATETIME NOT NULL,
    `edit_date` DATETIME DEFAULT NULL,
    `user_id` INT(10) UNSIGNED,
    `article_id` INT(10) UNSIGNED,
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
    CONSTRAINT `fk_comments_articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
