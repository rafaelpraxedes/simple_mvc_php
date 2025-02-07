-- mysql -u root -p -A

CREATE DATABASE crm_app_db;
CREATE USER 'crm_app_admin'@'localhost' IDENTIFIED by 'G0q9hO&Dj1(FzXIM8NrkfFXp';
GRANT ALL PRIVILEGES ON crm_app_db.* TO 'crm_app_admin'@'localhost';
FLUSH PRIVILEGES;

SHOW GRANTS for crm_app_admin@localhost;

USE crm_app_db;

CREATE TABLE crm_app_db.customers 
(
    id         INT AUTO_INCREMENT PRIMARY KEY
   ,name       VARCHAR(200) NOT NULL
   ,email      VARCHAR(100) NOT NULL
   ,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE crm_app_db.customer_addresses
(
    id          INT AUTO_INCREMENT PRIMARY KEY
   ,customer_id INT
   ,address     VARCHAR(300) NOT NULL
   ,type        VARCHAR(50) NOT NULL CHECK (type IN ('mailing', 'shipping'))
   ,created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   ,FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
);
