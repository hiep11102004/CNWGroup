<?php

class Material {
    private $id;
    private $lesson_id;
    private $filename;
    private $file_path;
    private $file_type;
    private $uploaded_at;

    public function __construct($lesson_id, $filename, $file_path, $file_type) {
        $this->lesson_id = $lesson_id;
        $this->filename = $filename;
        $this->file_path = $file_path;
        $this->file_type = $file_type;
        $this->uploaded_at = date('Y-m-d H:i:s');
    }

    public function getId() {
        return $this->id;
    }

    public function getLessonId() {
        return $this->lesson_id;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function getFilePath() {
        return $this->file_path;
    }

    public function getFileType() {
        return $this->file_type;
    }

    public function getUploadedAt() {
        return $this->uploaded_at;
    }

    public function save($conn) {
        $stmt = $conn->prepare("INSERT INTO materials (lesson_id, filename, file_path, file_type, uploaded_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $this->lesson_id, $this->filename, $this->file_path, $this->file_type, $this->uploaded_at);
        return $stmt->execute();
    }

    public static function getAllByLessonId($conn, $lesson_id) {
        $stmt = $conn->prepare("SELECT * FROM materials WHERE lesson_id = ?");
        $stmt->bind_param("i", $lesson_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function deleteById($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM materials WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}