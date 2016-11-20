<?php

	require 'vendor/autoload.php';
	
	// Create and configure Slim app
	$config = ['settings' => [
	    'addContentLengthHeader' => false,
	]];

	$app = new \Slim\App($config);
	
	$status = 200;

	require 'processo.php';

	$app->run();
?>