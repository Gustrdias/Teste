<!DOCTYPE html>
 <?php
        require("Controller/ScaleController.php");
        require("Controller/TeamController.php");
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title></title>
    </head>
    <body>
        <div class="container">
            <?php
                if(isset($_GET['idTeam'])){
                    $id=$_GET['idTeam'];
                    $teamController=new TeamController();
                    $scaleController=new ScaleController();
                    $scaleController->calendarNextMonth($id,$teamController);
                    echo("<a href='/'>Página inicial</a>");
                }else{
                    echo("<p>Equipe não selecionada</p><a href='/'>Voltar a página inicial</a>");
                }
              ?>
        </div>
    </body>
</html>
