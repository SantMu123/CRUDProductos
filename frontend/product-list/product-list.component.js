angular.module('productList', [])
.component('productList', {
    templateUrl: 'product-list/product-list.template.html',
    controller: ['productService', function ProductListController(productService) {
        var self = this;

        self.selectedCategory = null;

        self.loadProducts = function() {
            productService.getAllProducts().then(function(response) {
                console.log(response)
                self.products = response.data;
            }).catch(function(error) {
                console.error('Error fetching products:', error);
            });
        };

        self.filterByCategory = function(category) {
            self.selectedCategory = category;
        };

        self.$onInit = function() {
            self.loadProducts();
        };

        self.deleteProduct = function(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                productService.deleteProduct(productId).then(function() {
                    self.loadProducts();
                }).catch(function(error) {
                    console.error('Error deleting product:', error);
                });
            }
        };
    }]
});

