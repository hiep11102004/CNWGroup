<?php

class User {
    private $id;
    private $username;
    private $email;
    private $password;
    private $fullname;
    private $role;
    private $created_at;
    private $db;

    public function __construct($username, $email, $password, $fullname, $role) {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->fullname = $fullname;
        $this->role = $role;
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function getRole() {
        return $this->role;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function validate() {
        if (empty($this->username) || empty($this->email) || empty($this->password) || empty($this->fullname)) {
            return false;
        }
        return true;
    }
    public function getAllUsers() {
        $query = "SELECT * FROM users ORDER BY created_at DESC";
        return $this->db->query($query)->fetchAll();
    }

    public function getTotalUsers() {
        $query = "SELECT COUNT(*) as total FROM users";
        $result = $this->db->query($query)->fetch();
        return $result['total'];
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = ?";
        return $this->db->query($query, [$id])->fetch();
    }

    public function createUser($name, $email, $password, $role = 'student') {
        $query = "INSERT INTO users (name, email, password, role, created_at) 
                  VALUES (?, ?, ?, ?, NOW())";
        return $this->db->query($query, [$name, $email, password_hash($password, PASSWORD_DEFAULT), $role]);
    }

    public function updateUser($id, $name, $email, $role) {
        $query = "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?";
        return $this->db->query($query, [$name, $email, $role, $id]);
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = ?";
        return $this->db->query($query, [$id]);
    }
}