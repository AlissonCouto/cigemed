<?php

    // ARRAY QUE ARMAZENARÁ OS ERROS DO APLICAÇÃO DURANTE A EXECUÇÃO
    $msg = [];
    $nomeFunc = "";
    $objeto = "";
    
    // Pegando filtro da requisição
    $data = (isset($_GET["busca"])) ? $_GET["busca"] : "";
    
    // Importação dos arquivos de CRUD
    require_once 'scripts/db/Transacao.php';
    require_once 'scripts/db/Sql.php';
    require_once 'scripts/db/crudCi.php';
    
    // Se houve submissão do formulário de busca por filtro
    if(isset($_GET["busca"])){

        // Manipulando instrução SQL baseado no tipo de busca
        if(preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/", $data)){

            $filtro = " WHERE data_cad = :data_cad ";
            $parameter[":data_cad"] = $data;
            
        }else if(preg_match("/[0-9]/", $data)){

            $filtro = " WHERE numero = :numero ";
            $parameter[":numero"] = $data;
            
        }else if(preg_match("/^[a-zA-ZÀ-Úà-ú ]+$/", $data)){
            
            $filtro = " WHERE nome like concat('%', :nome ,'%') ";
            $parameter[":nome"] = $data;
        }
        
         //Pegando a página atual (se não foi informada será 1)
         $pg = (isset($_GET["pgAtual"])) ? $_GET["pgAtual"] : 1;
        
        // Pegando total de ci da base de dados
         $rawQuery = "SELECT numero, nome, objeto, data_cad as 'data' FROM tbCi" . $filtro;
         $listaCi = selectPerFilter($rawQuery, $parameter);
         $totalCi = (int) $listaCi->rowCount();

         // Definindo a quantidade de itens por página
        $total_pg = 8;
        
        // Calculando quantidade de páginas necessárias para a paginação
        $qnt_pg = ceil($totalCi / $total_pg);
        
        // Calculando inicio do limit para busca
        $inicio =  ($total_pg * $pg) - $total_pg;
        
        $rawQuery = "SELECT numero, nome, objeto, data_cad as 'data' FROM tbCi " . $filtro
        ."ORDER BY numero DESC LIMIT $inicio, $total_pg"        
        ;
         $listaCi = selectPerFilter($rawQuery, $parameter);
    }
    
    // Verificar página anterior e página posterior
    $pg_anterior = $pg - 1;
    $pg_posterior = $pg + 1;
    
   // Chamadas de scripts responsáveis pela consulta de CI e pelao número novo do usuário
  /* if($_GET){
              
        include_once 'scripts/searchCi.php';
       
   }else{
           header("location: index.php");
       }*/
   
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="author" content="Alisson Couto">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CI - GEMED CONSULTA</title>

        <link rel="stylesheet" href="estilo/css/estilo.css">
        <link rel="stylesheet" href="estilo/fontes/awesome/css/all.css">
    </head>

    <body>
    
        <div class="container">
            <header class="header">
                <div class="logo">
                    <span>
                        <b>CI</b>
                        GEMED
                    </span>
                </div><!-- CONTAINER LOGO -->

                <div class="search-container">
                    <form id="search-form" name="search-ci" method="get" action="">
                            <select class="" onchange="javascript:alterField(this)">
                                <option id="optName">Nome</option>
                                <option id="optNumeroCi">Número CI</option>
                                <option id="optData">Data</option>
                            </select>
                    
                        <input id="cmpNomeBusca" class="cmpNomeBusca ativarCampo" type="search" name="busca" placeholder="Digite o nome do solicitante." required>
                        <input id="cmpNumeroBusca" class="cmpNumeroBusca" type="number" name="busca" placeholder="Digite um número de CI." disabled required>
                        <input id="cmpDataBusca" class="cmpDataBusca" type="date" name="busca" disabled required>
                        
                    </form><!-- FORMULÁRIO DE BUSCA -->
                </div><!-- CONTAINER COM CAMPO DE BUSCA -->
                
                <button form="search-form" id="btn-search" class="icon-search" type="button">
                    <i class="fa fa-search"></i>
                </button><!-- COTAINER ICONE DE BUSCA -->
            </header>

            <div class="insert-ic">
                <form method="post" action="index.php" name="insert-form">
                    <input id="idNome" type="text" name="nome" value="<?= $nomeFunc ?>" placeholder="Informe seu nome aqui" required autofocus>
                    <input id="idObj" type="text" name="objeto" value="<?= $objeto ?>" placeholder="Informe o objeto da ci" required>
                    <button>SALVAR</button>
                </form><!-- FORMULÁRIO DE INSERÇÃO -->
            </div><!-- CONTAINER CAMPOS DE INSERÇÃO -->

            <section class="content">
                
                        <?php
                        
                            if($msg){
                        ?>
                
                            <div class="error-msg">
                                <?php
                                
                                    echo implode("<br>", $msg);
                                
                                ?>
                            </div>
                        <?php
                            }
                        ?>
                    
                <article class="new-ic">
                    <span>Seu nº de ci: <b>
                            <?php
                            
                            if($_GET){
                                
                                $novaCi = isset($_GET["novaCi"]) ? $_GET["novaCi"] : "";
                                
                                echo $novaCi;
                            }
                                
                            
                            ?>
                        </b></span>
                </article>

                <article class="table-ic">
                   
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nº</th>
                                <th scope="col">NOME</th>
                                <th scope="col">OBJETO</th>
                                <th scope="col">DATA</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $listaCi = $listaCi->fetchAll();
                            if(get_object_vars((object) $listaCi)){
                                
                               foreach($listaCi as $ci){

                            ?>
                                <tr class="line-body">
                                    <td class="text-center"><?= $ci->numero ?></td>
                                    <td><?= $ci->nome ?></td>
                                    <td><?= $ci->objeto ?></td>
                                    <td class="text-center"><?= date('d/m/Y', strtotime($ci->data)) ?></td>
                                </tr>
                            <?php
                               }
                            ?>
                        </tbody>
                    </table><!-- TABELA  -->
                    
                    <div class="dv-tb-paginator">
                        <table class="table-paginator">
                        <tr>
                            
                            <?php
                            
                                if($pg_anterior != 0){
                            ?>
                                <td>
                                    <a href="?busca=<?= $data ?>&pgAtual=<?= $pg_anterior ?>">
                                        <<
                                    </a>
                                </td>
                            <?php
                                }
                            
                            ?>
                            
                            <?php

                            $iteracoes = ceil($totalCi / 8);

                            for($i = 1; $i <= $iteracoes; $i++){
                            
                            ?>
                            
                            <td>
                                <a href="?busca=<?= $data ?>&pgAtual=<?= $i ?>">
                                    <?= $i ?>
                                </a>
                            </td>
                            
                                 <?php                                    
                                }
                                
                                if($pg_posterior <= ($qnt_pg)){
                            ?>
                            
                            <td>
                                <a href="?busca=<?= $data ?>&pgAtual=<?= $pg_posterior ?>">
                                    >>
                                </a>
                            </td>
                            
                            <?php } ?>
                            </tr>
                    </table>
                    </div>
                            
                        <?php
                        }else{
                        ?>
                            
                            <table class="table table-striped">
                                <tr class="line-body">
                                    <td colspan="4" class="text-center">Nenhuma comunicação interna!</td>
                                </tr>
                            </table>
                            
                        <?php
                        }
                            ?>
                        
                </article><!-- CONTEÚDO DA TABELA DE LISTAGEM DE CI -->
            </section><!-- SEÇÃO COM RESULTADOS DE CI -->
        </div><!-- CONTAINER PRINCIPAL -->

        <script src="lib/jquery/jquery-1.9.1.js"></script>
        <script src="js/eventos.js"></script>

    </body>

</html>