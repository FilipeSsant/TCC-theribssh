<?php
  //Verifica a variavel em POST
  if(isset($_POST['idrestaurante'])){
    //Conexão com o banco
    include_once('../conexao/mysql.php');
    //Pega a informação mandada por AJAX
    $idRestaurante = $_POST['idrestaurante'];
    $resultado2 = $idRestaurante;  
    //Comando SQL
    $sql = "select id_cardapio, nome from tbl_cardapio where id_restaurante = ".$idRestaurante;
    $select = mysql_query($sql) or die(mysql_error());
    if($rs = mysql_fetch_array($select)){
      $resultado = $rs['id_cardapio'];
    }
  }

  //Verifica a variavel em POST
  if(isset($_POST['idhrefres'])){
    //Conexão com o banco
    include_once('../conexao/mysql.php');
    //Pega a informação mandada por AJAX
    $idRestaurante = $_POST['idhrefres'];
    $resultado2 = $idRestaurante;  
    //Comando SQL
    $sql = "select id_cardapio, nome from tbl_cardapio where id_restaurante = ".$idRestaurante;
    $select = mysql_query($sql) or die(mysql_error()); 
    if($rs = mysql_fetch_array($select)){
      $resultado = $rs['id_cardapio'];
    }
  }

  echo($resultado.",".$resultado2);
?>
