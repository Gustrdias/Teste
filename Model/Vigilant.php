<?php
    class Vigilant{
        private $idTeam;
        private $id;
        private $name;
	private $registration;
	
	public function __construct(){
           
	}
        public function getName(){
            return $this->name;
        }
        public function setName($name){
            $this->name=$name;
        }
        public function getRegistration(){
            return $this->registration;
        }
        public function setRegistration($registration){
            $this->registration=$registration;
        }
         public function getIdTeam(){
            return $this->idTeam;
        }
        public function setIdTeam($idTeam){
            $this->idTeam=$idTeam;
        }
         public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id=$id;
        }
    }
