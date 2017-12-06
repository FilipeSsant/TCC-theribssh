<?php

    //Conexão com o banco
    include_once('../conexao/mysql.php');
    //Pega as cores da paleta  de cores no banco
    $sql = "select * from tbl_paletacor where status = 1";

    $select = mysql_query($sql) or die(mysql_error());

    if($rs = mysql_fetch_array($select)){
        $corPrimaria =  $rs['cor_primaria']; /*FRACA*/
        $corSecundaria = $rs['cor_secundaria'];
        $corTerciaria = $rs['cor_terciaria']; /*FORTE*/
        $corQuartenaria = $rs['cor_quartenaria']; /*MEDIANA*/
    }else{
        $corPrimaria = "#462D19"; /*FRACA*/
        $corSecundaria = "#ffffff";
        $corTerciaria = "#553C27"; /*FORTE*/
        $corQuartenaria = "#886B53"; /*MEDIANA*/
    }

    if(isset($_POST['ano'])){
        $contagem = 1;
        $diaDaSemana = "";
        $numMesaReservada = "";

        $idRestaurante = $_POST['idrestaurante'];

        //Comando SQL para pegar a data atual segundo o BD
        $sql = "select curdate() as 'dataAtual'";
        $select = mysql_query( $sql) or die(mysql_error());

        if($rs=mysql_fetch_array($select)){
            $dataAtual = $rs['dataAtual'];
        }

        $dataParte = explode("-", $dataAtual);
        //Ano
        $anoAtual = $dataParte[0];
        //Mês
        $mesAtual = $dataParte[1];
        //Dia
        $diaAtual = $dataParte[2];

        $mesNumerico = $_POST['mesnumerico'];
        $ano = $_POST['ano'];

        //Comando SQL para pegar a semana do div_semana
        $sql = "select weekday('".$ano."-".$mesNumerico."-1') as 'diaSemana'";
        $select = mysql_query( $sql) or die(mysql_error());

        if($rs=mysql_fetch_array($select)){
            $diaDaSemana = $rs['diaSemana'];
        }

        if($diaDaSemana != 6){
            $onclick = "";
            $mesNumericoAnt = "";

            if ($mesNumerico - 1 < 1){
                $mesNumericoAnt = 12;
                $anoAnt = $ano - 1;
            }else{
                $mesNumericoAnt = $mesNumerico - 1;
                $anoAnt = $ano;
            }

            $diasMesAnt = cal_days_in_month(CAL_GREGORIAN, $mesNumericoAnt, $anoAnt);

            $min = $diasMesAnt - ($diaDaSemana);

            while ($min <= $diasMesAnt){

                if ($anoAnt < $anoAtual){
                    $cor = "#d45b5b";
                    $cursor = "not-allowed";
                    $info = "Dia indisponível para a reserva";
                }elseif($anoAnt == $anoAtual){
                    if($mesNumericoAnt < $mesAtual){
                        $cor = "#d45b5b";
                        $cursor = "not-allowed";
                        $info = "Dia indisponível para a reserva";
                    }elseif($mesNumericoAnt == $mesAtual){
                        if($min <= $diasMesAnt){
                            $cor = "#d45b5b";
                            $onclick = "";
                            $cursor = "not-allowed";
                            $info = "Não é possivel fazer a reserva no mesmo dia";
                            if($min == $diaAtual){
                                $cor = "#3e85ce";
                                $onclick = "";
                                $cursor = "not-allowed";
                            }
                        }else{
                            $cor = "$corPrimaria";
                            $info = "";
                        }
                    }else{
                        $cor = "$corPrimaria";
                        $info = "";
                    }
                }else{
                    $cor = "$corPrimaria";
                    $info = "";
                }

                ?>
                <div class="div_dia">
                    <div title="<?php echo($info); ?>" class="dia" style="cursor:<?php echo($cursor); ?>; background-color:<?php echo($cor); ?>; color:<?php echo($corSecundaria); ?>;">
                        <span class="centralizar_texto" ><?php echo($min); ?></span>
                    </div>
                </div>
                <?php

                $min++;

            }
        }

        //Chama a quantidade dias no mes
        $dia = cal_days_in_month(CAL_GREGORIAN, $mesNumerico, $ano);

        while($contagem <= $dia){

            //Comando SQL
            $sql = "select * from tbl_mesa where id_restaurante = ".$idRestaurante;
            $select = mysql_query( $sql) or die(mysql_error());
            $numMesa = mysql_num_rows($select);

            $dataParaInsert = $ano."-".$mesNumerico."-".$contagem;

            //Seleciona na tbl_reserva
            $sql = "select * from tbl_periodorestaurante where id_restaurante =".$idRestaurante;
            $select = mysql_query( $sql) or die(mysql_error());
            while($rs=mysql_fetch_array($select)){
                $idPeriodoRestaurante = $rs['id_periodo'];

                //Seleciona na tbl_reserva
                $sql2 = "select * from tbl_reserva where dataMarcada = '".$dataParaInsert."' and id_restaurante = ".$idRestaurante." and id_periodo = ".$idPeriodoRestaurante.";";
                $select2 = mysql_query( $sql2) or die(mysql_error());
                $numMesaReservada = mysql_num_rows($select2);

            }

            $onclick = "";

            if ($ano < $anoAtual){
                $cor = "#d45b5b";
                $cursor = "not-allowed";
                $info = "Dia indisponível para a reserva";
            }elseif($ano == $anoAtual){
                if($mesNumerico < $mesAtual){
                    $cor = "#d45b5b";
                    $cursor = "not-allowed";
                    $info = "Dia indisponível para a reserva";
                }elseif($mesNumerico == $mesAtual){
                    if($contagem <= $diaAtual){
                        $cor = "#d45b5b";
                        $cursor = "not-allowed";
                        $info = "Dia indisponível para a reserva";
                        if($contagem == $diaAtual){
                            $cor = "#3e85ce";
                            $onclick = "";
                            $cursor = "not-allowed";
                            $info = "Não é possivel fazer a reserva no mesmo dia";
                        }
                    }else{
                        if($numMesa == $numMesaReservada){
                            $cor = "#9b48d0";
                            $onclick = "";
                            $cursor = "not-allowed";
                            $info = "Não há reservas disponiveis!";
                        }else{
                            $cor = "$corPrimaria";
                            $info = "";
                            $cursor = "pointer";
                            $onclick = "onclick='pegarDia(".$contagem.",".$diaAtual."); verificarPeriodoAtivo();'";
                        }
                    }
                }else{
                    if($numMesa == $numMesaReservada){
                        $cor = "#9b48d0";
                        $onclick = "";
                        $cursor = "not-allowed";
                        $info = "Não há reservas disponiveis!";
                    }else{
                        $cor = "$corPrimaria";
                        $info = "";
                        $cursor = "pointer";
                        $onclick = "onclick='pegarDia(".$contagem.",".$diaAtual."); verificarPeriodoAtivo();'";
                    }
                }
            }else{
                if($numMesa == $numMesaReservada){
                    $cor = "#9b48d0";
                    $onclick = "";
                    $cursor = "not-allowed";
                    $info = "Não há reservas disponiveis!";
                }else{
                    $cor = "$corPrimaria";
                    $info = "";
                    $cursor = "pointer";
                    $onclick = "onclick='pegarDia(".$contagem.",".$diaAtual."); verificarPeriodoAtivo();'";
                }
            }


        ?>
        <div class="div_dia">
            <div id="dia<?php echo($contagem)?>" <?php echo($onclick); ?> title="<?php echo($info); ?>" class="dia" style="cursor:<?php echo($cursor); ?>; background-color:<?php echo($cor); ?>; color:<?php echo($corSecundaria); ?>;">
                <span class="centralizar_texto" ><?php echo($contagem); ?></span>
            </div>
        </div>
        <?php
                $contagem++;
        }
    }
?>
