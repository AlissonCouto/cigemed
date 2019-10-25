<?php

function getLastNumber(){
    /* BUSCAR TODAS */
    $sql = new Sql();
            
    $busca = $sql->query(
                        "SELECT max(numero) as numero FROM tbCi"
                    )->fetch();
            
    return $busca->numero;
}
