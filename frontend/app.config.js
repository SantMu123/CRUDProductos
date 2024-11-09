angular.module('productApp')
    .config(['$routeProvider', function config($routeProvider) {
        $routeProvider
            .when('/', {
                template: '<product-list></product-list>'
            })
            .otherwise('/');
    }]);

