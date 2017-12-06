<?php

    if(isset($_POST['idrestaurante'])){
        
        //Conexão com o banco
        include_once('../conexao/mysql.php');
        
        $idrestaurante = $_POST['idrestaurante'];
        $totalfeedbacks = 0;
        $resultado1 = 0;
        $resultado2 = 0;
        $resultado3 = 0;
        $resultado4 = 0;
        $resultado5 = 0;
        $valor1 = 0;
        $valor2 = 0;
        $valor3 = 0;
        $valor4 = 0;
        $valor5 = 0;
        
        
        //Da um select para pegar o total de feedbacks
        $sql = "select count(*) as 'total' from tbl_feedback as fb
        inner join tbl_pedido as p on p.id_pedido = fb.id_pedido
        inner join tbl_funcionario as f on f.id_funcionario = p.id_funcionario
        where f.id_restaurante = ".$idrestaurante;
        
        $select = mysql_query($sql) or die(mysql_error());
        
        while($rs=mysql_fetch_array($select)){
            $totalfeedbacks = $rs['total'];
        }
        
        //Pega o total de ids na tbl_avaliacao
        $sql = "select id_avaliacao from tbl_avaliacao";
        
        $select = mysql_query($sql) or die(mysql_error());
        
        while($rs=mysql_fetch_array($select)){
            
            $idavaliacao = $rs['id_avaliacao'];
            
            $sql2 = "select count(*) as 'totalindividual' from tbl_feedback as fb
            inner join tbl_pedido as p on p.id_pedido = fb.id_pedido
            inner join tbl_funcionario as f on f.id_funcionario = p.id_funcionario
            where f.id_restaurante = ".$idrestaurante." and fb.id_avaliacao = ".$idavaliacao;
            
            $select2 = mysql_query($sql2) or die(mysql_error());
                        
            while($rs2=mysql_fetch_array($select2)){
                
                if($idavaliacao == 1){
                    $valor1 = $rs2['totalindividual'];
                }elseif($idavaliacao == 2){
                    $valor2 = $rs2['totalindividual'];
                }elseif($idavaliacao == 3){
                    $valor3 = $rs2['totalindividual'];
                }elseif($idavaliacao == 4){
                    $valor4 = $rs2['totalindividual'];
                }elseif($idavaliacao == 5){
                    $valor5 = $rs2['totalindividual'];
                }
            } 
        }
        
        $resultado1 = ($valor1 * 100)/$totalfeedbacks;
        $resultado2 = ($valor2 * 100)/$totalfeedbacks;
        $resultado3 = ($valor3 * 100)/$totalfeedbacks;
        $resultado4 = ($valor4 * 100)/$totalfeedbacks;
        $resultado5 = ($valor5 * 100)/$totalfeedbacks;
    }
    echo($resultado1.",".$resultado2.",".$resultado3.",".$resultado4.",".$resultado5);
?>