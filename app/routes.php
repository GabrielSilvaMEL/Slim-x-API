<?php

use App\Controller\ProdutosController;
use App\Controller\TokenController;
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
    $group->post('/produtos', ProdutosController::class.':cadastrar');
})->add(new Tuupola\Middleware\JwtAuthentication([
    'secret' => getenv('JWT_SECRET'),
    'attribute' => 'jwt',
    'reaxed' => ['localhost']
]));

$app->get('/api/token', TokenController::class.':gerar_token');