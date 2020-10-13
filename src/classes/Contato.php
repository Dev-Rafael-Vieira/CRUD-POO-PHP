<?php
    class Contato {
        protected $table = 'contatos';

        public function incluirContato($con, $cnpj, $nome_contato, $telefone){
            $stmt = $con->prepare("INSERT INTO $this->table (cnpj, nome_contato, telefone) VALUES (?, ?, ?)");
            $stmt->bindParam(1,$cnpj);
            $stmt->bindParam(2,$nome_contato);
            $stmt->bindParam(3,$telefone);
            $stmt->execute();
        }

        public function buscarContato($con, $nome, $cnpj){
            $sql = "SELECT * FROM $this->table WHERE nome_contato LIKE '%$nome%' OR cnpj LIKE '$cnpj' ";
            $rs = $con->query($sql);
            $finded[] = 0;
            while($row = $rs->fetch(PDO::FETCH_OBJ)){
                $object = new stdClass();
                $object->nome_contato = $row->nome_contato;
                $object->telefone = $row->telefone;
                $object->cnpj = $row->cnpj;
                $finded[] = $object;
            }
            if (count($finded) == 0 ){
                return $finded;
            }else{
                unset($finded[0]);
                return $finded;
            }

        }

        public function excluirContato($con, $telefone){
            $delete = $con->prepare("DELETE FROM $this->table WHERE telefone LIKE '$telefone'");
            $delete->bindValue("telefone", $telefone);
            $delete->execute();
            if($delete->rowCount()){
                echo "Deletou com sucesso";
                } else {
                    echo "Erro ao deletar";
                }
        }
    }