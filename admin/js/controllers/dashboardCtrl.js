app.controller('dashboardCtrl', function($scope, Api, estoqueBaixo, $rootScope){

	$rootScope.loadViews = false;

	$scope.estoqueBaixo = estoqueBaixo.data;

	$scope.substr = function(string) {
        if(string) return string.substring(0, 2);
    }
});