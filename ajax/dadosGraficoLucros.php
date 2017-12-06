<?php

    if(isset($_POST['idrestaurante'])){
        
        //Conexão com o banco
        include_once('../conexao/mysql.php');
        
        $idrestaurante = $_POST['idrestaurante'];
        $lucro = "";
        $prejuizo = "";
        
        $sql = "select prod.nome, prod.preco from tbl_pedido as ped
        inner join tbl_funcionario as fun on fun.id_funcionario = ped.id_funcionario
        inner join tbl_restaurante as r on r.id_restaurante = fun.id_restaurante
        inner join tbl_pedidoproduto as pp on pp.id_pedido = ped.id_pedido
        inner join tbl_produto as prod on prod.id_produto = pp.id_produto
        where r.id_restaurante = ".$idrestaurante;
        
        $select = mysql_query($sql);
        
        while($rs=mysql_fetch_array($select)){
            
            $precoProduto = $rs['preco'];
            
            $lucro = $lucro + $precoProduto;
            
        }
        
        $sql = "select ing.nome, mp.quantidade, pc.precounitario, (mp.quantidade * pc.precounitario) as 'precototal' 
        from tbl_fornecedor as forn
        inner join tbl_pedidocompra as pc on pc.id_fornecedor = forn.id_fornecedor
        inner join tbl_materiaprima as mp on mp.id_pedidocompra = pc.id_pedidocompra
        inner join tbl_estoque as est on est.id_estoque = mp.id_estoque
        inner join tbl_ingrediente as ing on ing.id_ingrediente = mp.id_ingrediente
        where pc.status = 1 and est.id_restaurante = ".$idrestaurante;
        
        $select = mysql_query($sql);
        
        while($rs=mysql_fetch_array($select)){
            
            $precoTotalPorProduto = $rs['precototal'];
            
            $prejuizo = $prejuizo + $precoTotalPorProduto;
            
        }
        
        
    }
    echo($lucro."|".$prejuizo);
?>