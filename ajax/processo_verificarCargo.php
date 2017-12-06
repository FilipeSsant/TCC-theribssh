<?php
  //Verifica a variavel em POST
  if(isset($_POST['idcargoajax'])){
    //Conexão com o banco
    include_once('../conexao/mysql.php');
    //Pega a informação mandada por AJAX
    $idCargo = $_POST['idcargoajax'];
    //Comando SQL
    $sql = "select * from tbl_cargo where id_cargo = ".$idCargo;
    $select = mysql_query($sql) or die(mysql_error());
    while ($rs = mysql_fetch_array($select)){
      if($rs['nome'] == 'Garçom'){
          $resultado = 'block';
      }else{
          $resultado = 'none';
      }
    }
  }

  echo($resultado);
?>
