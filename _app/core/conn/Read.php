<?php
    namespace core\conn;

    class Read extends Conn{

        private $select;    # Query de consulta
        private $places;    # Valores dos termos
        private $result;     # Verifica o cadastro

        // PDO Statement
        private $read;

        // Var PDO
        private $conn;

        // PUBLIC METHODS

        # Seleciona apenas uma tabela
        public function exeRead($tabela, $termos = null, $parseString = null){
            if(!empty($parseString)){
                parse_str($parseString, $this->places); # Separa o $parseString em array
            }
            $this->select = "SELECT * FROM {$tabela} {$termos}";
            $this->Execute();

        }#endFunction

        # Seleciona uma ou mais tabelas
        public function fullRead($query, $parseString = null){
            $this->select = (string) $query;
            if (!empty($parseString)){
                parse_str($parseString, $this->places);
            }
            $this->Execute();
        }#endFunction

        # Retorna o resultado do cadastro
        public function getResult(){
            return $this->result;
        }#endFunction

        # Informa se há na tabela
        public function getRowCount(){
            return $this->read->rowCount();
        }#endFunction

        # Permite reescrita dos places
        public function setPlaces($parseString){
            parse_str($parseString, $this->places);
            $this->Execute();
        }#endFunction

        // PRIVATE METHODS

        # Cria a conexão
        private function Connect(){
            $this->conn = parent::getConn();
            $this->read = $this->conn->prepare($this->select); # Prepara a Query
            $this->read->setFetchMode(\PDO::FETCH_ASSOC);
        }#endFunction

        # Prepara a sintaxe se houver places
        private function getSyntax(){
            if ($this->places){
                foreach ($this->places as $vinculo => $valor){
                    if ($vinculo == 'limit' || $vinculo == 'offset'){
                        $valor = (int) $valor;
                    }
                    $this->read->bindValue(":{$vinculo}", $valor, (is_int($valor) ? \PDO::PARAM_INT : \PDO::PARAM_STR));
                }
            }
        }#endFunction

        # Pega a conexão e executa a query
        private function Execute(){
            $this->Connect();
            try{
                $this->getSyntax();
                $this->read->execute(); # Executa a query select
                $this->result = $this->read->fetchAll(); # As consultas vem como array
            } catch (\PDOException $e){
                $this->result = null;
                MSErro("Erro ao selecionar: {$e->getMessage()}", $e->getCode());
            }
        }#endFunction


    }