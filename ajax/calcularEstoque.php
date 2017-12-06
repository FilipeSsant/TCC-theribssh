<?php

    //Conexão com o banco
    include_once('../conexao/mysql.php');

    if(isset($_POST['id_estoque'])){

        $idestoque = $_POST['id_estoque'];   
        $resultado = "";

        $sql = "select i.id_ingrediente, i.nome as 'nomeingrediente', tu.sigla as 'siglaatual', mp.quantidade as 'quantidadeatual' from tbl_materiaprima as mp
        inner join tbl_ingrediente as i on i.id_ingrediente = mp.id_ingrediente
        inner join tbl_tipounit as tu on tu.id_tipounit = mp.id_tipounit where mp.id_estoque = ".$idestoque;

        $select = mysql_query($sql) or die(mysql_error());

        while($rs=mysql_fetch_array($select)){

            $nomeingrediente = $rs['nomeingrediente'];
            $idingrediente = $rs['id_ingrediente'];
            $siglaatual = $rs['siglaatual'];
            $quantidadeatual = $rs['quantidadeatual'];
            $sigla = "";
            $estoqueminimo = 0;

            $sql2 = "select i.nome as 'nomeingrediente', ip.quantidade, tu.sigla, tu.nome as 'nometipo' from tbl_materiaprima as mp 
            inner join tbl_ingrediente as i on i.id_ingrediente = mp.id_ingrediente 
            inner join tbl_ingredienteproduto as ip on ip.id_ingrediente = mp.id_ingrediente 
            inner join tbl_pedidoproduto as pp on pp.id_produto = ip.id_produto 
            inner join tbl_tipounit as tu on tu.id_tipounit = ip.id_tipounit 
            where mp.id_estoque = ".$idestoque." and mp.id_ingrediente = ".$idingrediente;

            $select2 = mysql_query($sql2);

            while($rs2=mysql_fetch_array($select2)){

                $quantidade = $rs2['quantidade'];
                $sigla = $rs2['sigla'];
                $nometipounit = $rs2['nometipo'];
                $resultadofloat = 0;
                $resultadoint = 0;

                if(($sigla == "g") || ($sigla == "mL")){
                    if($sigla == "g"){
                        $sigla = "kg";
                    }elseif($sigla == "mL"){
                        $sigla = "L";    
                    }
                    
                    $resultadofloat = $resultadofloat + $quantidade/1000;
                }elseif(($sigla == "L") || ($sigla == "kg") || ($nometipounit == "Unidade")){
                    $resultadoint = $resultadoint + $quantidade;
                }

                $qntfinal = $resultadoint + $resultadofloat;

                //Estoque de segurança
                $estoqueminimo = $qntfinal * 3;

            }
            

            $resultado = $resultado."<div class='conteudo_colunaEstoque'> ".$nomeingrediente."</div> 
                                    <div class='conteudo_colunaEstoqueNum'> ".$estoqueminimo.$sigla."</div>
                                    <div class='conteudo_colunaEstoqueNum'> ".$quantidadeatual.$siglaatual."</div>";


        }
    }  
    echo($resultado);  


?>