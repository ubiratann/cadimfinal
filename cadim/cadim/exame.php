<?php
    include 'autentication.php';
    include 'Conexao.php';

    $link = AbrirConexao();

    $ecg_id = $_GET["ecg_id"];


if ($link){
    $result = $link->query("SELECT * from ecg where ecg_id=$ecg_id");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
    }
}
?>
<html>
<head>

      <title>Cadim</title>
        <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Dosis&display=swap" rel="stylesheet"> 
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="all" href="_css/php.css" /> 
        


<script src="../js/jquery-3.4.1.min.js">
$(function(){

    var canvas=document.getElementById("canvas");
    var ctx=canvas.getContext("2d");

    var data=[
        <?php 
            echo file_get_contents("../sinais/ecg1.txt");
        ?>
    ];

    
    var x=0;

    var panAtX=250;

    var continueAnimation=true;
    animate();


    function animate(){

        if( x > data.length-1 ){return;}

        if(continueAnimation){
            requestAnimationFrame(animate);
        }

        if(++x<panAtX){

            ctx.moveTo(x-1,data[x-1]);
            ctx.lineTo(x,data[x]);
            ctx.stroke();

        }else{

            ctx.clearRect(0,0,canvas.width,canvas.height);

            ctx.beginPath();

            for(var xx=0;xx<panAtX;++xx){

                var y1=data[x-panAtX+xx-1];
                ctx.moveTo(xx-1,y1);             

                var y2=data[x-panAtX+xx];
                ctx.lineTo(xx,y2);

                ctx.stroke();
            }
        }
    }

  
    $("#stop").click(function(){continueAnimation=false;});
    $("#resume").click(function(){ctx.clearRect(0,0,canvas.width,canvas.height);continueAnimation=true;animate();});
    
});
</script>

</head>

<body>
<nav class="navbar navbar-expand-sm navbar-light justify-content-between" style="background-color: #474a51;">
    <button class="navbar-toggler " 
        type="button" 
        data-toggle="collapse" 
        data-target="#toglemenu1"  
        aria-expanded="false" 
        aria-label="Toggle navigation"
        >
      

      <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="toglemenu1">
          <ul class=" navbar-nav mr-auto" id="nav-bar1">
        <a class="navbar-brand" href="index.html">
            <img src="../images/icon.png" width="30" height="30" alt="">
          </a>
          <li class="nav-item">					
						<?php
							if($link){
						$result = $link->query("SELECT nome from medico where crm =".$_SESSION['login']);		
						$dado = 	$result->fetch_assoc();
						echo"<a class = 'nav-link active' style='color : white;' href='inicial.php'> Dr. ".utf8_encode($dado['nome'])."</a> ";
					}
					?>
          </li>
        </ul> 

        <ul class=" navbar-nav ml-auto justify-content-between" id="nav-bar2">
          <li class="nav-item " id="sair" >
              <a class="nav-link " href="login.html" style="color: white">SAIR</a>
          </li>
  </nav> 


    <div class="container" style="padding-top: 2rem; padding-bottom: 0;">
        <div class="row">   
            <div class="col-8" id="col8">
                <h3 class="text-center">Adicionar diagnostico</h3>
                    <form name="formularioDiagnostico" method="POST">
                        <textarea type="input" name="descricao" style ="width: 100%; height: 9rem;" placeholder="Preencha com o diagnóstico:"></textarea>
                            <legend>Selecione o Tipo de Cardiopatia:</legend>
                            <?php      
                                if ($link){
                                    $result = $link->query("SELECT * from cardiopatia order by card_descricao");
                                    if ($result->num_rows > 0) {
                                        echo "<select class ='custom-select' id='sel_card' required>";
                                        echo "<option value ='' disabled selected hiden>Tipo de Cardiopatia</option>";
                                        while($row = $result->fetch_assoc()) {
                                       
                                            echo "<option value='".$row['card_id']."'>".utf8_encode($row['card_descricao'])."</option>";
                                        }
                                    }
                                }
                            ?>
                        <input type="submit" name="submit" class="btn btn-secondary" id="submit_bt" style ="margin-top: 1rem;">
                            <?php
                                $tipo = filter_input(INPUT_POST, 'tipoCardiopatia');
                                $descricao = filter_input(INPUT_POST, 'descricao');
                                if (!empty($descricao)) {
                                    $sql = "INSERT INTO diagnostico (descricao,ecg_id,crm) VALUES ('".$descricao."', '".$ecg_id."', '".$_SESSION['login']."')";

                                    if ($link->query($sql) === TRUE) {
                                        echo "New record created successfully";
                                    } else {
                                        echo "Error: " . $sql . "<br>" . $link->error;
                                    }
                                }
                            ?>
                    </form>
            </div>
            
        
            <div class="col-4">
                <canvas id="canvas" width=300 height=300></canvas>
                <button id="stop" type="button" class="btn btn-danger ">Stop</button>
                <button id="resume" type="button" class="btn btn-success ">Resume</button>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 1rem; margin-bottom: 1rem;">
                <div class="row">   
                    <div class="col-8" id="col8">
                    <h3>Outros diagnosticos</h3>
                            <?php
                                if ($link){
                                    $result = $link->query("SELECT * from diagnostico where ecg_id=".$ecg_id);
                                    if ($result->num_rows) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "CRM: ".$row['crm']." <br>Descricao:".$row['descricao']."<br>";
                                        }
                                    }
                                }
                            ?>
                    </div>
                </div>
    </div>
        <!-- Fim do seu codigo -->
         <script src="../js/jquery-3.4.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="_js/script.js"></script>
        
        <footer class="page-footer font-small ">
            <!-- Copyright -->
            <div class="footer-copyright text-center py-3" id="footer" style="margin-top: 1rem;">© Cadim
            </div>
            <!-- Copyright -->
        </footer>

</body>
</html>