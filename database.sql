CREATE DATABASE IF NOT EXISTS db_mahasiswa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_mahasiswa;
DROP TABLE IF EXISTS mahasiswa;
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nama VARCHAR(100) NOT NULL
) ENGINE=InnoDB;
CREATE TABLE mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nim VARCHAR(15) NOT NULL UNIQUE,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  prodi VARCHAR(50) NOT NULL,
  angkatan YEAR NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
-- Akun login: admin / admin123 (password disimpan sebagai hash bcrypt)
INSERT INTO users (username,password,nama) VALUES ('admin','$2b$10$MPRbMK6aEr/JVBqWW/VmCOfAnkeasu83TbyigqBElzfNueEc7e8uu','Administrator');
INSERT INTO mahasiswa (nim,nama,email,prodi,angkatan) VALUES
('2023010001','Budi Santoso','budi@example.com','Teknik Informatika',2023),
('2023020002','Siti Aminah','siti@example.com','Sistem Informasi',2023),
('2024010003','Andi Wijaya','andi@example.com','Teknik Informatika',2024);
