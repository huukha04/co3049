SET time_zone = '+07:00';  -- Việt Nam (UTC+7)

CREATE TABLE IF NOT EXISTS `users` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    
    role ENUM('customer', 'admin') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    rank ENUM('bronze', 'silver', 'gold') DEFAULT 'bronze',
    point INT DEFAULT 0,
    avatar VARCHAR(255),
    phone VARCHAR(20),
    address VARCHAR(255)
);
