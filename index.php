<?php

$acao = 'recuperarTarefasPendentes';
require 'tarefa_controller.php';

?>


<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>App Lista Tarefas</title>

	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<script>
		function editar(id, txtTarefa) {
			//Form de edição
			let form = document.createElement('form')
			form.action = 'index.php?pag=index&acao=atualizar'
			form.method = 'post'
			form.className = 'row'

			//Input para entrada de texto
			let inputTarefa = document.createElement('input')
			inputTarefa.type = 'text'
			inputTarefa.name = 'tarefa'
			inputTarefa.className = 'col-9 form-control'
			inputTarefa.value = txtTarefa

			//criar um hiden para guardar o id da tarefa
			let inputId = document.createElement('input')
			inputId.type = 'hidden'
			inputId.name = 'id'
			inputId.value = id


			//button de envio do form
			let button = document.createElement('button')
			button.type = 'submit'
			button.className = 'btn btn-info col-3'
			button.innerHTML = 'Atualizar'

			//incluir inputId no form
			form.appendChild(inputId)

			//incluir input tarefa no form
			form.appendChild(inputTarefa)

			//incluir o button no form
			form.appendChild(button)

			//selecionar a div tarefa
			let tarefa = document.getElementById('tarefa_' + id)
			//limpar o conteudo da tarefa par ainclusão do form
			tarefa.innerHTML = ' ';

			//incluir o form na pagina
			tarefa.insertBefore(form, tarefa[0]);

		}

		function remover(id) {
			location.href = 'index.php?pag=index&acao=remover&id=' + id;
		}

		function marcarRealizada(id) {
			location.href = 'index.php?pag=index&acao=marcarRealizada&id=' + id;
		}
	</script>
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

	<div class="container app">
		<div class="row">
			<div class="col-md-3 menu">
				<ul class="list-group">
					<li class="list-group-item active"><a href="#">Ocorrências pendentes</a></li>
					<li class="list-group-item"><a href="nova_tarefa.php">Nova Ocorrência</a></li>
					<li class="list-group-item"><a href="todas_tarefas.php">Todas Ocorrências</a></li>
					<li class="list-group-item"><a href="filtrar.php">Filtrar Ocorrências</a></li>
					<li class="list-group-item "><a href="tempo_total.php">Tempo total de parada</a></li>
				</ul>
			</div>

			<div class="col-md-9">
				<div class="container pagina">
					<div class="row">
						<div class="col">
							<h4>Ocorrências pendentes</h4>
							<hr />
							<?php foreach ($tarefas as $indice => $tarefa) { ?>

								<div class="border row mb-3 d-flex align-items-center tarefa">

									<div class="col-sm-9">
										<h5><?= ucfirst($tarefa->maquina) ?></h5>
									</div>
									<div class="col-sm-9 mt-1">
										<h6>Ocorrência:</h6>
									</div>
									<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>">
										<?= $tarefa->tarefa ?>
									</div>
									<div class="col-sm-9 mt-1">
										<h6>Descrição:</h6>
									</div>
									<div class="col-sm-9"><?= $tarefa->servico ?> </div>
									<div class="col-sm-9 mt-1">
										<h6>Data Inicial:</h6>
									</div>
									<div class="col-sm-9"><?= $tarefa->data_cadastrado ?> </div>
									<div class="col-sm-9 mt-1">
										<h6>Hora Inicial:</h6>
									</div>
									<div class="col-sm-9"><?= $tarefa->hora_cadastrado ?> </div>

									<div class="col-sm-9 mt-1">
										<h6>Técnico Responsável:</h6>
									</div>
									<div class="col-sm-9 mb-1"><?= $tarefa->tecnico ?> </div>
									<div class="mb-2 mx-auto d-flex justify-content-between d-grid gap-3">
										<a class="p-2 bg-light border" onClick="remover(<?= $tarefa->id ?>)" href=""><i class="fas fa-trash-alt fa-lg text-danger" onClick="remover(<?= $tarefa->id ?>)">Excluir</i></a>
										<?php if ($tarefa->status == 'pendente') { ?>
											<a class="p-2 bg-light border" href=""><i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id ?>,'<?= $tarefa->tarefa ?>')">Editar</i></a>
											<a class="p-2 bg-light border" href=""><i class=" fas fa-check-square fa-lg text-success" onClick="marcarRealizada(<?= $tarefa->id ?>)">Concluir</i></a>
										<? } ?>
									</div>

								</div>


							<? } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</body>

</html>