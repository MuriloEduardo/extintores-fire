app.controller('usuariosCtrl', function($scope, $http, $location, allUsuarios, Api){

    $scope.usuarios = allUsuarios.data;
    $scope.resNewUser = false;
    $scope.tipoUsuarios = [{val: '2', desc: 'Usuário'},{val: '1', desc: 'Administrador'}];

    $scope.excluirUsuarios = function (id_usuario, idx) {
        var certeza = confirm("Você tem certeza?");
        if(certeza){
            Api.deleteUsuario(id_usuario).success(function (response) {
                $scope.usuarios.splice(idx, 1);
            }).error(function(response) {
                alert('Aconteceu um problema: ' + data);
            });
        }
    };

    $scope.closeNewUser = function() {
        $scope.newUserOpen = false; 
        $scope.resNewUser = undefined;
        delete $scope.userForm;
    }

    $scope.substr = function(string) {
        if(string) return string.substring(0, 2);
    }

    $scope.editaTipoUser = function(usuario) {
        Api.editaUsuario(usuario);
    }

    $scope.cadastrar = function (user, valid) {
        if(!valid)return false;
        Api.saveUsuario(user).success(function (response) {
            if(response.status){
                $scope.usuarios.push(angular.copy(user));
                delete $scope.userForm;
                $scope.newUserForm.$setPristine();
            }
            $scope.resNewUser = response;
        }).error(function(response) {
            alert('Aconteceu um problema: ' + response);
        });
    };
});