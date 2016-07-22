app.controller('clientesCtrl', function($scope, Upload, allClientes, Api){

	$scope.clientes = allClientes.data;
    $scope.editarCliente = false;
    $scope.newUserOpen = false;

    $scope.toggleNewUser = function(toggle) {
        if(toggle){
            $scope.newUserOpen = true;
        }else{
            $scope.newUserOpen = false;    
        }
        $scope.resNewUser = undefined;
        $scope.editarCliente = false;
        delete $scope.clienteForm;
    }

    $scope.OpenEditarClientes = function(cliente, idx) {
        $scope.newUserOpen = true;
        $scope.editarCliente = true;
        $scope.clienteForm = cliente;
    }

    $scope.editarClientes = function(cliente) {
        Upload.upload({
            url: 'endpoints/controllers/clientes/editar.php',
            data: cliente
        }).then(function (resp) {
            console.log('Success ' + resp.config.data.Foto.name + 'uploaded. Response: ' + resp.data);

            $scope.clientes.push(angular.copy(cliente));
            delete $scope.clienteForm;
            $scope.newUserForm.$setPristine();
        }, function (resp) {
            console.log('Error status: ' + resp.status);
        }, function (evt) {
            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
            console.log('progress: ' + progressPercentage + '% ' + evt.config.data.Foto.name);
        });
    }

    $scope.setBgImage = function (url) {
    	if(!url)
    		url = 'x.png'

		return { 'background-image': 'url(./upload/'+url+')' }
	}

    $scope.cadastrar = function (cliente, valid) {
        if(!valid)return false;

        Upload.upload({
            url: 'endpoints/controllers/clientes/cadastrar.php',
            data: cliente
        }).then(function (resp) {
            $scope.clientes.push(angular.copy(cliente));
            delete $scope.clienteForm;
            $scope.newUserForm.$setPristine();
            $scope.resNewUser = resp;
        });
    };

    $scope.excluirClientes = function (id_cliente, idx) {
        var certeza = confirm("Você tem certeza?");
        if(certeza){
            Api.deleteCliente(id_cliente).success(function (response) {
                $scope.clientes.splice(idx, 1);
            }).error(function(response) {
                alert('Aconteceu um problema: ' + data);
            });
        }
    };
});