CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    points_balance INT DEFAULT 0
);

INSERT INTO users (name, email, points_balance) VALUES
('John Doe', 'john.doe@example.com', 100),
('Jane Smith', 'jane.smith@example.com', 200),
('Bob Johnson', 'bob.johnson@example.com', 300);