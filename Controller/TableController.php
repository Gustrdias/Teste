<?php
    require_once("DBController.php");
    class TableController {
    
     public function createTable(){
        try{
            $db=new DBController();
            $db->connect();
            $query = "CREATE DATABASE ".DB::getDBName();
            $resultSet=mysqli_query($db->getConnection(),$query);
            $db->dbBase(DB::getDBName());
            $this->createTeam($db);
            $this->createVigilant($db);
            $this->alterTableVigilant($db);
            $this->populateTeam($db);
        }catch(Exeption $e){
            $db->closeConnection();
            echo("erro exeption "+ $e);
            return;
          }
    }
    public function createTeam($db){
        $query = "CREATE TABLE IF NOT EXISTS `team` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `name` varchar(255) NOT NULL,
                    `workHours` int(11) NOT NULL,
                    `dayOff` int(11) NOT NULL,
                     `initHour` int(11) NOT NULL,
                     PRIMARY KEY (`id`)
             ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;";
        try{
            $resultSet=mysqli_query($db->getConnection(),$query);
        }catch(Exeption $e){
            $db->closeConnection();
            echo("erro exeption "+ $e);
            return;
        }
   }  
   public function createVigilant($db){
       $query = "CREATE TABLE IF NOT EXISTS `vigilant` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `registration` varchar(255) NOT NULL,
        `id_Team` int(11) NOT NULL,
        PRIMARY KEY (`id`),
        KEY `id_Team` (`id_Team`)
        ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";
        try{
            $resultSet=mysqli_query($db->getConnection(),$query);
        }catch(Exeption $e){
            $db->closeConnection();
            echo("erro exeption "+ $e);
            return;
        }
   }
   public function alterTableVigilant($db){
       $query = "ALTER TABLE `vigilant`
        ADD CONSTRAINT `vigilant_ibfk_1` FOREIGN KEY (`id_Team`) REFERENCES `team`
        (`id`) ON DELETE CASCADE ON UPDATE CASCADE;COMMIT;";
        try{
            $resultSet=mysqli_query($db->getConnection(),$query);
        }catch(Exeption $e){
            $db->closeConnection();
            echo("erro exeption "+ $e);
            return;
        }
   }
   public function populateTeam($db){
       $query = "INSERT INTO `team` (`id`, `name`, `workHours`, `dayOff`, `initHour`) VALUES
        (1, 'equipe 1', 12, 36, 0),(2, 'equipe 2', 12, 36, 12),(3, 'equipe 3', 12, 36, 0),
        (4, 'equipe 4', 12, 36, 12);";
        try{
            $resultSet=mysqli_query($db->getConnection(),$query);
        }catch(Exeption $e){
            $db->closeConnection();
            echo("erro exeption "+ $e);
            return;
        }
   }
   public function checkDBExist(){
        try{
            $db=new DBController();
            $db->connect();
          
            $query = "SHOW DATABASES LIKE '".DB::getDBName()."'";
            $resultSet=mysqli_query($db->getConnection(),$query);
            while($line=mysqli_fetch_array($resultSet,MYSQLI_ASSOC)){
                foreach($line as $ln)
                    if($ln == DB::getDBName()){
                        $db->closeConnection();
                        return true;
                    }
                }
            $db->closeConnection();
            return false;
             }catch(Exeption $e){
		$db->closeConnection();
		echo("erro exeption "+ $e);
		return;
            }
        }
}
