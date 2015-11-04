<?php

use yii\db\Schema;
use yii\db\Migration;

class m151026_142937_initial_tables extends Migration
{
    public function up()
    {
        $this->execute("
            SET NAMES utf8;
            SET time_zone = '+00:00';
            SET foreign_key_checks = 0;
            SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

            DROP TABLE IF EXISTS `blog_category`;
            CREATE TABLE `blog_category` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `identifier` varchar(255) NOT NULL,
              `created_by` int(11) NOT NULL,
              `updated_by` int(11) NOT NULL,
              `created_at` int(10) unsigned NOT NULL,
              `updated_at` int(10) unsigned NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `identifier` (`identifier`),
              FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
              FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
            );

            DROP TABLE IF EXISTS `blog_category_lang`;
            CREATE TABLE `blog_category_lang` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `blog_category_id` int(11) NOT NULL,
              `language` varchar(6) NOT NULL,
              `name` varchar(255) NOT NULL,
              `slug` varchar(255) NOT NULL,
              `description` text NULL,
              `meta_description` varchar(255) NULL,
              `created_by` int(11) NOT NULL,
              `updated_by` int(11) NOT NULL,
              `created_at` int(10) NOT NULL,
              `updated_at` int(10) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `blog_category_id` (`blog_category_id`),
              KEY `created_by` (`created_by`),
              KEY `updated_by` (`updated_by`),
              CONSTRAINT `blog_category_lang_ibfk_1` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `blog_category_lang_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
              CONSTRAINT `blog_category_lang_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
            );

            DROP TABLE IF EXISTS `blog_post`;
            CREATE TABLE `blog_post` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `blog_category_id` int(11) NULL,
              `is_published` tinyint(1) NOT NULL DEFAULT '1',
              `featured_image` varchar(255) NULL,
              `created_by` int(11) NOT NULL,
              `updated_by` int(11) NOT NULL,
              `created_at` int(10) NOT NULL,
              `updated_at` int(10) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `blog_category_id` (`blog_category_id`),
              KEY `created_by` (`created_by`),
              KEY `updated_by` (`updated_by`),
              CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_category` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
              CONSTRAINT `blog_post_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
              CONSTRAINT `blog_post_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


            DROP TABLE IF EXISTS `blog_post_lang`;
            CREATE TABLE `blog_post_lang` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `blog_post_id` int(11) NOT NULL,
              `language` varchar(6) NOT NULL,
              `title` varchar(255) NOT NULL,
              `slug` varchar(255) NOT NULL,
              `meta_description` varchar(255) NOT NULL,
              `text` text NOT NULL,
              `created_by` int(11) NOT NULL,
              `updated_by` int(11) NOT NULL,
              `created_at` int(10) unsigned NOT NULL,
              `updated_at` int(10) unsigned NOT NULL,
              PRIMARY KEY (`id`),
              KEY `blog_post_id` (`blog_post_id`),
              KEY `created_by` (`created_by`),
              KEY `updated_by` (`updated_by`),
              CONSTRAINT `blog_post_lang_ibfk_1` FOREIGN KEY (`blog_post_id`) REFERENCES `blog_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `blog_post_lang_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
              CONSTRAINT `blog_post_lang_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            DROP TABLE IF EXISTS `content`;
            CREATE TABLE `content` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `flat_page_id` int(11) NOT NULL,
              `name` varchar(255) NOT NULL,
              `created_by` int(11) NOT NULL,
              `updated_by` int(11) NOT NULL,
              `created_at` int(10) unsigned NOT NULL,
              `updated_at` int(10) unsigned NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `name_flat_page_id` (`name`, `flat_page_id`),
              KEY `created_by` (`created_by`),
              KEY `updated_by` (`updated_by`),
              KEY `flat_page_id` (`flat_page_id`),
              CONSTRAINT `content_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
              CONSTRAINT `content_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
              CONSTRAINT `content_ibfk_3` FOREIGN KEY (`flat_page_id`) REFERENCES `flat_page` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


            DROP TABLE IF EXISTS `content_lang`;
            CREATE TABLE `content_lang` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `content_id` int(11) NOT NULL,
              `language` varchar(6) NOT NULL,
              `text` text NOT NULL,
              `created_by` int(11) NOT NULL,
              `updated_by` int(11) NOT NULL,
              `created_at` int(10) unsigned NOT NULL,
              `updated_at` int(10) unsigned NOT NULL,
              PRIMARY KEY (`id`),
              KEY `content_id` (`content_id`),
              KEY `created_by` (`created_by`),
              KEY `updated_by` (`updated_by`),
              CONSTRAINT `content_lang_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`),
              CONSTRAINT `content_lang_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
              CONSTRAINT `content_lang_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


            DROP TABLE IF EXISTS `flat_page`;
            CREATE TABLE `flat_page` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `url` varchar(255) NOT NULL,
              `created_by` int(11) NOT NULL,
              `updated_by` int(11) NOT NULL,
              `created_at` int(10) unsigned NOT NULL,
              `updated_at` int(10) unsigned NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `url` (`url`),
              KEY `created_by` (`created_by`),
              KEY `updated_by` (`updated_by`),
              CONSTRAINT `flat_page_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
              CONSTRAINT `flat_page_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


            DROP TABLE IF EXISTS `flat_page_lang`;
            CREATE TABLE `flat_page_lang` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `flat_page_id` int(11) NOT NULL,
              `language` varchar(6) NOT NULL,
              `title` varchar(255) NOT NULL,
              `slug` varchar(255) NOT NULL,
              `meta_description` varchar(255) NOT NULL,
              `anchor` varchar(255) NOT NULL,
              `created_by` int(11) NOT NULL,
              `updated_by` int(11) NOT NULL,
              `created_at` int(10) unsigned NOT NULL,
              `updated_at` int(10) unsigned NOT NULL,
              PRIMARY KEY (`id`),
              KEY `created_by` (`created_by`),
              KEY `updated_by` (`updated_by`),
              KEY `flat_page_id` (`flat_page_id`),
              CONSTRAINT `flat_page_lang_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
              CONSTRAINT `flat_page_lang_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
              CONSTRAINT `flat_page_lang_ibfk_4` FOREIGN KEY (`flat_page_id`) REFERENCES `flat_page` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


            DROP TABLE IF EXISTS `gallery`;
            CREATE TABLE `gallery` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `slug` varchar(255) NOT NULL,
              `created_by` int(11) NOT NULL,
              `updated_by` int(11) NOT NULL,
              `created_at` int(10) unsigned NOT NULL,
              `updated_at` int(10) unsigned NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `name` (`name`),
              KEY `created_by` (`created_by`),
              KEY `updated_by` (`updated_by`),
              CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
              CONSTRAINT `gallery_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


            DROP TABLE IF EXISTS `gallery_image`;
            CREATE TABLE `gallery_image` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `gallery_id` int(11) NOT NULL,
              `file_name` varchar(255) NOT NULL,
              `sort_order` int(10) unsigned NOT NULL DEFAULT '0',
              `is_active` tinyint(1) NOT NULL DEFAULT '1',
              `created_by` int(11) NOT NULL,
              `updated_by` int(11) NOT NULL,
              `created_at` int(10) unsigned NOT NULL,
              `updated_at` int(10) unsigned NOT NULL,
              PRIMARY KEY (`id`),
              KEY `gallery_id` (`gallery_id`),
              KEY `created_by` (`created_by`),
              KEY `updated_by` (`updated_by`),
              CONSTRAINT `gallery_image_ibfk_1` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`),
              CONSTRAINT `gallery_image_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
              CONSTRAINT `gallery_image_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


            DROP TABLE IF EXISTS `global_configuration`;
            CREATE TABLE `global_configuration` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `slug` varchar(255) NOT NULL,
              `value` varchar(255) NOT NULL,
              `created_by` int(11) NOT NULL,
              `updated_by` int(11) NOT NULL,
              `created_at` int(10) unsigned NOT NULL,
              `updated_at` int(10) unsigned NOT NULL,
              PRIMARY KEY (`id`),
              KEY `created_by` (`created_by`),
              KEY `updated_by` (`updated_by`),
              CONSTRAINT `global_configuration_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
              CONSTRAINT `global_configuration_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


            DROP TABLE IF EXISTS `user_profile`;
            CREATE TABLE `user_profile` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` int(11) NOT NULL,
              `name` varchar(255) NOT NULL,
              `lastname` varchar(255) NULL,
              `avatar` varchar(255) DEFAULT NULL,
              `created_at` int(10) unsigned NOT NULL,
              `updated_at` int(10) unsigned NOT NULL,
              PRIMARY KEY (`id`),
              KEY `user_id` (`user_id`),
              CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    public function down()
    {
        echo "m151026_142937_initial_tables cannot be reverted.\n";

        return false;
    }


    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
