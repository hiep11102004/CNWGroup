<?php

class Enrollment {
    private $conn;
    private $table_name = "enrollments";

    public $id;
    public $course_id;
    public $student_id;
    public $enrolled_date;
    public $status;
    public $progress;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET course_id=:course_id, student_id=:student_id, 
                      enrolled_date=:enrolled_date, status=:status, progress=:progress";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->course_id = htmlspecialchars(strip_tags($this->course_id));
        $this->student_id = htmlspecialchars(strip_tags($this->student_id));
        $this->enrolled_date = htmlspecialchars(strip_tags($this->enrolled_date));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->progress = htmlspecialchars(strip_tags($this->progress));

        // bind values
        $stmt->bindParam(":course_id", $this->course_id);
        $stmt->bindParam(":student_id", $this->student_id);
        $stmt->bindParam(":enrolled_date", $this->enrolled_date);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":progress", $this->progress);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE student_id = :student_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":student_id", $this->student_id);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET status = :status, progress = :progress 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->progress = htmlspecialchars(strip_tags($this->progress));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind values
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":progress", $this->progress);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}