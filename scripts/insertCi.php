<?php

    $msg = [];

    require_once 'db/Transacao.php';
    require_once 'db/crudCi.php';
   
    $nomeFunc = (isset($_POST["nome"]) ? trim($_POST["nome"]) : 1);
    $objeto = (isset($_POST["objeto"]) ? trim($_POST["objeto"]) : "");
    
    // Expressões regulares aceitando apenas letras e espaços 
    $nomeRegex = "/^[\sa-zA-ZÀ-Úàú]+$/";
    if(!preg_match($nomeRegex, $nomeFunc) || strlen($nomeFunc) === 0){
        $msg[] = "Nome inválido!";
    }
    $objetoRegex = "/^[\sa-zA-ZÀ-Úàú0-9]+$/";
    if(!preg_match($objetoRegex, $objeto) || strlen($objeto) === 0){
        $msg[] = "O objeto informado tem formato incorreto!";
    }
        
    try{
        Transacao::begin();
        
        // SE NÃO HOUVE NENHUM ERRO A INSERÇÃO DA CI SERÁ REALIZADA
        if(!$msg){

            insertCi($objeto, $nomeFunc);

        }
        
        Transacao::commit();
        
    }catch(PDOException $e){
        Transacao::rollback();
    }