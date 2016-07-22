app.controller('mainCtrl', function($scope, $location, Api, $rootScope){

	$rootScope.loadViews = false;
	
	Api.getLimitLogs().success(function(response){
		$scope.logs = response;
	});

	if(localStorage.length)
		$scope.dadosUsuario = JSON.parse(window.localStorage.getItem('user')).user;

	$scope.getClass = function (path) {
		return ($location.path() === path) ? 'active' : '';
	}

	$scope.substr = function(string) {
        if(string) return string.substring(0, 2);
    }

    $scope.logout = function() {
    	location.href='../';
    	localStorage.clear();
    }

    $scope.ngViewNav = function() {
    	$rootScope.loadViews = true;	
    }
});