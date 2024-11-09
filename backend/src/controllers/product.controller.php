<?php
require_once __DIR__ . '/../models/products.model.php';

class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    public function showAllProducts() {
        $products = $this->productModel->showAllProducts(); 
        header('Content-Type: application/json');
        echo json_encode($products);
        exit();
    }

    public function showProductsByCategory($category_id) {
        $products = $this->productModel->getProductsByCategory($category_id);
        
        if (empty($products)) {
            http_response_code(404);
            echo json_encode(["error" => "No se encontraron productos para esta categoría."]);
        } else {
            echo json_encode($products);
        }
    }

    public function createProduct($code, $name, $category_id, $price) { 
        $response = $this->productModel->createProduct($code, $name, $category_id, $price);

        header('Content-Type: application/json');
        if ($response == "Producto creado exitosamente") {
            echo json_encode(['message' => $response, 'status' => 'success']);
        } else {
            echo json_encode(['message' => $response, 'status' => 'error']);
        }
        exit();
    }


    public function updateProduct($id, $code, $name, $category_id, $price) { 
        $response = $this->productModel->updateProduct($id, $code, $name, $category_id, $price); 
    
        header('Content-Type: application/json');
        if ($response === "Producto actualizado exitosamente.") {
            echo json_encode(['message' => $response, 'status' => 'success']);
        } else {
            echo json_encode(['message' => $response, 'status' => 'error']);
        }
        exit();
    }

    public function deleteProduct($id) {
        $response = $this->productModel->deleteProduct($id); 
    
        header('Content-Type: application/json');
        if ($response === "Producto eliminado exitosamente.") {
            echo json_encode(['message' => $response, 'status' => 'success']);
        } else {
            echo json_encode(['message' => $response, 'status' => 'error']);
        }
        exit();
    }
    
    public function getProductById($id) {
        $product = $this->productModel->getProductById($id); 
    
        header('Content-Type: application/json');
        if ($product) {
            echo json_encode($product);
        } else {
            echo json_encode(["error" => "Producto no encontrado."]);
        }
        exit();
    }
}

?>