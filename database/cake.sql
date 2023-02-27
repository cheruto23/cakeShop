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
INSERT INTO tbl_category(id,title,image_name) VALUES
(5,'birthday cake','vanilla cake'),
(9,'graduation cake','strawberry cake'),
(4,'wedding cake','chiffon cake'),
(10,'graduation cake','chocolate cake'),
(6,'birthday cake','red velvet cake');





CREATE TABLE tbl_cake (
  id INT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  image_name VARCHAR(255) NOT NULL,
  category_id INT NOT NULL,
  FOREIGN KEY (category_id) REFERENCES tbl_category(id)
)
INSERT INTO tbl_cake(id,title,description,price,image_name,category_id) VALUES
(1,'birthday cake','vanilla flavored cake','ksh.1500','vanilla cake',5),
(4,'graduation cake','strawberry flavored cake','ksh.2000','strawberry cake',9),
(9,'wedding cake','chiffon flavored cake','ksh.2500','chiffon cake',5),
(15,'birthday cake','red velvet flavored cake','ksh.1200', 'red velvet cake',6),
(21,'graduation cake','chocolate flavored cake','ksh.2200','chocolate cake',10);




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
INSERT INTO tbl_order(id,cake,price,total,order_date,status,customer_name,customer_contact,customer_email,customer_address)
VALUES
(14,'red velvet cake','ksh1200','ksh.2400','9/02/2023','in process','Vincent Red','0723546751','vinny678@gmail.com','acbdcgr123'),
(34,'strawberry cake','ksh.2000','ksh.2000','6/02/2023','delivered','Wendy Makena','0729356438','wendygy@gmail.com','fhhdsaru'),
(21,'chocolate cake','ksh.2200','ksh.11000','4/02/2023','delivered','Ruby Johns','0713478902','rubyjohns@gmail.com','nhy7ruyt'),
(3,'chiffon cake','ksh.2500','ksh.2500','9/02/2023','in process','Phillis Joy','0773215679','phillisjoy@gmail.com','vgrtayu'),
(45,'vanilla cake','ksh.1500','ksh.1500','15/01/2023','delivered','Judy Jade','0702547803','judyjade23@gmail.com','ygdart');





CREATE TABLE users (
  id int NOT NULL,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL
);
INSERT INTO users(id,username,email,password) VALUES
(1,'Vinny','vinny678@gmail.com','1234567'),
(3,'Judy23','judyjade23@gmail.com','462389'),
(17,'Wendy','wendygy@gmail.com','fy563r'),
(54,'Philis45','phillisjoy@gmail.com','345ty7u'),
(21,'Rubyjohs','rubyjohns@gmail.com','45st23');





CREATE TABLE userlog (
  id int primary key NOT NULL,
  userEmail varchar(255) NOT NULL,
  userip binary(16) NOT NULL,
  loginTime datetime NOT NULL,
  logout datetime NOT NULL,
  status varchar NOT NULL
);
INSERT INTO userlog(id,userEmail,userip,logintime,logout,status) VALUES
(54,'phillisjoy@gmail.com','192.158.1.38','09:25','09:50','inactive'),
(1,'vinny678@gmail.com','192.157.1.38','20:00','20:09','active'),
(21,'rubyjohns@gmail.com','172.31.255.255','15:00','15:05','inactive'),
(17,'wendygy@gmail.com','172.16.0.0','11:54','12:09','inactive'),
(3,'judyjade23@gmail.com','192.158.1.38','06:05','06:13','active');

CREATE TABLE IF NOT EXISTS `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(50) NOT NULL,
 `email` varchar(50) NOT NULL,
 `password` varchar(50) NOT NULL,
 `create_datetime` datetime NOT NULL,
 PRIMARY KEY (`id`)
);

