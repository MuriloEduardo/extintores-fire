app.controller('usuariosCtrl', function($scope, $http, $timeout){

    $scope.loadLogin = false;

	$scope.logar = function(dados){

        if(!dados) return false;

        $scope.loadLogin = true;

        $http.post('admin/endpoints/controllers/usuarios/logar.php', dados).success(function(response){

            $timeout(function() {
                $scope.ErroLogin = undefined;
                $scope.loadLogin = false;
            }, 0);

            if(response=='0'){
                // Email e/ou senha incorretos!
                $timeout(function() {
                    $scope.ErroLogin = true;
                }, 0);
            }else{
                localStorage.setItem('user', JSON.stringify({user: response}))
                location.href = './admin';
                $timeout(function() {
                    $scope.ErroLogin = false;
                }, 0);
            }
        }).error(function(error) {
            alert('Ops! Aconteceu alguma coisa errada :/');
        });
    }
});