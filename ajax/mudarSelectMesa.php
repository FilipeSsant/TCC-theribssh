<?php

    //Conexão com o banco
    include_once('../conexao/mysql.php');

    $fixo = "";
    $resultado = "";

    if(isset($_POST['periodoselecionado'])){

        if(isset($_POST['datapremarcada'])){
            $periodoSelecionado = $_POST['periodoselecionado'];
            $idRestaurante = $_POST['idrestaurante'];
            $dataPreMarcada = $_POST['datapremarcada'];

            //Seleciona na tbl_reserva
            $sql = "select * from tbl_reserva where dataMarcada = '".$dataPreMarcada."' and id_restaurante = ".$idRestaurante." and id_periodo = ".$periodoSelecionado;
            $select = mysql_query($sql) or die(mysql_error());
            $numeroLinhas = mysql_num_rows($select);

            $contador = 0;
            while($rs=mysql_fetch_array($select)){
                $idMesaReserva[$contador] = $rs['id_mesa'];
                $desabilitandoMesa = "";
                $titleReservado = "";
                $contador++;
            }

            if($numeroLinhas > 0){
                //Seleciona tudo da tbl_mesa
                $sql2 = "select m.id_mesa, m.nome as 'nomeMesa', tp.nome as 'qtdLugares' from tbl_mesa as m
                        inner join tbl_tipomesa as tp on tp.id_tipomesa = m.id_tipomesa
                        where m.id_restaurante = ".$idRestaurante;

                $select2 = mysql_query($sql2) or die(mysql_error());

                while($rs2=mysql_fetch_array($select2)){
                    $idMesa=$rs2['id_mesa'];
                    $quantidadeLugares=$rs2['qtdLugares'];
                    $nomeMesa = $rs2['nomeMesa'];

                    $contador = 0;
                    while($contador <= $numeroLinhas){
                        if($idMesaReserva[$contador] == $idMesa){
                            $desabilitandoMesa = "disabled";
                            $titleReservado = "A mesa já está reservada para este período";
                            break;
                        }else{
                            $desabilitandoMesa = "";
                            $titleReservado = "";
                        }
                        $contador++;
                    }

                    $fixo = "<option selected disabled>Selecione a quantidade de lugares</option>";
                    $resultado = $resultado."<option ".$desabilitandoMesa." title='".$titleReservado."' value='".$idMesa."'>".$quantidadeLugares." Lugares (Mesa ".$nomeMesa.")</option>";
                }
            }

            if($numeroLinhas == 0){
                //Seleciona tudo da tbl_mesa
                $sql = "select m.id_mesa, m.nome as 'nomeMesa', tp.nome as 'qtdLugares' from tbl_mesa as m
                        inner join tbl_tipomesa as tp on tp.id_tipomesa = m.id_tipomesa
                        where m.id_restaurante = ".$idRestaurante;

                $select = mysql_query($sql) or die(mysql_error());

                while($rs=mysql_fetch_array($select)){
                    $idMesa=$rs['id_mesa'];
                    $quantidadeLugares=$rs['qtdLugares'];
                    $nomeMesa = $rs['nomeMesa'];
                    $fixo = "<option selected disabled>Selecione a quantidade de lugares</option>";
                    $resultado = $resultado."<option value='".$idMesa."'>".$quantidadeLugares." Lugares (Mesa ".$nomeMesa.")</option>";
                }
            }
        }
    }

    echo($fixo.$resultado);

?>
