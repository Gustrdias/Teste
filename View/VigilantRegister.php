<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <title>Cadastro Vigilante</title>
    </head>
    <body>
        <div class="row">
            <div class="col-sm-2"></div> 
            <div class="col-sm-8">
                <div class="box">
                    <h3>Cadastro Vigilante</h3>
                     <?php

                            if(isset($_GET['idTeam'])){
                                $id=$_GET['idTeam'];
                            }else{
                                $id=1;
                            }
                     ?>
                     <form id="form" action="/" method="post">
                        Nome: <input type="text" name="cadName" >
                        Matrícula: <input type="text" name="cadRegist" >
                        Equipe: <input type="text" name="cadEquip" value=" <?php echo $id;?>" >
                        <input type="submit" name="cadVigilant" value="Enviar"><br>
                    </form>
                    <br><br>
                    <a href="/">Voltar a página inicial</a>
                </div>
             </div>  
             <div class="col-sm-2"></div> 
        </div>
    </body>
</html>
