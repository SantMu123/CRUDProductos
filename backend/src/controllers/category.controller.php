<?php
require_once __DIR__ . '/../models/category.model.php';

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new Category();
    }

    public function showAllCategories() {
        $categorys = $this->categoryModel->showAllCategories();
        header('Content-Type: application/json'); 
        echo json_encode($categorys);
        exit();
    }
    
}

?>