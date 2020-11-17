<?php
    class ScaleController {
        private $teamOneScale=Array("1"=>1,"2"=>2,"3"=>1,"4"=>2,"5"=>2
            ,"6"=>1,"7"=>1,"8"=>2,"9"=>1,"10"=>1,"11"=>2,"12"=>2);
        private $teamTwoScale=Array("1"=>2,"2"=>1,"3"=>2,"4"=>1,"5"=>1
            ,"6"=>2,"7"=>2,"8"=>1,"9"=>2,"10"=>2,"11"=>1,"12"=>1);
        
        public function nextScales($workHours,$dayOff,$initDay,$date=0){
            $workdays=Array();
            $hours=0;
            for($day=$initDay;$day <= $this->getMonthDays($date);$day++){
               array_push($workdays,$day);
               $hours+=$workHours+$dayOff;
                while($hours > 24){
                    $day++;
                    $hours-=24;
                    if($hours == 24)
                        $hours=0;
                }
            }
            return $workdays; 
        }
       
        public function getMonthDays($date=0){
            return date('t', mktime(0, 0, 0, date("m")+$date, 1,date("Y")));
        }
        public function calendarNextMonth($idTeam,$teamController,$date=0){
            $actualDay=date("d");
            $monthDay= $this->getMonthDays($date);
            $oneWeek=7;
            $nextMonth=1;
            $this->drawCalendar($idTeam,$teamController);
            if($monthDay - $actualDay <= $oneWeek ){
               $this->drawCalendar($idTeam,$teamController,$nextMonth);
            }           
        }
        public function getInitDay($idTeam){
            if($idTeam < 3){
                $team=$this->getTeamOne();
                return $team[date('m')];
            }
           $team=$this->getTeamTwo();
           return $team[date('m')];
        }
        public function drawDate($date=0,$idTeam){
            if($date ==0)
                echo("<h2>Calendário</h2>");
            if($idTeam == 1 || $idTeam == 3){
                echo("<p>Início 00:00h - Término 12:00h</p>");
            }else{
                echo("<p>Início 12:00h - Término 00:00h</p>");
            }
            echo("<p>".date('M', mktime(0, 0, 0, date("m")+$date, 1,date("Y")))."</p> 
           <table class='table table-bordered'>
             <thead>
               <tr>
                 <th>Dom</th>
                 <th>Seg</th>
                 <th>Ter</th>
                  <th>Qua</th>
                 <th>Qui</th>
                 <th>Sex</th>
                  <th>Sab</th>
               </tr>
             </thead>
             <tbody>
                 <tr>");
        
        }
        public function drawCalendar($idTeam,$teamController,$date=0){
            $this->drawDate($date,$idTeam);
            $team=$teamController->getTeamDB($idTeam);
            $listDays= $this->nextScales($team->getWorkHours(), $team->getDayOff(), $this->getInitDay($idTeam),$date);
            
            $nameDayOne=date('w', mktime(0, 0, 0, date("m")+$date, 1,date("Y")));
            $jumpRow=1;
            $weekyCalendar=0;
            while($weekyCalendar != $nameDayOne){
                echo("<td></td>");
                $jumpRow++;
                $weekyCalendar++;
            }
            for($day=1;$day <= $this->getMonthDays($date);$day++){
                if($jumpRow > 7){
                   $jumpRow=1;
                   echo("</tr><tr>");
                }
                if(in_array($day, $listDays)){
                    echo("<td style='background-color:red'>".$day."</td>");
                }else{
                    echo("<td>".$day."</td>");
                }
                $jumpRow++;
            }
            echo( "</tbody>
           </table>");
        }
      public function getTeamOne(){
          return $this->teamOneScale;
      }
       public function getTeamTwo(){
          return $this->teamTwoScale;
      }
}
