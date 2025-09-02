CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(120) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS measurements (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  type VARCHAR(32) NOT NULL,
  value DECIMAL(10,2) NOT NULL,
  measured_at DATE NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO users (email, password_hash) VALUES ('demo@demo.com', 'x');

INSERT INTO measurements (user_id, type, value, measured_at) VALUES
(1,'weight',83.2,'2025-08-20'),
(1,'weight',82.7,'2025-08-21'),
(1,'weight',82.4,'2025-08-22');
