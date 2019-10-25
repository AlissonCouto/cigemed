<?php

class Connect
{

    private static $instance;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance()
    {
    $usuario = 'User';
    $senha = 'Password';
        if(!isset(self::$instance)){

            try{

                $opcoes = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
                );
                self::$instance = new PDO('mysql:host=localhost;dbname=Database', $usuario, $senha, $opcoes);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch(PDOException $e){

                echo "<br> <b>Código:</b> " . $e->getCode();
                echo "<br> <b>Mensagem:</b>" . $e->getMessage();
                echo "<br> <b>Linha:</b>" . $e->getLine();
                echo "<br> <b>Arquivo:</b>" . $e->getFile();

            }

        }

        return self::$instance;
    }

}