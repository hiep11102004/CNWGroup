<?php

class Course {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function create($title, $description, $instructor_id, $category_id, $price, $duration_weeks, $level, $image) {
        $query = "INSERT INTO courses (title, description, instructor_id, category_id, price, duration_weeks, level, image, created_at, updated_at) 
                  VALUES (:title, :description, :instructor_id, :category_id, :price, :duration_weeks, :level, :image, NOW(), NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':instructor_id', $instructor_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':duration_weeks', $duration_weeks);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }

    public function update($id, $title, $description, $category_id, $price, $duration_weeks, $level, $image) {
        $query = "UPDATE courses SET title = :title, description = :description, category_id = :category_id, 
                  price = :price, duration_weeks = :duration_weeks, level = :level, image = :image, updated_at = NOW() 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':duration_weeks', $duration_weeks);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM courses WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT * FROM courses";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM courses WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllCourses() {
        $query = "SELECT * FROM courses ORDER BY created_at DESC";
        return $this->db->query($query)->fetchAll();
    }

    public function getCourseById($id) {
        $query = "SELECT * FROM courses WHERE id = ?";
        return $this->db->query($query, [$id])->fetch();
    }

    public function createCourse($title, $description, $instructor_id, $category_id, $price, $duration_weeks, $level, $image) {
        $imagePath = $this->uploadImage($image);
        
        $query = "INSERT INTO courses (title, description, instructor_id, category_id, price, duration_weeks, level, image, created_at) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        return $this->db->query($query, [$title, $description, $instructor_id, $category_id, $price, $duration_weeks, $level, $imagePath]);
    }

    public function updateCourse($id, $title, $description, $price, $duration_weeks, $level) {
        $query = "UPDATE courses SET title = ?, description = ?, price = ?, duration_weeks = ?, level = ? WHERE id = ?";
        return $this->db->query($query, [$title, $description, $price, $duration_weeks, $level, $id]);
    }

    public function deleteCourse($id) {
        $query = "DELETE FROM courses WHERE id = ?";
        return $this->db->query($query, [$id]);
    }

    private function uploadImage($image) {
        if (!isset($image) || $image['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $uploadDir = '../uploads/courses/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = time() . '_' . basename($image['name']);
        $uploadPath = $uploadDir . $fileName;

        if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
            return 'uploads/courses/' . $fileName;
        }
        return null;
    }

    public function getCoursesByInstructor($instructor_id) {
        $query = "SELECT * FROM courses WHERE instructor_id = ? ORDER BY created_at DESC";
        return $this->db->query($query, [$instructor_id])->fetchAll();
    }

    public function getCoursesByCategory($category_id) {
        $query = "SELECT * FROM courses WHERE category_id = ? ORDER BY created_at DESC";
        return $this->db->query($query, [$category_id])->fetchAll();
    }
}