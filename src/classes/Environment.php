<?php

    require_once '.' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

    //classe tem acesso as variaveis de conexão protegidas nas variaveis de ambiente
    class Environment{
        private $host;
        private $db;
        private $user;
        private $passworld;

        public function __construct(){

            $dotenv = Dotenv \ Dotenv::createImmutable 
            (__DIR__ . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . ''); //direcionado até .env
            $dotenv -> load ();
        
            $this->host = $_ENV['HOST_NAME'];
            $this->db = $_ENV['DB_NAME'];
            $this->user = $_ENV['USER_NAME'];
            $this->passworld = $_ENV['PW'];

            
        }
        
        //retorna um array com as variáveis de conexão ao o banco
        public function getEnvArray(){
            return array( 
                'host' => $this->host,
                'db' => $this->db,
                'user' => $this->user,
                'passworld' => $this->passworld
            );
                
            
        }
    }
 
