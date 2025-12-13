<?php
class EnrollmentController {
    private $enrollmentModel;
    private $courseModel;
    private $userModel;

    public function __construct() {
        // Load models
        $this->enrollmentModel;
        $this->courseModel;
        $this->userModel ;
    }

    public function enroll($courseId, $studentId) {
        // Validate input
        if (empty($courseId) || empty($studentId)) {
            return "Course ID and Student ID are required.";
        }

        // Check if the student is already enrolled
        if ($this->enrollmentModel->isEnrolled($courseId, $studentId)) {
            return "You are already enrolled in this course.";
        }

        // Enroll the student
        $result = $this->enrollmentModel->enrollStudent($courseId, $studentId);
        return $result ? "Enrollment successful." : "Enrollment failed.";
    }

    public function viewEnrollments($studentId) {
        // Validate input
        if (empty($studentId)) {
            return "Student ID is required.";
        }

        // Get enrollments
        $enrollments = $this->enrollmentModel->getEnrollmentsByStudent($studentId);
        return $enrollments;
    }

    public function updateProgress($enrollmentId, $progress) {
        // Validate input
        if (empty($enrollmentId) || !is_numeric($progress) || $progress < 0 || $progress > 100) {
            return "Invalid enrollment ID or progress value.";
        }

        // Update progress
        $result = $this->enrollmentModel->updateProgress($enrollmentId, $progress);
        return $result ? "Progress updated successfully." : "Failed to update progress.";
    }

    public function dropCourse($enrollmentId) {
        // Validate input
        if (empty($enrollmentId)) {
            return "Enrollment ID is required.";
        }

        // Drop the course
        $result = $this->enrollmentModel->dropEnrollment($enrollmentId);
        return $result ? "Successfully dropped the course." : "Failed to drop the course.";
    }
}
?>