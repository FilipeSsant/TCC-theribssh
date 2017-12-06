<?php

    session_start();

    //Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 15";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }

    $nome = "";
    $email = "";
    $telefone = "";
    $celular = "";
    $tipodeinformacao = "";
    $restaurante ="";
    $obs = "";

    if(isset($_GET['modo'])){

        if($_GET['modo']=='excluir'){

            $id_faleconosco = $_GET['codigo'];

            $sql="delete from tbl_faleconosco where id_faleconosco=".$id_faleconosco;

            mysql_query($sql);
            header('location:gerenciamento_faleConosco.php');
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cms - Sistema de Gerenciamento</title>
        <link rel="stylesheet" href="css/cssUniversal.css">
        <link rel="stylesheet" href="css/gerenciamento_faleConosco.css">
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

            function aumentarFooter(){
                //Após o $ é o id ou a classe na qual se deseja implementar uma função css
                //No .css é implementada o comando css dentro do {}
                $('footer').css({"height":"500px"});
            }

            function normalizarFooter(){
                //Após o $ é o id ou a classe na qual se deseja implementar uma função css
                //No .css é implementada o comando css dentro do {}
                $('footer').css({"height":"75px"});
            }

        </script>
    </head>
    <body>
        <!--Fundo Transparente-->
        <div id="fundo_transparente" onClick="normalizarFooter()">

        </div>
        <div id="esqueleto">
            <?php

                if(isset($_GET['modo'])){
                    $modo = $_GET['modo'];
                    $id_faleconosco = $_GET['codigo'];

                    if($modo =='excluir'){
                        $sql="delete from tbl_faleconosco where id_faleconosco=".$id_faleconosco;
                        mysql_query($sql);
                        header('location:gerenciamento_faleConosco.php');
                    }elseif($modo =='verInfo'){
                        $sql="select
                                fc.nome_completo as 'nomeUsuario',
                                fc.celular,
                                fc.telefone,
                                fc.email,
                                res.nome as 'nomeRestaurante',
                                fc.obs,
                                info.nome as 'nomeInfo'
                                from tbl_faleconosco as fc
                                join tbl_restaurante as res
                                on res.id_restaurante = fc.id_restaurante
                                join tbl_tipoinfo as info
                                on fc.id_tipoInfo = info.id_tipoInfo where id_faleconosco = ".$id_faleconosco;
                        $select = mysql_query($sql) or die(mysql_error());
                        if($rs=mysql_fetch_array($select)){
                            $nome = $rs['nomeUsuario'];
                            $email = $rs['email'];
                            $telefone = $rs['telefone'];
                            $celular = $rs['celular'];
                            $tipodeinformacao = $rs['nomeInfo'];
                            $restaurante = $rs['nomeRestaurante'];
                            $obs = $rs['obs'];
                        }

                        ?>
                            <script>
                                $(document).ready(function(){
                                    abrirPopUp();
                                    aumentarFooter();
                                });
                            </script>
                        <?php

                    }
                }

                include_once('externos/verInformacoes/gerenciamento_faleConosco/popupCadastro.php');

            ?>
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
                        Gerenciamento do Fale Conosco
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/faleConoscoIcon.png" alt="">
                    </div>
                </div>
                <!--Crud-->
                <div id="div_foraTabela">
                    <div id="div_conteudo">
                        <!--Tabela-->
                        <div id="tabela_crud_titulos">
                            <div class="titulo_colunaPoucosCampos">
                                Nome
                            </div>
                            <div class="titulo_coluna">
                                Tipo de Informação
                            </div>
                            <div class="titulo_colunaObs">
                                Observação
                            </div>
                            <div class="titulo_coluna">
                                Restaurante
                            </div>
                            <div class="titulo_2opcColuna">
                                Opções
                            </div>
                        </div>
                        <div class="tabela_crud_conteudo">

                            <?php
                                $sql="select fc.id_faleconosco,
                                fc.nome_completo as 'nomeUsuario',
                                fc.celular,
                                fc.telefone,
                                fc.email,
                                res.nome as 'nomeRestaurante',
                                fc.obs,
                                info.nome as 'nomeInfo'
                                from tbl_faleconosco as fc
                                join tbl_restaurante as res
                                on res.id_restaurante = fc.id_restaurante
                                join tbl_tipoinfo as info
                                on fc.id_tipoInfo = info.id_tipoInfo;";

                                $select = mysql_query($sql) or die(mysql_error());
                                while($rs = mysql_fetch_array($select)){

                            ?>

                            <div class="conteudo_colunaPoucosCamposFn">
                                 <span class="span_centralizar"> <?php echo($rs['nomeUsuario']) ?> </span>
                            </div>
                            <div class="conteudo_coluna">
                                <span class="span_centralizar"> <?php echo($rs['nomeInfo']) ?> </span>
                            </div>
                            <div class="conteudo_colunaObs">
                                <div class="div_textoConteudoObs">
                                    <span class="span_centralizar"> <?php echo($rs['obs']); ?></span>
                                </div>
                            </div>
                            <div class="conteudo_coluna">
                                <span class="span_centralizar"> <?php echo($rs['nomeRestaurante']) ?></span>
                            </div>
                            <div class="coluna_2opcoesFaleConosco">
                                <!--Informações-->
                                <a href="gerenciamento_faleConosco.php?modo=verInfo&codigo=<?php echo($rs['id_faleconosco']); ?>">
                                    <div class="opcao_registro" onclick="">
                                        <div class="imagem_opcao">
                                            <img src="img/infoIcon.png" alt="" title="Informações">
                                        </div>
                                    </div>
                                </a>
                                <!--Apagar-->
                                <a href="gerenciamento_faleConosco.php?modo=excluir&codigo=<?php echo($rs['id_faleconosco']); ?>">
                                    <div class="opcao_registro">
                                        <div class="imagem_opcao">
                                            <img src="img/apagar.png" alt="" title="Apagar">
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                                }
                            ?>
                        </div>

                    </div>
                </div>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
