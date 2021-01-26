<?php

require_once ("vendor/autoload.php");

use Slim\App;
use Slim\Container;

$settings = array(
	"settings" => array(
		"displayErrorDetails" => true 
	)
);
$container = new Container($settings);
$app = new App($container);
			
$app->get("/", function($request, $response){
	$parameter = $request->getQueryParams();
	$umur = $parameter["umur"];
	$result = array(
		"nama" => $parameter["nama"],
		"alamat" => $parameter["alamat"],
		"umur" => $umur
	);
	return $response->withJson($result);
});

$app->post("/post", function($request, $response){
	$parameter = $request->getParsedBody();
	$umur = $parameter["umur"];
	$result = array(
		"hp" => $parameter["hp"],
		"alamat" => $parameter["alamat"],
		"umur" => $umur
	);
	return $response->withJson($result);
});



$app->run();