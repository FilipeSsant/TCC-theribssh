<?php

    session_start();

    //Conexão com o banco
    include_once('../conexao/mysql.php');

    $sql = "select * from tbl_cargopermissao where id_cargo = ".$_SESSION['idCargoFuncionarioU']." and id_permissao = 12";
    $select = mysql_query($sql) or die(mysql_error());

    if($rs=mysql_fetch_array($select)){

    }else{
        //Faz o usuário voltar para a home caso não seja cadastrado e queira entrar pela url
        ?>
            <script>window.location = "../index.php";</script>
        <?php
    }


    //Reduzir possiveis erros de variaveis vazias
    $nomeCliente = "";
    $emailCliente = "";
    $telefoneCliente = "";
    $celularCliente = "";
    $nomeRestaurante = "";
    $nomeMesa = "";
    $qntLugares = "";
    $nomePeriodo = "";
    $horarioInicial = "";
    $horarioFinal = "";
    $dataMarcada = "";
    $dataFormatoBR = "";
    $urlDefinitiva = "";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cms - Sistema de Gerenciamento</title>
        <link rel="stylesheet" href="css/cssUniversal.css">
        <link rel="stylesheet" href="css/gerenciamento_reservas.css">
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
                $('footer').css({"height":"900px"});
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
            <?php include_once('externos/verInformacoes/gerenciamento_reservas/popupCadastro.php'); ?>
            <!--Cabeçalho-->
            <?php

                include_once('cabecalho/cabecalho.php');

                //If para ver se existe um modo no href
                if(isset($_GET['modo'])){

                    $modo = $_GET['modo'];
                    $id = $_GET['id'];

                    //Switch para ver as condições do modo no href
                    switch($modo){
                        case 'verInfo':

                            ?>
                                <script>
                                    abrirPopUp();
                                    aumentarFooter();
                                </script>
                            <?php

                            break;
                        case 'aprovarReserva':
                            //Comando SQL
                            $sql = "update tbl_reserva set id_status = 1 where id_reserva = ".$id;
                            if(mysql_query($sql)){
                                ?>
                                    <script>
                                        swal({
                                          title: "Reserva Aprovada!",
                                          text: "Clique no botão acima para ver",
                                          type: "success",
                                          icon: "success",
                                          button: {
                                                     text: "Ok",
                                                 },
                                          closeOnEsc: true,
                                      });
                                      //Voltar para o php sem dados na url
                                      setTimeout(function(){
                                          window.location = "gerenciamento_reservas.php";
                                      }, 2000);
                                    </script>
                                <?php
                            }
                            break;
                        case 'cancelarReserva':
                            //Comando SQL
                            $sql = "update tbl_reserva set id_status = 2 where id_reserva = ".$id;
                            if(mysql_query($sql)){
                                ?>
                                    <script>
                                        swal({
                                          title: "Reserva Cancelada!",
                                          text: "As reservas canceladas só terão a visualização do usuário.",
                                          type: "success",
                                          icon: "success",
                                          button: {
                                                     text: "Ok",
                                                 },
                                          closeOnEsc: true,
                                      });
                                      //Voltar para o php sem dados na url
                                      setTimeout(function(){
                                          window.location = "gerenciamento_reservas.php";
                                      }, 3000);
                                    </script>
                                <?php
                            }
                            break;
                    }

                }

            ?>
            <!--Conteúdo-->
            <section>
                <!--Menu-->
                <!--Inclui o menu que irá aparecer em todas as páginas-->
                <?php include_once('externos/menu_universal.php'); ?>
                <!--Título do Crud-->
                <div id="div_titulo_crud">
                    <div id="titulo_crud">
                        Gerenciamento de Reservas
                    </div>
                    <!--Icone do Crud-->
                    <div id="div_icone_crud">
                        <img src="img/acompanhamentoRIcon.png" alt="">
                    </div>
                </div>
                <!--Crud-->
                <div id="div_foraTabela">
                    <div id="div_conteudo">
                        <!--Título da Tabela-->
                        <div id="div_tituloTabela">
                            Reservas feitas até o momento
                        </div>
                        <!--Tabela Reservas Feitas até o momento-->
                        <div id="tabela_crud_titulos">
                            <div class="titulo_colunaPoucosCampos">
                                Nome do Cliente
                            </div>
                            <div class="titulo_coluna">
                                Período
                            </div>
                            <div class="titulo_coluna">
                                Mesa
                            </div>
                            <div class="titulo_3opcColuna">
                                Opções
                            </div>
                        </div>
                        <div class="tabela_crud_conteudo">
                            <?php
                                //Comando SQL
                                $sql = "select rs.id_reserva, rt.nome as 'nomeRestaurante', m.nome as 'nomeMesa', c.nome as 'nomeCliente', tp.nome as 'qntLugares', p.nome as 'nomePeriodo'
                                from tbl_reserva as rs inner join tbl_restaurante as rt on rt.id_restaurante = rs.id_restaurante
                                inner join tbl_periodo as p on p.id_periodo = rs.id_periodo
                                inner join tbl_mesa as m on m.id_mesa = rs.id_mesa
                                inner join tbl_tipomesa as tp on tp.id_tipomesa = m.id_tipomesa
                                inner join tbl_cliente as c on c.id_cliente = rs.id_cliente where rs.id_status = 0";

                                $select = mysql_query($sql) or die(mysql_error());

                                while($rs=mysql_fetch_array($select)){
                                    $idReserva = $rs['id_reserva'];
                            ?>
                                    <div class="conteudo_colunaPoucosCampos">
                                        <?php echo($rs['nomeCliente']); ?>
                                    </div>
                                    <div class="conteudo_coluna">
                                        <?php echo($rs['nomePeriodo']); ?>
                                    </div>
                                    <div class="conteudo_coluna">
                                        <?php echo($rs['nomeMesa']); ?> - <?php echo($rs['qntLugares']); ?> Lugares
                                    </div>
                                    <div class="coluna_3opcoes">
                                        <!--Informações-->
                                        <a href="gerenciamento_reservas.php?id=<?php echo($idReserva); ?>&modo=verInfo">
                                            <div class="opcao_registro">
                                                <div class="imagem_opcao">
                                                    <img src="img/infoIcon.png" alt="" title="Informações">
                                                </div>
                                            </div>
                                        </a>
                                        <!--Aprovar-->
                                        <a href="gerenciamento_reservas.php?id=<?php echo($idReserva); ?>&modo=aprovarReserva">
                                            <div class="opcao_registro">
                                                <div class="imagem_opcao">
                                                    <img src="img/aprovar.png" alt="" title="Aprovar">
                                                </div>
                                            </div>
                                        </a>
                                        <!--Cancelar-->
                                        <a href="gerenciamento_reservas.php?id=<?php echo($idReserva); ?>&modo=cancelarReserva">
                                            <div class="opcao_registro">
                                                <div class="imagem_opcao">
                                                    <img src="img/cancelarIcon.png" alt="" title="Cancelar">
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
                <!--Botão Cadastrar-->
                <a href="ver_reservasAprovadas.php">
                    <button id="botao_verAprovadas">
                        <img src="img/reservaAprovadaIcon.png" alt="" title="Reservas Aprovadas!">
                    </button>
                </a>
            </section>
            <!--Rodapé-->
            <?php include_once('rodape/rodape.php'); ?>
        </div>
    </body>
</html>
