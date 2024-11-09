angular.module('productApp').controller('ProductController', function($routeParams, productService) {
    const ctrl = this;
    ctrl.products = [];
    ctrl.newProduct = {};
    ctrl.editingProduct = null;
    ctrl.categories = []; 
    ctrl.selectedCategory = null;

    ctrl.loadProducts = function() {
        productService.getAllProducts().then(function(response) {
            ctrl.products = response.data;
            console.log(ctrl.products);
        }).catch(function(error) {
            console.error('Error fetching products:', error);
        });
    };

    ctrl.loadProductsByCategory = function() {
        if (ctrl.selectedCategory) {
            productService.getProductsByCategory(ctrl.selectedCategory.id).then(function(response) {
                ctrl.products = response.data;
            }).catch(function(error) {
                console.error('Error fetching products by category:', error);
            });
        } else {
            ctrl.loadProducts();
        }
    };

    ctrl.addProduct = function() {
        productService.createProduct(ctrl.newProduct).then(function(response) {
            ctrl.products.push(response.data);
            ctrl.newProduct = {};
        }).catch(function(error) {
            console.error('Error creating product:', error);
        });
    };

    ctrl.editProduct = function(product) {
        ctrl.editingProduct = angular.copy(product);
    };

    ctrl.updateProduct = function() {
        productService.updateProduct(ctrl.editingProduct).then(function(response) {
            const index = ctrl.products.findIndex(p => p.id === ctrl.editingProduct.id);
            if (index !== -1) {
                ctrl.products[index] = response.data;
            }
            ctrl.editingProduct = null;
        }).catch(function(error) {
            console.error('Error updating product:', error);
        });
    };

    ctrl.cancelEdit = function() {
        ctrl.editingProduct = null;
    };

    ctrl.deleteProduct = function(id) {
        productService.deleteProduct(id).then(function() {
            ctrl.products = ctrl.products.filter(p => p.id !== id);
        }).catch(function(error) {
            console.error('Error deleting product:', error);
        });
    };

    ctrl.loadCategories = function() {
        productService.getAllCategories().then(function(response) {
            ctrl.categories = response.data;
        }).catch(function(error) {
            console.error('Error fetching categories:', error);
        });
    };

    ctrl.loadProductsOrCategory = function() {
        const categoryId = $routeParams.categoryId;
        if (categoryId) {
            ctrl.selectedCategory = ctrl.categories.find(c => c.id === categoryId);
            ctrl.loadProductsByCategory();
        } else {
            ctrl.loadProducts();
        }
    };

    ctrl.init = function() {
        ctrl.loadCategories(); 
        ctrl.loadProductsOrCategory(); 
    };

    ctrl.init();
});

