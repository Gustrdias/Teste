<?php
    class DB{
        private static $DB_NAME="escalatrab";
        private $connection=null;
        
        public function __construct(){
            
        }
        public function getConnection(){
            return $this->connection;
        }
        public function setConnection($connection){
            $this->connection=$connection;
        }
        public static function getDBName(){
            return self::$DB_NAME;
        }
    }

