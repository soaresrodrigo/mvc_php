<?php
    namespace core\conn;

    class Delete extends Conn{

        private $tabela;
        private $termos;
        private $places;
        private $result;
        private $query;

        // PDOStatement
        private $delete;

        // PDO VAR
        private $conn;

        // PUBLIC METHODS

        public function exeDelete($tabela, $termos, $parseString){
            $this->tabela = (string) $tabela;
            $this->termos = (string) $termos;
            parse_str($parseString, $this->places);

            $this->getSyntax();
            $this->Execute();

        }#endFunction

        // PRIVATE METHODS

        # Cria a sintaxe da query
        private function getSyntax(){
            $this->query = "DELETE FROM {$this->tabela} {$this->termos}";
        }#endFunction

        # Cria a conexão com o banco
        private function Connect(){
            $this->conn = parent::getConn();
            $this->delete = $this->conn->prepare($this->query);
        }#endFunction

        # Pega a conexão, sintaxe e executa a query
        private function Execute(){
            $this->connect();
            try{
                $this->delete->execute($this->places); # Executa a query
                $this->result = true;
            } catch (\PDOException $e){
                $this->result = null;
                MSErro("<b>Erro ao deletar:</b> {$e->getMessage()}", $e->getCode());
            }
        }#endFunction

    }