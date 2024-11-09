angular.module('productApp')
.controller('productListController', ['productService', function(productService) {
    var self = this;
    self.categoryMap = {
        'Sensores': 1,
        'Drones': 2,
        'Accesorios': 3
    };

    self.products = [];
    self.selectedCategoryId = null;
    self.isEditing = false;
    self.selectedProduct = {};
    self.isCreating = false;
    self.newProduct = {};

    self.startCreate = function() {
        self.isCreating = true;
        self.newProduct = {}; 
    };

    self.cancelCreate = function() {
        self.isCreating = false;
        self.newProduct = {};
    };

    self.createProduct = function() {
        productService.createProduct(self.newProduct).then(function(response) {
            //console.log("Producto:", response.data);
            self.loadProducts();
            self.cancelCreate();
        }).catch(function(error) {
            console.error("Error al crear el producto:", error);
        });
    };

    self.startEdit = function(product) {
        self.isEditing = true;
        self.selectedProduct = angular.copy(product);
    };

    self.cancelEdit = function() {
        self.isEditing = false;
        self.selectedProduct = {};
    };

    self.updateProduct = function() {
        if (self.selectedProduct && self.selectedProduct.id) {
            productService.updateProduct(self.selectedProduct).then(function(response) {
                //console.log("Producto actualizado:", response.data);
                self.loadProducts();
                self.cancelEdit();
            }).catch(function(error) {
                console.error("Error al actualizar el producto:", error);
            });
        }
    };

    self.loadProducts = function() {
        //console.log("Categoria seleccionada: ", self.selectedCategoryId);

        if (self.selectedCategoryId !== null) {
            productService.getProductsByCategory(self.selectedCategoryId).then(function(response) {
                //console.log(response);
                self.products = response.data;
            }).catch(function(error) {
                console.error('Error fetching products by category:', error);
            });
        } else {
            productService.getAllProducts().then(function(response) {
                //console.log(response);
                self.products = response.data;
            }).catch(function(error) {
                console.error('Error fetching all products:', error);
            });
        }
    };

    self.filterByCategory = function(categoryName) {
        self.selectedCategoryId = self.categoryMap[categoryName] || null;
        //console.log("Filtrando por: ", categoryName);
        self.loadProducts();  
    };

    self.$onInit = function() {
        //console.log("Controlador iniciado");
        self.loadProducts();
    };

    self.deleteProduct = function(productId) {
        if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
            productService.deleteProduct(productId).then(function() {
                alert('Producto eliminado con éxito');
                self.loadProducts(); 
            }).catch(function(error) {
                console.error('Error al eliminar el producto:', error);
            });
        }
    };
}]);

