<?php
require_once 'src/controllers/product.controller.php';
require_once 'src/controllers/category.controller.php';

function handleRequest($uri, $method) {
    $productsController = new ProductController();
    $categoriesController = new CategoryController();

    if ($method === 'GET') {
        if ($uri === '/products') {
            $productsController->showAllProducts();
        }elseif (preg_match('/^\/products\/category\/(\d+)$/', $uri, $matches)) {
            // Ruta para productos por categoría
            $category_id = $matches[1];
            $productsController->showProductsByCategory($category_id);
        }elseif (preg_match('/^\/products\/(\d+)$/', $uri, $matches)) {
            $id = $matches[1];
            $productsController->getProductById($id); 
        } elseif ($uri === '/categories') {
            $categoriesController->showAllCategories();
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Ruta no encontrada."]);
        }
    }
    elseif ($method === 'POST') {
        if ($uri === '/create') {
            $data = json_decode(file_get_contents("php://input"), true);

            if (isset($data['code']) && isset($data['name']) && isset($data['category_id']) && isset($data['price'])) {
                $productsController->createProduct($data['code'], $data['name'], $data['category_id'], $data['price']);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Faltan datos necesarios."]);
            }
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Ruta no encontrada."]);
        }
    }

    elseif ($method === 'PUT') {
        if (preg_match('/^\/update\/(\d+)$/', $uri, $matches)) {
            $id = $matches[1];
            $data = json_decode(file_get_contents("php://input"), true);

            if (isset($data['code']) && isset($data['name']) && isset($data['category_id']) && isset($data['price'])) {
                $productsController->updateProduct($id, $data['code'], $data['name'], $data['category_id'], $data['price']);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Faltan datos necesarios."]);
            }
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Ruta no encontrada."]);
        }
    }

    elseif ($method === 'DELETE') {
        if (preg_match('/^\/delete\/(\d+)$/', $uri, $matches)) {
            $id = $matches[1];
            $productsController->deleteProduct($id);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Ruta no encontrada."]);
        }
    } else {
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido."]);
    }
}
?>