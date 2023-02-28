CREATE DATABASE cakes_order

use cakes_order;

CREATE TABLE admin (
  admin_id INT PRIMARY KEY,
  full_name VARCHAR(255) NOT NULL,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);
INSERT INTO admin(admin_id,full_name,username) VALUES
(1, 'Joy Cheruto', 'Cheruto23'),
(2, 'Mercy Rono','Rono'),
(3,'Honourine Jacobs','Jacobs34'),
(4,'Taqwa John','Taqwa'),
(1,'Lavyn Kemmy','Kemikal');




CREATE TABLE tbl_category (
  id INT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  image_name VARCHAR(255) NOT NULL
);





CREATE TABLE tbl_cake (
  id INT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  image_name VARCHAR(255) NOT NULL,
  category_id INT NOT NULL,
  FOREIGN KEY (category_id) REFERENCES tbl_category(id)
)





CREATE TABLE tbl_order (
  id INT PRIMARY KEY,
  cake VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  qty INT NOT NULL,
  total DECIMAL(10,2) NOT NULL,
  order_date DATETIME NOT NULL,
  status varchar(50),
  customer_name VARCHAR(255) NOT NULL,
  customer_contact VARCHAR(15) NOT NULL,
  customer_email VARCHAR(255) NOT NULL,
  customer_address TEXT NOT NULL
);



CREATE TABLE users (
  id int NOT NULL,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL
);






CREATE TABLE userlog (
  id int primary key NOT NULL,
  userEmail varchar(255) NOT NULL,
  userip binary(16) NOT NULL,
  loginTime datetime NOT NULL,
  logout datetime NOT NULL,
  status varchar NOT NULL
);


CREATE TABLE IF NOT EXISTS `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(50) NOT NULL,
 `email` varchar(50) NOT NULL,
 `password` varchar(50) NOT NULL,
 `create_datetime` datetime NOT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE chatbot_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender VARCHAR(10) NOT NULL,
    message TEXT NOT NULL,
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

