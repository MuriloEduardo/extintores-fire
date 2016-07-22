app.controller('meusdadosCtrl', function($scope, Api, $rootScope){

	$rootScope.loadViews = false;

	$scope.dadosUsuario = JSON.parse(window.localStorage.getItem('user')).user;
	$scope.perfil = {
		Nome : $scope.dadosUsuario.Nome,
		Login : $scope.dadosUsuario.Login,
	};

	$scope.substr = function(string) {
        if(string) return string.substring(0, 2);
    }

    $scope.tipoUser = function(tpUser) {
    	return tpUser ? 'Administrador' : 'Usuário';
    }
});