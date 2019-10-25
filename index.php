<?php
// ( qnt_pg * pg ) - qnt-pg
    // Variáveis de erros e de values de campos html
    $msg = [];
    $nomeFunc = "";
    $objeto = "";
    
    // Condição para busca SQL, iniciará vazio pois se o usuário não buscar concatena vazio e traz todos
    $filtro = "";
    // $parameter => array com parâmetros para bindValue()
    $parameter = [];
    
    // Importação dos scripts utilizados para CRUD
    require_once 'scripts/db/Transacao.php';
    require_once 'scripts/db/Sql.php';
    require_once 'scripts/db/crudCi.php';

    
    // Pegando a página atual (se não foi informada será 1)
    $pg = (isset($_GET["pgAtual"])) ? $_GET["pgAtual"] : 1;
    
    // Pegando total de ci da base de dados
    $totalCi = getTotalCi();
    
    // Definindo a quantidade de itens por página
    $total_pg = 8;
    
    // Calculando quantidade de páginas necessárias para a paginação
    $qnt_pg = ceil($totalCi / $total_pg);
    
    // Calculando inicio do limit para busca
    $inicio =  ($total_pg * $pg) - $total_pg;

    // Buscando as ci da base de dados
    $listaCi = (array) select($inicio, $total_pg);
        
    //Limitar os link antes depois
    $max_links = 2;

   if($_POST){
      
      // IMPORTAÇÃO DOS SCRIPT's DE CRUD
      include_once 'scripts/db/Sql.php';
      include_once 'scripts/insertCi.php';
      include_once 'scripts/getLastNumber.php';
      $novaCi = getLastNumber();
      
      if(!$msg){
          header("Location: index.php?novaCi=$novaCi");
      }
       
   }
   
    // Verificar página anterior e página posterior
    $pg_anterior = $pg - 1;
    $pg_posterior = $pg + 1;
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="author" content="Alisson Couto">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CI - GEMED</title>

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
                    <form id="search-form" name="search-ci" method="get" action="consulta.php">
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
                <form method="post" action="#" name="insert-form">
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
                           
                                <td>
                                    <a href="?pgAtual=1">
                                        Primeira
                                    </a>
                                </td>
                            
                            
                            <?php

                            //$iteracoes = ceil($totalCi / 8);
                            for($pag_ant = $pg - $max_links; $pag_ant <= $pg - 1; $pag_ant++){
                                if($pag_ant >= 1){
				
                            ?>
                                <td>
                                    <a href="?pgAtual=<?= $pag_ant ?>">
                                        <?= $pag_ant ?>
                                     </a>
                                </td>
			
                            <?php
                                }
                            }
                            ?>
                            <td>
                                <a>
                                    <?= $pg ?>
                                </a>
                            </td>
                              
                            <?php
                            
                                for($pag_dep = $pg + 1; $pag_dep <= $pg + $max_links; $pag_dep++){
                                    if($pag_dep <= $qnt_pg){
                            ?>
                            
                                <td>
                                    <a href="?pgAtual=<?= $pag_dep ?>">
                                        <?= $pag_dep ?>
                                     </a>
                                </td>
                            
                            <?php
                                    }
                                }
                            
                            ?>
                            
                            <td>
                                <a href="?pgAtual=<?= $qnt_pg ?>">
                                    Última
                                </a>
                            </td>
                            
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