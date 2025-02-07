-- Insert customers
INSERT INTO crm_app_db.customers (name, email) VALUES 
('Alice Smith', 'alice.smith@example.com'),
('Bob Johnson', 'bob.johnson@example.com'),
('Charlie Davis', 'charlie.davis@example.com'),
('Diana Evans', 'diana.evans@example.com'),
('Edward Green', 'edward.green@example.com'),
('Fiona Harris', 'fiona.harris@example.com'),
('George Thompson', 'george.thompson@example.com'),
('Hannah White', 'hannah.white@example.com'),
('Ian Black', 'ian.black@example.com'),
('Julia Brown', 'julia.brown@example.com');

-- Insert customer_addresses for each customer
INSERT INTO crm_app_db.customer_addresses (customer_id, address, type) VALUES 
(1, '123 Maple Street, Springfield', 'mailing'),
(1, '456 Oak Avenue, Springfield', 'shipping'),
(2, '789 Pine Road, Greenville', 'mailing'),
(3, '101 Elm Street, Centerville', 'mailing'),
(4, '202 Cedar Lane, Riverside', 'mailing'),
(5, '303 Walnut Drive, Hilltown', 'mailing'),
(6, '404 Birch Boulevard, Lakeview', 'mailing'),
(7, '505 Cherry Court, Brookside', 'mailing'),
(8, '606 Redwood Road, Bayside', 'mailing'),
(9, '707 Aspen Street, Mountainview', 'mailing'),
(10, '808 Willow Way, Riverton', 'mailing'),
(10, '909 Palm Avenue, Riverton', 'shipping');
