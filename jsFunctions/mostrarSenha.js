//Revela a Senha no pressionar no ícone
function textSenha(){
    //Faz um callback do valor que está dentro da caixa de texto (no caso a senha) que está em password
    //Para depois alterar o seu type para text
    $('input[name=txt_senha]').attr("type","text");
}

//Volta ao password a Senha no soltar do ícone
function passwordSenha(){
    //Faz um callback do valor que está dentro da caixa de texto (no caso a senha) que está em text
    //Para depois alterar o seu type para password novamente
    $('input[name=txt_senha]').attr("type","password");
}
