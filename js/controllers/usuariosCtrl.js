app.controller('usuariosCtrl', function($scope, $http, $timeout){

	$scope.logar = function(dados){
    	
    	if(!dados) return false;

        $http.post('admin/endpoints/controllers/usuarios/logar.php', dados).success(function(response){
            $timeout(function() {
                $scope.ErroLogin = undefined;
            }, 0);
            if(response=='0'){
                // Email e/ou senha incorretos!
                $timeout(function() {
                    $scope.ErroLogin = true;
                }, 0);
            }else{
                location.href = './admin';
                localStorage.setItem('user', JSON.stringify({user: response}))
                $timeout(function() {
                    $scope.ErroLogin = false;
                }, 0);
            }
        }).error(function(error) {
            alert('Ops! Aconteceu alguma coisa errada :/');
        });
    }
});