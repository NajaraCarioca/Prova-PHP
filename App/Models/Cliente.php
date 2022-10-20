<?php
    namespace App\Models;

    class Cliente
    {
        private static $table = 'cliente';

        public static function select(int $id) {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'SELECT * FROM '.self::$table.' WHERE id = :id';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Nenhum cliente encontrado!");
            }
        }

        public static function selectAll() {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'SELECT * FROM '.self::$table;
            $stmt = $connPdo->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {                
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                throw new \Exception("Nenhum cliente encontrado!");
            }
        }

        public static function insert($data)
        {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'INSERT INTO '.self::$table.' (IdUsuario, DataHoraCadastro, Codigo, Nome, CPF_CNPJ, CEP, Logradouro,'. 
            'Endereco, Numero, Bairro, Cidade, UF, Complemento, Fone, LimiteCredito, Validade)'. 
            'VALUES (:iu, :dt, :co, :no, :cp, :ce, :lo, :en, :nu, :ba, :ci, :uf, :mp, :fo, :li, :va)';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':iu', $data['idusuario']);
            $stmt->bindValue(':dt', $data['dtcadastro']);
            $stmt->bindValue(':co', $data['codigo']);
            $stmt->bindValue(':no', $data['nome']);
            $stmt->bindValue(':cp', $data['cpf_cnpj']);
            $stmt->bindValue(':ce', $data['cep']);
            $stmt->bindValue(':lo', $data['endereco']);
            $stmt->bindValue(':en', $data['endereco']);
            $stmt->bindValue(':nu', $data['numero']);
            $stmt->bindValue(':ba', $data['bairro']);
            $stmt->bindValue(':ci', $data['cidade']);
            $stmt->bindValue(':uf', $data['uf']);
            $stmt->bindValue(':mp', $data['compl']);
            $stmt->bindValue(':fo', $data['fone']);
            $stmt->bindValue(':li', $data['limcredito']);
            $stmt->bindValue(':va', $data['validade']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Cliente inserido com sucesso!';
            } else {
                throw new \Exception("Falha ao inserir cliente!");
            }
        }
        public static function update($data, $id)
        {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'UPDATE '.self::$table.' SET IdUsuario = :iu, Codigo = :co, Nome = :no, CPF_CNPJ = :cp, CEP = :ce,'.
            'Logradouro = :lo, Endereco = :en, Numero = :nu, Bairro = :ba, Cidade = :ci, UF = :uf, Complemento = :mp, Fone = :fo,'.
            'LimiteCredito = :li, Validade = :va, update_at = current_timestamp() WHERE id = '.$id;
            $stmt = $connPdo->prepare($sql);            
            $stmt->bindValue(':iu', $data['idusuario']);
            $stmt->bindValue(':co', $data['codigo']);
            $stmt->bindValue(':no', $data['nome']);
            $stmt->bindValue(':cp', $data['cpf_cnpj']);
            $stmt->bindValue(':ce', $data['cep']);
            $stmt->bindValue(':lo', $data['endereco']);
            $stmt->bindValue(':en', $data['endereco']);
            $stmt->bindValue(':nu', $data['numero']);
            $stmt->bindValue(':ba', $data['bairro']);
            $stmt->bindValue(':ci', $data['cidade']);
            $stmt->bindValue(':uf', $data['uf']);
            $stmt->bindValue(':mp', $data['compl']);
            $stmt->bindValue(':fo', $data['fone']);
            $stmt->bindValue(':li', $data['limcredito']);
            $stmt->bindValue(':va', $data['validade']);
            //$stmt->bindValue(':id', $data['id']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Cliente alterado com sucesso!';
            } else {
                throw new \Exception("Falha ao alterar cliente!");
            }
        }
        public static function delete(int $id)
        {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);

            $sql = 'DELETE FROM '.self::$table.' WHERE id = :id';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Cliente deletado com sucesso!';
            } else {
                throw new \Exception("Falha ao deletar cliente!");
            }
        }
    }