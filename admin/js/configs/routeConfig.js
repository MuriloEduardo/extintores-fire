app.config(function ($routeProvider) {
    
    $routeProvider
    .when('/', {
        templateUrl: 'views/dashboard.html',
        controller: 'dashboardCtrl',
        resolve: {
            estoqueBaixo: function (Api){
                return Api.getEstoqueBaixo();
            }
        }
    })

    .when('/meus-dados', {
        templateUrl: 'views/meusdados.html',
        controller: 'meusdadosCtrl'
    })

    .when('/usuarios', {
        templateUrl: 'views/usuarios.html',
        controller: 'usuariosCtrl',
        resolve: {
            allUsuarios: function (Api){
                return Api.getAllUsuarios();
            }
        }
    })

    .when('/produtos', {
        templateUrl: 'views/produtos.html',
        controller: 'produtosCtrl',
        resolve: {
            allProdutos: function (Api){
                return Api.getAllProdutos();
            }
        }
    })

    .when('/clientes', {
        templateUrl: 'views/clientes.html',
        controller: 'clientesCtrl',
        resolve: {
            allClientes: function (Api){
                return Api.getAllClientes();
            }
        }
    })

    .when('/servicos', {
        templateUrl: 'views/servicos.html',
        controller: 'servicosCtrl',
        resolve: {
            allClientes: function (Api){
                return Api.getAllClientes();
            },
            allProdutos: function (Api){
                return Api.getAllProdutos();
            },
            allServicos: function (Api){
                return Api.getAllServicos();
            }
        }
    })

    .when('/logs', {
        templateUrl: 'views/logs.html',
        resolve: {
            allLogs: function (Api){
                return Api.getAllLogs();
            }
        }
    })

    .when('/logs/:id', {
        templateUrl: 'views/logs.html'
    })

    .otherwise({redirectTo: '/'});
});