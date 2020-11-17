<?php
    require ("Model/Vigilant.php");
    require("DBController.php");
    class VigilantController extends Vigilant{
       
        public function checkVigilantDB($name,$registration,$idTeam){
            $this->setIdTeam($idTeam);
            $db=new DBController();
            $query="SELECT * FROM `vigilant` WHERE 1";
           
            try{
		$db->connect();
		$db->dbBase(DB::getDBName());
		$this->setName(mysqli_real_escape_string($db->getConnection(),$name));
		$this->setRegistration(mysqli_real_escape_string($db->getConnection(),$registration));
                $resultSet=mysqli_query($db->getConnection(),$query);
                while($line=mysqli_fetch_array($resultSet,MYSQLI_ASSOC)){
                    if($line['registration'] == $registration){
			echo("<div style=' background-color: red; color: white;'>
                            <span>&times;</span> 
                               Matricula já cadastrada no banco de dados
                            </div>");
			$db->closeConnection();
                        return;
                    }
                }
               $this->addVigilantDB($db);
                
            }catch(Exeption $e){
		$db->closeConnection();
		echo("erro exeption "+ $e);
		return;
            }
        }
        public function addVigilantDB($db){
           try{
               if(!is_numeric($this->getIdTeam())){
                   echo("<div style=' background-color: red; color: white;'>
                            <span>&times;</span> 
                               Utilize apenas numeros para a equipe(1-4)
                            </div>");
               }
                $db=new DBController();
                $db->connect();
                $db->dbBase(DB::getDBName());
                $query="INSERT INTO `vigilant`(`name`,`registration`,`id_Team`) VALUES "
                        . "('".$this->getName()."','".$this->getRegistration()."',".$this->getIdTeam().")";
		$result=mysqli_query($db->getConnection(), $query);
		$db->closeConnection();
		echo("<div style=' background-color: green; color: white;'>
                <span>&times;</span> 
                    Dados adicionado com sucesso
                </div>");		
				
            }catch(Exeption $e){
		$db->closeConnection();
		echo("erro exeption "+$e);
		return;
            }	
        }
        public function editVigilantDB($name,$registration,$idTeam,$id){
            try{
                $db=new DBController();
                $db->connect();
                $db->dbBase(DB::getDBName());
                $query="UPDATE `vigilant` SET `name`='".$name."',`registration`='".$registration."',`id_Team`=".$idTeam." WHERE id=".$id;
                $result=mysqli_query($db->getConnection(), $query);
                $db->closeConnection();
             }catch(Exeption $e){
		$db->closeConnection();
		echo("erro exeption "+$e);
		return;
            }
        }
        
        public function deleteVigilant($id){
             try{
               $db=new DBController();
               $db->connect();
               $db->dbBase(DB::getDBName());
               $query="DELETE FROM `vigilant` WHERE id=".$id;
               $result=mysqli_query($db->getConnection(), $query);
               $db->closeConnection();
             }catch(Exeption $e){
		$db->closeConnection();
		echo("erro exeption "+$e);
		return;
            }
        }
        public function getVigilantById($idVigilant){
            $vigilant=new Vigilant();
            $db=new DBController();
            $query="SELECT * FROM `vigilant` WHERE id=".$idVigilant;
           
            try{
		$db->connect();
		$db->dbBase(DB::getDBName());
		$resultSet=mysqli_query($db->getConnection(),$query);
                while($line=mysqli_fetch_array($resultSet,MYSQLI_ASSOC)){ 
                    $vigilant->setName($line["name"]);
                    $vigilant->setRegistration($line["registration"]);
                    $vigilant->setIdTeam($line["id_Team"]);
                    $vigilant->setId($line["id"]);
                }
                $db->closeConnection();
                return $vigilant;
            }catch(Exeption $e){
		$db->closeConnection();
		echo("erro exeption "+$e);
		return;
            }
        }
        public function getAllByTeam($idTeam){
            $listVigilants=Array();
            $vigilant=new Vigilant();
            $db=new DBController();
            $query="SELECT * FROM `vigilant` WHERE id_Team=".$idTeam;
           
            try{
		$db->connect();
		$db->dbBase(DB::getDBName());
		$resultSet=mysqli_query($db->getConnection(),$query);
                while($line=mysqli_fetch_array($resultSet,MYSQLI_ASSOC)){ 
                    $vigilant->setName($line["name"]);
                    $vigilant->setRegistration($line["registration"]);
                    $vigilant->setIdTeam($line["id_Team"]);
                    $vigilant->setId($line["id"]);
                    array_push($listVigilants,$vigilant);
                    $vigilant=new Vigilant();
                }
                $db->closeConnection();
                return $listVigilants;
            }catch(Exeption $e){
		$db->closeConnection();
		echo("erro exeption "+$e);
		return;
            }
        }
        public function showList($idTeam){
           echo("<table class='table table-bordered'>
                    <thead>
                        <tr>
                           <th>Nome</th>
                           <th>Matrícula</th>
                           <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>");
           foreach($this->getAllByTeam($idTeam) as $vigilant) {
               echo("<tr>
                        <td>".$vigilant->getName()."</td>
                        <td>".$vigilant->getRegistration()."</td>
                        <td><a href='/?idDel=".$vigilant->getId()."'>Delete </a>"
                       . "<a href='/VigilantEdit.php/?id=".$vigilant->getId()."'>Editar</a></td>
                    </tr>");
           }                
            echo(" </tbody>
                    </table>");                                      
        }
    }
