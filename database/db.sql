-- csdl dùng trên phpmyadmin





-- -- 1. Tạo CSDL và chọn sử dụng nó
-- CREATE DATABASE IF NOT EXISTS onlinecourse CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE onlinecourse;

-- -- 2. Bảng Users (Người dùng)
-- CREATE TABLE users (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     username VARCHAR(50) NOT NULL UNIQUE,
--     email VARCHAR(100) NOT NULL UNIQUE,
--     password VARCHAR(255) NOT NULL,
--     fullname VARCHAR(100) NOT NULL,
--     role INT DEFAULT 0 COMMENT '0: Student, 1: Instructor, 2: Admin',
--     created_at DATETIME DEFAULT CURRENT_TIMESTAMP
-- );

-- -- 3. Bảng Categories (Danh mục khóa học)
-- CREATE TABLE categories (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(100) NOT NULL,
--     description TEXT,
--     created_at DATETIME DEFAULT CURRENT_TIMESTAMP
-- );

-- -- 4. Bảng Courses (Khóa học)
-- CREATE TABLE courses (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     title VARCHAR(255) NOT NULL,
--     description TEXT,
--     instructor_id INT NOT NULL,
--     category_id INT,
--     price DECIMAL(10, 2) DEFAULT 0,
--     duration_weeks INT DEFAULT 0,
--     level VARCHAR(50) DEFAULT 'Beginner',
--     image VARCHAR(255),
--     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
--     updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--     FOREIGN KEY (instructor_id) REFERENCES users(id) ON DELETE CASCADE,
--     FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
-- );

-- -- 5. Bảng Enrollments (Đăng ký học)
-- CREATE TABLE enrollments (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     student_id INT NOT NULL,
--     course_id INT NOT NULL,
--     enrolled_date DATETIME DEFAULT CURRENT_TIMESTAMP,
--     status VARCHAR(50) DEFAULT 'active' COMMENT 'active, completed, dropped',
--     progress INT DEFAULT 0 COMMENT 'Percentage 0-100',
--     FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
--     FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
-- );

-- -- 6. Bảng Lessons (Bài học)
-- CREATE TABLE lessons (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     course_id INT NOT NULL,
--     title VARCHAR(255) NOT NULL,
--     content LONGTEXT,
--     video_url VARCHAR(255),
--     sort_order INT DEFAULT 0,
--     created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
-- );

-- -- 7. Bảng Materials (Tài liệu)
-- CREATE TABLE materials (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     lesson_id INT NOT NULL,
--     filename VARCHAR(255) NOT NULL,
--     file_path VARCHAR(255) NOT NULL,
--     file_type VARCHAR(50),
--     uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE
-- );

-- -- --- DỮ LIỆU MẪU (DUMMY DATA) ĐỂ TEST ---

-- -- Tạo 3 user: 1 Admin, 1 Giảng viên, 1 Học viên
-- -- Mật khẩu mẫu là '123456' (Lưu ý: Trong thực tế cần mã hóa MD5 hoặc Bcrypt, ở đây để text trần để test cho nhanh)
-- INSERT INTO users (username, email, password, fullname, role) VALUES 
-- ('admin', 'admin@gmail.com', '123456', 'Quản Trị Viên', 2),
-- ('teacher1', 'teacher1@gmail.com', '123456', 'Nguyễn Văn Thầy', 1),
-- ('student1', 'student1@gmail.com', '123456', 'Trần Văn Trò', 0);

-- -- Tạo 1 danh mục
-- INSERT INTO categories (name, description) VALUES 
-- ('Lập trình Web', 'Các khóa học về HTML, CSS, PHP, JS');

-- -- Tạo 1 khóa học (Do teacher1 dạy, thuộc danh mục 1)
-- INSERT INTO courses (title, description, instructor_id, category_id, price, level) VALUES 
-- ('Lập trình PHP căn bản', 'Học PHP từ con số 0 đến mô hình MVC', 2, 1, 500000, 'Beginner');

-- -- Tạo 1 bài học cho khóa đó
-- INSERT INTO lessons (course_id, title, content, sort_order) VALUES 
-- (1, 'Bài 1: Giới thiệu PHP', 'Nội dung bài học giới thiệu...', 1);