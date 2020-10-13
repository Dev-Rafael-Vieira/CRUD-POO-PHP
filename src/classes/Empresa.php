<?php

    class Empresa {

        protected $table = 'empresas';

        public function findByEmpresa($con, $buscaEmpresa){
            $sql = "SELECT * FROM $this->table WHERE nome_empresa LIKE '%$buscaEmpresa%' OR cnpj LIKE '%$buscaEmpresa%' ";
            $rs = $con->query($sql);
            $finded[] = 0;
            while($row = $rs->fetch(PDO::FETCH_OBJ)){
                $object = new stdClass();
                $object->nome_empresa = $row->nome_empresa;
                $object->email = $row->email;
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

        public function validar_cnpj($cnpj)
        {
            $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
            
            // Valida tamanho
            if (strlen($cnpj) != 14)
                return false;
        
            // Verifica se todos os digitos são iguais
            if (preg_match('/(\d)\1{13}/', $cnpj))
                return false;	
        
            // Valida primeiro dígito verificador
            for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
            {
                $soma += $cnpj[$i] * $j;
                $j = ($j == 2) ? 9 : $j - 1;
            }
        
            $resto = $soma % 11;
        
            if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
                return false;
        
            // Valida segundo dígito verificador
            for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
            {
                $soma += $cnpj[$i] * $j;
                $j = ($j == 2) ? 9 : $j - 1;
            }
        
            $resto = $soma % 11;
        
            return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
        }

        public function cadastraEmpresa($con, $cnpj, $nome_empresa, $email){

            if ($this->validar_cnpj($cnpj) == true){
                $stmt = $con->prepare("INSERT INTO $this->table (cnpj, nome_empresa, email) VALUES (?, ?, ?)");
                $stmt->bindParam(1,$cnpj);
                $stmt->bindParam(2,$nome_empresa);
                $stmt->bindParam(3,$email);
                $stmt->execute();
            } else {
                echo 'cnpj inválido!';
            }

        }

        public function deletarEmpresa($con, $cnpj){

            $delete = $con->prepare("DELETE FROM $this->table WHERE cnpj LIKE '$cnpj'");
            $delete->bindValue("cnpj", $cnpj);
            $delete->execute();
            if($delete->rowCount()){
                echo "Deletou com sucesso";
                } else {
                    echo "Erro ao deletar";
                }
            
        }

        public function editarEmpresa($con, $cnpj, $nome_empresa, $email){
            $editar = $con->prepare("UPDATE $this->table SET email = ?, nome_empresa = ? WHERE cnpj = ?");
            $editar->execute([$email, $nome_empresa, $cnpj]);
            if($editar->rowCount() > 0){
                echo 'sucesso';
            } else {
                echo "erro";
            }
        }

    }