<?php


?>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>App Lista Tarefas</title>

	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

</head>

<body>
	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#">
				<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
				Livro de Ocorrências
			</a>
		</div>
	</nav>

	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 1) { ?>

		<div class="alert alert-success" role="alert">
			<h4 class="alert-heading">Muito bem!</h4>
			<p>Tarefa inclusa com sucesso</p>

		</div>

	<? } ?>
	<div class="container app">
		<div class="row">
			<div class="col-md-3 menu">
				<ul class="list-group">
					<li class=" list-group-item"><a href="index.php">Ocorrências pendentes</a></li>
					<li class="list-group-item active"><a href="#">Nova Ocorrência</a></li>
					<li class="list-group-item"><a href="todas_tarefas.php">Todas Ocorrências</a></li>
					<li class="list-group-item"><a href="filtrar.php">Filtrar</a></li>
					<li class="list-group-item "><a href="tempo_total.php">Tempo total de parada</a></li>
				</ul>
			</div>

			<div class="col-md-9">
				<div class="container pagina">
					<div class="row">
						<div class="col">
							<h4>Nova Ocorrência</h4>
							<hr />

							<form method="post" action="tarefa_controller.php?acao=inserir">

								<div class="form-group">

									<div class="form-group">
										<!-- <label for="equipamento">
											<h5>Máquina</h5>
										</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" placeholder="DV_1000" name="maquina"> -->
										<label for="equipamento">
											<h5>Máquina</h5>
										</label>
										<div class="col-sm-9">
											<select class="form-control" name="maquina" id="maquina">
												<option value="" select>Escolha uma máquina</option>
												<option value="mp3">MP3</option>
												<option value="t100">T100</option>
												<option value="sincro1">SINCRO 1</option>
												<option value="sincro2">SINCRO 2</option>
												<option value="dv1000">DV-1000</option>
											</select>
										</div>
									</div>
									<label>
										<h5>Técnico Responsável:</h5>
									</label>
									<div class="col-sm-9">
										<select class="form-control" name="tecnico" id="maquina">
											<option value="" select>Escolha uma Técnico</option>
											<option value="Diego">Diego Matos</option>
											<option value="Sandro">Sandro</option>
											<option value="Paulo">Paulo</option>
											<option value="Paulo">Itamar</option>
										</select>
									</div>
									<label>
										<h5>Ocorrência:</h5>
									</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="tarefa" placeholder="Exemplo: Falha o Sensor">
									</div>
									<label>
										<h5>Serviço executado:</h5>
									</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="servico" placeholder="Exemplo: Reposicionar Sensor">
									</div>

								</div>

								<button class="btn btn-success">Cadastrar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>