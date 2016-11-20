<?php
	
	require 'DAO.php';

	$app->get('/processo/{id}', function ($request, $response, $args) {
		
		$json = $request->getParsedBody();

		$idProcesso = $args['id'];
		$processo = null;

		$dao = new DAO();
		$results = $dao->query(" SELECT * FROM TB_PROCESSO WHERE ID_PROCESSO = :id ; ", array(':id' => $idProcesso));
		
		$processos = array();

		foreach ($results as $obj) {

			$processo = array(
				'id' => $obj['ID_PROCESSO'],
				'numero' => $obj['NUMERO'],
				'nomeCliente' => $obj['NOME_CLIENTE']
			);

			array_push($processos, $processo);
		}

		if ($processo == null) {

			$processo = array(
				'id' => $idProcesso
			);

		} else {
			$processo = $processos[0];
		}

	    return $response->withJson($processo, $status);
	});

	$app->post('/processo/0', function ($request, $response, $args) {

		$json = $request->getParsedBody();
		$idProcesso = $args['id'];
		
		$message = null;

		if ($json == null) {

			$status = 400;
			$message = array ("message" => "Erro na gravação.", "type" => "ERROR", "code" => $status);

		} else {

			$dao = new DAO();
			$results = $dao->query(" INSERT INTO TB_PROCESSO(NUMERO, NOME_CLIENTE) VALUES (:numero, :nome) ; ", 
								   array(':numero' => $json['processo_numero'], 
										 ':nome'   => $json['processo_nome_cliente']));

			$message = array ("message" => "Gravação realizada com sucesso.", "type" => "SUCCESS", "code" => $status);
		}

	    return $response->withJson($message, $status);
	});

	$app->put('/processo/{id}', function ($request, $response, $args) {

		$json = $request->getParsedBody();
		$idProcesso = $args['id'];
		
		$message = null;

		if ($json == null) {

			$status = 400;
			$message = array ("message" => "Erro na gravação.", "type" => "ERROR", "code" => $status);

		} else {

			$dao = new DAO();
			$results = $dao->query(" UPDATE TB_PROCESSO SET NUMERO=:numero, NOME_CLIENTE=:nome WHERE ID_PROCESSO = :id ", 
									array(':numero' => $json['processo_numero'], 
								   		  ':nome'   => $json['processo_nome_cliente'],
								   		  ':id'     => $idProcesso));

			$message = array ("message" => "Atualização realizada com sucesso.", "type" => "SUCCESS", "code" => $status);
		}

	    return $response->withJson($message, $status);
	});
	
?>