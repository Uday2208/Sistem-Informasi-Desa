CREATE DATABASE IF NOT EXISTS sid_premium;
USE sid_premium;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `users` (`username`, `password`) VALUES ('admin', MD5('admin123'));

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key_name` varchar(50) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
);

INSERT INTO `settings` (`key_name`, `value`) VALUES
('site_title', 'Sistem Informasi Desa Premium'),
('meta_description', 'Website resmi pemerintahan desa, informasi UMKM, dan layanan publik.'),
('meta_keywords', 'desa, pemerintahan, umkm, sid, sistem informasi desa'),
('meta_author', 'Pemerintah Desa'),
('favicon', 'favicon.png'),
('logo', 'logo.png'),
('domain', 'http://localhost/sistem-informasi-desa');

CREATE TABLE `berita` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `content` longtext,
  `meta_title` varchar(255),
  `meta_description` text,
  `meta_image` varchar(255),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

CREATE TABLE `umkm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `deskripsi` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `deskripsi` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
