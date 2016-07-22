app.controller('servicosCtrl', function($scope, allClientes, allProdutos, allServicos, Api, $filter, $timeout, $rootScope){

    $rootScope.loadViews = false;

    $scope.servicos = allServicos.data;
    $scope.clientes = allClientes.data;
    $scope.produtos = allProdutos.data;

    $scope.linhasServicos = [{idLinha: 0}];
	$scope.resNewUser = false;
    $scope.editaServico = false;
    $scope.valorTotal = 0;
    $scope.dadosClienteAtual = {Foto: 'no-image.png'};

    var parseCurrency = function(num) {
        return parseFloat(num.replace( /,/g, ''));
    }

	$scope.toggleNewUser = function(toggle) {
        if(toggle){
            $scope.newUserOpen = true;
        }else{
            $scope.newUserOpen = false;
            resetForm()
        }
        $scope.resNewUser = undefined;
        $scope.editaPrdt = false;
        delete $scope.servicoForm;
    }

    $scope.clienteServico = function(servico) {
    	for (var i=0;i<$scope.clientes.length;i++) {
    		if(servico == $scope.clientes[i]['Id_Cliente']){
                $scope.dadosClienteAtual = $scope.clientes[i];
    		}
    	}
    	$scope.passoDoisServico = true;
    }

    $scope.addLinhaServicos = function(index, id_linha) {
        if($scope.linhasServicos.slice(-1)[0].idLinha == id_linha){
            $scope.linhasServicos.push({idLinha: index + 1});
        }
    }

    $scope.removeLinha = function(linha, idx) {
        $scope.linhasServicos.splice(idx, 1);
        delete linha['item_' + idx];
        $scope.somaLinha();
    }

    $scope.editarServicos = function(servico) {
        Api.editaServico(servico).success(function(response) {
            if(response.status){
                $scope.servicos.push(angular.copy(servico));
                delete $scope.servicoForm;
                $scope.servicosFormForm.$setPristine();
            }
        });
    }

    $scope.somaLinha = function() {
        //
        // Valor total da ordem de serviço inteira
        //
        var valorTotalOrdemServico = 0;

        angular.forEach($scope.servicoForm.ItensServico, function(obj, key) {
            if(obj.Quant && obj.Valor){
                valorTotalOrdemServico += obj.Quant * parseCurrency(obj.Valor);
                $scope.valorTotal = valorTotalOrdemServico;
                $scope.servicoForm.Valor_Total = valorTotalOrdemServico;
            }
        });
    }

    var resetForm = function() {
        $timeout(function() {
            $scope.passoDoisServico = false;
            $scope.dadosClienteAtual = {Foto: 'no-image.png'};
            $scope.valorTotal = 0;
            $scope.linhasServicos = [{idLinha: 0}];
            $scope.send = undefined;
        }, 0);
    }

    $scope.cadastrar = function (servico, valid) {
        if(!valid)return false;
        Api.saveServicos(servico).success(function (response) {
            
            single_object = $filter('filter')($scope.clientes, function (result) {
                return result.Id_Cliente === servico.Id_Cliente;
            })[0];

            $scope.resNewUser = response;

            if(response.status){
                $scope.servicos.push(angular.copy(single_object));
                delete $scope.servicoForm;
                $scope.servicosFormForm.$setPristine();

                resetForm();
            }
        }).error(function(response) {
            alert('Aconteceu um problema: ' + response);
        });
    };

    $scope.OpenEditarServicos = function(servico, idx) {
        $scope.newUserOpen = true;
        $scope.editaServico = true;
        $scope.servicosForm = servico;
    }

    $scope.excluirServicos = function (id_servico, idx) {
        var certeza = confirm("Você tem certeza?");
        if(certeza){
            Api.deleteServico(id_servico).success(function (response) {
                $scope.servicos.splice(idx, 1);
            }).error(function(response) {
                alert('Aconteceu um problema: ' + data);
            });
        }
    };
});