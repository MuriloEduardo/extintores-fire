app.controller('dashboardCtrl', function($scope, Api, estoqueBaixo){

	$scope.estoqueBaixo = estoqueBaixo.data;

	$scope.substr = function(string) {
        if(string) return string.substring(0, 2);
    }
});