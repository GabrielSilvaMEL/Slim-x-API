<?php

namespace App\Controller;

use \App\DAO\ConexaoDAO;
use App\DAO\ProdutoDAO;

class ProdutosController{

    public function listar_todos($request, $response, $args){
        $status = '';
        $dados = [];

        try {
            $conexao = new ConexaoDAO();
            $db = $conexao->conectar();
            
            $produtoDAO = new ProdutoDAO($db);
            $dados = $produtoDAO->listar_todos();

            $status = 'sucesso';
            
        } catch (\PDOException $e) {
            $status = 'erro';
        }
        
        if($status=='erro'){
            $retorno = ['status' => $status, 'mensagem' => $e-> getMessage()];
        }
        else{
            $retorno = ['status' => $status, 'mensagem' => 'Dados Recebidos', 'dados' => $dados];
        }

        // $retorno = ['status' => $status, 'dados' => $dados];

        $response->getBody()->write(json_encode($retorno));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function cadastrar($request, $response, $args){
        $status = null;
        $mensagem = null;
        $data = (object) $request->getParsedBody();
        
        try {
            $conexao = new conexaoDAO();
            $db = $conexao->conectar();

            $produtoDAO = new ProdutoDAO($db);
            $produtoDAO->cadastrar($data);

            $status = 'sucesso';
            $mensagem = 'Produto cadastrado com sucesso';
        } catch (\Exception $e) {
            $status = 'erro';
            $mensagem = $e->getMessage();
        }

        $retorno = ['status' => $status, 'mensagem'=> $mensagem];
        $response->getBody()->write(json_encode($retorno));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}