<?php

class CourseController
{
    private $courseModel;

    public function __construct()
    {
    
        require_once '../models/Course.php';
        $this->courseModel ;
    }

    public function index()
    {
    
        $courses = $this->courseModel->getAllCourses();
        require_once '../views/courses/index.php';
    }

    public function detail($id)
    {
    
        $course = $this->courseModel->getCourseById($id);
        require_once '../views/courses/detail.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
            $title = $_POST['title'];
            $description = $_POST['description'];
            $instructor_id = $_POST['instructor_id'];
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $duration_weeks = $_POST['duration_weeks'];
            $level = $_POST['level'];
            $image = $_FILES['image'];

        
            if ($this->validateCourseInput($title, $description, $price, $duration_weeks, $level)) {
              
                $this->courseModel->createCourse($title, $description, $instructor_id, $category_id, $price, $duration_weeks, $level, $image);
                header('Location: /courses');
            } else {
                $error = "Invalid input. Please check your data.";
            }
        }
        require_once '../views/instructor/course/create.php';
    }

    public function edit($id)
    {
        $course = $this->courseModel->getCourseById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $duration_weeks = $_POST['duration_weeks'];
            $level = $_POST['level'];

        
            if ($this->validateCourseInput($title, $description, $price, $duration_weeks, $level)) {
                $this->courseModel->updateCourse($id, $title, $description, $price, $duration_weeks, $level);
                header('Location: /courses');
            } else {
                $error = "Invalid input. Please check your data.";
            }
        }
        require_once '../views/instructor/course/edit.php';
    }

    public function delete($id)
    {
        $this->courseModel->deleteCourse($id);
        header('Location: /courses');
    }

    private function validateCourseInput($title, $description, $price, $duration_weeks, $level)
    {
    
        if (empty($title) || empty($description) || !is_numeric($price) || !is_numeric($duration_weeks) || empty($level)) {
            return false;
        }
        return true;
    }
}