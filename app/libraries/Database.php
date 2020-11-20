<?php
    /*
     * PDO Database class
     * Connect to DB
     * Create prepared statements
     * Bind values
     * Return rows and results 
     */

    class Database {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $password = DB_PASSWORD;
        private $dbname = DB_NAME;

        private $dbhandler;
        private $statement;
        private $error;

        public function __construct(){
            // Set Data Source Name (DSN)
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            // PDO instance
            try{
                $this->dbhandler = new PDO($dsn, $this->user, $this->password, $options);
            } catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Prepare statements with query
        public function query($sql){
            $this->statement = $this->dbhandler->prepare($sql);
        }
        // Bind values
        public function bind($parameter, $value, $type = null){
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;                    
                    case is_null($value):    
                        $type = PDO::PARAM_NULL;
                        break;                    
                    default:
                        $type = PDO::PARAM_STR;               
                }
            }
            $this->statement->bindValue($parameter, $value, $type);
        }

        // Execute prepared statement
        public function execute(){
            return $this->statement->execute();
        }

        // Get results set as an array of objects
        public function resultSet(){
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }

        // Get single record as object
        public function single(){
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }

        // Get row count
        public function rowCount(){
            return $this->statement->rowCount();
        }

        public function lastInsertedId(){
            return $this->dbhandler->lastInsertId();
        }

        public function beginTransaction(){
            return $this->dbhandler->beginTransaction();
        }

        public function commit(){
            return $this->dbhandler->commit();
        }

        public function rollback(){
            return $this->dbhandler->rollback();
        }

    }

?>