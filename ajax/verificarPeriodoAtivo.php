<?php
    //Conexão com o banco
    include_once('../conexao/mysql.php');

    $fixo = "";
    $resultado = "";

    if(isset($_POST['idrestaurante'])){
        if(isset($_POST['datapremarcada'])){

            $idRestaurante = $_POST['idrestaurante'];
            $dataPreMarcada = $_POST['datapremarcada'];

            //Comando SQL
            $sql = "select * from tbl_mesa where id_restaurante = ".$idRestaurante;
            $select = mysql_query($sql) or die(mysql_error());
            $numMesa = mysql_num_rows($select);
            $numMesaReservada = "";


            //Seleciona na tbl_reserva
            $sql = "select * from tbl_periodorestaurante where id_restaurante =".$idRestaurante;
            $select = mysql_query($sql) or die(mysql_error());
            while($rs=mysql_fetch_array($select)){
                $idPeriodoRestaurante = $rs['id_periodo'];

                //Seleciona na tbl_reserva
                $sql2 = "select * from tbl_reserva where dataMarcada = '".$dataPreMarcada."' and id_restaurante = ".$idRestaurante." and id_periodo = ".$idPeriodoRestaurante.";";
                echo($sql2);
                $select2 = mysql_query($sql2) or die(mysql_error());
                $numMesaReservada = mysql_num_rows($select2);

            }

            if($numMesaReservada == $numMesa){
                //Seleciona tudo da tbl_periodo
                $sql3 = "select p.id_periodo, p.nome, p.horario_inicial, p.horario_final from tbl_periodo as p
                        inner join tbl_periodorestaurante as pr on pr.id_periodo = p.id_periodo
                        where pr.id_restaurante = ".$idRestaurante;

                $select3 = mysql_query($sql3) or die(mysql_error());

                while($rs3=mysql_fetch_array($select3)){
                    $idPeriodo=$rs3['id_periodo'];
                    $nomePeriodo=$rs3['nome'];
                    $horario_inicial =$rs3['horario_inicial'];
                    $horario_final=$rs3['horario_final'];

                    if($idPeriodo == $idPeriodoRestaurante){
                        $desabilitandoMesa = "disabled";
                        $titleReservado = "Não há como mais fazer reserva nesse período";
                    }

                    $fixo = "<option selected disabled>Selecione um Período</option>";
                    $resultado = $resultado."<option ".$desabilitandoMesa." title='".$titleReservado."' value='".$idPeriodo."'>".$nomePeriodo." (".$horario_inicial." - ".$horario_final.")</option>";
                }
            }else{
                //Seleciona tudo da tbl_periodo
                $sql3 = "select p.id_periodo, p.nome, p.horario_inicial, p.horario_final from tbl_periodo as p
                        inner join tbl_periodorestaurante as pr on pr.id_periodo = p.id_periodo
                        where pr.id_restaurante = ".$idRestaurante;

                $select3 = mysql_query($sql3) or die(mysql_error());

                while($rs3=mysql_fetch_array($select3)){
                    $idPeriodo=$rs3['id_periodo'];
                    $nomePeriodo=$rs3['nome'];
                    $horario_inicial =$rs3['horario_inicial'];
                    $horario_final=$rs3['horario_final'];

                    $fixo = "<option selected disabled>Selecione um Período</option>";
                    $resultado = $resultado."<option value='".$idPeriodo."'>".$nomePeriodo." (".$horario_inicial." - ".$horario_final.")</option>";
                }
            }


        }
    }

    echo($fixo.$resultado);
?>
