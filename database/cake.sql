CREATE DATABASE cakes_order

use cakes_order;

CREATE TABLE tbl_admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255),
    username VARCHAR(255),
    password VARCHAR(255)
);


CREATE TABLE tbl_category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    image_name VARCHAR(255),
    featured BOOLEAN,
    active BOOLEAN
);



CREATE TABLE tbl_cake (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    price DECIMAL(10,2),
    image_name VARCHAR(255),
    category_id INT,
    featured BOOLEAN,
    active BOOLEAN,
    FOREIGN KEY (category_id) REFERENCES tbl_category(id)
);



CREATE TABLE tbl_order (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cake VARCHAR(255),
    price DECIMAL(10,2),
    qty INT,
    total DECIMAL(10,2),
    order_date DATE,
    status VARCHAR(255),
    customer_name VARCHAR(255),
    customer_contact VARCHAR(255),
    customer_email VARCHAR(255),
    customer_address VARCHAR(255)
);



CREATE TABLE tbl_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    password VARCHAR(255),
    created_at TIMESTAMP
);





CREATE TABLE chatbot_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender VARCHAR(255),
    message TEXT,
    time TIMESTAMP,
    response TEXT,
    user_input TEXT
);




