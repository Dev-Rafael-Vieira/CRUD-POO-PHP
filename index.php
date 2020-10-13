<?php
    spl_autoload_register(function ($class) {
        if (file_exists('src' . DIRECTORY_SEPARATOR .'classes'. DIRECTORY_SEPARATOR . ucfirst($class) . '.php')) {
            require_once 'src' . DIRECTORY_SEPARATOR .'classes'. DIRECTORY_SEPARATOR  . ucfirst($class) . '.php';
        }
    });

    //recebe um array com todos os parâmetros de comunicação com o DB 
    $db_vars = new Environment;
    $db_vars = $db_vars->getEnvArray();
    
    //converte os valores do array para variaveis isoladas
    $dbName = $db_vars['db'];
    $serverName = $db_vars['host'];
    $userName = $db_vars['user'];
    $passName = $db_vars['passworld'];

    //instância uma conexão com o banco
    $con = PdoConnection::getInstance($dbName, $serverName, $userName, $passName);



    $contato = new Contato;
    //$contato = $contato->excluirContato($con, '34353556' );
    //$contato = $contato->buscarContato($con, 'e', '78923456712' );
    //$contato = $contato->incluirContato($con, '0737877352', 'aline', '34353556');
    //print_r($contato);

    $empresa = new Empresa;
    //$empresa = $empresa->deletarEmpresa($con, '78923456712');
    //$empresa = $empresa->findByEmpresa($con, '7');
    //$empresa = $empresa->cadastraEmpresa($con, '11444777000161', 'coltex', 'coltex@coltex.com');
    //$empresa = $empresa->editarEmpresa($con, '11444777000161', 'coltex', 'coltex@coltex.com');

/*
    print_r($empresa);
    
    foreach($empresa as $data) {
        echo $data->nome_empresa.'---';
        echo $data->cnpj.'---';
     }

 */
