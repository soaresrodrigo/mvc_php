<?php
    namespace core\conn;
    use \PDO;
    use PDOException;

       abstract class Conn{

        private static $host = HOST;
        private static $pass = PASS;
        private static $user = USER;
        private static $dbsa = DBSA;

        // Variavel PDO
        private static $Conn = null;

         /**  Retorna um objeto PDO Singleton Pattern */
        public static function getConn() {
            return self::Conectar();
        }#endFunction

        private static function Conectar() {
        try {
            if (self::$Conn == null){
                $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbsa;
                $options = [ \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                self::$Conn = new \PDO($dsn, self::$user, self::$pass, $options);
            }
        } catch (\PDOException $e) {
            PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            die;
        }

        self::$Conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return self::$Conn;

    }#endFunction

}#endClass