<?php
namespace App\Controller;

use Firebase\JWT\JWT;
class TokenController{
    public function gerar_token($request,$response,$args){
        $date = (new \DateTime())->modify('+30minute');
        $tokenPayload = [
            'sub' => mt_rand(100,999),
            "exp" => $date->getTimestamp()
        ];
        $token = JWT::encode($tokenPayload, getenv('JWT_SECRET'));
        $retorno = ['token' => $token];
        $response->getBody()->write(json_encode($retorno));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}