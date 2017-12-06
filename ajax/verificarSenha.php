<?php

    $resultado = "";

    //Verifica as senha e o confirmar dela para ver se tem igualdade
    if(isset($_POST['caixaconfirmarsenha'])){
        //Pega no post as informações da caixa
        $textoSenha = $_POST['caixasenha'];
        $textoConfirmarSenha = $_POST['caixaconfirmarsenha'];
        
            
        if($textoSenha != $textoConfirmarSenha){
            $resultado = "<img src='../img/confSenhaErrada.png' alt='' title='As senhas não estão iguais'>";
        }  
            
    }  

    echo($resultado);
?>