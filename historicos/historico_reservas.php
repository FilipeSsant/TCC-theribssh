<?php

    session_start();

    //Conexão com o banco
    include_once('../conexao/mysql.php');

    //inclui o php Universal que utilizara em todas as páginas
    include_once('../externos/phpUniversal.php');

    //If para verificar se o usuário tem uma sessão
    if(isset($_SESSION['id_cliente'])){

    }else{
        header('location:../home/home.php');
    }

    //Retirando possiveis erros de variaveis vazias
    $corStatus = "";
    $dataMarcada = "";
    $partesData = "";
    $dataFormatoBR = "";
    $status = "";
    $textoStatus = "";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>The Ribs Steakhouse</title>
        <link rel="stylesheet" href="../css/historico_reservas.css">
        <link rel="stylesheet" href="../css/cssUniversal.css">
        <link href="fontes/openSans" rel="stylesheet">
        <link rel="icon" href="../icon.png" type="image/x-icon" />
        <link rel="shortcut icon" href="../icon.png" type="image/x-icon" />
        <script type="text/javascript" src="../jquery/jquery-2.2.4.js" ></script>
        <script type="text/javascript" src="../jquery/jquerymaskplugin.js" ></script>
        <!--Script de Máscaras-->
        <script>
            //Máscaras
            <?php include_once('../jsFunctions/mascaraLoginCadastro.js')?>
        </script>
        <!--Script Funções-->
		<script>
            //Inclui o pop up do cadastro e do login
            <?php include_once('../jsFunctions/popup.js')?>
            //Inclui a função de mostrar a senha caso o usuario pressione o botão
            <?php include_once('../jsFunctions/mostrarSenha.js')?>
            //Inclui a janelinha informativa caso o usuário tenha alguma duvida
            //Passando o mouse por cima da figura e assim aparecendo a explicação
            <?php include_once('../jsFunctions/janelaInformativa.js')?>
            //Inclui o Scroll do cabeçalho
            <?php include_once('../jsFunctions/cabecalho_scroll.js');?>
		</script>
    </head>
    <body style="background-color:<?php echo($corSecundaria); ?>">
        <div id="esqueleto">
            <!--Cabeçalho-->
            <?php
                //Inclui o cabeçalho para a página
                include_once('../cabecalho/cabecalho.php');
            ?>
            <!--Corpo-->
            <section>
                <h6>The Ribs Steakhouse - Meu Perfil - Histórico de Reservas</h6>
                <!--Div do Título do Restaurante-->
                <div class="div_titulo" style="background-color:<?php echo($corSecundaria); ?>; border-top:20px solid <?php echo($corSecundaria)?>;">
                    <!--Titulo-->
                    <div class="titulo">
                        <span style="color:<?php echo($corPrimaria); ?>">Histórico de Reservas</span>
                    </div>
                </div>
                <div class="informacoes_historico" style="border-left:1px solid <?php echo($corPrimaria); ?>; border-right:1px solid <?php echo($corPrimaria); ?>; border-bottom:1px solid <?php echo($corPrimaria); ?>;">
                    <div class="informacoes_primeira_linha" style="background-color:<?php echo($corPrimaria); ?>;">
                        <div class="restaurante_data_periodo">
                            <span style="color:<?php echo($corSecundaria); ?>">Mesa</span>
                        </div>
                        <div class="reserva">
                            <span style="color:<?php echo($corSecundaria); ?>"> Local da Reserva</span>
                        </div>
                        <div class="restaurante_data_periodo">
                            <span style="color:<?php echo($corSecundaria); ?>">Data da Reserva</span>
                        </div>
                        <div class="restaurante_data_periodo">
                            <span style="color:<?php echo($corSecundaria); ?>">Período</span>
                        </div>
                    </div>
                    <?php

                        //Comando SQL
                        $sql = "select rs.id_reserva, rt.nome as 'nomeRestaurante', rs.id_status, rt.descricao, m.nome as 'nomeMesa', tp.nome as 'qntLugares', rs.dataMarcada, p.nome as 'nomePeriodo'
                        from tbl_reserva as rs inner join tbl_restaurante as rt on rt.id_restaurante = rs.id_restaurante
                        inner join tbl_periodo as p on p.id_periodo = rs.id_periodo
                        inner join tbl_mesa as m on m.id_mesa = rs.id_mesa
                        inner join tbl_tipomesa as tp on tp.id_tipomesa = m.id_tipomesa where rs.id_cliente = ".$_SESSION['id_cliente'];

                        $select = mysql_query($sql) or die(mysql_error());

                        while($rs=mysql_fetch_array($select)){
                            $dataMarcada = $rs['dataMarcada'];
                            $partesData = explode("-", $dataMarcada);
                            //Ano
                            $ano = $partesData[0];
                            //Mes
                            $mes = $partesData[1];
                            //Dia
                            $dia = $partesData[2];

                            $dataFormatoBR = $dia."/".$mes."/".$ano;

                            $status = $rs['id_status'];

                            if($status == 0){
                                $textoStatus = "Reserva em andamento...";
                                $imgStatus = "aguardarIcon.png";
                            }elseif($status == 1){
                                $textoStatus = "Reserva Aprovada!";
                                $imgStatus = "aprovadoIcon.png";
                            }elseif($status == 2){
                                $textoStatus = "Reserva Cancelada.";
                                $imgStatus = "canceladoIcon.png";
                            }

                    ?>
                    <div class="informacoes_segunda_linha">
                        <div class="info_data_periodo">
                            <span class="centralizar_txt" style="color:<?php echo($corPrimaria); ?>"><?php echo($rs['nomeMesa']); ?> - <?php echo($rs['qntLugares']); ?> Lugares</span>
                        </div>
                        <div class="info_reserva">
                            <div class="nome_restaurante" style="border-bottom:1px solid <?php echo($corPrimaria)?>;">
                                <span style="color:<?php echo($corPrimaria); ?>"><?php echo($rs['nomeRestaurante']); ?></span>
                            </div>
                            <div class="informacoes_restaurante">
                                <span style="color:<?php echo($corPrimaria); ?>"><?php echo($rs['descricao']); ?></span>
                            </div>
                        </div>
                        <div class="info_data_periodo">
                            <span class="centralizar_txt" style="color:<?php echo($corPrimaria); ?>"><?php echo($dataFormatoBR); ?></span>
                        </div>
                        <div class="info_data_periodo">
                            <span class="centralizar_txt" style="color:<?php echo($corPrimaria); ?>"><?php echo($rs['nomePeriodo']); ?></span>
                        </div>
                    </div>
                    <div class="status_reserva" title="<?php echo($textoStatus); ?>">
                        <img src="../img/<?php echo($imgStatus); ?>" alt=""/>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </section>
            <!--Rodapé-->
            <?php
                //Inclui o rodapé para a página
                include_once('../rodape/rodape.php');
            ?>
        </div>
    </body>
</html>
