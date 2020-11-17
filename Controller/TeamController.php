<?php
    require('Model/Team.php');
    require("DBController.php");
    class TeamController extends Team {
       
         public function checkTeamDB($name,$workHours,$dayOff,$initHours){
            $this->setWorkHours($workHours);
            $this->setDayOff($dayOff);
            $this->setInitHours($initHours);
            $db=new DBController();
            $query="SELECT * FROM `team` WHERE 1";
          
            try{
		$db->connect();
		$db->dbBase(DB::getDBName());
		$this->setName(mysqli_real_escape_string($db->getConnection(),$name));
                $resultSet=mysqli_query($db->getConnection(),$query);
                while($line=mysqli_fetch_array($resultSet,MYSQLI_ASSOC)){
                    if($line['name'] == $this->getName()){
			echo("<p>Nome de equipe já cadastrada no banco de dados</p><br>");
			$db->closeConnection();
                        return;
                    }
                }
                $this->addTeamDB($db);
            }catch(Exeption $e){
		$db->closeConnection();
		echo("erro exeption "+ $e);
		return;
            }
        }
        public function addTeamDB($db){
           try{
                $db=new DBController();
                $db->connect();
                $db->dbBase(DB::getDBName());
                $query="INSERT INTO `team`(`name`,`workHours`,`dayOff`,`initHour`) "
                        . "VALUES ('".$this->getName()."',".$this->getWorkHours().",".$this->getDayOff().",".$this->getInitHours().")";
		$result=mysqli_query($db->getConnection(), $query);
		$db->closeConnection();
		echo("<div class='alert'>Dados enviados</div>");		
				
            }catch(Exeption $e){
		$db->closeConnection();
		echo("erro exeption "+$e);
		return;
            }	
        }
        public function deleteTeamDB($id){
             try{
                $db=new DBController();
                $db->connect();
                $db->dbBase(DB::getDBName());
                $query="DELETE FROM `team` WHERE id=".$id;
                $result=mysqli_query($db->getConnection(), $query);
                $db->closeConnection();
              }catch(Exeption $e){
		$db->closeConnection();
		echo("erro exeption "+$e);
		return;
            }
        }
        public function getTeamDB($idTeam){
            $db=new DBController();
            $query="SELECT * FROM `team` WHERE id=".$idTeam;
            $team=new Team();
            try{
		$db->connect();
		$db->dbBase(DB::getDBName());
                $resultSet=mysqli_query($db->getConnection(),$query);
                while($line=mysqli_fetch_array($resultSet,MYSQLI_ASSOC)){
                    $team->setDayOff($line["dayOff"]);
                    $team->setInitHours($line["initHour"]);
                    $team->setWorkHours($line["workHours"]);
                }
               return $team;
            }catch(Exeption $e){
		$db->closeConnection();
		echo("erro exeption "+ $e);
		return;
            }
        }
        
    }
