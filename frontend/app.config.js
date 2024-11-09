angular.module('productApp')
    .config(['$routeProvider', function config($routeProvider) {
        $routeProvider
            // Ruta principal donde se carga la lista de productos y categorías
            .when('/', {
                template: '<product-list></product-list>'
            })
            // Ruta para cargar productos por categoría
            .when('/category/:categoryId', {
                template: '<product-list></product-list>'

            })
            .otherwise('/');
    }]);

