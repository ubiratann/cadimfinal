

<?php
include 'autentication.php';
include 'Conexao.php';

#echo '<img src="../images/imagens_medicos/'.$_SES SION['login'].'.jpeg" class="imagemMedico avatarMedico" >';
$nome ;
$link = AbrirConexao();
/*
if ($link){
	$result = $link->query("SELECT pac_id,nome from paciente order by nome,pac_id");

	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	    	echo "<a href='exames.php?pac_id=".$row["pac_id"]."'><img src='../images/imagens_pacientes/".$row["pac_id"].".jpeg' class='imagemPaciente'> </a>";
	        echo "id: " . $row["pac_id"]. " - Name: " . $row["nome"]."<br>";
	    }
	}
}*/
?>

<html>
	<head>
	<title>Cadim</title>
        <meta charset="utf-8">   <!-- Estilos customizados para este template -->
    		<link href="album.css" rel="stylesheet">
      	<meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">   
				<link href="../css/bootstrap.min.css" rel="stylesheet">

				<link href="https://fonts.googleapis.com/css?family=Dosis&display=swap" rel="stylesheet"> 
				<link rel="stylesheet" type="text/css" media="all" href="_css/php.css?version=11" /> 
				
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
						echo"<a class = 'nav-link active' style='color : white;'> Dr. ".utf8_encode($dado['nome'])."</a> ";
					}
					?>
          </li>
        </ul> 

        <ul class=" navbar-nav ml-auto justify-content-between" id="nav-bar2">
          <li class="nav-item " id="sair" >
              <a class="nav-link " href="login.html" style="color: white">SAIR</a>
          </li>
  </nav> 

	<main role="main">
	<section class="jumbotron text-center">

			<div class='album py-5 bg-light'>

			<div class="container ">
					<?php
					if($link){
						echo '<img class="avatarMedico" src="../images/imagens_medicos/'.$_SESSION['login'].'.jpeg">';
						echo "<h4 class='text-doc jumbotron-heading'> Dr. ".utf8_encode($dado['nome'])."</h4>    "; 	
					}
					?>
				</div>
				<div class='container'>

				<hr style="width:100%; color = grey;">
				<H5>Seus pacientes</H5>	

				<hr style="width:100%; color = grey;">
					<div class='row'>	
						<?php					
							if ($link){
								$result = $link->query("SELECT pac_id,nome,telefone from paciente order by nome,pac_id");
								if ($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											echo"							
												<div class='col-md-3'  >
													<div class='card mb-3 shadow-sm'style='padding-top: 1rem;'>
														<a href='exames.php?pac_id=".$row["pac_id"]."'><img  id= 'pac-img' class='card-img-top' src='../images/imagens_pacientes/".$row["pac_id"].".jpeg' ></a>
														<div class='card-body'>
															<p id ='titulo_card'class = 'card-text '> Nome: ".$row["nome"]." <br>ID:".$row["pac_id"]."</p> 
															
															<div class='d-flex justify-content-between align-items-center'>
																<small class='text-muted'>Tel:".$row["telefone"]." </small>
															</div>
														</div>
													</div>
												</div>";
										}
									}
								}
							?>
						</div>
					</div> 
				</div>

	</main>
	</section>
	
	<!-- Footer -->
		<footer class="page-footer font-small ">

		<!-- Copyright -->
		<div class="footer-copyright text-center py-3" id="footer">© Cadim
		</div>
		<!-- Copyright -->

	</footer>
	<!-- Footer -->

	   <!-- Fim do seu codigo -->
	   <script src="../js/jquery-3.4.1.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
	</body>

</html