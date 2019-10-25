<?php

require_once 'Conexao.php';

Class Sql extends PDO{

    private $conexao;

    public function __construct(){

        $this->conexao = Connect::getInstance();

    }

    public function setParam($stm, $k, $v){

        $stm->bindValue($k, $v);

    }

    public function setParams($stm, $parameters = []){
 
        foreach($parameters as $k => $v){

            $this->setParam($stm, $k, $v);

        }

    }

    public function query($sql, $parameters = []){
        
        $stm = $this->conexao->prepare($sql);
        $this->setParams($stm, $parameters);
        $stm->execute();

        return $stm;
    }

    public function select($sql, $parameters = []){

        $stm = $this->query($sql, $parameters);

        return $stm->fetchAll();
    }

}