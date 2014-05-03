<?php
error_reporting(0);
session_start();
require_once("../../engine/conexao.php");
include_once("../../engine/funcoes.php");
logadoAdmin();

include("../topo.php");

    
    $SQL = "SELECT * FROM categoria_fotos ORDER BY nome;";
    $resultado = mysql_query($SQL) or die(mysql_error());
    $total = mysql_num_rows($resultado);
    if($total > 0){
    ?>
     <div class="mws-panel grid_8">
           <div class="mws-panel-header">
                    <span class="mws-i-24 i-folder">Albuns</span>
            </div>
            <div class="mws-panel-body">
                <div class="mws-panel-toolbar top clearfix">
                    <ul>
                        <li><a href="inserirCategoria.php" class="mws-ic-16 ic-accept">Inserir novo Album</a></li>
                    </ul>
                </div>
                <table class="mws-datatable mws-table">
                    <thead>
                        <tr>
                            <th>Nome</th>                        
                            <th colspan="2">Op&ccedil;&otilde;es</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php
                       while($linhas = mysql_fetch_array($resultado)){
                        extract($linhas);
                        ?>
                            <tr>
                                <td><?=$nome;?></td>
                                 <td><a href="alterarCategoria.php?id=<?=$id;?>">Alterar</a></td>
                                 <td><a href="excluirCategoria.php?id=<?=$id;?>">Excluir</a></td>
                            </tr>
                        <?
                     }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?  }else{
        ?>
         <div class="mws-panel grid_8">
                <div class="mws-panel-header">
                <span class="mws-i-24 i-table-1">Categorias</span>
            </div>
            <div class="mws-panel-body">
                <div class="mws-panel-toolbar top clearfix">
                    <ul>
                        <li><a href="inserirCategoria.php" class="mws-ic-16 ic-accept">Inserir Categoria</a></li>
                    </ul>
                </div>
                <table class="mws-datatable mws-table">
                     <tbody>
                        <tr>
                            <td>N&atilde;o existem categorias cadastrados no sistema</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?
    }



    $SQL = "SELECT f.id, f.fotos, c.id AS cat_id, c.nome FROM fotos f INNER JOIN categoria_fotos c ON f.categoria_fotos_id = c.id;";
    $resultado = mysql_query($SQL) or die(mysql_error());
    $total = mysql_num_rows($resultado);
    if($total > 0){
    ?>
     <div class="mws-panel grid_8">
           <div class="mws-panel-header">
                    <span class="mws-i-24 i-table-1">Arquivos</span>
            </div>
            <div class="mws-panel-body">
                <div class="mws-panel-toolbar top clearfix">
                    <ul>
                        <li><a href="inserir.php" class="mws-ic-16 ic-accept">Inserir Arquivo</a></li>
                    </ul>
                </div>
                <table class="mws-datatable mws-table">
                    <thead>
                        <tr>
                            <th>Arquivo</th>                        
                            <th>Categoria</th>                        
                            <th colspan="2">Op&ccedil;&otilde;es</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php
                       while($linhas = mysql_fetch_array($resultado)){
                        extract($linhas);
                        ?>
                            <tr>
                                <td><?=$fotos;?></td>
                                <td><?=$nome;?></td>
                                 <td><a href="alterar.php?cat_id=<?=$cat_id;?>">Alterar</a></td>
                                 <td><a href="excluir.php?id=<?=$id;?>">Excluir</a></td>
                            </tr>
                        <?
                     }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?  
    }else{
        ?>
         <div class="mws-panel grid_8">
                <div class="mws-panel-header">
                <span class="mws-i-24 i-table-1">Arquivos</span>
            </div>
            <div class="mws-panel-body">
                <div class="mws-panel-toolbar top clearfix">
                    <ul>
                        <li><a href="inserir.php" class="mws-ic-16 ic-accept">Inserir Arquivos</a></li>
                    </ul>
                </div>
                <table class="mws-datatable mws-table">
                     <tbody>
                        <tr>
                            <td>N&atilde;o existem arquivos cadastrados no sistema</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?
    }


    include("../rodape.php");
    ?>
