SET time_zone = '+07:00';  -- Việt Nam (UTC+7)

CREATE TABLE IF NOT EXISTS poster (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    expiration_date DATE NOT NULL,
    title VARCHAR(255),
    description TEXT

);

CREATE TABLE IF NOT EXISTS about;

CREATE TABLE IF NOT EXISTS deal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    url VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    expiration_date DATE NOT NULL,
    status ENUM('Coming', 'Showing', 'Ended') DEFAULT 'Coming' NOT NULL
);

CREATE TABLE IF NOT EXISTS new (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    url VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    expiration_date DATE NOT NULL,
    status ENUM('Coming', 'Showing', 'Ended') DEFAULT 'Coming' NOT NULL
);



CREATE TABLE IF NOT EXISTS movie (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Mã phim tự tăng
    status ENUM('Coming', 'Showing', 'Ended') DEFAULT 'Coming' NOT NULL,
    premiere_date DATE NOT NULL,  -- Ngày khởi chiếu
    expiration_date DATE NOT NULL,  -- Ngày hết hạn (có thể là ngày ngừng chiếu)
    title VARCHAR(255) NOT NULL,  -- Tên phim
    category_code VARCHAR(10) NOT NULL,  -- Mã phân loại phim (VD: T18, T19)
    url VARCHAR(255) NOT NULL,  -- Đường dẫn URL của phim (trang web)

    trailer VARCHAR(255),
    description TEXT ,  -- Mô tả nội dung phim
    time INT,  -- Thời lượng phim (tính bằng phút, VD: 137 phút)
    rating FLOAT ,  -- Điểm đánh giá trung bình (VD: 8.7)
    vote_count INT ,  -- Số lượt đánh giá (VD: 29)
    year INT NOT NULL,  -- Năm sản xuất (VD: 2021)
    country VARCHAR(100) ,  -- Quốc gia sản xuất (VD: Mỹ)
    producer VARCHAR(255) ,  -- Nhà sản xuất (VD: Plan B Entertainment, Warner Bros)
    genre VARCHAR(255) ,  -- Thể loại phim (VD: Hài, Hành Động, Giả Tưởng, Phiêu Lưu)
    director VARCHAR(255) ,  -- Đạo diễn phim (VD: Bong Joon Ho)
    cast TEXT  -- Danh sách diễn viên chính (VD: Robert Pattinson, Mark Ruffalo, Steven Yeun)
);

CREATE TABLE IF NOT EXISTS `user` (
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
    address VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    status ENUM('Active', 'Inactive') DEFAULT 'Active'
);





CREATE TABLE cinema (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL
);

CREATE TABLE room (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    seat_capacity INT NOT NULL, -- Só lượng ghế


    cinema_id INT NOT NULL,
    FOREIGN KEY (cinema_id) REFERENCES cinema(id) ON DELETE CASCADE
);

CREATE TABLE seat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    seat_code VARCHAR(10) NOT NULL,  -- Mã ghế (A1, B2,...)
    row_number INT NOT NULL,         -- Số hàng (1,2,3...)
    column_number INT NOT NULL,      -- Số cột (1,2,3...)
    capacity INT DEFAULT 1 NOT NULL, -- Có thể ngồi mấy người
    seat_type ENUM('center', 'vip', 'normal', 'couple') NOT NULL,

    room_id INT NOT NULL,
    FOREIGN KEY (room_id) REFERENCES room(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE ticket (
    id INT PRIMARY KEY AUTO_INCREMENT,
    
    -- Đã thanh toán, đã hoàn trả, đã hủy/hết hạn
    status ENUM('reserved', 'paid', 'cancelled') NOT NULL DEFAULT 'reserved',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    schedule_id INT NOT NULL,
    FOREIGN KEY (schedule_id) REFERENCES schedule(id) ON DELETE CASCADE,

    seat_id INT NOT NULL,
    FOREIGN KEY (seat_id) REFERENCES seat(id) ON DELETE CASCADE,

    user_id INT NULL, --Lưu về kho vé nếu có user
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
    email VARCHAR(255) NOT NULL, -- Lấy từ user nếu có -- Gửi vé qua mail

);


CREATE TABLE schedule (
    id INT PRIMARY KEY AUTO_INCREMENT, 
    show_time DATETIME NOT NULL, -- Giờ bắt đầu
    price DECIMAL(10,2) NOT NULL, -- Giá / 1 

    movie_id INT NOT NULL, 
    FOREIGN KEY (movie_id) REFERENCES movie(id) ON DELETE CASCADE ON UPDATE CASCADE,

    room_id INT NOT NULL, 
    FOREIGN KEY (room_id) REFERENCES room(id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE product (
    id INT PRIMARY KEY AUTO_INCREMENT, 
    price DECIMAL(10,2) NOT NULL, -- Giá / 1 
    count INT NOT NULL, --Số lượng
    title  VARCHAR(255) NOT NULL, -- Loại bắp - nước - đồ ăn - đồ lưu niệm
    name  VARCHAR(255) NOT NULL, -- Tên
    url VARCHAR(255) NOT NULL, -- Ảnh

    cinema_id INT NOT NULL,
    FOREIGN KEY (cinema_id) REFERENCES cinema(id) ON DELETE CASCADE


);



CREATE TABLE IF NOT EXISTS otp;

CREATE TABLE IF NOT EXISTS faq;


CREATE TABLE IF NOT EXISTS order_ticket (

);

CREATE TABLE IF NOT EXISTS order_product (

);

CREATE TABLE IF NOT EXISTS payment (

);