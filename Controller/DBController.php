<?php
    require("Model/DB.php");
    class DBController extends DB {
         
    public function connect(){
            $this->setConnection(mysqli_connect("localhost:3306","root",""));
            if(!$this->getConnection())
		die("impossiível conectar ".mysqli_connect_error($this->getConnection()));
            
            mysqli_set_charset($this->getConnection(),"utf8");
	}
	public function dbBase($name){
            $baseActive=mysqli_select_db($this->getConnection(),$name);
            if(!$baseActive){
                die("impossível conectar".mysqli_error($this->getConnection()));
            }
        }
	public function closeConnection(){
		mysqli_close($this->getConnection());
	}
       
    }
