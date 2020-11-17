<!DOCTYPE html>
<?php
    require("Controller/VigilantController.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Editar Vigilante</title>
    </head>
    <body>
        <div class="row">
        <div class="col-sm-2"></div> 
        <div class="col-sm-8">
            <div class="box">
                <h3>Editar Vigilante</h3>
                    <?php 
                        if(isset($_GET['id'])){
                            $id=$_GET['id'];
                            $vigilantController=new VigilantController();
                            $vigilant=$vigilantController->getVigilantById($id);
                        }
                    ?>
                <form id="form" action=<?php echo("/?idEdit=".$id);?> method="post">
                    Nome: <input type="text" name="editName" value="<?php echo($vigilant->getName()); ?>" >
                    Matrícula: <input type="text" name="editRegist" value="<?php echo($vigilant->getRegistration()); ?>" >
                    Equipe: <input type="text" name="editIdTeam" value="<?php echo($vigilant->getIdTeam()); ?>" >
                    <input type="submit" name="editVigilant" value="Enviar"><br>
                </form>
                <br><br>
                <a href="/">Voltar a página inicial</a>
            </div>
        </div>
         <div class="col-sm-2"></div> 
    </body>
</html>
