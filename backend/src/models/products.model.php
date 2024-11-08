<?php
require_once __DIR__ . '/../../config/database.php';

class Product {
    private $db;

    public function __construct() {
        $this->db = getDatabaseConnection();
    }

    public function showAllProducts() {
        $query = $this->db->query("SELECT * FROM Product");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsByCategory($category_id) {
        $query = "SELECT * FROM Product WHERE category_id = :category_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createProduct($code, $name, $category_id, $price) {
        $query = "INSERT INTO Product (code, name, category_id, price, createdAt)
                  VALUES (:code, :name, :category_id, :price, NOW())";
        
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':price', $price);

        if ($stmt->execute()) {
            return "Producto creado exitosamente";
        } else {
            return "Error al crear el producto";
        }
    }

    public function updateProduct($id, $code, $name, $category_id, $price) {
        $query = "UPDATE Product 
                  SET code = :code, name = :name, category_id = :category_id, price = :price, updatedAt = NOW() 
                  WHERE id = :id";
    
        $stmt = $this->db->prepare($query);
    
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id);
    
        if ($stmt->execute()) {
            return "Producto actualizado exitosamente.";
        } else {
            return "Error al actualizar el producto.";
        }
    }

    public function deleteProduct($id) {
        $query = "DELETE FROM Product WHERE id = :id";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
    
        if ($stmt->execute()) {
            return "Producto eliminado exitosamente.";
        } else {
            return "Error al eliminar el producto.";
        }
    }


    public function getProductById($id) {
        $query = "SELECT * FROM Product WHERE id = :id LIMIT 1";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
}


?>