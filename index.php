<!DOCTYPE html>
<?php
       require("Controller/VigilantController.php");
       require("Controller/ScaleController.php"); 
       require("Controller/TableController.php");
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Escolha time</title>
</head>
<body>
    <?php

       $vigilantController=new VigilantController();
       $scaleController=new ScaleController();
       $tableController=new TableController();
       
      if(!$tableController->checkDBExist()){
          $tableController->createTable();
      }
       
       if(isset($_POST["cadVigilant"])){
            if(!empty($_POST["cadName"]) && !empty($_POST["cadRegist"])&& !empty($_POST["cadEquip"])){
                if($_POST["cadEquip"] > 4 || $_POST["cadEquip"] <=0){
                   echo("<p>Valor de equipe incorreto,utilize valores de 1 a 4</p>");
                }else{
                   $vigilantController->checkVigilantDB($_POST["cadName"],$_POST["cadRegist"],$_POST["cadEquip"]);
                }
            }
        }
        if(isset($_GET['idEdit'])){
            if(isset($_POST["editVigilant"])){
                if(!empty($_POST["editName"]) && !empty($_POST["editRegist"]) && !empty($_POST["editIdTeam"])){
                    $vigilantController->editVigilantDB($_POST["editName"],$_POST["editRegist"],
                          $_POST["editIdTeam"],$_GET['idEdit']);
                }
            }
        }
        if(isset($_GET['idDel'])){
            $vigilantController->deleteVigilant($_GET['idDel']);
        } 
         
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div> 
            <div class="col-sm-8">
               <h2>Equipes</h2>
                <ul class="nav nav-tabs">
                 <li class="active"><a data-toggle="tab" href="#equipe1">Equipe 1</a></li>
                 <li><a data-toggle="tab" href="#equipe2">Equipe 2</a></li>
                 <li><a data-toggle="tab" href="#equipe3">Equipe 3</a></li>
                 <li><a data-toggle="tab" href="#equipe4">Equipe 4</a></li>
                </ul>  
                <div class="tab-content">
                    <div id="equipe1" class="tab-pane  active">
                        <?php $vigilantController->showList(1);?>
                        <a href="/View/VigilantRegister/?idTeam=1">Adicionar Vigilante</a>
                       <div  style="text-align: center">
                           <a href="/ScaleCalendar/?idTeam=1">Calendario</a>
                       </div>
                    </div>
                    <div id="equipe2" class="tab-pane  ">
                        <?php $vigilantController->showList(2);?>
                        <a href="/View/VigilantRegister/?idTeam=2">Adicionar Vigilante</a>
                        <div  style="text-align: center">
                           <a href="/ScaleCalendar/?idTeam=2">Calendario</a>
                       </div>
                    </div>
                     <div id="equipe3" class="tab-pane ">
                        <?php $vigilantController->showList(3);?>
                        <a href="/View/VigilantRegister/?idTeam=3">Adicionar Vigilante</a>
                        <div  style="text-align: center">
                           <a href="/ScaleCalendar/?idTeam=3">Calendario</a>
                       </div>
                    </div>
                     <div id="equipe4" class="tab-pane  ">
                        <?php $vigilantController->showList(4);?>
                        <a href="/View/VigilantRegister/?idTeam=4">Adicionar Vigilante</a>
                        <div  style="text-align: center">
                           <a href="/ScaleCalendar/?idTeam=4">Calendario</a>
                       </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
         </div>   
    </div>
</body>
</html>