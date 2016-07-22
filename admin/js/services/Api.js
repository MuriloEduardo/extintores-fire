app.factory('Api', function($http){
	
	// Dashboard
    var _getEstoqueBaixo = function() {
        return $http.get('./endpoints/controllers/dashboard/listarEstoqueBaixo.php');
    };

    // Usuarios
    var _getAllUsuarios = function() {
        return $http.get('./endpoints/controllers/usuarios/listarTodos.php');
    };

	var _saveUsuario = function(usuario) {
        return $http.post('./endpoints/controllers/usuarios/cadastrar.php', usuario);
    };

    var _editaUsuario = function(usuario) {
        return $http.put('./endpoints/controllers/usuarios/editar.php', usuario);
    };

	var _deleteUsuario = function(id) {
        return $http.delete('./endpoints/controllers/usuarios/delete.php', {
            data: {id: id}
        });
    };

    // Produtos
    var _saveProdutos = function(produto) {
        return $http.post('./endpoints/controllers/produtos/cadastrar.php', produto);
    };

    var _getAllProdutos = function() {
    	return $http.get('./endpoints/controllers/produtos/listarTodos.php');	
    }

    var _deleteProduto = function(id) {
        return $http.delete('./endpoints/controllers/produtos/delete.php', {
            data: {id: id}
        });
    };

    var _editaProduto = function(produto) {
        return $http.put('./endpoints/controllers/produtos/editar.php', produto);
    };

    // Clientes
    var _getAllClientes = function() {
        return $http.get('./endpoints/controllers/clientes/listarTodos.php');
    };

    var _deleteCliente = function(id) {
        return $http.delete('./endpoints/controllers/clientes/delete.php', {
            data: {id: id}
        });
    };

    var _editaCliente = function(produto) {
        return $http.put('./endpoints/controllers/clientes/editar.php', produto);
    };

    // Serviços
    var _saveServicos = function(servico) {
        return $http.post('./endpoints/controllers/servicos/cadastrar.php', servico);
    };

    var _getAllServicos = function() {
        return $http.get('./endpoints/controllers/servicos/listarTodos.php');  
    }

    var _deleteServico = function(id) {
        return $http.delete('./endpoints/controllers/servicos/delete.php', {
            data: {id: id}
        });
    };

    var _editaServico = function(servico) {
        return $http.put('./endpoints/controllers/servicos/editar.php', servico);
    };

    // Logs
    var _getAllLogs = function() {
        return $http.get('./endpoints/controllers/logs/listarTodos.php');
    };

    var _getLimitLogs = function() {
        return $http.get('./endpoints/controllers/logs/listarLimit.php');
    };

	return {
		// Dashboard
        getEstoqueBaixo: _getEstoqueBaixo,

        // Usuarios
		getAllUsuarios: _getAllUsuarios,
		deleteUsuario: _deleteUsuario,
		editaUsuario: _editaUsuario,
		saveUsuario: _saveUsuario,
		
        // Produtos
		saveProdutos: _saveProdutos,
		getAllProdutos: _getAllProdutos,
		deleteProduto: _deleteProduto,
        editaProduto: _editaProduto,

        // Clientes
        // saveCliente no propio controller
        getAllClientes: _getAllClientes,
        deleteCliente: _deleteCliente,
        editaCliente: _editaCliente,

        // Servicos
        saveServicos: _saveServicos,
        getAllServicos: _getAllServicos,
        deleteServico: _deleteServico,
        editaServico: _editaServico,

        // Logs
        getAllLogs: _getAllLogs,
        getLimitLogs: _getLimitLogs
	}
});