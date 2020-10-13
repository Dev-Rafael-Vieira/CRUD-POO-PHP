<?php
    //conexão com o banco através do Pattern Singleton
    class PdoConnection{
 
        private static $instance;

        private function __construct(){
            // Impede a instanciação
        }

        private function __clone(){
            // Impede a clonagem 
        }

        private function __wakeup(){
            // Impede a utilização do Unserialize
        }

        //retorna um objeto PDO como uma instancia ativa
        public function getInstance($dbName, $serverName, $userName, $passName){

            if (!isset(self::$instance)) {// se não existir a instância
                try{
                    $db  = $dbName;
                    $server = $serverName;
                    $user   = $userName;
                    $pass = $passName;
                    $dsn    = "mysql:host={$server};dbname={$db};";

                    // Instânciando um novo objeto do tipo PDO informando o DSN e parâmetros de array
                    self::$instance = new \PDO($dsn, $user, $pass);

                    // Gerando uma excessão do tipo PDOException com o código de erro
                    self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                    return self::$instance;

                } catch (\PDOException $e) { 
                    return $e->getMessage();
                    exit();
                }
            } else {
                //se não retorna a própria instância
                return self::$instance;
            }
        }
    }

