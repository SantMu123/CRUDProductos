<?php

require_once __DIR__ . '/../../config/database.php';

class Category {
    private $db;

    public function __construct() {
        $this->db = getDatabaseConnection(); 
    }

    public function showAllCategories() {
        $query = $this->db->query("SELECT * FROM Category");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

?>