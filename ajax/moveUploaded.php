<?php
    //Guarda a pasta de destino em uma variavel
    $uploaddir1 = "../cms/arquivos/foto_restaurante/";

    //Pega o nome das fotos enviadas e guarda em uma variavel
    //usando o comando strtolower para deixar o nome da imagem/video minusculo.
    $arquivo1 = strtolower(basename($_FILES['fileres']['name']));

    //Salva numa variavel que junta a pasta de destino com o nome do arquivo
    $uploadfile1 = $uploaddir1.$arquivo1;

    if(move_uploaded_file($_FILES['fileres']['tmp_name'], $uploadfile1)){
    }else{
    }

    //Guarda a pasta de destino em uma variavel
    $uploaddir2 = "../cms/arquivos/logo_banco/";

    //Pega o nome das fotos enviadas e guarda em uma variavel
    //usando o comando strtolower para deixar o nome da imagem/video minusculo.
    $arquivo2 = strtolower(basename($_FILES['fileban']['name']));

    //Salva numa variavel que junta a pasta de destino com o nome do arquivo
    $uploadfile2 = $uploaddir2.$arquivo2;

    if(move_uploaded_file($_FILES['fileban']['tmp_name'], $uploadfile2)){
    }else{
    }

    //Guarda a pasta de destino em uma variavel
    $uploaddir3 = "../cms/arquivos/foto_perfilFuncionario/";

    //Pega o nome das fotos enviadas e guarda em uma variavel
    //usando o comando strtolower para deixar o nome da imagem/video minusculo.
    $arquivo3 = strtolower(basename($_FILES['filefun']['name']));

    //Salva numa variavel que junta a pasta de destino com o nome do arquivo
    $uploadfile3 = $uploaddir3.$arquivo3;

    if(move_uploaded_file($_FILES['filefun']['tmp_name'], $uploadfile3)){
    }else{
    }

?>