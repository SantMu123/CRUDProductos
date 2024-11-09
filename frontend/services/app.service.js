angular.module('productApp').service('productService', function($http) {
    const apiUrl = 'http://localhost:3600';

    this.getAllProducts = function() {
        return $http.get(`${apiUrl}/products`);
    };

    this.getProductsByCategory = function(categoryId) {
        return $http.get(`${apiUrl}/products/category/${categoryId}`);
    };

    this.getAllCategories = function() {
        return $http.get(`${apiUrl}/categories`);
    };

    this.createProduct = function(product) {
        return $http.post(`${apiUrl}/create`, product);
    };

    this.updateProduct = function(product) {
        return $http.put(`${apiUrl}/update/${product.id}`, product);
    };

    this.deleteProduct = function(id) {
        return $http.delete(`${apiUrl}/delete/${id}`);
    };
});
