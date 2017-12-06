<?php

    //Verifica se a variavel mandada por ajax está disponivel
    if(isset($_POST['textoDigitado'])){
        //Conexão com o banco
        include_once('../conexao/mysql.php');

        //inclui o php Universal que utilizara em todas as páginas
        include_once('../externos/phpUniversal.php');

        $texto = $_POST['textoDigitado'];

        //Comando SQL
        $sql = "select r.id_restaurante, r.nome as 'nomeRestaurante' , r.descricao, r.imagem, r.descricao, ed.logradouro,
                ed.bairro, ed.rua, ed.numero, c.nome as 'nomeCidade', es.nome as 'nomeEstado', p.nome as 'nomePais'
                from tbl_restaurante as r inner join tbl_endereco as ed on r.id_endereco = ed.id_endereco
                inner join tbl_cidade as c on c.id_cidade = ed.id_cidade
                inner join tbl_estado as es on es.id_estado = c.id_estado
                inner join tbl_regiao as reg on reg.id_regiao = es.id_regiao
                inner join tbl_pais as p on p.id_pais = reg.id_pais
                where r.nome like '%".$texto."%' or rua like '%".$texto."%' or bairro like '%".$texto."%' or c.nome like '%".$texto."%' or es.nome like '%".$texto."%' or p.nome like '%".$texto."%'";

        $select = mysql_query($sql) or die(mysql_error());

        while($rs=mysql_fetch_array($select)){
            $idRestaurante = $rs['id_restaurante'];
            $nomeRestaurante = $rs['nomeRestaurante'];
            $descRestaurante = $rs['descricao'];
            $nomeEstado = $rs['nomeEstado'];
            $nomeCidade = $rs['nomeCidade'];
            $bairro = $rs['bairro'];
            $rua = $rs['rua'];
            $numero = $rs['numero'];
            $foto = $rs['imagem'];

            echo("<div class='reserva'>
                <!--Foto do restaurante-->
                <div class='foto_restaurante'>
                    <img src='../cms/".$foto."' alt=''>
                </div>
                <!--Nome do restaurante-->
                <div class='div_nomeEndRestaurante' style='color:".$corSecundaria."'>
                    <!--Nome-->
                    <div class='nome_res' style='background-color:".$corQuartenaria."'>
                        ".$nomeRestaurante."
                    </div>
                    <!--Endereço-->
                    <div class='end_res' style='background-color:'".$corTerciaria."'>
                        ".$nomeEstado." - ".$nomeCidade." - ".$bairro." - ".$rua." - Nº ".$numero."
                    </div>
                </div>
                <!--Descrição do restaurante-->
                <div class='descricao_restaurante' style='background-color:".$corSecundaria."'>
                    <div class='texto_descricaoRes'>
                        <span class='centra_txt'>".$descRestaurante."</span>
                    </div>
                </div>
                <!--Opção fazer Reserva-->
                <div class='div_botaoReserva' style='background-color:".$corPrimaria."'>
                    <!--Botão reservar-->
                    <a class='centralizar_botao' href='home.php?id=".$idRestaurante."&funcao=reservar'>
                        <div class='botao_reservar' style='background-color:".$corQuartenaria."; color:".$corSecundaria."'>
                            <span class='centralizar_texto'>Reservar</span>
                        </div>
                    </a>
                </div>
            </div>");
        }
    }

?>
