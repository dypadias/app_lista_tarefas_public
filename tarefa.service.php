<?php

//CRUD
class TarefaService
{

	private $conexao;
	private $tarefa;



	public function __construct(Conexao $conexao, Tarefa $tarefa)
	{
		$this->conexao = $conexao->conectar();
		$this->tarefa = $tarefa;
	}

	public function inserir()
	{ //create

		$query = 'insert into tb_tarefas(tarefa,maquina,servico,tecnico)values(?,?,?,?)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->tarefa->__get('tarefa'));
		$stmt->bindValue(2, $this->tarefa->__get('maquina'));
		$stmt->bindValue(3, $this->tarefa->__get('servico'));
		$stmt->bindValue(4, $this->tarefa->__get('tecnico'));
		$stmt->execute();


		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function recuperar()
	{ //read

		$query = '
		select
		   t.id,
		  s.status,
		   t.tarefa ,
		   data_cadastrado,
		   maquina,
		   servico,
		   tecnico
		from
		    tb_tarefas as t
			left join tb_status as s on(t.id_status = s.id )
		order by
			data_cadastrado
			desc
		
		';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar()
	{ //update
		$query = "update tb_tarefas set tarefa = ?,data_atualizado = CURRENT_TIME() where id = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->tarefa->__get('tarefa'));
		$stmt->bindValue(2, $this->tarefa->__get('id'));

		return $stmt->execute();
	}

	public function remover()
	{ //delete

		$query = 'delete from tb_tarefas where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue('id', $this->tarefa->__get('id'));
		return $stmt->execute();
	}

	public function marcarRealizada()
	{
		$query = "update tb_tarefas set id_status = ? where id = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->tarefa->__get('id_status'));
		$stmt->bindValue(2, $this->tarefa->__get('id'));
		$stmt->fetchAll(PDO::FETCH_OBJ);
		return $stmt->execute();
	}

	public function recuperarTarefasPendentes()
	{
		$query = '
		select
		   t.id,
		   s.status,
		   t.tarefa ,
		   t.data_cadastrado,
		   maquina,
		   servico,
		   tecnico
		from
		    tb_tarefas as t
			left join tb_status as s on(t.id_status = s.id )
		where
			t.id_status = :id_status
		order by
			data_cadastrado
			desc
		';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function filtrarTarefa()
	{
		$query = '
		select
		   t.id,
		   s.status,
		   t.tarefa ,
		   t.data_cadastrado,
		   maquina,
		   servico,
		   tecnico
		from
		    tb_tarefas as t
			left join tb_status as s on(t.id_status = s.id ) 
		WHERE 
			maquina 
		LIKE
			 :filtro 
		OR 
			tecnico 
		LIKE 
			 :filtro
		ORDER BY 
			data_cadastrado DESC
		';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':filtro', $this->tarefa->__get('filtro'));
		//$stmt->bindValue(2, $this->tarefa->__get('filtro'));
		$stmt->execute();

		return ($stmt->fetchAll(PDO::FETCH_OBJ));
		/* echo '<pre>';
		print_r($stmt->fetchAll(PDO::FETCH_OBJ));
		echo '</pre>';
		 */
	}
}
