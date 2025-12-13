<?php

class LessonController {
    private $lessonModel;
    private $courseModel;

    public function __construct() {
        // Include models
        require_once '../models/Lesson.php';
        require_once '../models/Course.php';
        $this->lessonModel;
        $this->courseModel ;
    }

    public function index($courseId) {
        // Validate course exists
        if (empty($courseId)) {
            die("Course ID is required.");
        }

        $course = $this->courseModel->getCourseById($courseId);
        if (!$course) {
            die("Course not found.");
        }

        $lessons = $this->lessonModel->getLessonsByCourseId($courseId);
        require_once '../views/student/lessons/index.php';
    }

    public function view($lessonId) {
        // Validate lesson exists
        if (empty($lessonId)) {
            die("Lesson ID is required.");
        }

        $lesson = $this->lessonModel->getLessonById($lessonId);
        if (!$lesson) {
            die("Lesson not found.");
        }

        $course = $this->courseModel->getCourseById($lesson['course_id']);
        require_once '../views/student/lessons/view.php';
    }

    public function create($courseId) {
        // Validate course exists
        if (empty($courseId)) {
            die("Course ID is required.");
        }

        $course = $this->courseModel->getCourseById($courseId);
        if (!$course) {
            die("Course not found.");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $videoUrl = trim($_POST['video_url'] ?? '');
            $order = intval($_POST['order'] ?? 0);

            // Validate input
            if (!$this->validateLesson($title, $content, $videoUrl, $order)) {
                $error = "All fields are required. Order must be a non-negative integer.";
                require_once '../views/instructor/lessons/create.php';
                return;
            }

            // Create lesson
            if ($this->lessonModel->createLesson($courseId, $title, $content, $videoUrl, $order)) {
                header("Location: /onlinecourse/controllers/LessonController.php?action=manage&course_id=" . $courseId);
                exit();
            } else {
                $error = "Failed to create lesson.";
                require_once '../views/instructor/lessons/create.php';
            }
        } else {
            require_once '../views/instructor/lessons/create.php';
        }
    }

    public function edit($lessonId) {
        // Validate lesson exists
        if (empty($lessonId)) {
            die("Lesson ID is required.");
        }

        $lesson = $this->lessonModel->getLessonById($lessonId);
        if (!$lesson) {
            die("Lesson not found.");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $videoUrl = trim($_POST['video_url'] ?? '');
            $order = intval($_POST['order'] ?? 0);

            // Validate input
            if (!$this->validateLesson($title, $content, $videoUrl, $order)) {
                $error = "All fields are required. Order must be a non-negative integer.";
                require_once '../views/instructor/lessons/edit.php';
                return;
            }

            // Update lesson
            if ($this->lessonModel->updateLesson($lessonId, $title, $content, $videoUrl, $order)) {
                header("Location: /onlinecourse/controllers/LessonController.php?action=manage&course_id=" . $lesson['course_id']);
                exit();
            } else {
                $error = "Failed to update lesson.";
                require_once '../views/instructor/lessons/edit.php';
            }
        } else {
            require_once '../views/instructor/lessons/edit.php';
        }
    }

    public function manage($courseId) {
        // Validate course exists
        if (empty($courseId)) {
            die("Course ID is required.");
        }

        $course = $this->courseModel->getCourseById($courseId);
        if (!$course) {
            die("Course not found.");
        }

        $lessons = $this->lessonModel->getLessonsByCourseId($courseId);
        require_once '../views/instructor/lessons/manage.php';
    }

    public function delete($lessonId) {
        // Validate lesson exists
        if (empty($lessonId)) {
            die("Lesson ID is required.");
        }

        $lesson = $this->lessonModel->getLessonById($lessonId);
        if (!$lesson) {
            die("Lesson not found.");
        }

        $courseId = $lesson['course_id'];

        // Delete lesson
        if ($this->lessonModel->deleteLesson($lessonId)) {
            header("Location: /onlinecourse/controllers/LessonController.php?action=manage&course_id=" . $courseId);
            exit();
        } else {
            die("Failed to delete lesson.");
        }
    }

    public function getNext($courseId, $currentOrder) {
        $lesson = $this->lessonModel->getNextLesson($courseId, $currentOrder);
        return $lesson;
    }

    public function getPrevious($courseId, $currentOrder) {
        $lesson = $this->lessonModel->getPreviousLesson($courseId, $currentOrder);
        return $lesson;
    }

    private function validateLesson($title, $content, $videoUrl, $order) {
        if (empty($title) || empty($content) || empty($videoUrl) || $order < 0) {
            return false;
        }
        return true;
    }
}
?>