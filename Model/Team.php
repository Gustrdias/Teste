<?php

    class Team{
        private $id;
        private $name;
        private $vigilants=Array();
        private $workHours;
        private $dayOff;
        private $initHours;
        
        public function setName($name){
            $this->name=$name;
        }
        public function getName(){
            return $this->name;
        }
        public function setVigilants($vigilants){
            $this->vigilants=$vigilants;
        }
        public function getVigilants(){
            return $this->vigilants;
        }
        public function setWorkHours($workHours){
            $this->workHours=$workHours;
        }
        public function getWorkHours(){
            return $this->workHours;
        }
        public function setDayOff($dayOff){
            $this->dayOff= $dayOff;
        }
        public function getDayOff(){
            return $this->dayOff;
        }
         public function setInitHours($initHours){
            $this->initHours=$initHours;
        }
        public function getInitHours(){
            return $this->initHours;
        }
    }
