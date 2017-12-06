<?php

    //If para ver se existe um modo no href
    if(isset($_GET['modo'])){
        
        $url = $_SERVER['REQUEST_URI'];
        $urlSemBarra = explode('/', $url);
        $urlSemPontInterrogacao = explode('?', $urlSemBarra[3]);
        $urlDefinitiva = $urlSemPontInterrogacao[0];
        
        $modo = $_GET['modo'];
        $id = $_GET['id'];

        //Switch para ver as condições do modo no href
        switch($modo){
            case 'verInfo':

                //Comando SQL
                $sql = "select rs.id_reserva, rt.nome as 'nomeRestaurante', m.nome as 'nomeMesa', c.nome as                 'nomeCliente', c.celular, c.telefone, c.email, tp.nome as 'qntLugares', p.nome as 'nomePeriodo',         p.horario_inicial, p.horario_final, rs.dataMarcada
                    from tbl_reserva as rs inner join tbl_restaurante as rt on rt.id_restaurante = rs.id_restaurante
                    inner join tbl_periodo as p on p.id_periodo = rs.id_periodo
                    inner join tbl_mesa as m on m.id_mesa = rs.id_mesa
                    inner join tbl_tipomesa as tp on tp.id_tipomesa = m.id_tipomesa
                    inner join tbl_cliente as c on c.id_cliente = rs.id_cliente where rs.id_reserva = ".$id;

                $select = mysql_query($sql) or die(mysql_error());

                if($rs=mysql_fetch_array($select)){
                    $nomeCliente = $rs['nomeCliente'];
                    $emailCliente = $rs['email'];
                    $telefoneCliente = $rs['telefone'];
                    $celularCliente = $rs['celular'];
                    $nomeRestaurante = $rs['nomeRestaurante'];
                    $nomeMesa = $rs['nomeMesa'];
                    $qntLugares = $rs['qntLugares'];
                    $nomePeriodo = $rs['nomePeriodo'];
                    $horarioInicial = $rs['horario_inicial'];
                    $horarioFinal = $rs['horario_final'];
                    $dataMarcada = $rs['dataMarcada'];

                    $partesData = explode("-", $dataMarcada);
                    //Ano
                    $ano = $partesData[0];
                    //Mes
                    $mes = $partesData[1];
                    //Dia
                    $dia = $partesData[2];

                    $dataFormatoBR = $dia."/".$mes."/".$ano;
                }

                break;
        }

    }

?>
<!--Div de Cadastro-->
<div id="div_foraCadastro">
    <!--Botão fechar-->
    <a href="<?php echo($urlDefinitiva); ?>">
        <div class="botao_fecharPopUp" onClick="fecharPopUp(), normalizarFooter()">
            <img src="img/fecharPopUp.png" alt="">
        </div>
    </a>    
    <!--Div de Login-->
    <div id="div_cadastro">
        <!--Título div Cadastro-->
        <div class="titulo_loginCadastro">
            <!--Linha atras do Titulo-->
            <div class="linha_atrasDoTitulo">
            </div>
            <!--Texto do Título-->
            <div class="div_tituloCadastro">
                <span>Informações do Usuário/Reserva</span>
            </div>
        </div>
        <!--Formulário de preenchimento para Login-->
        <div id="div_informacoes">
            <!--Nome do cliente-->
            <div class="titulo_popCadastro">
                Nome do Cliente
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($nomeCliente); ?>
            </div>
            <!--Celular-->
            <div class="titulo_popCadastro">
                Celular
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($celularCliente); ?>
            </div>
            <!--Telefone-->
            <div class="titulo_popCadastro">
                Telefone
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($telefoneCliente); ?>
            </div>
            <!--E-mail-->
            <div class="titulo_popCadastro">
                E-mail
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($emailCliente); ?>
            </div>
            <!--Restaurante em que foi reservado-->
            <div class="titulo_popCadastro">
                Restaurante em que foi reservado
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($nomeRestaurante); ?>
            </div>
            <!--Período-->
            <div class="titulo_popCadastro">
                Período
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($nomePeriodo); ?> (<?php echo($horarioInicial); ?> - <?php echo($horarioFinal); ?>)
            </div>
            <!--Horário em que foi reservado-->
            <div class="titulo_popCadastro">
                Horário em que foi reservado
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($dataFormatoBR); ?>
            </div>
            <!--Mesa-->
            <div class="titulo_popCadastro">
                Mesa
            </div>
            <!--Caixa com conteúdo-->
            <div class="conteudo_popCadastro">
                <?php echo($rs['nomeMesa']); ?> - <?php echo($rs['qntLugares']); ?> Lugares
            </div>
        </div>
    </div>
</div>
