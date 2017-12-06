//Abre um popUp que mostra o que o usuário pode fazer
function abrirDetalhesUser(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#informacoes_usuario').css({"display":"block","z-index":"102"});
    $('#ponta_divInfoUsuario').css({"display":"block","z-index":"102"});
}
//Fecha o popup
function fecharDetalhesUser(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#informacoes_usuario').css({"display":"none","z-index":"0"});
    $('#ponta_divInfoUsuario').css({"display":"none","z-index":"0"});
}
