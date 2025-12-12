<?php
class AdminController {
    private $userModel;
    private $categoryModel;

    public function __construct() {
        $this->userModel;
        $this->categoryModel;
    }

    public function dashboard() {
        require_once '../views/admin/dashboard.php';
    }

    public function manageUsers() {
        $users = $this->userModel->getAllUsers();
        require_once '../views/admin/users/manage.php';
    }

    public function createCategory() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];


            if (empty($name) || empty($description)) {
                $error = "All fields are required.";
            } else {
                $this->categoryModel->createCategory($name, $description);
                header('Location: /admin/categories/list');
                exit();
            }
        }
        require_once '../views/admin/categories/create.php';
    }

    public function editCategory($id) {
        $category = $this->categoryModel->getCategoryById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];


            if (empty($name) || empty($description)) {
                $error = "All fields are required.";
            } else {
                $this->categoryModel->updateCategory($id, $name, $description);
                header('Location: /admin/categories/list');
                exit();
            }
        }
        require_once '../views/admin/categories/edit.php';
    }

    public function listCategories() {
        $categories = $this->categoryModel->getAllCategories();
        require_once '../views/admin/categories/list.php';
    }

    public function viewStatistics() {
    
        $statistics = $this->getStatistics();
        require_once '../views/admin/reports/statistics.php';
    }

    private function getStatistics() {
    
        return [
            'totalUsers' => $this->userModel->getTotalUsers(),
            'totalCourses' => $this->categoryModel->getTotalCourses(),
    
        ];
    }
}
?>