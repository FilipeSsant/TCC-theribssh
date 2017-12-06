<?php
  //Verifica a variavel em POST
  if(isset($_POST['verificado'])){
    $resultado = 'block';
  }else{
    $resultado = 'none';
  }
  echo($resultado);
?>
