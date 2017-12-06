//Abre Janela Informativa com detalhes sobre determinado item caso haja alguma dúvida
function abrirJanelaInformativa(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('.div_informativa').css({"opacity":"1"});
}

//Fecha Janela Informativa com detalhes sobre determinado item caso haja alguma dúvida
function fecharJanelaInformativa(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('.div_informativa').css({"opacity":"0"});
}
