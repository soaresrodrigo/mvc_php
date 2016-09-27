<?php
    namespace core\conn;

    class Update extends Conn{

        private $tabela;
        private $dados;
        private $termos;
        private $places;
        private $result;
        private $query;

        // PDOStatement
        private $update;

        // VAR PDO
        private $conn;

        // PUBLIC METHODS

        public function exeUpdate($tabela, array $dados, $termos, $parseString){
            $this->tabela = (string) $tabela;
            $this->dados = $dados;
            $this->termos = (string) $termos;
            parse_str($parseString, $this->places);

            $this->getSyntax();
            $this->Execute();

        }#endFunction

        # Retorna o resultado do cadastro
        public function getResult(){
            return $this->result;
        }#endFunction

        # Informa se ocorreu alteração na tabela
        public function getRowCount(){
            return $this->update->rowCount();
        }#endFunction

        # Permite a reescrita dos places
        public function setPlaces($parseString){
            parse_str($parseString, $this->places);
            $this->getSyntax();
            $this->Execute();

        }#endFunction

        // PRIVATE METHODS

        # Cria a query
        private function getSyntax(){
            foreach ($this->dados as $key => $value){
                $places[] = $key . ' = :' . $key; # Transforma em variaves PDO
            }

            $places = implode(', ', $places); # Separa cada variavel por virgula
            $this->query = "UPDATE {$this->tabela} SET {$places} {$this->termos}"; # Cria a Query sem os valores

        }#endFunction

        # Realiza a conexão com o banco
        private function Connect(){
            $this->conn = parent::getConn();
            $this->update = $this->conn->prepare($this->query); # Prepara a query

        }#endFunction

        # Obtem a conexão, a syntax e executa a query
        private function Execute(){
            $this->Connect();

            try{
                $this->update->execute(array_merge($this->dados, $this->places));
                $this->result = true;
            } catch (\PDOException $e){
                $this->result = null;
                MSErro("<b>Erro ao atualizar:</b> {$e->getMessage()}", $e->getCode());
            }

        }#endFunction

    }