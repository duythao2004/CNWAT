CREATE DATABASE IF NOT EXISTS shop
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE shop;

-- Bảng loại sản phẩm
CREATE TABLE IF NOT EXISTS categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Bảng sản phẩm
CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  price DECIMAL(12,2) NOT NULL DEFAULT 0,
  category_id INT,
  image VARCHAR(255),
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_prod_cat FOREIGN KEY (category_id)
    REFERENCES categories(id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

-- (Tùy chọn) Bảng người dùng cho phần đăng nhập
CREATE TABLE IF NOT EXISTS users(
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE,
  password VARCHAR(255) NOT NULL,   -- demo dùng MD5 cho nhanh
  role ENUM('user','admin') DEFAULT 'user'
);

-- Dữ liệu mẫu: 5 loại
INSERT INTO categories(name) VALUES
('DELL'),('HP'),('ASUS'),('LENOVO'),('ACER');

-- Dữ liệu mẫu: 10 sản phẩm
INSERT INTO products(name,price,category_id,image,description) VALUES
('Dell Inspiron 15',15990000,1,'dell1.jpg','Core i5, 8GB, 512GB'),
('Dell Vostro 3400',13990000,1,'dell2.jpg','Core i3, 8GB'),
('HP 15s',12990000,2,'hp1.jpg','Ryzen 5, 8GB, 512GB'),
('HP Pavilion 14',18990000,2,'hp2.jpg','Core i5 Gen13'),
('ASUS VivoBook 14',11990000,3,'asus1.jpg','Core i3, mỏng nhẹ'),
('ASUS TUF Gaming',24990000,3,'asus2.jpg','RTX 2050, i5'),
('Lenovo IdeaPad 3',10990000,4,'lenovo1.jpg','Ryzen 3'),
('Lenovo ThinkPad E14',22990000,4,'lenovo2.jpg','i5, business'),
('Acer Aspire 5',11990000,5,'acer1.jpg','i3, 8GB'),
('Acer Nitro 5',25990000,5,'acer2.jpg','Gaming, RTX 3050');

-- Tài khoản admin demo (admin/admin)
INSERT INTO users(username,password,role)
VALUES ('admin', MD5('admin'),'admin'),
       ('user1', MD5('123456'),'user');
