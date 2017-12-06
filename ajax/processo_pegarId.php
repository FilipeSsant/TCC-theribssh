<?php
  $resultado = "<option selected disabled>Selecione uma Cidade</option>";
  //Verifica a variavel em POST
  if(isset($_POST['idestadoajax'])){
    //Conexão com o banco
    include_once('../conexao/mysql.php');
    //Pega a informação mandada por AJAX
    $idEstado = $_POST['idestadoajax'];

    //Comando SQL
    $sql = "select * from tbl_cidade where id_estado = ".$idEstado;
    $select = mysql_query($sql) or die(mysql_error());
    while ($rs = mysql_fetch_array($select)){
      $idCidade = $rs["id_cidade"];
      $nomeCidade = $rs["nome"];

      $resultado = $resultado."<option value='".$idCidade."'>".$nomeCidade."</option>";
    }
  }

  echo($resultado);
?>
