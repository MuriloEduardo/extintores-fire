app.controller('produtosCtrl', function($scope, Api, allProdutos, $rootScope){

    $rootScope.loadViews = false;

	$scope.produtos = allProdutos.data;
    $scope.resNewUser = false;
    $scope.editaPrdt = false;

	$scope.excluirProdutos = function (id_produto, idx) {
        var certeza = confirm("Você tem certeza?");
        if(certeza){
            Api.deleteProduto(id_produto).success(function (response) {
                $scope.produtos.splice(idx, 1);
            }).error(function(response) {
                alert('Aconteceu um problema: ' + data);
            });
        }
    };

    $scope.toggleNewUser = function(toggle) {
        if(toggle){
            $scope.newUserOpen = true;
        }else{
            $scope.newUserOpen = false;    
        }
        $scope.resNewUser = undefined;
        $scope.editaPrdt = false;
        delete $scope.produtoForm;
    }

    $scope.OpenEditarProdutos = function(produto, idx) {
        $scope.newUserOpen = true;
        $scope.editaPrdt = true;
        $scope.produtoForm = produto;
    }

    $scope.editarProdutos = function(produto) {
        Api.editaProduto(produto).success(function(response){
            if(response.status){
                delete $scope.produtoForm;
                $scope.newUserForm.$setPristine();
            }
            $scope.resNewUser = response;
        });
    }

    $scope.substr = function(string) {
        if(string) return string.substring(0, 2);
    }

    $scope.cadastrar = function (produto, valid) {
        if(!valid)return false;
        Api.saveProdutos(produto).success(function (response) {
            if(response.status){
                $scope.produtos.push(angular.copy(produto));
                delete $scope.produtoForm;
                $scope.newUserForm.$setPristine();
            }
            $scope.resNewUser = response;
        }).error(function(response) {
            alert('Aconteceu um problema: ' + response);
        });
    };
});