app.controller('logsCtrl', function($scope, allLogs){
	
	$scope.logs = allLogs.data;

	$scope.substr = function(string) {
        if(string) return string.substring(0, 2);
    }
});