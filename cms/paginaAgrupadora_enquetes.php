<?php

    session_start();

    //Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 13";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cms - Sistema de Gerenciamento</title>
        <link rel="stylesheet" href="css/cssUniversal.css">
        <link rel="stylesheet" href="css/paginaAgrupadora_enquetes.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="jquery/jquerymaskplugin.js" ></script>
        <script>
            //Inclui uma janelinha que mostra os detalhes do usuário quando é passado
            //o mouse por cima da foto
            <?php include_once('jsFunctions/mostrarJanelaDetalhes.js');?>
            //Inclui o pop up do cadastro da página
            <?php include_once('jsFunctions/popup.js');?>
        </script>
    </head>
    <body>
        <div id="esqueleto">
            <!--Cabeçalho-->
            <?php include_once('cabecalho/cabecalho.php');?>
            <!--Conteúdo-->
            <section>
                <!--Menu-->
                <!--Inclui o menu que irá aparecer em todas as páginas-->
                <?php include_once('externos/menu_universal.php'); ?>
                <!--Título do Crud-->
                <div id="div_titulo_crud">
                    <div id="titulo_crud">
                        Elementos das Enquetes
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/enquetesIcon.png" alt="">
                    </div>
                </div>
                <!--Crud-->
                <div id="div_foraTabela">
                    <div id="div_conteudo">
                        <a href="crud_tituloEnquetes.php">
                            <div class="div_icone_paginaAgrupadora">
                                <!--Icone-->
                                <div class="icone_pagina">
                                    <img src="img/enquetesIcon.png" alt="">
                                </div>
                                <!--Texto-->
                                <div class="texto_icone">
                                    Título da Enquete
                                </div>
                            </div>
                        </a>
                        <a href="crud_perguntaEnquete.php">
                            <div class="div_icone_paginaAgrupadora">
                                <!--Icone-->
                                <div class="icone_pagina">
                                    <img src="img/perguntaIcon.png" alt="">
                                </div>
                                <!--Texto-->
                                <div class="texto_icone">
                                    Perguntas
                                </div>
                            </div>
                        </a>
                        <a href="crud_opcoesPergunta.php">
                            <div class="div_icone_paginaAgrupadora">
                                <!--Icone-->
                                <div class="icone_pagina">
                                    <img src="img/opcoesIcon.png" alt="">
                                </div>
                                <!--Texto-->
                                <div class="texto_icone">
                                    Opções
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
