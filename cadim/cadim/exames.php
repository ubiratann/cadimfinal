<?php
		include 'autentication.php';
		include 'Conexao.php';
		$link = AbrirConexao();

		$pac_id = $_GET["pac_id"];
?>
<style type="text/css">
	div.exame_ecg{
		border: 5px solid red;
		width: 80px;
		height: 50px
		border-style: solid;
		background-image: url("../images/imagemExame.png");
		opacity: 0.5;
	}
	div.exame_ecg:hover{
		opacity: 1.0;
	}

</style>
<head>
	<title>Cadim</title>
		<meta charset="utf-8">   
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">  
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" media="all" href="_css/php.css?version=11" /> 
		<link href="https://fonts.googleapis.com/css?family=Dosis&display=swap" rel="stylesheet"> 
		
	<script type>
	jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    	});
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



	<table class="table table-hover" id="tbecg">
		<thead class ="thead-dark">
			<tr>
				<th colspan="4" class="text-center">Tabela de ECGS</th>
			</tr> 
		</thead>
		<thead class="thead-dark text-center">
			
			<tr>
			<th scope="col"></th>
			<th scope="col">ECG ID</th>
			<th scope="col">Data do ECG</th>
			<th scope="col">Hora do ECG</th>
			</tr>	
		</thead>
		<tbody>

		<?php 
		
			if ($link){
				$result = $link->query("SELECT data_hora, ecg_id from ecg where pac_id = ".$pac_id." 	order by data_hora	 desc");

				
						
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {

						echo'<tr onclick="window.location.assign(';
						echo"'exame.php?ecg_id=".$row['ecg_id']."');";
						echo'">';
						echo"
							<th class='text-center' scope='row'></th>
							<td class='text-center' id='td'>".$row["ecg_id"]."</td>
							<td class='text-center' id='td'>".substr($row["data_hora"], 0,-8) ."</td>
							<td class='text-center' id='td'>".substr($row["data_hora"], -8) ."</td>
							</a></tr> ";
					}
				}
			}
		?>
		</tbody>
			
	</table>

	
</body>