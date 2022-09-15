<?php

use App\Controller\ProdutosController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;

$app->get('/api/ola_mundo', function (Request $request, Response $response, $args){

    $resposta = ["produto_id" => 1, "produto_nome" => "mouse"];

    $response->getBody()->write(json_encode($resposta));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
});


$app->group('/api',function(RouteCollectorProxy $group){
    $group->get('/produtos', ProdutosController::class.':listar_todos');
});