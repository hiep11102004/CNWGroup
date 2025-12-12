<?php

class Category {
    private $db;
    private $table = 'categories';

    public function __construct($database) {
        $this->db = $database;
    }

    public function create($name, $description) {
        $query = "INSERT INTO " . $this->table . " (name, description, created_at) VALUES (:name, :description, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $description) {
        $query = "UPDATE " . $this->table . " SET name = :name, description = :description, updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function find($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     public function getAllCategories() {
        $query = "SELECT * FROM categories ORDER BY created_at DESC";
        return $this->db->query($query)->fetchAll();
    }

    public function getCategoryById($id) {
        $query = "SELECT * FROM categories WHERE id = ?";
        return $this->db->query($query, [$id])->fetch();
    }

    public function createCategory($name, $description) {
        $query = "INSERT INTO categories (name, description, created_at) 
                  VALUES (?, ?, NOW())";
        return $this->db->query($query, [$name, $description]);
    }

    public function updateCategory($id, $name, $description) {
        $query = "UPDATE categories SET name = ?, description = ? WHERE id = ?";
        return $this->db->query($query, [$name, $description, $id]);
    }

    public function deleteCategory($id) {
        $query = "DELETE FROM categories WHERE id = ?";
        return $this->db->query($query, [$id]);
    }

    public function getTotalCourses() {
        $query = "SELECT COUNT(*) as total FROM categories";
        $result = $this->db->query($query)->fetch();
        return $result['total'];
    }
}