<?php

function getTotalCi(){
    $sql = new Sql();
            
    $rawQuery = "SELECT count(numero) as total FROM tbCi";
    
    $busca = $sql->query($rawQuery)->fetch();
            
    return $busca->total;
}

function insertCi($objetoCi, $nome){
    
            $sql = new Sql();
            
            $rawQuery = "INSERT INTO tbCi(objeto, nome, data_cad) VALUES (:objeto, :nome, :data_cad)";
            
            $parameters = [":objeto" => $objetoCi, ":nome" => $nome, ":data_cad" => date('Y-m-d')];

            $sql->query($rawQuery, $parameters);
                 
}

function select($limit, $total){
    /* BUSCAR TODAS */
    $sql = new Sql();
            
    $rawQuery = "SELECT numero, nome, objeto, data_cad as data FROM tbCi
                    ORDER BY numero DESC
                    LIMIT $limit, $total
                ";

    $busca = $sql->query($rawQuery)->fetchAll();
            
    return $busca;
}

function selectPerFilter($rawQuery, $parameters){
    $sql = new Sql();
    
    $busca = $sql->query($rawQuery, $parameters);
    
    return (Object) $busca;
}

