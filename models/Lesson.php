<?php

class Lesson {
    private $id;
    private $course_id;
    private $title;
    private $content;
    private $video_url;
    private $order;
    private $created_at;
    private $db;

    public function __construct($course_id, $title, $content, $video_url, $order) {
        $this->course_id = $course_id;
        $this->title = $title;
        $this->content = $content;
        $this->video_url = $video_url;
        $this->order = $order;
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function getId() {
        return $this->id;
    }

    public function getCourseId() {
        return $this->course_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getVideoUrl() {
        return $this->video_url;
    }

    public function getOrder() {
        return $this->order;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function createLesson($courseId, $title, $content, $videoUrl, $order) {
        $query = "INSERT INTO lessons (course_id, title, content, video_url, lesson_order, created_at) 
                  VALUES (?, ?, ?, ?, ?, NOW())";
        return $this->db->query($query, [$courseId, $title, $content, $videoUrl, $order]);
    }

    public function getLessonById($lessonId) {
        $query = "SELECT * FROM lessons WHERE id = ?";
        return $this->db->query($query, [$lessonId])->fetch();
    }

    public function getLessonsByCourseId($courseId) {
        $query = "SELECT * FROM lessons WHERE course_id = ? ORDER BY lesson_order ASC";
        return $this->db->query($query, [$courseId])->fetchAll();
    }

    public function updateLesson($lessonId, $title, $content, $videoUrl, $order) {
        $query = "UPDATE lessons SET title = ?, content = ?, video_url = ?, lesson_order = ? WHERE id = ?";
        return $this->db->query($query, [$title, $content, $videoUrl, $order, $lessonId]);
    }

    public function deleteLesson($lessonId) {
        $query = "DELETE FROM lessons WHERE id = ?";
        return $this->db->query($query, [$lessonId]);
    }

    public function getTotalLessonsByCourse($courseId) {
        $query = "SELECT COUNT(*) as total FROM lessons WHERE course_id = ?";
        $result = $this->db->query($query, [$courseId])->fetch();
        return $result['total'];
    }

    public function getNextLesson($courseId, $currentOrder) {
        $query = "SELECT * FROM lessons WHERE course_id = ? AND lesson_order > ? ORDER BY lesson_order ASC LIMIT 1";
        return $this->db->query($query, [$courseId, $currentOrder])->fetch();
    }

    public function getPreviousLesson($courseId, $currentOrder) {
        $query = "SELECT * FROM lessons WHERE course_id = ? AND lesson_order < ? ORDER BY lesson_order DESC LIMIT 1";
        return $this->db->query($query, [$courseId, $currentOrder])->fetch();
    }

    public function getFirstLesson($courseId) {
        $query = "SELECT * FROM lessons WHERE course_id = ? ORDER BY lesson_order ASC LIMIT 1";
        return $this->db->query($query, [$courseId])->fetch();
    }

    public function updateLessonOrder($lessonId, $newOrder) {
        $query = "UPDATE lessons SET lesson_order = ? WHERE id = ?";
        return $this->db->query($query, [$newOrder, $lessonId]);
    }
}