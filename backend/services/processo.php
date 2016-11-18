<?php

	$app->get('/processo/{id}', function ($request, $response, $args) {
		
		$json = $request->getParsedBody();

		$idProcesso = $args['id'];
		$processo = null;

		if ($idProcesso == 0) {

			$processo = array(
				'id' => $idProcesso
			);

		} else {

			$processo = array(
				'id' => $idProcesso,
				'numero' => '00212346320155030027',
				'nomeCliente' => 'Mauricio Monteiro'
			);
		}
		
	    return $response->withJson($processo, $status);
	});


	$app->post('/processo/{id}', function ($request, $response, $args) {

		$json = $request->getParsedBody();
		$idProcesso = $args['id'];
		
		$processo = null;

		if ($json == null) {

			$status = 400;

			$processo = array ("message" => "Erro na gravação.", "type" => "ERROR", "code" => $status);

		} else {

			$processo = array(
				'id' => $idProcesso,
				'numero' => $json['processo_numero'],
				'nomeCliente' => $json['processo_nome_cliente']
			);
		}

		if ($idProcesso == 400) {
			$status = 400;
			$processo = array ("message" => "Erro na gravação.", "type" => "ERROR", "code" => $status);
		}
		
	    return $response->withJson($processo, $status);
	});
	
?>