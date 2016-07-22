app.controller('logsCtrl', function($scope, allLogs, $rootScope){

	$rootScope.loadViews = false;
	
	$scope.logs = allLogs.data;

	$scope.substr = function(string) {
        if(string) return string.substring(0, 2);
    }
});