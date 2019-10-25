<?php

require_once 'Conexao.php';

class Transacao {
    
    private static $conexao;
    
    private function __construct(){}
    
     public static function begin(){
         
         self::$conexao = Connect::getInstance();
         
        if(self::$conexao){
            self::$conexao->beginTransaction();
        }
    }

    public static function commit(){
        if(self::$conexao){
            self::$conexao->commit();
            self::$conexao = null;
        }
    }

    public static function rollback(){
        if(self::$conexao){
            self::$conexao->rollback();
            self::$conexao = null;
        }
    }
    
}
