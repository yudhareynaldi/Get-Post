<?php

require_once ("vendor/autoload.php");
require_once ("Connection.php");

use Slim\App;
use Slim\Container;

$settings = array(
	"settings" => array(
		"displayErrorDetails" => true 
	)
);
$container = new Container($settings);
$app = new App($container);
$db = new Connection();

$app->get("/siswa/all", function($request, $response){
	$db = new Connection();
	$query = "SELECT * FROM siswa";
	$daftar_siswa = $db->fetchALL($query, []);
	return $response->withJson($daftar_siswa);
});

$app->get("/siswa/detail", function($request, $response){
	$db = new Connection();
	$param = $request->getQueryParams();
	$id_siswa = $param ['id_siswa'];
	$args = array(":id" => $id_siswa);
	$query = "SELECT * FROM siswa WHERE id = :id";
	$siswa = $db->fetch($query, $args);
	return $response->withJson($siswa);
});

$app->post("/siswa/add", function($request, $response){
	$db = new Connection();
	$param = $request->getParsedBody();
	$query = "INSERT INTO siswa(nama, siswa, sekolah) Values (:nama, :siswa, :sekolah)";
	$args = [
		":nama" => $param['nama'],
		":siswa" => $param['siswa'],
		":sekolah" => $param['sekolah']
	];
	$db->execute($query, $args);
	return $response->withJson(["message" => "Success !"]);
});

$app->post("/siswa/edit", function($request, $response){
	$db = new Connection();
	$param = $request->getParsedBody();
	$query = "UPDATE siswa SET nama = :nama, siswa = :siswa, sekolah = :sekolah WHERE id = :id";
	$args = [
		":nama" => $param['nama'],
		":siswa" => $param['siswa'],
		":sekolah" => $param['sekolah'],
		":id" => $param['id']
	];
	$db->execute($query, $args);
	return $response->withJson(["message" => "Success !"]);
});

$app->post("/siswa/delete", function($request, $response){
	$db = new Connection();
	$param = $request->getParsedBody();
	$query = "DELETE FROM siswa WHERE id = :id";
	$args = [
		":id" => $param["id"]
	];
	$db->execute($query, $args);
	return $response->withJson(["message" => "Success !"]);
});

$app->run();