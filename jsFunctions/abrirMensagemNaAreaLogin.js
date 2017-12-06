//Aparece Mensagem ao passar o mouse no botão na area de Login
function aparecerMensagemLoginFuncionario(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#textoBotao_mudancaLoginFuncionario').css({"width":"130px"});
}

//Desaparece a mensagem ao passar o mouse no botão na area de Login
function desaparecerMensagemLoginFuncionario(){
    //Após o $ é o id ou a classe na qual se deseja implementar uma função css
    //No .css é implementada o comando css dentro do {}
    $('#textoBotao_mudancaLoginFuncionario').css({"width":"0px"});
}
