<?php
    namespace core\conn;

    class Create extends Conn{

        private $tabela;
        private $dados;
        private $result;
        private $query;

        // PDOStatement
        private $create;

        // Var PDO
        private $conn;

        // PUBLIC METHODS

        public function exeCreate($tabela, array $dados){
            $this->tabela = (string) $tabela;
            $this->dados = $dados;

            $this->getSyntax();
            $this->Execute();

        }#endFunction

        public function getResult(){
            return $this->result;
        }#endFunction

        // PRIVATE METHODS

        # Cria a sintaxe da query para o Prepared Statement
        private function getSyntax(){
            $fields = implode(',', array_keys($this->dados)); # Separa os campos da tabela
            $places = ':' . implode(', :', array_keys($this->dados)); # Cria as variaves PDO
            $this->query = "INSERT INTO {$this->tabela} ({$fields}) VALUES ({$places})";
        }#endFunction

        # Inicia a conexão
        private function Connect(){
            $this->conn = parent::getConn(); # Inicia a conexão
            $this->create = $this->conn->prepare($this->query); # Inicia a Query
        }#endFunction

        # Pega a conexão e executa a query
        private function Execute(){
            $this->Connect(); # Inicia a conexão
            try{
                $this->create->execute($this->dados); # Se o nome da tabela for igual a variavel do PDO, o $this->Create transforma os Dados em bindValue
                $this->result = $this->conn->lastInsertId(); # Ultimo valor inserido na Tabela
            } catch (\PDOException $e){
                $this->result = null;
                MSErro("Erro ao cadastrar: {$e->getMessage()}", $e->getCode());
            }
        }#endFunction

    }#endClass