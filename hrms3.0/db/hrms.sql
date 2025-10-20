
CREATE DATABASE IF NOT EXISTS hotelreservationms;
USE hotelreservationms;

DROP TABLE IF EXISTS reservations;
DROP TABLE IF EXISTS rooms;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','guest') NOT NULL DEFAULT 'guest',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE rooms (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  price DECIMAL(10,2) NOT NULL DEFAULT 0.00
);

CREATE TABLE reservations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  room_id INT NOT NULL,
  check_in DATE NOT NULL,
  check_out DATE NOT NULL,
  guests INT NOT NULL DEFAULT 1,
  notes TEXT,
  status ENUM('pending','approved','cancelled') NOT NULL DEFAULT 'pending',
  created_at DATETIME NOT NULL,
  approved_at DATETIME NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (room_id) REFERENCES rooms(id)
);

-- seed admin and sample rooms
INSERT INTO users (username,password,role) VALUES
('admin', 'admin123', 'admin'); -- password: admin123

UPDATE users SET password = '$2y$12$no0NsuM9SoTnZsu3RgJ7VeR4thmwOOQQ.xlBQBA6EDJucWtpZy7w.' WHERE username = 'admin';

INSERT INTO rooms (name,description,price) VALUES
('Standard Room','Cozy room with queen bed, Wi‑Fi, and TV.', 1800.00),
('Deluxe Room','Spacious room with king bed and city view.', 2500.00),
('Family Suite','Two-bedroom suite perfect for families.', 4200.00);
